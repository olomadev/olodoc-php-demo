
## Authentication

Olobase Admin is first and foremost an admin panel application, so it includes basic HTTP authentication, JWT, OAuth etc. It offers several authentication providers to integrate well with all different types of authentication systems, such as. Similar to data providers, Olobase Admin uses an adapter approach model that allows your API server to communicate with your authentication by writing your own authentication provider.

### Available Authentication Providers

Olobase Admin provides 2 configurable authentication providers:

* <b>basicAuthProvider:</b> Basic HTTP authentication.
* <b>jwtAuthProvider:</b> <a href="https://jwt.io/introduction" target="_blank">JWT</a> (default) for stateless authentication.

All of these providers need an <a href="https://axios-http.com/docs/intro" target="_blank">axios</a> instance to work. The easiest way is to create an axios instance and pass it to both authentication and data providers:

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

All included providers can be used in the same way; If you want to use <b>basicAuthProvider</b> instead of <b>jwtAuthProvider</b>, simply replace <b>jwtAuthProvider</b> with <b>basicAuthProvider</b>.

### First Auth Parameter: Axios

To access the axios instance from anywhere in your custom Vue components via <code>admin.http</code>, the <b>axios</b> instance is called the <b>OlobaseAdmin</b> constructor method and from there to the <b>jwtAuthProvider</b> is sent to the provider. This submitted example allows reuse of the current authentication state (cookie or token).

### Second Auth Parameter: Params

If you pass a second optional <kbd>params</kbd> variable to your auth provider like this, it can be used to replace or add to various existing parameters:

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
         <th>Option</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>routes</strong></td>
         <td>Object containing all authentication routes, i.e. login, logout, refresh (JWT), user information.</td>
      </tr>
      <tr>
         <td><strong>getToken</strong></td>
         <td>JWT only function that returns token from a successful login API response has <code>token</code> set by default.</td>
      </tr>
      <tr>
         <td><strong>getCredentials</strong></td>
         <td>Function mapper for credentials that returns a compatible credential format for your API.</td>
      </tr>
      <tr>
         <td><strong>getId</strong></td>
         <td>The function that returns the id of the current user.</td>
      </tr>
      <tr>
         <td><strong>getFullname</strong></td>
         <td>The function that returns the name of the current user (user information retrieved from the API endpoint) is by default: <code>fullname</code></td>
      </tr>
      <tr>
         <td><strong>getEmail</strong></td>
         <td>The function that returns the current user's email is, by default: <code>email</code>.</td>
      </tr>
      <tr>
         <td><strong>getPermissions</strong></td>
         <td>The function that returns the roles of the current user is by default: <code>permissions</code>.</td>
      </tr>
   </tbody>
</table>
</div>

### Authentication with JWT (Default)

With this provider, a simple bearer token will be added to the Authorization header for each subsequent XHR request. The JWT will be stored within <b>cookies</b> under a configurable key. While the <kbd>/api/auth/token</kbd> route is used when creating the token, the specific <kbd>/api/auth/refresh</kbd> route is used for the auto-refresh token once the token expires, which can be set from the configuration.

<a href="https://creately.com/diagram/example/ij64mtn22/jwt-authentication-classic" target="_blank">Check out the JWT flow diagram</a>

For JWT authentication to work, JWT keys must be configured on the backend. You can find relevant information from this link. <a href="/php-api/jwt-authentication.html#Generating%20JWT%20Keys">Generating JWT Keys</a>.

### Basic HTTP authentication

Basic HTTP Provider can be used for basic cases. All basic authentication information will be easily sent to each XHR request. By default, basic authentication returns only the username used for credentials. If you prefer to use a specific API endpoint to provide more user information to Olobase Admin (this is recommended if you need functional profile editing), you need to set the user route as follows:

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

### Authorization Pages

All unauthenticated pages such as Login, Register or any special public pages should be saved as classic pages in your base router file in <kbd>src/router/index.js</kbd>. This method allows you to use any private or public <b>layout</b>. Authenticated private pages should use the special <kbd>src/router/admin.js</kbd> file. This file is a simple admin redirect object that takes advantage of the entire admin layout with the app bar header and sidebar.

### Login Page

In order for the login page to work, it must have a classic login form. Then all you need to do is send it to the login authentication action, which will pass the credentials to the login authentication provider method.

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

### Login Redirect

For unauthenticated login redirection, to localize the login URL path, Olobase Admin looks for a route called login; Therefore, make sure that your login route named <b>dashboard</b> is set in the configuration in your admin plugin.

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

### Registration and Password Reset

If you need to add these features, the home page is the perfect place to do it. Simply add the relevant forms, then call your API-specific registration or password reset endpoint using the global admin <b>this.admin.http()</b> method as shown in the next section of the profile page.

### Account Page

As explained above, this <b>authenticated</b> page must be registered in <kbd>src/router/admin.js</kbd> for the admin layout to be inherited. In this way, Olobase Admin can obtain the authenticated user's information and pre-fill the form in the user account.

![Account](/images/account.jpg)

The <b>this.admin.http()</b> method should be used to make authenticated API requests as saving account information may differ depending on the project context. The default api url for the current user's account update is <kbd>/api/account/update</kbd>.

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

> When Olobase Admin form elements are used on pages other than CRUD operations, the name of the relevant resource must be entered in the <b>resource</b> attribute for tag translation operations, as seen above, since the resource is unknown, unlike CRUD numbers. Otherwise, the translation process for the element will not occur.

### Authentication with checkAuth()

After successful account update, you can refresh the new user information in the Vuex store by calling <b>checkAuth()</b> from your authentication provider method and obtain the user's information with this function.

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

The object returned from the <b>checkAuth()</b> method.

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

If you want to use it to access user information on your login page immediately after logging in, you can also use the checkAuth method immediately after logging in.

```js
await this.login({ username: this.username, password: this.password });
await this.checkAuth().then(function(response){
  console.error(response);  // { "user" : { "id" : "50767814-6c78-4b9e-b858-9ff18dbd531b", "fullname": "James Brown" } }
})
```

> If you want to show a status message after any action you can use the following code.

```js
this.admin.message('info', "This is an example info message");
```

For more detailed information about messages, visit the <a href="/ui/messages.html">messages</a> section.

### Writing Your Own Authentication Provider

If none of these configurable authentication providers suit you, you can always write your own authorization provider by applying the following convention, similar to <a href="/ui/data-providers.html">data providers</a>.

### API Contract

Authentication providers must comply with a specific agreement to allow communication with the Olobase Admin. The next object represents the minimum contract that must be implemented:

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

All of these methods can be explained as follows:

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Operation</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>login</strong></td>
         <td>Sends credentials to your API. If the response status code is outside the 2xx range, a rejected <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise" target="_blank">promise</a> should return. If successful, <b>checkAuth</b> is called.</td>
      </tr>
      <tr>
         <td><strong>logout</strong></td>
         <td>Explicitly logout from your API. If successful, <b>checkAuth</b> is called.</td>
      </tr>
      <tr>
         <td><strong>checkAuth</strong></td>
         <td>Checks the current authentication validity by retrieving user information from a specific API endpoint. Called after every client-side route navigation. If successful, refresh the user information in the public authentication store. If it fails, clear the authentication store information and redirect to the login page.</td>
      </tr>
      <tr>
         <td><strong>checkError</strong></td>
         <td>Called after each API error, it allows you to take special actions based on the API error condition. Do automatic logout if rejection <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Promise" target="_blank">promise</a> is returned. The most common use case is to force automatic logout if the API returns a 401 or 403 status code.</td>
      </tr>
      <tr>
         <td><strong>getName</strong></td>
         <td>Return the user's full name from the authenticated user object. Used to show the username in the user title dropdown menu.</td>
      </tr>
      <tr>
         <td><strong>getEmail</strong></td>
         <td>Return the user's email from the authenticated user object. Used to show email in user title dropdown menu.</td>
      </tr>
      <tr>
         <td><strong>getPermissions</strong></td>
         <td>Return the roles/permissions for the authenticated user. Used for <a href="/ui/authorization.html">Authorization System</a>.</td>
      </tr>
   </tbody>
</table>
</div>