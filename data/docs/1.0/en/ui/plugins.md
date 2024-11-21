
## Plugins

All plugins in your project are called from your <b>main.js</b> file with the <b>registerPlugins()</b> method.

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

### Admin Plugin

The Admin plugin allows the Olobase Admin main library to be included in your project and the basic functions in your project to be configured and run. The following example shows an example of the admin plugin:

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

The main tasks of the Admin plugin are as follows:

* Loads data providers, locales, and admin routes.
* Loads the resources you want to save.
* Vue Route saves current instances of Vuex and Vue I18n.
* Allows customization of authorization control.
* Initializes the Olobase Olobase Admin object with the Init method.
* Registers generic components such as Error404.vue to the Vue instance.

### Configuration

The OlobaseAdmin object requires the <kbd>src/\_config.js</kbd> object located on your application side for configuration.

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

### Instancing the Admin Plugin

The OlobaseAdmin constructor method needs all the parameters listed below to work:

<div class="table-responsive">
<table class="table">
  <tr>
    <th>Key</th>
    <th>Type</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>router</td>
    <td>VueRouter</td>
    <td>Vue Router instance that can contain all your public custom routes.</td>
  </tr>
  <tr>
    <td>store</td>
    <td>Vuex.Store</td>
    <td>Vue Store instance that can contain all your custom modules for automatic source API modules hyperlink registration.</td>
  </tr>
  <tr>
    <td>i18n</td>
    <td>VueI18n</td>
    <td>Vue I18n instance that can contain all your custom localized tags for full localization support.</td>
  </tr>
  <tr>
    <td>dashboard</td>
    <td>string</td>
    <td>It determines the route of your application's home page. If you want to differentiate the route of your home page, you should give this value an existing route name.</td>
  </tr>
  <tr>
    <td>downloadUrl</td>
    <td>string</td>
    <td>Determines the file download api route.</td>
  </tr>
  <tr>
    <td>readFileUrl</td>
    <td>string</td>
    <td>Determines the file reading api route.</td>
  </tr>
  <tr>
    <td>title</td>
    <td>string</td>
    <td>Your app's title will be shown after the page title in the app bar title and document title.</td>
  </tr>
  <tr>
    <td>routes</td>
    <td>object</td>
    <td>List of authenticated routes that should be inherited from the admin layout. CRUD pages of all resource routes will be saved as children here.</td>
  </tr>
  <tr>
    <td>locales</td>
    <td>object</td>
    <td>At least one Olobase Admin locale must be provided; Only <b>en</b> and <b>tr</b> languages are 100% supported.</td>
  </tr>
  <tr>
    <td>authProvider</td>
    <td>object</td>
    <td>The authentication provider that must implement the authentication contract.</td>
  </tr>
  <tr>
    <td>dataProvider</td>
    <td>object</td>
    <td>Data provider who must implement the data contract.</td>
  </tr>
  <tr>
    <td>resources</td>
    <td>array</td>
    <td>The array of resources that contains all the resources to be managed</td>
  </tr>
  <tr>
    <td>http</td>
    <td>object</td>
    <td>Optionally added custom HTTP client, available via this.admin.http.</td>
  </tr>
  <tr>
    <td>config</td>
    <td>object</td>
    <td>Some general configuration and options for fields or entries.</td>
  </tr>
  <tr>
    <td>canAction</td>
    <td>null|function</td>
    <td>Customizable authorization function for every action of any resource.</td>
  </tr>
</table>
</div>

<b>Olobase Admin flow chart.</b>

![Olobase Admin Plugin](/images/olobase-admin.jpg)

> Vuetify Admin will convert your resources into client-side CRUD routes and Vuex modules for data ingestion. These modules will be able to communicate seamlessly with your API server thanks to your injected providers that will do the conversion work.

### Vue Router

The main VueRouter should only have public pages (or any other pages not related to vuetify-admin). These pages are completely free of any Admin Layout, so you can use your own layout. Olobase Admin will need the Vue Router to add the CRUD source routes it creates via <kbd>VueRouter.addRoute()</kbd>.

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

By default you should have a login page like above, which may include any registration or password resets.

### Vuex

You can put all your custom <b>store</b> modules here. You're free to use them wherever you want, whether on your custom pages or resource pages. Olobase Admin will need fully instantiated Vuex to register the API resources modules it creates via <a href="https://vuex.vuejs.org/api/#registermodule" target="_blank">RegisterModule()</a> .

Here's a basic example:

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

### Authenticated Routes

Olobase Admin needs a base route format object separate from the above generic routes that will contain all authenticated routes as children. The main reason for this departure is due to Vue Router sub <a href="https://github.com/vuejs/vue-router/issues/1156" target="_blank">registration limitation</a>. So it needs to be manually injected into the OlobaseAdmin constructor, at least for now. This is where you can view all your authenticated private pages like dashboard, profile page, etc. This is where you can place it.

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

> As you can see here, this means all subpages, app bar title, sidebar menu, etc. It is the only way to use a fully customizable <b>AdminLayout</b> component that allows it to inherit the entire admin authenticated structure with .

### 404 Error Page

Page requests that cannot be resolved by Olobase Admin are directed to the <kbd>src/views/Error404.vue</kbd> component. It is used as the default 404 page and can be customized.

### Loader Plugin

The Loader plugin, as its name suggests, includes basic loading tasks. Listed below are these tasks for your libraries.

* Registers all third-party components in the Resources directory as Portal Vue, Trix and CRUD pages resources.
* Imports custom CSS files.
* Automatically installs your modules under your <b>/src/resources/</b> folder.

> It is recommended to install your libraries that need to be installed globally in this section.

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

### useHttp Plugin

The <b>useHttp(axios)</b> method is used to obtain an admin client from an axios instance. In other words, since the <b>useHttp()</b> method is disabled, the following functions will not work in your application below.

* authentication
* refresh token
* process queue
* error parsing
* session ttl

To put it clearly, the <b>useHttp()</b> method assigns application-specific <a href="https://axios-http.com/docs/interceptors">axios interceptors</a> to the axios instance.

> In cases where you cannot use the <b>this.admin.http()</b> method, it is important for the integrity of the application that you use the <b>useHttp(axios)</b> method for each axios instance you create.

The primary axios instance of the application is created in the <b>plugins/index.js</b> file and the <b>useHttp()</b> method is run there.

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
    let token = cookies.get(cookieKey.token);
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

### Vuetify Plugin

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