
## Mesajlar

<b>va-messages</b> bileşeni vuetify <a href="https://vuetifyjs.com/en/components/snackbars/" target="_blank">v-snackbar</a> bileşenini kullanarak özel durum mesajları veya API hatalarında kullanıcıya hata mesajları göstermek için kullanılır.

<b>Tanımlı durum mesajları:</b>

* info
* error
* warning
* success

![Info](/images/info.png)

![Error](/images/error.png)

![Warning](/images/warning.png)

![Success](/images/success.png)

### Mesajların Manuel Gösterimi

Eğer manuel olarak herhangi bir işlemden sonra bir durum mesajı göstermek istiyorsanız aşağıdaki kodu kullanabilirsiniz.

```js
this.admin.message('error', "This is an example error message");
```

Mesajları kullanabilmeniz için admin nesnesini takip eden örnekte olduğu gibi enjekte etmelisiniz.

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

Mesajlar bileşeni aşağıdaki gibi <b>Layout.vue</b> içerisinde tanımlıdır.

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

> Unutmayın durum mesajları sadece kimliği doğrulanmış kullanıcının gezindiği sayfalarda gösterilir. <b>Login.vue</b> ya da <b>ForgotPassword.vue</b> gibi sayfalarda bu bileşenin gösterilebilmesi için <b>va-messages</b> bileşenini manual olarak ilgili şablon içerisinde aşağıdaki gibi ilan etmiş olmanız gerekmektedir.

<kbd>src/views/Login.vue</kbd>

```html [line-numbers] data-line="3"
<template>
  <div class="xs-12 sm-10 md-8 lg-6">
    <va-messages></va-messages>
  </div>
</template>
```

### Özelleştirme

Mesaj renkleri, pozisyonu, ikonu, süresi ve başlığı gibi özellikler takip eden örnekte gösterildiği gibi uygulamanız içinde yer alan <kbd>src/\_config.js</kbd> dosyasından ayarlanabilir.

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

### Onay Mesajları

Onay mesajlarını <b>confirm</b> metodu ile geçerli sayfanızda takip eden örnekte gösterildiği gibi kullanabilirsiniz.

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

### Mesajların Gösterimi

Uygulamadan dönen hatalar <b>parseApiErrors()</b> metodu aracılığı ile aşağıdaki gibi kullanıcıya gösterilir.

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

### Hata Mesajlarını Yakalamak/Gizlemek

Bazı durumlarda http istekleri yaptığınızda api sunucusundan dönen hataları yakalamak isteyebilirsiniz. Bu durumda mevcut global hata gösterimini devre dışı bırakmanız gerekebilir. Bunun için <b>this.admin.hideApiErrors()</b> fonksiyonunu kullanabilirsiniz.

```js
this.admin.hideApiErrors(true);
//
// ... admin http request(s)
// 
this.admin.hideApiErrors(false); // restore api errors
```

Takip eden örnekte global hatalar devre dışı bırakılarak api den dönen hata yakalanıyor. 

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