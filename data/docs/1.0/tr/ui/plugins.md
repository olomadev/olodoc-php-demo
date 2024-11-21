
## Eklentiler (Plugins)

Projenizdeki tüm eklentiler <b>registerPlugins()</b> metodu ile <b>main.js</b> dosyanızdan çağırılırlar.

<kbd>src/main.js</kbd>

```js
// Components
import App from "./App.vue";

// Composables
import { createApp } from "vue";

// Plugins
import { registerPlugins } from "@/plugins";
const app = createApp(App);

registerPlugins(app); 
app.mount("#app");
```

### Admin Eklentisi

Admin eklentisi Olobase Admin ana kütüphanesinin projenize dahil edilmesini ve projenizdeki temel fonksiyonların konfigüre edilmesini ve çalışmasını sağlar. Takip eden örnekte admin eklentisine ait bir örnek gösteriliyor:

<kbd>src/plugins/admin.js</kbd>

```js
import OlobaseAdmin from "olobase-admin";
import router from "@/router";
import i18n from "../i18n";
import store from "@/store";
import config from "@/_config";
import routes from "@/router/admin";
import PageNotFound from "@/views/Error404.vue";
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
      app,
      router,
      resources,
      store,
      i18n,
      dashboard: "dashboard",
      downloadUrl: "/files/findOneById/",
      readFileUrl: "/files/readOneById/",
      title: "demo",
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
      config: config,
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

Admin eklentisinin temel görevleri aşağıdaki gibidir:

* Veri sağlayıcıları, yerel ayarları, ve yönetici rotalarını yükler.
* Kaydetmek istediğiniz kaynakları yükler.
* Vue Route, Vuex ve Vue I18n'nin güncel örneklerini kaydeder.
* Yetki kontrolünün özelleştirilebilmesini sağlar.
* Init metodu ile Olobase Olobase Admin nesnesini başlatır.
* Error404.vue gibi genel bileşenleri Vue örneğine kayıt eder.

### Konfigürasyon

OlobaseAdmin nesnesi konfigurasyon için uygulamanız tarafında bulunan <kbd>src/\_config.js</kbd> nesnesine ihtiyaç duyar.

```js
export default {
  //
  // va-form component global settings
  // 
  form: {
    disableExitWithoutSave: false,
  },
  dateFormat: "shortFormat",
  //
  // va-list provider global settings
  // 
  list: {
    disableGlobalSearch: false,
    disableItemsPerPage: true,
    itemsPerPage: 10,
    itemsPerPageOptions: [100],
  },
  /*
  ...
  */
}
```

### Admin Eklentisinin Örneklenmesi

OlobaseAdmin constructor metodunun çalışması için aşağıda listelenen parametrelerin tümüne ihtiyacı vardır:

<div class="table-responsive">
<table class="table">
  <tr>
    <th>Anahtar</th>
    <th>Tür</th>
    <th>Açıklama</th>
  </tr>
  <tr>
    <td>router</td>
    <td>VueRouter</td>
    <td>Tüm genel özel rotalarınızı içerebilen Vue Router örneği.</td>
  </tr>
  <tr>
    <td>store</td>
    <td>Vuex.Store</td>
    <td>Otomatik kaynak API modülleri köprü kaydı için tüm özel modüllerinizi içerebilen Vue Store örneği.</td>
  </tr>
  <tr>
    <td>i18n</td>
    <td>VueI18n</td>
    <td>Tam yerelleştirme desteği için tüm özel yerelleştirilmiş etiketlerinizi içerebilen Vue I18n örneği.</td>
  </tr>
  <tr>
    <td>dashboard</td>
    <td>string</td>
    <td>Uygulamanızın giriş sayfasına ait rotasını belirler. Giriş sayfanızın rotasını farklılaştırmak istiyrosanız bu değere mevcut bir rota adı vermelisiniz.</td>
  </tr>
  <tr>
    <td>downloadUrl</td>
    <td>string</td>
    <td>Dosya indirme api rotasını belirler.</td>
  </tr>
  <tr>
    <td>readFileUrl</td>
    <td>string</td>
    <td>Dosya okuma api rotasını belirler.</td>
  </tr>
  <tr>
    <td>title</td>
    <td>string</td>
    <td>Uygulamanızın başlığı, uygulama çubuğu başlığında ve belge başlığında sayfa başlığından sonra gösterilecektir</td>
  </tr>
  <tr>
    <td>routes</td>
    <td>object</td>
    <td>Yönetici düzeninden devralınması gereken, kimliği doğrulanmış rotaların listesi. Tüm kaynak rotalarının CRUD sayfaları burada alt öğe olarak kaydedilecek</td>
  </tr>
  <tr>
    <td>locales</td>
    <td>object</td>
    <td>En az bir Olobase Admin yerel ayarı sağlanmalıdır; yalnızca <b>en</b> ve <b>tr</b> dilleri %100 desteklenir.</td>
  </tr>
  <tr>
    <td>authProvider</td>
    <td>object</td>
    <td>Kimlik doğrulama sözleşmesini uygulaması gereken kimlik doğrulama sağlayıcısı.</td>
  </tr>
  <tr>
    <td>dataProvider</td>
    <td>object</td>
    <td>Veri sözleşmesini uygulaması gereken veri sağlayıcı.</td>
  </tr>
  <tr>
    <td>resources</td>
    <td>array</td>
    <td>Yönetilecek tüm kaynakları içeren kaynaklar dizisi.</td>
  </tr>
  <tr>
    <td>http</td>
    <td>object</td>
    <td>İsteğe bağlı olarak eklenen özel HTTP istemcisi, this.admin.http aracılığıyla kullanılabilir.</td>
  </tr>
  <tr>
    <td>config</td>
    <td>object</td>
    <td>Alanlar veya girişler için bazı genel seçenekler ve bazı ayarlar için kullanılır.</td>
  </tr>
  <tr>
    <td>canAction</td>
    <td>null|function</td>
    <td>Herhangi bir kaynağın her eylemi için özelleştirilebilir yetki fonksiyonu.</td>
  </tr>
</table>
</div>

<b>Olobase Admin akış şeması.</b>

![Olobase Admin Plugin](/images/olobase-admin.jpg)

> Olobase Admin, veri alımı için kaynaklarınızı istemci tarafı CRUD rotalarına ve Vuex modüllerine dönüştürecektir. Bu modüller, dönüşüm işini yapacak olan enjekte edilmiş sağlayıcılarınız sayesinde API sunucunuzla sorunsuz bir şekilde iletişim kurabilecektir.

### Vue Router

Ana VueRouter yalnızca genel sayfalara (veya vuetify-admin ile ilgili olmayan tüm diğer sayfalara) sahip olmalıdır. Bu sayfalarda herhangi bir Admin Düzeni tamamen yoktur, dolayısıyla kendi düzeninizi kullanabilirsiniz. Olobase Admin, oluşturduğu CRUD kaynak rotalarını <kbd>VueRouter.addRoute()</kbd> aracılığıyla eklemek için Vue Router'a ihtiyaç duyacaktır.

<kbd>src/router/index.js</kbd>

```js
import { createRouter, createWebHistory } from "vue-router";

import i18n from "../i18n";
import Member from "@/layouts/Member.vue";
import Login from "@/views/Login.vue";
import ForgotPassword from "@/views/ForgotPassword";
import ResetPassword from "@/views/ResetPassword";

const routes = [
  {
    path: "/",
    redirect: "/login",
    component: Member,
    children: [
      {
        path: "/login",
        name: "login",
        component: Login,
        meta: {
          title: i18n.global.t("routes.login"),
        },
      },
      {
        path: "/forgotPassword",
        name: "forgotPassword",
        component: ForgotPassword,
        meta: {
          title: i18n.global.t("routes.forgotPassword"),
        },
      },
      {
        path: "/resetPassword",
        name: "resetPassword",
        component: ResetPassword,
        meta: {
          title: i18n.global.t("routes.resetPassword"),
        },
      },
    ],
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

export default router;
```

Varsayılan olarak yukarıdaki gibi herhangi bir kayıt veya şifre sıfırlamanın da dahil olabileceği bir giriş sayfanız olmalıdır.

### Vuex

Tüm özel <b>store</b> modüllerinizi buraya koyabilirsiniz. İster özel sayfalarınızda ister kaynak sayfalarınızda olsun, bunları istediğiniz yerde kullanmakta özgürsünüz. Olobase Admin, oluşturduğu API kaynakları modüllerini <a href="https://vuex.vuejs.org/api/#registermodule" target="_blank">RegisterModule()</a> aracılığıyla kaydettirmek için tam olarak örneklenmiş Vuex'e ihtiyaç duyacaktır.

İşte temel bir örnek:

<kbd>src/store/index.js</kbd>

```js
import { createStore } from "vuex";
import axios from 'axios';

const store = createStore({
  state: {
    locale: "en",
    showDialog: false,
    confirm: false,
    resolve: null,
    reject: null,
  },
  actions: {
    setLocale({ commit }, locale) {
      commit("SET_LOCALE", locale);
    },
    openDialog({ commit, state }) {
      commit("TOGGLE_DIALOG", true);
      return new Promise((resolve, reject) => {
        state.resolve = resolve;
        state.reject = reject;
      });
    },
  },
  getters: {
    dialog(state) {
      return state.showDialog;
    },
    getLocale(state) {
      return state.locale
    }
  },
  mutations: {
    SET_LOCALE(state, locale) {
      state.locale = locale;
      axios.defaults.headers.common['Client-Locale'] = locale;
    },
    TOGGLE_DIALOG(state, bool) {
      state.showDialog = bool;
    },
    TOGGLE_DIALOG(state, bool) {
      state.showDialog = bool;
    },
    TOGGLE_AGREE(state) {
      state.resolve(true);
      state.showDialog = false;
    },
    TOGGLE_CANCEL(state) {
      state.resolve(false);
      state.showDialog = false;
    },
  },
  modules: {},
});

export default store;
```

### Kimlikleri Doğrulanmış Rotalar

Olobase Admin'in, alt öğeler olarak kimliği doğrulanmış tüm rotaları içerecek, yukarıdaki genel rotalardan ayrı bir temel rota formatı nesnesine ihtiyacı vardır. Bu ayrılmanın temel nedeni Vue Router alt <a href="https://github.com/vuejs/vue-router/issues/1156" target="_blank">kayıt sınırlamasından</a> kaynaklanmaktadır. Bu nedenle en azından şimdilik OlobaseAdmin yapıcısına manuel olarak enjekte edilmesi gerekiyor. Burası, kimliği doğrulanmış tüm özel sayfalarınızı kontrol paneli, profil sayfası vb. olarak yerleştirebileceğiniz yerdir.

<kbd>src/router/admin.js</kbd>

```js
import AdminLayout from "@/layouts/Admin";
import Dashboard from "@/views/Dashboard";
import Account from "@/views/Account";
import Password from "@/views/Password";
import Error404 from "@/views/Error404";
import i18n from "../i18n";

export default {
  path: "",
  component: AdminLayout,
  meta: {
    title: i18n.global.t("routes.home"),
  },
  children: [
    {
      path: "/dashboard",
      name: "dashboard",
      component: Dashboard,
      meta: {
        title: i18n.global.t("routes.dashboard"),
      },
    },
    {
      path: "/account",
      name: "account",
      component: Account,
      meta: {
        title: i18n.global.t("routes.account"),
      },
    },
    {
      path: "/password",
      name: "password",
      component: Password,
      meta: {
        title: i18n.global.t("routes.password"),
      },
    },
    {
      path: "*",
      component: Error404,
      meta: {
        title: i18n.global.t("routes.notFound"),
      },
    },
  ],
};
```

> Burada görebileceğiniz gibi, bu, tüm alt sayfaların, uygulama çubuğu başlığı, kenar çubuğu menüsü vb. ile tüm yönetici kimlik doğrulamalı yapıyı devralmasına olanak tanıyan, tamamen özelleştirilebilir bir <b>AdminLayout</b> bileşeni kullanan tek yoldur.

### 404 Hata Sayfası

Olobase Admin tarafından çözülemeyen sayfa istekleri <kbd>src/views/Error404.vue</kbd> bileşenine yönlendirilir. Varsayılan 404 sayfası olarak kullanılır ve özelleştirilebilir.

### Loader Eklentisi

Loader eklentisi adından anlaşılacağı gibi temel yükleme görevlerini içerir. Aşağıda bu görevler listelenmiştir.küütüphanelerinizi .

* Kaynaklar dizinindeki tüm üçüncü taraf bileşenlerini Portal Vue, Trix ve CRUD sayfaları kaynakları olarak kaydeder.
* Özel CSS dosyalarını içe aktarır.
* <b>/src/resources/</b> klasörünüz altındaki modüllerinizi otomatik olarak yükler.

> Global olarak yüklenmesi gereken kütüphanelerinizi bu kısımda yüklemeniz tavsiye edilir.

```js
import "./vuetify";
import Trix from "trix";
import "trix/dist/trix.css";
import "@mdi/font/css/materialdesignicons.css";
import PortalVue from "portal-vue";
import Modal from "../components/Modal";
import camelCase from "lodash/camelCase";
import upperFirst from "lodash/upperFirst";
/**
 * Autoload resources
 */
const modules = import.meta.glob('@/resources/*/*.vue', { eager: true })
/**
 * Dynamic vuetify components
 */
import {
  VAutocomplete,
  VCombobox,
} from "vuetify/components";

export default {
  install: (app) => {
    /**
     * Register portal-vue
     */
    app.use(PortalVue);
    /**
     * Register global modal
     */
    app.component('modal', Modal);
    /**
     * Explicit registering of this components because dynamic
     */
    app.component("VAutocomplete", VAutocomplete);
    app.component("VCombobox", VCombobox);
    /**
     * Register application resources automatically
     */
    for (let fileName in modules) {
      const componentConfig = modules[fileName];
      fileName = fileName
        .replace(/^\.\//, "")
        .replace(/\//, "")
        .replace(/\.\w+$/, "");
      const pathArray = fileName.split("/").slice(-2);
      const componentName = upperFirst(camelCase(pathArray[0].toLowerCase() + pathArray[1]));

      // register component
      app.component(
        componentName,
        componentConfig.default || componentConfig
      );
    }
    // end app resources
  },
};
```

### useHttp Eklentisi

<b>useHttp(axios)</b> metodu bir axios örneğinden admin client elde etmek için kullanılır. Yani <b>useHttp()</b> metodu devreden çıkarıldığından aşağıdaki uygulamanızda aşağıdaki fonksiyonlar çalışmayacaktır.

* authentication
* refresh token
* process queue
* error parsing

Açıkça anlatmak gerekirse <b>useHttp()</b> metodu uygulamaya özgü <a href="https://axios-http.com/docs/interceptors">axios interceptörler</a> i axios örneğine atamış olur.

> <b>this.admin.http()</b> metodunu kullanamadığınız durumlarda yeni yarattığınız her bir axios örneği için <b>useHttp(axios)</b> metodunu kullanmanız uygulamanın bütünlüğü açısından önemlidir.

Uygulamaya ait birincil axios örneği <b>plugins/index.js</b> dosyası içerisinde yaratılır ve <b>useHttp()</b> metodu burada çalıştırılır.

<kbd>src/plugins/index.js</kbd>

```js [line-numbers] data-line="23"
import { useHttp } from "../plugins/useHttp";
import axios from "axios";
/**
 * Set default global http configuration
 */
axios.defaults.timeout = 10000;
axios.defaults.baseURL = import.meta.env.VITE_API_URL;
axios.defaults.headers.common['Content-Type'] = "application/json";
axios.defaults.headers.common['Client-Locale'] = i18n.global.locale.value;
axios.interceptors.request.use(
  function (config) {
    let token = localStorage.getItem("token");
    if (typeof token == "undefined" || token == "undefined" || token == "") {
      return config;
    }
    config.headers["Authorization"] = "Bearer " + token;
    return config;
  },
  function (error) {
    return Promise.reject(error);
  }
);
useHttp(axios);
```

<kbd>src/plugins/useHttp.js</kbd>

```js
import i18n from "../i18n";
import store from "@/store";
import eventBus from "vuetify-admin/src/utils/eventBus";

let isRefreshing = false;
let failedQueue = [];
//
// https://github.com/Godofbrowser/axios-refresh-multiple-request/tree/master
// 
const processQueue = (error, token = null) => {
  failedQueue.forEach(prom => {
    if (error) {
      prom.reject(error);
    } else {
      prom.resolve(token);
    }
  });
  failedQueue = [];
};
/**
 * Http global response settings
 */
const useHttp = function (axios) {
  let axiosInstance = axios;  
  axiosInstance.interceptors.response.use(
    (response) => {
      const statusOk = (response && response["status"] && response.status === 200) ? true : false;
      const configUrlSegments = response.config.url.split('/');
      if (
        (statusOk && configUrlSegments.includes("create")) || 
        (statusOk && configUrlSegments.includes("update"))
      ) {
        eventBus.emit("last-dialog", false)  // close edit modal window if it's opened
        store.commit("messages/show", { type: 'success', message: i18n.global.t("form.saved") });
      }
      if (statusOk &&
       cookies.get(cookieKey.token) && 
       response.config.url == "/auth/session") {
        let config = response.config;
        config._retry = false; // retry value every must be false
        const delayRetryRequest = new Promise((resolve) => {
          setTimeout(() => {
            resolve();
          }, import.meta.env.VITE_SESSION_UPDATE_TIME * 60 * 1000); // every x minutes 
        });
        return delayRetryRequest.then(() => axiosInstance(config));
      }
      return response;
    },

    /* etc .... */
}
//
// This is an example and this part of the coding has been deleted 
// so it doesn't take up much space.
//
/**
 * Export useHttp method
 */
export { useHttp };
```

### Vuetify Eklentisi

Vuetify eklentisi, <a href="https://vuetifyjs.com/" target="_blank">VuetifyJs</a> kütüphanesine özgü konfigürasyonlarınızı içerir.

```js
// Styles
import "vuetify/styles";

// Translations provided by Vuetify
import { en, tr } from "vuetify/locale";
import Trans from "@/i18n/translation";
const defaultLang = Trans.guessDefaultLocale();

// Composables
import { createVuetify } from "vuetify";

const defaultTheme = {
  dark: false,
  colors: {
    background: "#FFFFFF",
    surface: "#FFFFFF",
    primary: localStorage.getItem("themeColor")
      ? localStorage.getItem("themeColor")
      : "#0a7248",
    secondary: "#eeeeee",
    error: "#ed0505",
    info: "#00CAE3",
    // success: '#4CAF50',
    // warning: '#FB8C00',
  },
};
// Vuetify 
export default createVuetify({
  locale: {
    locale: Trans.supportedLocales.includes(defaultLang) ? defaultLang : import.meta.env.VITE_DEFAULT_LOCALE,
    fallback: "en",
    messages: { tr, en },
  },
  theme: {
    defaultTheme: "defaultTheme",
    themes: {
      defaultTheme,
    },
  },
});
```