
## Veri Sağlayıcıları

Olobase Admin'nin temel amacı, uzak kaynakları belirli bir API'den yönetmektir. Herhangi bir standartlaştırılmış CRUD işlemi için arka uç API'niz ile iletişim kurması gerektiğinde, sağlayıcınızda kaynak verilerinin getirilmesinden veya güncellenmesinden sorumlu olacak uyarlanmış yöntemi çağırır.

```html
- packages
	- admin
		- providers
			- data
				jsonServer.js
```

<tab>
<title>List|Create|Update|Delete</title>
<content>

```js
// Fetching books
let { data, total } = await provider.getList("books", { page: 1, perPage: 10 });
console.log(data);

// Fetching one book
let { data } = await provider.getOne("books", { id: 1 });
console.log(book)
```
<tcol>

```js
// Create new book
await provider.create("books", { data: { title: "My title" } })
```
<tcol>

```js
// Update title book
await provider.update("books", { id: book.id, data: { title: "New title" } });
```
<tcol>

```js
// Delete book
await provider.delete("books", { id: book.id });
```
</content>
</tab>

Olobase Admin'in herhangi bir API sunucusuyla uyumluluğunu sağlamak için bir veri sağlayıcının tüm getirme yöntemleri standartlaştırılmıştır. Bu, REST, GraphQL ve hatta SOAP olsun, herhangi bir değişim protokolünün her bir arka uç türü için her türden farklı sağlayıcıya izin veren adaptör modelidir.

![Data Providers](/images/data-providers.jpg)

Olobase Admin'e uzak kaynak verilerini alma yeteneği kazandırmak için, sonraki bölümde açıklandığı gibi constructor metoduna belirli bir veri sağlayıcıyı enjekte edilmesi gerekir. Bu veri sağlayıcı varsayılan olarak <kbd>JsonServerProvider</kbd> sağlayıcısıdır.

### API Kontratı

Herhangi bir bağdaştırıcı modeli yaklaşımında her zaman olduğu gibi, Olobase Admin ile iletişime izin vermek için tüm veri sağlayıcılarının belirli bir sözleşmeye uyması gerekir. Sonraki nesne, uygulanması gereken minimum sözleşmeyi temsil eder:

```js [line-numbers]
const dataProvider = {
  getList:    (resource, params) => Promise,
  getOne:     (resource, params) => Promise,
  getMany:    (resource, params) => Promise,
  create:     (resource, params) => Promise,
  update:     (resource, params) => Promise,
  updateMany: (resource, params) => Promise,
  delete:     (resource, params) => Promise,
  deleteMany: (resource, params) => Promise,
  copy:       (resource, params) => Promise,
  copyMany:   (resource, params) => Promise,
}
```

### Desteklenen API Operasyon Metotları

<div class="table-responsive">
<table class="table">
  <tr>
    <td><b>getList</b></td>
    <td>
      Veri tablosu içindeki kaynakların listesini veya herhangi bir özel liste düzeni bileşenini göstermeye yönelik <kbd>Data Iterator</kbd> bileşeni. Arama, filtreleme, sıralama ve isteğe bağlı ilişki getirmeyi de destekler.
    </td>
  </tr>
  <tr>
    <td><b>getOne</b></td>
    <td>Kaynağın ayrıntılarını göstermek için, özellikle <kbd>Show</kbd> aksiyonu veya veri tablosu gösterme eylemleri için kullanılır.</td>
  </tr>
  <tr>
    <td><b>getMany</b></td>
    <td>İster sayfa içeriğini düzenlemede ister sorgu bağlamı filtrelemede olsun, ilk yüklemede kimliklere göre tüm mevcut seçimleri getirmek için yalnızca <kbd>AutoCompleter</kbd> bileşeni için kullanılır.</td>
  </tr>
  <tr>
    <td><b>create</b></td>
    <td><kbd>VaForm</kbd> tarafından yeni kaynak oluşturmak için kullanılır.</td>
  </tr>
  <tr>
    <td><b>update</b></td>
    <td><kbd>VaForm</kbd> tarafından mevcut kaynağı güncellemek için kullanılır.</td>
  </tr>
  <tr>
    <td><b>delete</b></td>
    <td><kbd>VADeleteButton</kbd> ile etkileşim kurulurken çağrılan basit silme eylemidir.</td>
  </tr>
</table>
</div>


### Bir Veri Sağlayıcının Ayarlanması

Veri sağlayıcıların kullanımı oldukça basitdir. İlk <kbd>constructor</kbd> argümanı olarak basit bir API URL'sini veya seçtiğiniz özel bir HTTP istemcisini alabilirler. Bazı başlıkları tüm yönetici uygulamasında paylaşmanız gerekiyorsa tam nesneyi kullanın; özellikle kimlik doğrulamayla ilgili başlıklar için kullanışlıdır.

<kbd>src/plugins/admin.js</kbd>

```js [line-numbers] data-line="27"
import {
  jsonServerDataProvider,
  jwtAuthProvider,
} from "olobase-admin/src/providers";
import { en, tr } from "olobase-admin/src/locales";
import config from "@/_config";

let admin = new OlobaseAdmin(import.meta.env);
/**
 * Install admin plugin
 */
export default {
  install: (app, http, resources) => {
    // console.error(app.config.globalProperties)
    admin.setOptions({
      app,
      router,
      resources,
      store,
      i18n,
      dashboard: "dashboard",
      downloadUrl: "/files/findOneById/",
      readFileUrl: "/files/readOneById/",
      title: "Demo",
      routes,
      locales: { en, tr },
      dataProvider: jsonServerDataProvider(http),
      authProvider: jwtAuthProvider(http),
      http,
      canAction: null,
      // canAction: ({ resource, action, can }) => {
      //   if (can(["admin"])) {
      //     return true;
      //   }
      //   // any other custom actions on given resource and action...
      // },
      options: config,
    });
    admin.init();
    OlobaseAdmin.install(app); // install layouts & components
    app.provide("i18n", i18n);
    app.provide("router", router);
    app.provide("admin", admin); // make injectable
    app.component("PageNotFound", PageNotFound);
  },
};
```

### Kendi Veri Sağlayıcınızı Yazmak

Kendi veri sağlayıcınızı yazmak oldukça basitdir. JsonServerProvider ı kopyalarak metot çağrı imzalarını dikkate alın.
Daha önce bahsedildiği gibi her sağlayıcı yöntemi 2 argüman alır:

* resource : ilgili kaynağın dize adını temsil eder ve her çağrı için kaynak API URL tabanı olmalıdır.
* params : her API çağrısı türüne uyarlanmış belirli bir nesne.


### Method Çağrı İmzaları

Aşağıdaki tablo, her sağlayıcı yöntemi için ikinci parametrede hangi parametrelerin gönderilebileciğini listeler.

<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th>Metot</th>
      <th>Açıklama</th>
      <th>Parametre Biçimi</th>
      <th>Yanıt</th>
    </tr>  
  </thead>
  <tbody>
    <tr>
      <td>getList</td>
      <td>Verileri listeler</td>
      <td>
        { pagination: { page: Number , perPage: Number }, sort: [{ by: String, desc: Boolean }], filter: Object }, include: String[], fields: { [resource]: String[] } }
      </td>
      <td>{ data: Resource[], total: Number }</td>
    </tr>
    <tr>
      <td>getOne</td>
      <td>Id ye göre bir kaynak (veri) getirir</td>
      <td>{ id: Any }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>getMany</td>
      <td>Id ye göre çoklu veriler getirir</td>
      <td>{ ids: Array, include: String[], fields: { [resource]: String[] } }</td>
      <td>{ data: Resource[] }</td>
    </tr>
    <tr>
      <td>create</td>
      <td>Yeni bir veri oluşturur</td>
      <td>{ data: Object }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>update</td>
      <td>Varsayılan bir kaynağı (veriyi) günceller</td>
      <td>{ id: Any, data: Object }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>updateMany</td>
      <td>Birden fazla veriyi günceller</td>
      <td>{ ids: Array, data: Object }</td>
      <td>empty</td>
    </tr>
    <tr>
      <td>delete</td>
      <td>Varsayılan veriyi siler</td>
      <td>{ id: Any }</td>
      <td>empty</td>
    </tr>
    <tr>
      <td>deleteMany</td>
      <td>Birden fazla veriyi siler</td>
      <td>{ ids: Array }</td>
      <td>empty</td>
    </tr>
    <tr>
      <td>copy</td>
      <td>Seçilen veriyi kopyalar</td>
      <td>{ id: Any }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>copyMany</td>
      <td>Seçilen birden fazla veriyi kopyalar</td>
      <td>{ ids: Array }</td>
      <td>{ data: Resource }</td>
    </tr>
  </tbody>
</table>
</div>

Her kaynak deposu modülündeki Olobase Admin'in bazı geçerli çağrı örnekleri:

```js
dataProvider.getList("books", {
  pagination: { page: 1, perPage: 15 },
  sort: [{ by: "publication_date", desc: true }, { by: "title", desc: false }],
  filter: { author: "Cassandra" },
  include: ["media", "reviews"],
  fields: { books: ["isbn", "title"], reviews: ["status", "author"] }
});
dataProvider.getOne("books", { id: 1 });
dataProvider.getMany("books", { ids: [1, 2, 3] });
dataProvider.create("books", { data: { title: "Lorem ipsum" } });
dataProvider.update("books", { id: 1, data: { title: "New title" } });
dataProvider.updateMany("books", { ids: [1, 2, 3], data: { commentable: true } });
dataProvider.delete("books", { id: 1 });
dataProvider.deleteMany("books", { ids: [1, 2, 3] });
```

### Hataların İşlenmesi

Herhangi bir sunucu tarafı hatası durumunda, yani yanıt durumu 2xx aralığının dışında olduğunda, HTTP durum kodunun yanı sıra en azından açıklayıcı bir hata mesajı içeren belirli bir Object ile bir ret sözü döndürmeniz yeterlidir. Bu durum, belirli bir durum koduna göre belirli bir kimlik doğrulama işlemi yapmanıza izin vermek için kimlik doğrulama sağlayıcısına iletilir.

Çoklu hata durumunda <kbd>errors</kbd>, sunucudan boş bir yanıt veya sunucu hatası gelmesi durumunda ise genel <kbd>error</kbd> yanıtına geri döneriz.

```js
try {
  let response = await this.admin.http('post', url, data);
} catch (e) {
    if (
      && e.response 
      && e.response.status === 400 
      && e.response["data"] 
      && e.response["data"]["data"]
      && e.response["data"]["data"]["error"]
      ) {
      this.admin.message("error", e.response.data.data.error);
    }
}
```

Beklenen hata nesnesi formatı:

<div class="table-responsive">
<table class="table">
  <tr>
    <th>Anahtar</th>
    <th>Tür</th>
    <th>Açıklama</th>
  </tr>
  <tr>
    <td>error</td>
    <td>string</td>
    <td>Snackbar'da gösterilecek hata mesajı</td>
  </tr>
  <tr>
    <td>status</td>
    <td>number</td>
    <td>Sunucu tarafından gönderilen yanıt durum kodu</td>
  </tr>
  <tr>
    <td>errors</td>
    <td>array</td>
    <td>İstemci tarafı doğrulama desteği için sunucu tarafından gönderilen hata nesneleri</td>
  </tr>
</table>
</div>

### Store

Özel <b>CRUD</b> sayfalarınızdaki veya kimliği doğrulanmış herhangi bir özel sayfanızdaki her kaynak için tüm veri sağlayıcı yöntemlerini doğrudan <b>Vuex</b> mağazasından kullanabilirsiniz. Biri mapActions <b>Vuex</b> yardımcısıyla, diğeri ise gönderimi kullanabileceğiniz global <b>$store</b> örneğiyle olmak üzere 2 farklı yönteminiz var. 

Takip eden kod, sağlayıcılarınızdan veri almanın her iki yolunu da bir örnek altında gösterir:

```js [line-numbers]
<template>
  <v-row>
    <v-col v-for="item in data" :key="item.id">
      {{ item.name }}
    </v-col>
  </v-row>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      data: [],
    }
  },
  async mounted() {
    /**
     * Use the global vuex store instance.
     * You need to provide the name of the resource followed by the provider method you want to call.
     * Each provider methods needs a `params` argument which is the same object described above.
     */
    this.data = await this.$store.dispatch("publishers/getList", {
      pagination: {
        page: 1,
        perPage: 5,
      },
    });

    /**
     * Use the registered global method which use global `api` store module.
     * Then you need to provide a object argument of this format : `{ resource, params }`
     */
    this.data = await this.getList({
      resource: "publishers",
      params: {
        pagination: {
          page: 1,
          perPage: 5,
        },
      },
    });
  },
  methods: {
    ...mapActions({
      getList: "api/getList",
    }),
  },
};
</script>
```

