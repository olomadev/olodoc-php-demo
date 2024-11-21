
## Kimlik Doğrulama (Authentication)

Olobase Admin her şeyden önce bir yönetici paneli uygulamasıdır, bu nedenle temel HTTP kimlik doğrulaması, JWT, OAuth vb. gibi tüm farklı kimlik doğrulama sistemi türleriyle iyi bir şekilde entegre olmak için birkaç kimlik doğrulama sağlayıcısı sunar. Veri sağlayıcılara benzer şekilde, Olobase Admin kendi kimlik doğrulama sağlayıcınızı yazarak API sunucunuzun kimlik doğrulamanızla iletişim kurmasına olanak tanıyan bir adaptör yaklaşım modelini kullanılır.

### Mevcut Kimlik Doğrulama Sağlayıcıları

Olobase Admin, yapılandırılabilir 2 kimlik doğrulama sağlayıcısını destekler:

* <b>basicAuthProvider:</b> Temel HTTP kimlik doğrulaması.
* <b>jwtAuthProvider:</b> Durum bilgisi olmayan kimlik doğrulama için <a href="https://jwt.io/introduction" target="_blank">JWT</a> (varsayılan).

Tüm bu sağlayıcıların çalışabilmesi için bir <a href="https://axios-http.com/docs/intro" target="_blank">axios</a> örneğine ihtiyacı vardır. En kolay yol, bir axios örneği oluşturmak ve bunu hem kimlik doğrulama hem de veri sağlayıcılara aktarmaktır:

<kbd>src/plugins/admin.js</kbd>

```js [line-numbers] data-line="4,16"
import OlobaseAdmin from "olobase-admin";
import {
  jsonServerDataProvider,
  jwtAuthProvider,
} from "olobase-admin/src/providers";
import { en, tr } from "olobase-admin/src/locales";

let admin = new OlobaseAdmin(import.meta.env);
/**
 * Install admin plugin
 */
export default {
  install: (app, http, resources) => {
    admin.setOptions({
      dataProvider: jsonServerDataProvider(http),
      authProvider: jwtAuthProvider(http),
    });
    admin.init();
    OlobaseAdmin.install(app); // install layouts & components
    app.provide("i18n", i18n);
    app.provide("router", router);
    /*
    ...
    */
  },
};
```

Dahil edilen tüm sağlayıcılar aynı şekilde kullanılabilir; eğer <b>jwtAuthProvider</b> yerine <b>basicAuthProvider</b> sağlayıcısını kullanmak istiyorsanız <b>jwtAuthProvider</b>'ı <b>basicAuthProvider</b> ile değiştirmeniz yeterlidir.

### Birinci Auth Parametresi: Axios

Özel Vue bileşenlerinizin her yerinden axios örneğine <code>admin.http</code> ile erişmek için <b>axios</b> örneği <b>OlobaseAdmin</b> constructor metoduna ve buradan da <b>jwtAuthProvider</b> sağlayıcısına gönderilir. Gönderilen bu örnek geçerli kimlik doğrulama durumunun (tanımlama bilgileri veya belirteç) yeniden kullanılmasına olanak tanır.

```js
jwtAuthProvider(http);
```

### İkinci Auth Parametresi: Params

Eğer isteğe bağlı ikinci bir <kbd>params</kbd> değişkenini aşağıdakiler gibi auth sağlayacınıza gönderirseniz bu varolan çeşitli parametreleri değiştirmeniz veya onlara ek yapmanız için kullanılabilir:

```js [line-numbers] data-line="20"
let params = {
  routes: {
    login: "auth/token",
    logout: "auth/logout",
    refresh: "auth/refresh",
  },
  getToken: (r) => r.token,
  getCredentials: ({ username, password }) => {
    return {
      username,
      password,
    };
  },
  getId: (r) => r.user.id,
  getFullname: (r) => r.user.fullname,
  getEmail: (r) => r.user.email,
  getAvatar: () => localStorage.getItem("avatar"),
  getPermissions: (r) => r.user.permissions,
};
jwtAuthProvider(http, params);
```

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Seçenek</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>routes</strong></td>
         <td>Tüm kimlik doğrulama rotalarını, yani giriş yapma, çıkış yapma, yenileme (JWT) gibi kullanıcı bilgilerini içeren nesne.</td>
      </tr>
      <tr>
         <td><strong>getToken</strong></td>
         <td>JWT için başarılı bir oturum açma API yanıtından token'ı döndüren işlev, varsayılan olarak <code>token</code> ayarlamıştır.</td>
      </tr>
      <tr>
         <td><strong>getCredentials</strong></td>
         <td>API'niz için uyumlu bir kimlik bilgisi biçimi döndüren kimlik bilgilerine yönelik işlev eşleyici.</td>
      </tr>
      <tr>
         <td><strong>getId</strong></td>
         <td>Geçerli kullanıcının id değerini döndüren işlev.</td>
      </tr>
      <tr>
         <td><strong>getFullname</strong></td>
         <td>Geçerli kullanıcının adını döndüren işlev (kullanıcı bilgileri API uç noktasından alınır), varsayılan olarak şu şekildedir: <code>name</code></td>
      </tr>
      <tr>
         <td><strong>getEmail</strong></td>
         <td>Geçerli kullanıcının e-postasını döndüren işlev, varsayılan olarak şu şekildedir: <code>email</code></td>
      </tr>
      <tr>
         <td><strong>getPermissions</strong></td>
         <td>Geçerli kullanıcının rollerini döndüren işlev, varsayılan olarak şu şekildedir: <code>permissions</code></td>
      </tr>
   </tbody>
</table>
</div>

### JWT ile Kimlik Doğrulama (Varsayılan)

Bu sağlayıcıyla, sonraki her XHR isteği için Yetkilendirme başlığına basit bir taşıyıcı jeton eklenecektir. JWT, yapılandırılabilir bir anahtar altında <b>çerezler</b> içinde saklanacaktır. Jeton yaratılırken <kbd>/api/auth/token</kbd> rotası kullanılırken, konfigürasyondan ayarlanabilen jeton süresi bittiğinde otomatik yenileme jetonu için belirli <kbd>/api/auth/refresh</kbd> rotası kullanılır.

<a href="https://creately.com/diagram/example/ij64mtn22/jwt-authentication-classic" target="_blank">JWT akış diagramına göz atın</a>

JWT kimlik doğrulamasının çalışabilmesi için arka uçta JWT anahtarlarının yapılandırılmış olması gerekir. İlgili bilgiye bu bağlantıdan ulaşabilirsiniz. <a href="/php-api/jwt-authentication.html#Generating%20JWT%20Keys">JWT Anahtarları Oluşturma</a>.

### Temel HTTP kimlik doğrulaması

Temel HTTP Sağlayıcısı temel durumlar için kullanılabilir. Temel kimlik doğrulama bilgilerinin tamamı, her XHR isteğine kolayca gönderilecektir. Varsayılan olarak, temel kimlik doğrulama yalnızca kimlik bilgileri için kullanılan kullanıcı adını döndürür. Olobase Admin'ne daha fazla kullanıcı bilgisi vermek için belirli bir API uç noktası kullanmayı tercih ederseniz (işlevsel profil düzenlemeye ihtiyacınız varsa bu önerilir), kullanıcı rotasını aşağıdaki gibi ayarlamanız gerekir:

<kbd>src/plugins/admin.js</kbd>

```js
import {
  basicAuthProvider,
} from "olobase-admin/src/providers";
import OlobaseAdmin from "olobase-admin";

let admin = new OlobaseAdmin(import.meta.env);
//...
/**
 * Install admin plugin
 */
export default {
  install: (app, http, resources) => {
  //...
  admin.setOptions({
    //...
    authProvider: basicAuthProvider(http, {
      routes: {
        user: "/api/user",
      }
    },
    //...
  });
  //...
  }
}
```

### Yetkilendirme Sayfaları

Oturum Açma, Kayıt Olma gibi kimliği doğrulanmamış tüm sayfalar veya herhangi bir özel genel sayfa, <kbd>src/router/index.js</kbd> dosyasındaki temel yönlendirici dosyanızda klasik sayfalar olarak kaydedilmelidir. Bu yöntem herhangi bir özel veya genel <b>layout</b> kullanmanıza olanak tanır. Kimliği doğrulanmış özel sayfalar özel <kbd>src/router/admin.js</kbd> dosyasını kullanılmalıdır. Bu dosya uygulama çubuğu başlığı ve kenar çubuğu ile tüm admin layout'undan  yararlanan basit bir admin yönlendirme nesnesidir.

### Oturum Açma Sayfası

Giriş sayfasının çalışabilmesi için klasik bir giriş formuna sahip olması gerekir. Daha sonra yapmanız gereken tek şey, kimlik bilgilerini oturum açma kimlik doğrulama sağlayıcısı yöntemine iletecek olan oturum açma kimlik doğrulama eylemine göndermektir.

![Login](/images/login.jpg)

<kbd>src/views/Login.vue</kbd>

```js
import { mapActions } from "vuex";

export default {
  data() {
    return {
      username: null,
      password: null,
    };
  },
  methods: {
    ...mapActions({
      login: "auth/login",
    }),
    async validate() {
      await this.login({
        username: this.username,
        password: this.password,
      });
    },
  },
};
```

### Giriş Yönlendirmesi

Kimliği doğrulanmamış oturum açma yönlendirmesi için, oturum açma URL'si yolunu yerelleştirmek amacıyla Olobase Admin, oturum açma adı verilen bir rota arar; bu nedenle admin eklentinizdaki konfigürasyonda <b>dashboard</b> isimli oturum açma rotanızın ayarlandığından emin olun.

<kbd>src/plugins/admin.js</kbd>

```js [line-numbers] data-line="10"
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
      /*
      ...
      */
    });
  }
}
```

### Kayıt ve Şifre Sıfırlama

Bu özellikleri eklemeniz gerekiyorsa, giriş sayfası bunu yapmak için mükemmel bir yerdir. Basitçe ilgili formları ekleyin, ardından profil sayfasının sonraki bölümünde gösterildiği gibi global admin <b>this.admin.http()</b> metodunu kullanarak API'ye özel kayıt veya parola sıfırlama uç noktanızı çağırın.

### Hesap Sayfası

Yukarıda açıklandığı gibi, admin layout mirasının devralınması için <b>kimliği doğrulanmış</b> bu sayfanın <kbd>src/router/admin.js</kbd>'ye kaydedilmesi gerekir. Bu sayede Olobase Admin kimliği doğrulanmış kullanıcının bilgilerini alabilir ve kullanıcı hesabındaki formunu önceden doldurabilir.

![Account](/images/account.jpg)

Hesap bilgilerinin kaydedilmesi proje bağlamına göre farklı olabileceğinden kimliği doğrulanmış API istekleri yapmak için <b>this.admin.http()</b> metodu kullanılmalıdır. Geçerli kullanıcının hesap güncellemesi için varsayılan api url adresi <kbd>/api/account/update</kbd> adresidir.

<kbd>src/views/Account.vue</kbd>

<tab>
<title>Template|Script</title>
<content>

```html
<template>
  <v-row>
    <v-col sm="12">
      <v-form @submit.prevent="updateAccount">
        <v-card flat>
          <v-card-text>
            <div class="d-flex align-center mb-2">
              <h1 class="h1">{{ $t("resources.account.title") }}</h1>
            </div>
            <v-row>
              <v-col lg="3" md="3" sm="12">
                <va-avatar-input
                  v-model="avatar.image"
                  :set-label="$t('resources.account.fields.avatar.set')"
                  :del-label="$t('resources.account.fields.avatar.delete')"
                >
                </va-avatar-input>

                <va-text-input
                  source="firstname"
                  resource="account"
                  v-model="firstname"
                  :error-messages="firstnameErrors"
                ></va-text-input>

                <va-text-input
                  source="lastname"
                  resource="account"
                  v-model="lastname"
                  :error-messages="lastnameErrors"
                />

                <va-text-input
                  source="email"
                  resource="account"
                  v-model="email"
                  type="email"
                  :error-messages="emailErrors"
                ></va-text-input>

                <va-color-picker-input
                  source="themeColor"
                  resource="account"
                  dot-size="25"
                  mode="hexa"
                  show-swatches
                  swatches-max-height="150"
                  v-model="themeColor"
                  :error-messages="themeColorErrors"
                ></va-color-picker-input>

              </v-col>
            </v-row>
            <v-btn color="primary" :loading="accountUpdating" type="submit">
              {{ $t("va.actions.save") }}
            </v-btn>
          </v-card-text>
        </v-card>
      </v-form>
    </v-col>
  </v-row>
</template>
```
<tcol>

```js
<script>
import { mapActions } from "vuex";
import { useVuelidate } from "@vuelidate/core";
import { required, email, minLength, maxLength } from "@vuelidate/validators";

export default {
  inject: ['admin', 'vuetify'],
  setup() {
    return { v$: useVuelidate() };
  },
  data() {
    return {
      accountUpdating: false,
      themeColor: "#F26522",
      firstname: null,
      lastname: null,
      email: null,
      avatarImage: null,
    };
  },
  validations() {
    return {
      firstname: {
        required,
        maxLength: maxLength(120),
      },
      lastname: {
        required,
        maxLength: maxLength(120),
      },
      email: {
        required,
        email,
      },
      themeColor: {
        required,
        minLength: minLength(7),
        maxLength: maxLength(7),
      },
    }
  },
  computed: {
    firstnameErrors() {
      const errors = [];
      const field = "firstname";
      if (!this.v$[field].$dirty) return errors;
      this.v$[field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$[field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "120" }));
      return errors;
    },
    lastnameErrors() {
      const errors = [];
      const field = "lastname";
      if (!this.v$[field].$dirty) return errors;
      this.v$[field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$[field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "120" }));
      return errors;
    },
    emailErrors() {
      const errors = [];
      const field = "email";
      if (!this.v$[field].$dirty) return errors;
      this.v$[field].required.$invalid &&
        errors.push(this.$t("v.email.required"));
      this.v$[field].email.$invalid && errors.push(this.$t("v.email.invalid"));
      return errors;
    },
    themeColorErrors() {
      const errors = [];
      const field = "themeColor";
      if (!this.v$[field].$dirty) return errors;
      this.v$[field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$[field].minLength.$invalid &&
        errors.push(this.$t("v.string.minLength", { min: "7" }));
      this.v$[field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "7" }));
      return errors;
    },
  },
  created() {
    this.initializeAccount();
  },
  methods: {
    ...mapActions({
      checkAuth: "auth/checkAuth",
    }),
    async initializeAccount() {
      let response = await this.admin.http.get("/account/findMe");
      let data = response.data.data;
      this.firstname = data.firstname;
      this.lastname = data.lastname;
      this.email = data.email;
      this.avatar.image = data.avatar.image;
      this.themeColor = data.themeColor ? data.themeColor : this.vuetify.theme.themes.value.defaultTheme.colors.primary;
    },
    async updateAccount() {
      this.v$.$touch();
      if (this.v$.$invalid) {
        return false;
      }
      this.accountUpdating = true;
      try {
        let data = {
          firstname: this.firstname,
          lastname: this.lastname,
          email: this.email,
          locale: this.locale,
          avatar: {
            image: this.avatar.image,
          },
          themeColor: this.themeColor
        };
        let Self = this;
        let user = await this.checkAuth();
        if (user) {
          this.admin.http({ method: "PUT", url: "/account/update", data: data }).then(async function(response){
            if (response && response.status == 200) {

              Self.vuetify.theme.themes.value.defaultTheme.colors.primary = Self.themeColor;
              localStorage.setItem("themeColor", Self.themeColor);
              Self.$router.push({ name: "dashboard"});
              setTimeout(function(){
                Self.admin.message("success", Self.$t("form.saved"));
              }, 1);
            }
          });
        }
      } catch (e) {
        // console.log(e.message);
      } finally {
        this.accountUpdating = false;
      }
    },
  },
};
</script>
```

</content>
</tab>

> CRUD işlemlerinin dışında kalan sayfalarda Olobase Admin form elementleri kullanıldığında CRUD saylarından farklı olarak kaynak bilinmediğinden etiket çevirme işlemleri için yukarıda görüldüğü gibi <b>resource</b> niteliğine ilgili kaynağın adı girilmelidir. Aksi durumda elemente ait çeviri işlemi gerçekleşmez.

### checkAuth() ile Kimlik Doğrulama

Başarılı hesap güncellemesinden sonra, kimlik doğrulama sağlayıcı yönteminizden <b>checkAuth()</b>'u geri çağırarak yeni kullanıcı bilgilerini Vuex mağazasında yenileyebilir ve kullanıcıya ait bilgileri bu fonksiyon elde edebilirsiniz. 

> This function is called automatically with every navigation/page change.

```js
export default {
  methods: {
    ...mapActions({
      checkAuth: "auth/checkAuth",
    }),
    async validate() {
      this.v$.$touch();
      this.loading = false;
      if (this.v$.$invalid) {
        return;
      }
      this.loading = true;
      try {
        //
        // you must call checkAuth() method for the users who already authenticated
        // 
        await this.checkAuth().then(function(response){
          console.error(response); // { "user" : { "id" : "50767814-6c78-4b9e-b858-9ff18dbd531b", "fullname": "James Brown" } }
        })
      } catch (e) {
        this.loading = false;
      }
    }
  },
};
```

<b>checkAuth()</b> methodundan geri dönen nesne.

```js
{
    "avatar": "undefined",
    "token": "fbac5d11a54ef6e0817530aeb16d464546133e44.....",
    "user": {
        "id": "50767814-6c78-4b9e-b858-9ff18dbd531b",
        "fullname": "James Brown",
        "email": "james.brown@example.com",
        "permissions": [
            "admin"
        ]
    },
    "cookieKey": {
        "user": "owa_user",
        "token": "owa_token"
    }
}
```

Eğer login sayfanızda oturum açma işleminden hemen sonra kullanıcı bilgilerine erişmek için kullanmak istiyorsanız oturum açma işleminden hemen sonra da checkAuth metodunu kullanabilirsiniz.

```js
await this.login({ username: this.username, password: this.password });
await this.checkAuth().then(function(response){
  console.error(response);  // { "user" : { "id" : "50767814-6c78-4b9e-b858-9ff18dbd531b", "fullname": "James Brown" } }
})
```

> Herhangi bir işlemden sonra bir durum mesajı göstermek istiyorsanız aşağıdaki kodu kullanabilirsiniz.

```js
this.admin.message('info', "This is an example info message");
```

Mesajlar hakkında daha detaylı bilgi için <a href="/ui/messages.html">mesajlar</a> bölümünü ziyaret edin.

### Kendi Kimlik Doğrulama Sağlayıcınızı Yazmak

Bu yapılandırılabilir kimlik doğrulama sağlayıcılarından hiçbiri size uymuyorsa, <a href="/ui/data-providers.html">veri sağlayıcılarına</a> benzer şekilde aşağıdaki sözleşmeyi uygulayarak her zaman kendi yetkilendirme sağlayıcınızı yazabilirsiniz.

### API Kontratı

Kimlik doğrulama sağlayıcılarının Olobase Admin ile iletişime izin verebilmesi için belirli bir sözleşmeye uyması gerekir. Sonraki nesne, uygulanması gereken minimum sözleşmeyi temsil eder:

```js
const authProvider = {
  login:          ({ username, password }) => Promise,
  logout:         () => Promise,
  checkAuth:      () => Promise,
  checkError:     (error) => Promise,
  getFullname:    (user) => String,
  getEmail:       (user) => String,
  getAvatar:      (user) => String,
  getPermissions: (user) => Array,
}
```

Bu yöntemlerin tümü şu şekilde açıklanabilir:

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Operasyon</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>login</strong></td>
         <td>Kimlik bilgilerini API'nize gönderir. Yanıt durum kodu 2xx aralığının dışındaysa reddedilen bir <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise" target="_blank">promise</a> döndürmelidir. Başarılı olursa <b>checkAuth</b> çağrılır.</td>
      </tr>
      <tr>
         <td><strong>logout</strong></td>
         <td>API'nizden açık bir şekilde çıkış yapar. Başarılı olursa <b>checkAuth</b> çağrılır.</td>
      </tr>
      <tr>
         <td><strong>checkAuth</strong></td>
         <td>Belirli bir API uç noktasından kullanıcı bilgilerini alarak mevcut kimlik doğrulama geçerliliğini kontrol eder. Her istemci tarafı rota navigasyonundan sonra çağrılır. Başarılı olursa genel kimlik doğrulama deposundaki kullanıcı bilgilerini yenileyin. Başarısız olursa, kimlik doğrulama deposu bilgilerini temizleyin ve oturum açma sayfasına yönlendirin.</td>
      </tr>
      <tr>
         <td><strong>checkError</strong></td>
         <td>Her API hatasından sonra çağrılan, API hata durumuna göre özel işlemler yapmanızı sağlar. Reddetme <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise" target="_blank">promise</a> i döndürülürse otomatik oturum kapatma yapın. En yaygın kullanım durumu, API'nin 401 veya 403 durum kodunu döndürmesi durumunda otomatik oturum kapatmaya zorlamaktır.</td>
      </tr>
      <tr>
         <td><strong>getFullname</strong></td>
         <td>Kimliği doğrulanmış kullanıcı nesnesinden kullanıcının tam adını döndürün. Kullanıcı başlığı açılır menüsünde kullanıcı adını göstermek için kullanılır.</td>
      </tr>
      <tr>
         <td><strong>getEmail</strong></td>
         <td>Kimliği doğrulanmış kullanıcı nesnesinden kullanıcının e-postasını döndürün. Kullanıcı başlığı açılır menüsünde e-postayı göstermek için kullanılır.</td>
      </tr>
      <tr>
         <td><strong>getPermissions</strong></td>
         <td>Kimliği doğrulanmış kullanıcıya  ait izinleri döndürün. <a href="/ui/authorization.html">Yetkilendirme Sistemi</a> için kullanılır.</td>
      </tr>
   </tbody>
</table>
</div>