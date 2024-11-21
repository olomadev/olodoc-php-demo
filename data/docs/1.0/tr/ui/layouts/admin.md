
## Admin Layout

Olobase Admin iskeletini indridiğinizde projeniz önceden oluşturulmuş varsayılan admin layout'u ile başlatılacaktır. Bu layout'un <b>.vue</b> şablonu <kbd>src/layout/Admin.vue</kbd> dosyasında bulunur ve <kbd>src/routes/admin.js</kbd> içindeki kimlik doğrulamalı rotaya aşağıdaki şekilde bağlanır:

<kbd>src/router/admin.js</kbd>

```js
import AdminLayout from "@/layouts/Admin";
//...
export default {
  path: "/",
  name: "home",
  redirect: "/dashboard",
  component: AdminLayout,
  meta: {
    title: i18n.t("routes.home"),
  },
  children: [
    //...
  ],
};
```

### Main Layout

Her bölge için bir slota sahip özelleştirilebilir ana düzeni <kbd>VaLayout</kbd> olarak adlandırılmıştır.

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Ad</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>VaAppBar</strong></td>
         <td>Kenar çubuğu alanı VNavigationDrawer, içerik başlığı bölgesi, ek özel mesajlar veya kimliğe bürünme durumu gibi önemli bildirimler vb. için ideal yerdir.</td>
      </tr>
      <tr>
         <td><strong>VaBreadcrumbs</strong></td>
         <td>İçerik başlığı bölgesi, VBreadcrumb'lar ve/veya ek özel mesajlar veya kimliğe bürünme durumu gibi önemli bildirimler vb. İçin ideal yer.</td>
      </tr>
      <tr>
         <td><strong>VaFooter</strong></td>
         <td>Alt bilgi alanına bazı kurumsal bilgileri ve bağlantıları koyabilirsiniz.</td>
      </tr>
      <tr>
         <td><strong>VaAside</strong></td>
         <td>İhtiyacınız olan her şeyi koyabileceğiniz 2. sol veya sağ yan alan.</td>
      </tr>
   </tbody>
</table>
</div>

> Bu slot kompozisyon sistemi tam bir kişiselleştirme olanağı sağlar. Her bir bileşeni tamamen kendinize göre özelleştirebilir veya değiştirebilirsiniz. Lütfen <kbd>/src/layout/Admin.vue</kbd> dosyasına gözatın. Özelleştirmeleri bu dosya üzerinde gerçekleştirmelisiniz.

### Menü Bağlantıları

Aşağıdaki <a href="/ui/layout.html#Bağlantılar">bağlantılar</a> bölümüne bakın.

### AppBar

Varsayılan <kbd>VAppBar</kbd> uygulama başlığını, başlık menülerini, doğrudan kaynak oluşturma bağlantılarını, genel yenileme eylemini, profil menüsünü içerir. Profil kullanıcısı açılır menüsü misafir modunda görünmez.

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özellik</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan başlığı değiştirmek için OlobaseAdmin.setOptions() metodu içerisindeki title anahtarı değerini değiştirin.</td>
      </tr>
      <tr>
         <td><strong>elevation</strong></td>
         <td><code>number|string</code></td>
         <td>Bileşenin gölge derecesini ayarlar. (Bknz. <a href="https://vuetifyjs.com/en/styles/elevation/#usage" target="_blank">Vuetify Elevations</a>).</td>
      </tr>
      <tr>
         <td><strong>headerMenu</strong></td>
         <td><code>array</code></td>
         <td>Başlık bağlantıları en tepede görünür hale getirmeyi sağlar.</td>
      </tr>
      <tr>
         <td><strong>disableCreate</strong></td>
         <td><code>boolean</code></td>
         <td>Oluşturma menüsünü devre dışı bırakır.</td>
      </tr>
      <tr>
         <td><strong>disableReload</strong></td>
         <td><code>boolean</code></td>
         <td>Yeniden yükleme (sayfa yenileme) tuşunu devre dışı bırakır.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>VNavigationDrawer için ana rengi ayarlar.</td>
      </tr>
      <tr>
         <td><strong>sidebarColor</strong></td>
         <td><code>string</code></td>
         <td>VNavigationDrawer için belirtilen rengi ayarlar.</td>
      </tr>
      <tr>
         <td><strong>listItemColor</strong></td>
         <td><code>string</code></td>
         <td>VNavigationDrawer liste öğleri için belirtilen rengi ayarlar.</td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin kullandığı dikey yüksekliği ayarlar. Varsayılan "compact". Alabileceği değerler: <kbd>'default' | 'prominent' | 'comfortable' | 'compact'</kbd>.</td>
      </tr>
      <tr>
         <td><strong>listItemDensity</strong></td>
         <td><code>string</code></td>
         <td>List-item bileşenlerinin kullandığı dikey yüksekliği ayarlar. Varsayılan "compact". Alabileceği değerler: <kbd>'default' | 'prominent' | 'comfortable' | 'compact'</kbd>.</td>
      </tr>
      <tr>
         <td><strong>flat</strong></td>
         <td><code>boolean</code></td>
         <td>AppBar gölgesini kaldırır.</td>
      </tr>
   </tbody>
</table>
</div>

### Kaynak Bağlantıları

Mevcut kullanıcının izinleri varsa, eylem bağlantıları oluşturma kayıtlı kaynaklarınızdan otomatik olarak oluşturulacaktır.

### Yeniden Yükleme Tuşu

Yeniden yükleme tuşu, veri sağlayıcınızdan (örneğin <b>getList</b>, <b>getOne</b> veya <b>getMany</b>) gelen her listeleme çağrısını dinamik olarak yeniler. Manuel bir tıklama ile içerik yeni bir listeleme çağrısı gönderir. Bu tuş sadece listeleme sayfalarında gözükür.

![Refresh Button](/images/refresh-button.png)

### VaAppBar:sidebar

Vuetify <a href="https://vuetifyjs.com/en/components/navigation-drawers/" target="_blank">VNavigationDrawer</a> bileşeni ile hiyerarşik menüye sahip varsayılan özelleştirilebilir bölümdür. Bu bölüm <kkd>VaAppBar</kkd> bileşeni içerisinde yer alır.

<kbd>packages/admin/src/components/layout/AppBar.vue</kbd>

![SideBar](/images/sidebar.png)

<kbd>src/layout/Admin.vue</kbd>

<tab>
<title>Template|Script</title>
<content>

```html
<template>
  <v-app>
    <va-layout 
      v-if="authenticatedUser"
    >
      <template #appbar>
        <va-app-bar
          :key="getCurrentLocale"
          color="primary"
          density="compact"
          :header-menu="getHeaderMenu"
          sidebar-color="white"
        >
          <template v-slot:logo>
            <div class="mb-1" style="letter-spacing: 1px;">logo</div>
          </template>

          <template v-slot:avatar>
            <v-avatar v-if="avatarExists" size="24px">
              <v-img 
                :src="getAvatar"
                alt="Avatar"
              ></v-img>
            </v-avatar>
            <v-icon v-else>mdi-account-circle</v-icon>
          </template>

          <template v-slot:profile>
            <v-card min-width="300">
              <v-list nav>
                <v-list-item 
                   v-if="getFullname"
                  :prepend-avatar="getAvatar"
                >
                  <div class="list-item-content">
                    <v-list-item-title class="title">{{ getFullname }}</v-list-item-title>
                    <v-list-item-subtitle v-if="getEmail">{{ getEmail }}</v-list-item-subtitle>
                  </div>
                </v-list-item>
                <v-divider></v-divider>
                <v-card flat>
                  <v-card-text style="padding:9px">
                    <v-list-item
                      v-for="(item, index) in getProfileMenu"
                      :key="index"
                      link
                      :to="item.link"
                      @click="item.logout ? logout() : null"
                      class=" mt-2"
                    >
                      <template v-slot:prepend>
                        <v-icon>{{ item.icon }}</v-icon>
                      </template>
                      <v-list-item-title>{{ item.text }}</v-list-item-title>
                    </v-list-item>
                  </v-card-text>
                </v-card>
              </v-list>
            </v-card>
          </template>
        </va-app-bar>
      </template>

      <template #header>
        <va-breadcrumbs />
      </template>

      <template #aside>
        <va-aside />
      </template>

      <template #footer>
        <va-footer 
          :key="getCurrentLocale" 
          :menu="getFooterMenu"
        >
          <span style="font-size:13px">&copy; 2023</span>
        </va-footer>
      </template>
    </va-layout>
  </v-app>
</template>
```
<tcol>

```js
<script>
import isEmpty from "lodash/isEmpty"
import { useDisplay } from "vuetify";
import { mapActions } from "vuex";
import Trans from "@/i18n/translation";

export default {
  name: "App",
  inject: ["admin"],
  data() {
    return {
      authenticatedUser: null,
    };
  },
  async created() {
    /**
     * Set default locale
     */
    const lang = Trans.guessDefaultLocale();
    if (lang && Trans.supportedLocales.includes(lang)) { // assign browser language
      await Trans.switchLanguage(lang);
    }
    /**
     * Check user is authenticated
     */
    this.authenticatedUser = await this.checkAuth();
    if (! this.authenticatedUser) {
      this.$router.push({name: "login"});
    } else {
      // 
      // Please do not remove it, it periodically updates the session lifetime.
      // Thus, as long as the user's browser is open, the user logged in to the application,
      // otherwise the session will be closed when the ttl period expires.
      // 
      this.admin.http.post('/auth/session', { update: 1 }); 
    }
  },
  computed: {
    avatarExists() {
      let base64Image = this.$store.getters["auth/getAvatar"];
      if (base64Image == "undefined" || base64Image == "null" || isEmpty(base64Image)) { 
        return false;
      }
      return true;
    },
    getAvatar() {
      let base64Image = this.$store.getters["auth/getAvatar"]; 
      if (base64Image == "undefined" || base64Image == "null" || isEmpty(base64Image)) { 
        return this.admin.getConfig().avatar.base64; // default avatar image
      }
      return base64Image;
    },
    getEmail() {
      return this.$store.getters["auth/getEmail"];
    },
    getFullname() {
      return this.$store.getters["auth/getFullname"];
    },
    getCurrentLocale() {
      return this.$store.getters[`getLocale`];
    },
    getHeaderMenu() {
      return [];
    },
    getProfileMenu() {
      return [
        {
          icon: "mdi-account",
          text:  this.$t("va.account"),
          link: "/account",
        },
        {
          icon: "mdi-key-variant",
          text: this.$t("va.changePassword"),
          link: "/password",
        },
        {
          icon: "mdi-logout",
          text: this.$t("va.logout"),
          logout: true,
        },
      ];
    },
    getFooterMenu() {
      return [
        {
          href: "https://oloma.dev/end-user-license-agreement",
          text: this.$t("menu.terms"),
        },
      ]
    }
  },
  methods: {
    ...mapActions({
      checkAuth: "auth/checkAuth",
    }),
    logout() {
      this.$store.dispatch("auth/logout");
    },
  },
};</script>
```

</content>
</tab>


### VaAppBar:logo

VaAppBar layout <kbd>logo</kbd> ve <kbd>navbar-logo</kbd> olmak üzere iki ayrı slot içerisinden logo eklemenize izin verir.

```html
<template v-slot:logo>
  <div class="mb-1" style="letter-spacing: 1px;">logo</div>
</template>
```

Header bölümündeki logo ya alternatif olarak <kbd>navbar-logo</kbd> slotu ile navigasyon üzerinde de logo ekleyebilirsiniz.

![Navbar Logo](/images/navbar-logo.png)

```html
<template v-slot:navbar-logo>
  <div class="navbar-logo ml-14">
    <img src="/src/assets/logo/navbar-logo.png" border="0" />
  </div>
</template>
```

### VaAppBar:header-buttons

VaAppBar layout <kbd>header-buttons</kbd> slotunu kullanarak kendi tuşlarınızı oluşturabilirsiniz.

![Header Buttons](/images/header-buttons.png)

```html
<template v-slot:header-buttons>
  <v-btn
    icon
    small
  >
    <v-badge :color="yellow" dot>
      <v-icon>mdi-cart-outline</v-icon>
    </v-badge>
  </v-btn>
  <v-btn v-if="!authenticatedUser" :to="{ name: 'login' }">{{ $t("menu.login") }}</v-btn>
</template>
```

### Footer

Bu alan <a href="https://vuetifyjs.com/en/components/footers/" target="_blank">VFooter</a> bileşeni içinde bazı kurumsal bilgilerin gösterilmesini sağlayan altbilgi alanıdır.

<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
       <th>Özellik</th>
       <th>Tür</th>
       <th>Açıklama</th>
    </tr>
  </thead>
  <tbody>
    <tr>
       <td><strong>footerMenu</strong></td>
       <td><code>array</code></td>
       <td>Menu bağlantıları.</td>
    </tr>
  </tbody>
</table>
</div>

![Footer](/images/footer.png)

<b>Slotlar</b>

<div class="table-responsive">
<table class="table">
   <thead>
    <tr>
       <th>Ad</th>
       <th>Açıklama</th>
    </tr>
   </thead> 
   <tbody>
      <tr>
         <td><strong>default</strong></td>
         <td>Sağ taraftaki bilgiler.</td>
      </tr>
   </tbody>
</table>
</div>

### Breadcrumbs

Breadcrumb'lar için <a href="https://vuetifyjs.com/en/components/breadcrumbs/" target="_blank">v-breadcrumbs</a> bileşenini kullananarak geçerli rotadan otomatik olarak hiyerarşik bağlantılar oluşturur.

![Breadcrumbs](/images/breadcrumbs.png)

### Aside

Bağlamsallaştırılmış bazı ek bilgiler koyduğunuz özelleştirilebilir alandır. Herhangi bir bağlamda, herhangi bir yerden içerik entegrasyonu için <kbd>VaAsideLayout</kbd> bileşeni kullanılır.

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Nitelikler</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>location</strong></td>
         <td><code>string</code></td>
         <td>Açılan bölümün pozisyonu. Alabileceği değerler: <kbd>'top' | 'end' | 'bottom' | 'start' | 'left' | 'right'</kbd>.</td>
      </tr>
      <tr>
         <td><strong>width</strong></td>
         <td><code>number</code></td>
         <td>Açılan bölümün genişliği.</td>
      </tr>
   </tbody>
</table>
</div>

![Aside](/images/aside.png)

<kbd>olobase-demo-ui/src/resources/Companies/List.vue</kbd>

```html
<template>
  <div>
    <va-aside-layout 
      :title="asideTitle"
    >
      <companies-form
        v-if="action !== 'show'"
        :id="id"
        :item="item"
        @saved="onSaved"
      ></companies-form>
    </va-aside-layout>
    <va-list 
      class="mb-0" 
      @action="onAction"
      :filters="filters"
      :fields="fields"
      :items-per-page="50"
      disable-create-redirect
    >
      <va-data-table-server
        row-show
        disable-show
        disable-create-redirect
        disable-edit-redirect
        @item-action="onAction"
      >
      </va-data-table-server>
    </va-list>
   </div>
</template>
```

Daha fazla detay için <b>demo</b> uygulamamızdaki <kbd>companies</kbd> modülüne gözatın.

### Menü Bağlantıları

Gezinmeyi destekleyen bileşenlere yerleştirilebilecek tüm gezinme menüleri, bir bağlantıyı temsil eden basit bir nesne dizisidir. Gezinmeyi destekleyen bileşenler; <b>header</b>, <b>profile</b>, <b>sidebar</b> ve <b>footer</b> menü olmak üzere toplam 4 farklı bileşenden oluşur.

Aşağıdaki gibi basit bir menü dizisini bu bileşenlere göndererek menüler oluşturulur.

```js
[
  {
    icon: "mdi-account",
    text: this.$t("menu.profile"),
    link: "/profile",
  },
  {
    icon: "mdi-settings",
    text: this.$t("menu.settings"),
    link: "/settings",
  },
]
```

Sidebar menu örneği:

<kbd>src/_nav.js</kbd>
```js
export default  {

  build: async function(t, admin) {

    return [
      {
        icon: "mdi-view-dashboard-outline",
        text: t("menu.dashboard"),
        link: "/dashboard",
      },
      {
        icon: "mdi-cart-variant",
        text: t("menu.plans"),
        children: [
          {
            icon: "circle",
            text: t("menu.subscriptions"),
            link: "/subscriptions",
          },
          {
            icon: "circle",
            text: t("menu.services"),
            link: "/services",
          },
        ]
      },
    ];

  } // end func

} // end class
```

Menüyü yetkilere göre dinamik olarak oluşturmak için <a href="/ui/authorization.html#OR%20ve%20&&%20Durumuları">ilgili belgeye</a> gözatın.

Nesne bağlantı yapısı:

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Nitelik</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>string</code></td>
         <td>Sol tarafta gösterilen menü simgesi. Geçerli bir <a href="https://pictogrammers.github.io/@mdi/font/7.0.96/" target="_blank">mdi</a> olmalıdır ve yalnızca <b>kenar çubuğu</b> ve <b>profil</b> menüsünde desteklenir.</td>
      </tr>
      <tr>
         <td><strong>text</strong></td>
         <td><code>string</code></td>
         <td>Bağlantı etiketi.</td>
      </tr>
      <tr>
         <td><strong>link</strong></td>
         <td><code>string | object</code></td>
         <td>Geçerli Vue yönlendirici menüsü. Child olan bağlantılar ile kullanılamaz.</td>
      </tr>
      <tr>
         <td><strong>href</strong></td>
         <td><code>string</code></td>
         <td>Sadece harici bağlantı için kullanın. Target değeri boş olarak gönderilir. Child olan bağlantılar ile kullanılamaz.</td>
      </tr>
      <tr>
         <td><strong>children</strong></td>
         <td><code>array</code></td>
         <td>Yalnızca kenar çubuğu için hiyerarşik menüye yönelik alt bağlantılar için kullanılır. Bağlantı veya href ile kullanılamaz.</td>
      </tr>
      <tr>
         <td><strong>expanded</strong></td>
         <td><code>boolean</code></td>
         <td>Children bağlantılarını varsayılan olarak genişletilmiş olarak gösterir. Yalnızca child olan bağlantıları etkiler.</td>
      </tr>
      <tr>
         <td><strong>heading</strong></td>
         <td><code>string</code></td>
         <td>Bağlantıyı yalnızca kenar çubuğu menüsü için bölüm etiketi başlığına dönüştürür. Kendi bünyesindeki diğer tüm özellikler devre dışı kalır.</td>
      </tr>
      <tr>
         <td><strong>divider</strong></td>
         <td><code>boolean</code></td>
         <td>Bağlantıyı yalnızca kenar çubuğu menüsü için ayırıcıya dönüştürür. Kendi bünyesindeki diğer tüm özellikler devre dışı kalır.</td>
      </tr>
   </tbody>
</table>
</div>