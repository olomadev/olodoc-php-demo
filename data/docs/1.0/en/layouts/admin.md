
## Admin Layout

When you download the Olobase Admin Skelethon, your project will be launched with the pre-created default admin layout. The <b>.vue</b> template for this layout is located in the <kbd>src/layout/Admin.vue</kbd> file and is linked to the authenticated route in <kbd>src/routes/admin.js</kbd>. connected as follows:

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

The customizable main layout with one slot for each area is called <kbd>VaLayout</kbd>.

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Name</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>VaAppBar</strong></td>
         <td>The sidebar area is the ideal place for the VNavigationDrawer content header region, additional custom messages or important notifications as impersonation status, etc. Ideal place for.</td>
      </tr>
      <tr>
         <td><strong>VaBreadcrumbs</strong></td>
         <td>Content header region, VBreadcrumbs and/or additional custom messages or important notifications as impersonation status, etc. Ideal place for.</td>
      </tr>
      <tr>
         <td><strong>VaFooter</strong></td>
         <td>You can put some corporate information and links in the footer area.</td>
      </tr>
      <tr>
         <td><strong>VaAside</strong></td>
         <td>2nd left or right side area where you can put everything you need.</td>
      </tr>
   </tbody>
</table>
</div>

> This slot composition system allows for complete customization. You can completely customize or replace each component. Please browse to <kbd>/src/layout/Admin.vue</kbd>. You must make customizations on this file.

### Menu Links

See <a href="/ui/layout.html#Links">links</a> below.

### VaAppBar

The default <kbd>VAppBar</kbd> contains the application title, header menus, direct resource creation links, global refresh action, profile menu. The profile user drop-down menu does not appear in guest mode.

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Property</th>
         <th>Type</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>To change the default title, change the title key value in the OlobaseAdmin.setOptions() method.</td>
      </tr>
      <tr>
         <td><strong>elevation</strong></td>
         <td><code>number|string</code></td>
         <td>Sets the shade degree of the component. (See. <a href="https://vuetifyjs.com/en/styles/elevation/#usage" target="_blank">Vuetify Elevations</a>).</td>
      </tr>
      <tr>
         <td><strong>headerMenu</strong></td>
         <td><code>array</code></td>
         <td>Header allows links to be visible at the top.</td>
      </tr>
      <tr>
         <td><strong>disableCreate</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the creation menu.</td>
      </tr>
      <tr>
         <td><strong>disableReload</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the reload (page refresh) key.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Sets the main color for the VAppBar component.</td>
      </tr>
      <tr>
         <td><strong>sidebarColor</strong></td>
         <td><code>string</code></td>
         <td>Sets the specified color for VNavigationDrawer.</td>
      </tr>
      <tr>
         <td><strong>listItemColor</strong></td>
         <td><code>string</code></td>
         <td>Sets the list item color for the VAppBar component.</td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>string</code></td>
         <td>Sets the vertical height used by the component. The default is "compact". Possible values: <kbd>'default' | 'prominent' | 'comfortable' | 'compact'</kbd>.</td>
      </tr>
      <tr>
         <td><strong>listItemDensity</strong></td>
         <td><code>string</code></td>
         <td>Sets the vertical height of list items. The default is "compact". Possible values: <kbd>'default' | 'prominent' | 'comfortable' | 'compact'</kbd>.</td>
      </tr>
      <tr>
         <td><strong>flat</strong></td>
         <td><code>boolean</code></td>
         <td>Removes AppBar shadow.</td>
      </tr>
   </tbody>
</table>
</div>

### Resource Links

If the current user has permissions, creating action links will be automatically created from your saved resources.

### Reload Button

The reload key dynamically refreshes every listing call from your data provider (for example <b>getList</b>, <b>getOne</b> or <b>getMany</b>). With a manual click, the content sends a new listing call. This button appears only on listing pages.

![Refresh Button](/images/refresh-button.png)

### VaAppBar:sidebar

Vuetify is the default customizable section with hierarchical menu with <a href="https://vuetifyjs.com/en/components/navigation-drawers/" target="_blank">VNavigationDrawer</a> component. This section is located within the <kkd>VaAppBar</kkd> component.

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
};
</script>
```

</content>
</tab>

### VaAppBar:logo

VaAppBar allows you to add logos from two separate slots: layout <kbd>logo</kbd> and <kbd>navbar-logo</kbd>.

```html
<template v-slot:logo>
  <div class="mb-1" style="letter-spacing: 1px;">logo</div>
</template>
```

As an alternative to the logo in the header section, you can also add a logo on the navigation with the <kbd>navbar-logo</kbd> slot.

![SideBar](/images/navbar-logo.png)

```html
<template v-slot:navbar-logo>
  <div class="navbar-logo ml-14">
    <img src="/src/assets/logo/navbar-logo.png" border="0" />
  </div>
</template>
```

### VaAppBar:header-buttons

You can create your own buttons using the VaAppBar layout <kbd>header-buttons</kbd> slot.

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

This section is a footer area that allows displaying some corporate information in the <a href="https://vuetifyjs.com/en/components/footers/" target="_blank">VFooter</a> component.

<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
       <th>Property</th>
       <th>Type</th>
       <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
       <td><strong>footerMenu</strong></td>
       <td><code>array</code></td>
       <td>Menu links.</td>
    </tr>
  </tbody>
</table>
</div>

![SideBar](/images/footer.png)

<b>Slots</b>

<div class="table-responsive">
<table class="table">
   <thead>
    <tr>
       <th>Name</th>
       <th>Description</th>
    </tr>
   </thead> 
   <tbody>
      <tr>
         <td><strong>default</strong></td>
         <td>Information on the right.</td>
      </tr>
   </tbody>
</table>
</div>

### Breadcrumbs

Automatically creates hierarchical links from the current route using the <a href="https://vuetifyjs.com/en/components/breadcrumbs/" target="_blank">v-breadcrumbs</a> component for breadcrumbs.

![Breadcrumbs](/images/breadcrumbs.png)

### Aside

Customizable layout where you put some additional contextualized information. The <kbd>VaAsideLayout</kbd> component is used to integrate content from anywhere, in any context.

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

For more details, check out the <kbd>companies</kbd> module in our <b>demo</b> application.

<div class="table-responsive">
<table class="table">
   <thead>
       <tr>
          <th>Property</th>
          <th>Type</th>
          <th>Description</th>
       </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>location</strong></td>
         <td><code>string</code></td>
         <td>Position of the opened section. Possible values: <kbd>'top' | 'end' | 'bottom' | 'start' | 'left' | 'right'</kbd>.</td>
      </tr>
      <tr>
         <td><strong>width</strong></td>
         <td><code>number</code></td>
         <td>Width of the opened section.</td>
      </tr>
   </tbody>
</table>
</div>

### Menu Links

Any navigation menu that can be placed in components that support navigation is a simple array of objects that represent a link. Components that support navigation; It consists of a total of 4 different components: <b>header</b>, <b>profile</b>, <b>sidebar</b> and <b>footer</b> menu.

Menus are created by sending a simple menu array as follows to these components.

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

Sidebar menu example:

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

To create the menu dynamically based on authorizations, see <a href="/ui/authorization.html#OR%20and%20&&%20Conditions">related document</a>.

Object link structure:

<div class="table-responsive">
<table class="table">
   <thead>
       <tr>
          <th>Property</th>
          <th>Type</th>
          <th>Description</th>
       </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>string</code></td>
         <td>The menu icon shown on the left. Must be a valid <a href="https://pictogrammers.github.io/@mdi/font/7.0.96/" target="_blank">mdi</a> and is only supported in <b>sidebar</b> and <b>profile</b> menu.</td>
      </tr>
      <tr>
         <td><strong>text</strong></td>
         <td><code>string</code></td>
         <td>Link tag.</td>
      </tr>
      <tr>
         <td><strong>link</strong></td>
         <td><code>string | object</code></td>
         <td>Current Vue router menu. It cannot be used with child connections.</td>
      </tr>
      <tr>
         <td><strong>href</strong></td>
         <td><code>string</code></td>
         <td>Use for external links only. The target value is sent as empty. It cannot be used with child connections.</td>
      </tr>
      <tr>
         <td><strong>children</strong></td>
         <td><code>array</code></td>
         <td>Used only for sublinks to the hierarchical menu for the sidebar. Cannot be used with link or href.</td>
      </tr>
      <tr>
         <td><strong>expanded</strong></td>
         <td><code>boolean</code></td>
         <td>Shows Children links as expanded by default. It only affects links that are children.</td>
      </tr>
      <tr>
         <td><strong>heading</strong></td>
         <td><code>string</code></td>
         <td>It just turns the link into a section label title for the sidebar menu. All other features within it are disabled.</td>
      </tr>
      <tr>
         <td><strong>divider</strong></td>
         <td><code>boolean</code></td>
         <td>It turns the link into a separator for the sidebar menu only. All other features within it are disabled.</td>
      </tr>
   </tbody>
</table>
</div>