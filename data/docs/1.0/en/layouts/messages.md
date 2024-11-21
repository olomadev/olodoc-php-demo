
## Mesajlar

<b>va-messages</b> component vuetify Exception messages using <a href="https://vuetifyjs.com/en/components/snackbars/" target="_blank">v-snackbar</a> component or used to show error messages to the user in case of API errors.

<b>Defined status messages:</b>

* info
* error
* warning
* success

![Info](/images/info.png)

![Error](/images/error.png)

![Warning](/images/warning.png)

![Success](/images/success.png)

### Manual Display of Messages

If you want to show a status message after any manual action, you can use the code below.

```js
this.admin.message('error', "This is an example error message");
```

To use messages, you must inject the admin object as in the following example.

```js
<script>
export default {
  inject: ["admin"],
  methods: {
    cancel() {
      this.admin.message('error', "This is an example error message");
    },
  }
}
</script>
```

The messages component is defined in <b>Layout.vue</b> as follows.

<kbd>admin/src/components/layout/Layout.vue</kbd>

```html [line-numbers] data-line="11"
<template>
  <v-app>
     <!-- @slot Top app bar region, ideal place for VAppBar. -->
     <slot name="appbar"></slot>
     <v-main>
      <div class="d-flex flex-column fill-height">     
          <header>
            <slot name="header"></slot> 
          </header>
          
          <va-messages></va-messages>

          <v-container fluid class="flex mb-10">
            <!-- New Vue 3 code -->
              <router-view v-slot="{ Component }"></router-view>
          </v-container>

          <footer>
            <slot name="footer"></slot>
          </footer>
      </div>
     </v-main>
    <!-- @slot Right aside region, where you can put anything you need. -->
    <slot name="aside"></slot>
  </v-app>
</template>
```

> Remember, status messages are only shown on pages visited by an authenticated user. In order for this component to be displayed on pages such as <b>Login.vue</b> or <b>ForgotPassword.vue</b>, you must manually declare the <b>va-messages</b> component in the relevant template as follows .

<kbd>src/views/Login.vue</kbd>

```html [line-numbers] data-line="3"
<template>
  <div class="xs-12 sm-10 md-8 lg-6">
    <va-messages></va-messages>
  </div>
</template>
```

### Customization

Features such as message colors, position, icon, duration and title can be set in the <kbd>src/\_config.js</kbd> file in your application, as shown in the following example.

```js
export default {
  /*
  ...
  */
  snackbar: {
    error: {
      class: "mt-10 slide-in",
      color: "error",
      icon: "mdi-close-circle",
      location: "top", // left, bottom, right
      variant: "elevated", // 'flat' | 'text' | 'elevated' | 'tonal' | 'outlined' | 'plain'
      rounded: true,
      timeout: 7500,
      title: "va.messages.error",
      visible: true 
    },
    info: {
      class: "mt-10 slide-in",
      color: "blue",
      icon: "mdi-information",
      location: "top",
      variant: "elevated",
      rounded: true,
      timeout: 7500,
      title: "va.messages.info",
      visible: true
    },
    success: {
      class: "mt-10 slide-in",
      color: "success",
      icon: "mdi-checkbox-marked-circle",
      location: "top",
      variant: "elevated",
      rounded: true,
      timeout: 7500,
      title: "va.messages.success",
      visible: true
    },
    warning: {
      class: "mt-10 slide-in",
      color: "warning",
      icon: "mdi-alert-circle",
      location: "top",
      variant: "elevated",
      rounded: true,
      timeout: 7500,
      title: "va.messages.warning",
      visible: true
    }
  },
};
```

### Confirmation Messages

You can use confirmation messages with the <b>confirm</b> method on your current page, as shown in the following example.

![Confirm Message](/images/confirm-message.png)

```js
<script>
export default {
  inject: ["admin"],
  methods: {
    async cancel() {
      let result = await this.admin.confirm("Confirmation", "Are you sure want to cancel ?");
      if (result) {
        // go on
      }
    },
  }
}
</script>
```

### Display of Messages

Errors returned from the application are shown to the user via the <b>parseApiErrors()</b> method as follows.

<kbd>src/plugins/useHttp.js</kbd>

```js
/**
 * parse validation errors
 */
function parseApiErrors(error) {
  if (typeof error.response.data.data.error !== "undefined") {
    let errorHtml = ""
    let hasError = false
    let errorObject = error.response.data.data.error
    if (errorObject instanceof Object) {
      errorHtml = "<ul>";
      Object.keys(errorObject).forEach(function (k) {
        if (Array.isArray(errorObject[k])) {
          hasError = true;
          errorObject[k].forEach(function (subObject) {
            if (typeof subObject === "string") {
              errorHtml += '<li>' + `${subObject}` + '</li>'
            } else if (typeof subObject === "object") {
              Object.values(subObject).forEach(function (subErrors) {
                if (Array.isArray(subErrors)) {
                  subErrors.forEach(function (strError) {
                    errorHtml += '<li>' + `${strError}` + '</li>'
                  });
                }
              });
            }
          });
        } else {
          hasError = true;
          errorHtml += '<li>' + `${errorObject[k]}` + '</li>'
        }
      })
      errorHtml += "</ul>"; 
    } else if (typeof errorObject === "string") {
      errorHtml = errorObject
      if (errorObject == "Token Expired") {
        /*
          ....
         */
      } else {
        hasError = true
      }
    }
    if (hasError) {
      store.commit("messages/show", { type: 'error', message: errorHtml })
    }
    return error;
  }
}
```

### Catching/Hiding Error Messages

In some cases, you may want to catch errors returned from the API server when you make HTTP requests. In this case you may need to disable the current global error display. You can use the <b>this.admin.hideApiErrors()</b> function for this.

```js
this.admin.hideApiErrors(true);
//
// ... admin http request(s)
// 
this.admin.hideApiErrors(false); // restore api errors
```

In the following example, global errors are disabled and the error returned from the API is caught.

```js
<script>
export default {
  inject: ['admin'],
  data() {
    return {
      errorMessage: null,
    }
  },
  methods: {
    async deleteDomain(domainId) {
      const Self = this;
      this.admin.hideApiErrors(true);
      let response = await this.admin.http.delete("/domains/delete/" + domainId).catch(function (error) {
        if (error 
          && error["response"] 
          && error["response"]["data"] 
          && error["response"]["data"]["data"]
          && error["response"]["data"]["data"]["error"]
          ) {
            Self.errorMessage = error["response"]["data"]["data"]["error"]
        }
        Self.admin.hideApiErrors(false);
      });
    }
  }
};
</script>
```