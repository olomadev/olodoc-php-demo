
## Yetkilendirme (Authorization)

Birçok yönetim paneli uygulamasında bazı alanları sınırlamak için farklı rollere veya izinlere sahip kullanıcılara ihtiyacınız olacaktır. Olobase Admin bu özelliği birkaç düzeyde destekler.

### Arka Uç Önceliği

> Yetkilendirme ile burada kastedilen; yalnızca bağlantıları, eylemleri, kullanıcı arayüzü bileşenlerini görüntülemek veya gizlemek ile ilgilidir. Herhangi bir kullanıcının Admin yöneticisi olması durumunda kullanıcı arayüzüne tamamen erişebileceğini her zaman göz önünde bulundurmalısınız. Tarayıcı konsoluna yazılacak bazı javascript komutları ile de tüm kullanıcı arayüzünün kilidi açılabilir. Bu nedenle, herhangi bir kullanıcı arayüzü endişesinden önce her zaman arka uçtaki izinlerin güvenliğine öncelik vermelisiniz.

### Kullanıcıya ait yetkileri alın

Devam etmeden önce bu kılavuzun ilgili <a href="/ui/authentication.html">kimlik doğrulama</a> bölümüne göz atmış olmanız tavsiye edilir. Bahsedilen bölüm kullanıcı kimlik doğrulaması ve kullanıcı bilgilerinin alınması hakkında bilmeniz gereken her şeyi içerir.

Kimlik doğrulama kılavuzunda gördüğünüz gibi her kimlik doğrulama sağlayıcısının belirli bir <b>getPermissions()</b> yöntemi uygulaması gerekir. Bu rol, <b>checkAuth()</b> sağlayıcı yöntemi aracılığıyla API tarafından döndürülen geçerli bir kullanıcı nesnesinden izinleri alır. Bu izinler <b>array</b> dizisi olarak döner. Yetkiler <kbd>create_book</kbd> gibi düşük seviyeli özel bir izinden <kbd>editor</kbd> olarak daha genel bir role kadar istediğiniz herhangi bir şey olabilir. İhtiyacınız olan uygun ayrıntı düzeyini bulmak size kalmış. Örneğin, genel rol tabanlı olarak <kbd>["editor", "author"]</kbd> veya daha ayrıntılı izin tabanlı olarak <kbd>["list_author", "show_author", "list_book", "show_book", "create_book"]</kbd> gibi hayal edebiliriz.

### Kaynaklar

Her kaynağın her eylemi için belirli erişim izinleri tanımlayabilirsiniz. Bu izinler uygulamanın tamamına yansıtılır. Özellikle <b>getResourceLink()</b> yardımcısı kaynağa özel menülerin yanı sıra, ilgili kaynağa bağlı tüm <b>CRUD</b> eylem tuşlarını gizler veya gösterir. Bunun için ilgili kaynak nesnesine yeni bir izin tanımlamanız yeterlidir:

<kbd>src/resources/index.js</kbd>

```js
export default [
  {
    name: "reviews",
    icon: "mdi-comment",
    permissions: [
      { name: "admin", actions: ["list", "show", "create", "edit", "delete"] },
      { name: "editor", actions: ["list", "show", "edit"] },
      { name: "author", actions: ["list", "show", "edit", "delete"] },
    ],
  },
]
```

<b>Permissions</b> özelliği basit bir dize veya nesne dizisidir. Bu iznin tüm eylemlere uygulanmasını istiyorsanız basit dize kullanın. Nesne biçimi, kaynakların her eylemi için daha ayrıntılı izin tanımlamanıza olanak tanır. Kullanıcı bu izne sahip olduğunda izin adı için <kbd>name</kbd> ve izin verilen eylemlerin  listesi için <kbd>actions</kbd> kullanmanız yeterlidir.

### Varsayılan Davranış

Varsayılan olarak, hiçbir izin ayarlanmadıysa kimliği doğrulanmış tüm kullanıcılar bu kaynağın tüm işlemlerine erişebilir.

### Hariç Tutulan Eylemler

Genel işlemler <kbd>actions</kbd> veya istisna <kbd>except</kbd> özellikleri, yalnızca hariç tutulan işlemler için <kbd>permissions</kbd> seçeneğine göre önceliklendirilir. Dolayısıyla, eylemleri veya hariç özellikleri kullanırsanız, hariç tutulan eylemlere yönelik belirli izinlerin hiçbir etkisi olmayacaktır.

### Gelişmiş Kullanım

Yukarıdaki kaynak izin API'sinin sizin için yeterli olmaması durumunda, yine de Olobase Admin seçeneklerine belirli bir <kbd>canAction</kbd> fonksiyonu iletebilirsiniz; bu, izin eylemi filtrelemesi için daha fazla kontrole sahip olmanızı sağlar. Kullanıcı izinlerine göre aktif olması gerekip gerekmediğini bilmek için her kaynak bağlantısında (admin.getResourceLink veya admin.getResourceLinks kullanıyorsanız) veya herhangi bir kaynak CRUD eylem tuşunda yürütülür.

Bu özelleştirilebilir fonksiyon, 3 özelliğe sahip bir <kbd>params</kbd> nesnesini alır:

<div class="table-responsive">
<table class="table">
	<tr>
		<th>Argüman</th>
		<th>Açıklama</th>
	</tr>
	<tr>
		<td><b>resource</b></td>
		<td>İlgili kaynağın adı</td>
	</tr>
	<tr>
		<td><b>action</b></td>
		<td>İstenen eylem</td>
	</tr>
	<tr>
		<td><b>can</b></td>
		<td>Kimliği doğrulanmış kullanıcıdan doğrudan izin alma olanağı sağlayan bir yardımcı işlev</td>
	</tr>
</table>
</div>

<kbd>src/plugins/admin.js</kbd>

```js [line-numbers] data-line="11"
import OlobaseAdmin from "olobase-admin";
//...
let admin = new OlobaseAdmin(import.meta.env);
/**
 * Install admin plugin
 */
export default {
  install: (app, http, resources) => {
    admin.setOptions({
	  //...
	  canAction: ({ resource, action, can }) => {
	    if (can(["admin"])) {
	      return true;
	    }
	    // any other custom actions on given resource and action...
	  },
	  //...
    });
    admin.init();
    OlobaseAdmin.install(app); // install layouts & components
  },
};
```

### Geçersiz Kılma (Overriding) veya Varsayılan

Eğer geri çağırma geçerli bir <b>boolean</b> değeri döndürürse, ilgili kaynakta belirlenen izin değeri ne olursa olsun eylem geçerli olarak kabul edilecektir. Hiçbir şey döndürülmezse varsayılan davranış yürütülür.

### Yardımcılar

Olobase Admin size, mevcut kullanıcının yeteneklere sahip olup olmadığını hızlı bir şekilde test etmenize olanak tanıyan, her yerde kullanabileceğiniz global bir <kbd>admin.can()</kbd> yardımcı metodu sunar. Kimliği doğrulanmış kullanıcı bunlardan birine sahipse, test etmek ve true değerini döndürmek istediğiniz izinlerin listesi olan bir <b>array</b> dizeyi alır.

```html
<template>
  <va-form :id="id" :item="item">
    <va-text-input source="isbn" v-if="admin.can(['isbn_edit'])"></va-text-input>
  </va-form>
</template>
```

```js
<script>
export default {
  inject: ['admin'],
  method() {
    onSubmit() {
      if (this.admin.can(["book_edit"])) {

      }
    },
  },
};
</script>
```

### OR ve && Durumları

Takip eden örnekte olduğu gibi <kbd>||</kbd> ve <kbd>&&</kbd> kombinasyonlarını kullanarak, kenar çubuğundaki bağlantıları izinlere göre dizinin içinde kolayca gizlemek veya göstermek için kullanabilirsiniz:

<kbd>src/\_nav.js</kbd>

```js
export default  {

  build: async function(t, admin) {

    const user = await admin.can(["user"]);
    const adminUser = await admin.can(["user", "admin"]);

    return [
      {
        icon: "mdi-view-dashboard",
        text: i18n.t("menu.dashboard"),
        link: "/",
      },
      ...admin.getResourceLinks(["publishers", "authors", "books", "reviews"]),
      adminUser.can(["admin"]) && {
        icon: "mdi-settings",
        text: i18n.t("menu.settings"),
        link: "/settings",
      },
      (user || adminUser.can(["admin", "editor"])) && {
        icon: "mdi-message",
        text: i18n.t("menu.feedback"),
        link: "/feedback",
      },
      { icon: "mdi-help-circle", text: i18n.t("menu.help"), link: "/help" },
    ];

  } // end func

} // end class
```