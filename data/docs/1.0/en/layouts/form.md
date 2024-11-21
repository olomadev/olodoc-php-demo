
## Form

The <b>Create</b> and <b>Edit</b> pages allow creating a new resource item or modifying an existing one using the data provider create and update methods respectively. In general, these pages will share the same form, although this is not mandatory. With Olobase Admin, form development can be done with minimal code thanks to the many available input components with current form context information.

![Form](/images/form.png)

### Layouts

Both <b>create</b> and <b>edit</b> layouts with <a href="/ui/show.html" target="_blank">show</a> page containing specific contextual actions shares similar layout. There's nothing more to say about them since <b>VaForm</b> will do the actual work.

### Create Layout

Page layout for data creation.

<b>Mixins</b>

* Resource

<b>Properties</b>

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
         <td>Optional h1 heading shown to the left of the header.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td><strong>actions</strong></td>
         <td>Additional custom action buttons slot.</td>
      </tr>
      <tr>
         <td><strong>default</strong></td>
         <td>Page content slot.</td>
      </tr>
   </tbody>
</table>
</div>

### Cloning

Note that as soon as a specific resource query string with a valid existing ID exists, the render page supports copying (i.e. cloning) of values from other existing resources. This is done automatically via the <b>VaCloneButton</b>, which is available by default in <b>VaDataTableServer</b>. That's why the vue component <b>Create</b> has element support that allows you to inject it into <b>VaForm</b>.

```html
<template>
  <va-create-layout>
    <va-form :item="item">
      <!-- Olobase Admin inputs component -->
    </va-form>
  </va-create-layout>
</template>

<script>
export default {
  props: ["item"],
};
</script>
```

### Edit Layout

Page layout for data editing.

<b>Mixins</b>

* Resource

<b>Properties</b>

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
         <td>Optional h1 heading shown to the left of the header.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td><strong>actions</strong></td>
         <td>Additional custom action buttons slot.</td>
      </tr>
      <tr>
         <td><strong>default</strong></td>
         <td>Page content slot.</td>
      </tr>
   </tbody>
</table>
</div>

### ID

Compared to page creation, there is a new <b>id</b> property on the API side that corresponds to the resource to be edited and added. Don't forget to put the <b>id</b> attribute on the form to use the data provider update method under the hood.

```html
<template>
  <va-edit-layout>
    <va-form :id="id" :item="item">
      <!-- Olobase Admin inputs component -->
    </va-form>
  </va-edit-layout>
</template>

<script>
export default {
  props: ["id", "item"],
};
</script>
```

### Tabbed layout

Since you have complete freedom over the layout, it is really easy to create a tabbed detail page using any vuetify or custom component. Check out the example below.

![Show Layout](/images/tab.png)

```html
<template>
  <va-show-layout
    :showList="false"
    :showClone="false"
    :showEdit="false"
    :showDelete="false"
  >
    <va-show :item="item">
      <v-tabs v-model="tabs">
        <v-tab value="1">Tab 1</v-tab>
        <v-tab value="2">Tab 2</v-tab>
        <v-tab value="3">Tab 3</v-tab>
      </v-tabs>
      <v-window v-model="tabs">
        <v-window-item value="1">
          <v-card>
            <v-card-text>
              Tab content 1
            </v-card-text>
          </v-card>
        </v-window-item>
        <v-window-item value="2">
          <v-card>
            <v-card-text>
              Tab content 2
            </v-card-text>
          </v-card>
        </v-window-item>
        <v-window-item value="3">
          <v-card>
            <v-card-text>
              Tab content 3
            </v-card-text>
          </v-card>
        </v-window-item>
      </v-window>
    </va-show>
  </va-show-layout>
</template>
```

### Injector

The following example shows the component injector that facilitates resource visualization using Olobase Admin component fields. Inject this element for each Olobase Admin fields.

```js
<script>
export default {
  props: ["id", "item"],
}
</script>
```

<b>Properties</b>

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
         <td><strong>item</strong></td>
         <td><code>object</code></td>
         <td>Explicit element resource object where all properties must be added to Olobase Admin fields.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td>All content is rendered with all internal fields. The element is injected into each area.</td>
      </tr>
   </tbody>
</table>
</div>

As you might guess, VaShow's main role is to inject the full element resource object into each Olobase Admin space component, resulting in minimum standard code. The Olobase Admin field will then be able to capture the value of the resource property specified in the resource property.

### Input Components

Go to <a href="/ui/inputs.html" target="_blank">inputs</a> to see all supported components for editing data. If none of the ones shown here meet your needs, you can also create your own input component.

### Save and Forward

It is recommended to use <b>VaSaveButton</b> as the default save button. This button will automatically synchronize with the main form and form state data when saving to the API.

```html
<template>
  <va-form :id="id" :item="item" redirect="show">
    <!-- Olobase Admin inputs component -->
    <va-save-button></va-save-button>
  </va-form>
</template>
```
```js
<script>
export default {
  props: ["id", "title", "item"],
};
</script>
```

A successful save will redirect to the resource list page by default unless you set an explicit redirect to <b>VaForm</b> as above. Note that this support is only effective for the save button. You can also set redirection via <b>VaSaveButton</b>.

The following example may be useful when you need multiple redirects:

```html
<template>
  <va-form :id="id" :item="item">
    <!-- Olobase Admin inputs component -->
    <va-save-button class="mr-2"></va-save-button>
    <va-save-button
      text
      redirect="create"
      color="secondary"
    ></va-save-button>
  </va-form>
</template>

<script>
export default {
  props: ["id", "title", "item"],
};
</script>
```

As you can see, the code above creates two different buttons. The default one triggers the current save behavior while the other button triggers the save and redirect to list action.

![Save and Create](/images/save-and-create.png)


### Disabling Default Redirect

Use the <kbd>disable-redirect</kbd> feature in VaForm to prevent the default send redirect. This action has no effect on guided save buttons.

```html
<template>
  <va-form 
    :id="id" 
    :item="item" 
    disable-redirect 
    v-model="model"
  >
 </va-form>
</template>
```

### Disabling Snackbar Message

You can use the <kbd>disable-save-message</kbd> feature in VaForm to prevent the default snackbar message.

```html
<template>
  <va-form 
    :id="id" 
    :item="item" 
    disable-redirect 
    disable-save-message
    v-model="model"
  >
 </va-form>
</template>
```

### Form Events

Form events make it easier for you to take action by receiving responses from the server after the form is saved.

```html
<template>
  <va-form 
    :id="id" 
    :item="item" 
    @saved="afterSaveAction($event)"
    v-model="model"
  >
 </va-form>
</template>
```

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event Name</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>model</strong></td>
         <td>Allows you to access the data object sent to the server.</td>
      </tr>
      <tr>
         <td><strong>saved</strong></td>
         <td>It allows you to access the response object returned by the server after the form is registered.</td>
      </tr>
      <tr>
         <td><strong>error</strong></td>
         <td>Allows you to access any exceptional errors returned by the server, if any.</td>
      </tr>
   </tbody>
</table>
</div>

### Form Model

Use the <b>v-model</b> attribute in the form tag so that the v-model feature of the entries in the form can be controlled entirely within <b>va-form</b>.
This way, you won't have to write a v-model for each input. If you still need to use v-model in an input, there is of course no obstacle to this.

An example:

```html
<template>
  <va-form :id="id" :item="item" v-model="model">
    <va-text-input 
      source="description" 
      multiline
    ></va-text-input>
    <va-boolean-input 
      source="active"
      >
    </va-boolean-input>
    <va-save-button></va-save-button>
  </va-form>
</template>
```

```js
<script>
export default {
  props: ["id", "title", "item"],
  data() {
    return {
      model: {
        active: null,
        description: null,
      },
    };
  },
};
</script>
```

### Form Validation

VaForm uses the validation library <a href="https://vuelidate-next.netlify.app/" target="_blank">vuelidate</a>. The following example shows a form validation example with the <b>Vuelidate</b> library:

<kbd>olobase-demo-ui/src/resources/Companies/Form.vue</kbd>

<tab>
<title>Form|Template|Script</title>
<content>

![Form](/images/form-validation.png)
<tcol>

```html
<template>
  <va-form 
    :id="id" 
    :item="item" 
    disable-redirect 
    v-model="model"
  >
    <v-row>
      <v-col>
        <va-text-input
          source="companyName"
          :error-messages="companyNameErrors"
        ></va-text-input>
        <va-text-input
          source="companyShortName"
          :error-messages="companyShortNameErrors"
        ></va-text-input>
        <va-text-input
          source="taxOffice"
          :error-messages="taxOfficeErrors"
        ></va-text-input>
        <va-text-input
          source="taxNumber"
          :error-messages="taxNumberErrors"
        ></va-text-input>
        <va-text-input
          source="address"
          :error-messages="addressErrors"
        ></va-text-input>
        <va-save-button></va-save-button>
      </v-col>
    </v-row>
  </va-form>
</template>
```
<tcol>

```js
<script>
import Utils from "vuetify-admin/src/mixins/utils";
import { useVuelidate } from "@vuelidate/core";
import { required, maxLength, numeric } from "@vuelidate/validators";
import { provide } from 'vue';

export default {
  props: ["id", "item"],
  mixins: [Utils],
  setup() {
    let vuelidate = useVuelidate();
    provide('v$', vuelidate)
    return { v$: vuelidate }
  },
  data() {
    return {
      model: {
        id: null,
        companyName: null,
        companyShortName: null,
        taxOffice: null,
        taxNumber: null,
        address: null,
      },
    };
  },
  validations: {
    model: {
      companyName: {
        required,
        maxLength: maxLength(160),
      },
      companyShortName: {
        required,
        maxLength: maxLength(60),
      },
      taxOffice: {
        maxLength: maxLength(100),
      },
      taxNumber: {
        numeric,
        maxLength: maxLength(60),
      },
      address: {
        maxLength: maxLength(255),
      },
    },
  },
  computed: {
    companyNameErrors() {
      const errors = [];
      const field = "companyName";
      if (!this.v$["model"][field].$dirty) return errors;
      this.v$["model"][field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$["model"][field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "160" }));
      return errors;
    },
    companyShortNameErrors() {
      const errors = [];
      const field = "companyShortName";
      if (!this.v$["model"][field].$dirty) return errors;
      this.v$["model"][field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$["model"][field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "60" }));
      return errors;
    },
    taxOfficeErrors() {
      const errors = [];
      const field = "taxOffice";
      if (!this.v$["model"][field].$dirty) return errors;
      this.v$["model"][field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "100" }));
      return errors;
    },
    taxNumberErrors() {
      const errors = [];
      const field = "taxNumber";
      if (!this.v$["model"][field].$dirty) return errors;
      this.v$["model"][field].numeric.$invalid &&
        errors.push(this.$t("v.number.numeric"));
      this.v$["model"][field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "60" }));
      return errors;
    },
    addressErrors() {
      const errors = [];
      const field = "address";
      if (!this.v$["model"][field].$dirty) return errors;
      this.v$["model"][field].maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "255" }));
      return errors;
    },
  },
  created() {
    this.model.id = this.generateUid();
  }
};
</script>
```

</content>
</tab>

### List View Row Validation

Vue.js provide method is used to perform form validation in list-view data update tables. <b>validations</b> rules and <b>errors</b> messages regarding validation must be declared in the <b>provide</b> method.

![Form](/images/row-validation.png)

<kbd>olobase-demo-ui/src/resources/Permissions/List.vue</kbd>

<tab>
<title>Template|Script</title>
<content>
  
```html
<template>
  <va-list 
    disable-create
    :fields="fields"
    :filters="filters"
    :items-per-page="50"
  >
    <va-data-table-server
      :group-by="groupBy"
      row-create
      row-clone
      row-edit
      disable-edit
      disable-show
      disable-clone
      disable-create-redirect
    >
    </va-data-table-server>
  </va-list>
</template>
```
<tcol>

```js [line-numbers] data-line="6,8,27"
<script>
import { required } from "@vuelidate/validators";

export default {
  props: ["resource"],
  provide() {
    return {
      validations: {
        form: {
          moduleName: {
            required
          },
          resource: {
            required
          },
          route: {
            required
          },
          action: {
            required
          },
          method: {
            required
          }
        }
      },
      errors: {
        moduleNameErrors: (v$) => {
          const errors = [];
          if (!v$['form'].moduleName.$dirty) return errors;
          v$['form'].moduleName.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        resourceErrors: (v$) => {
          const errors = [];
          if (!v$['form'].resource.$dirty) return errors;
          v$['form'].resource.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        actionErrors: (v$) => {
          const errors = [];
          if (!v$['form'].action.$dirty) return errors;
          v$['form'].action.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        routeErrors: (v$) => {
          const errors = [];
          if (!v$['form'].route.$dirty) return errors;
          v$['form'].route.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        methodErrors: (v$) => {
          const errors = [];
          if (!v$['form'].method.$dirty) return errors;
          v$['form'].method.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
      }
    };
  },
  data() {
    return {
      groupBy: [{ key: 'moduleName' }],
      selected: [],
      filters: [],
      fields: [
        {
          source: "data-table-group",
          label: this.$t("va.datatable.group"),
          sortable: false,
        },
        {
          source: "moduleName",
          sortable: true,
        },
        {
          source: "resource",
          sortable: true,
        },
        {
          source: "action",
          type: "select",
          sortable: true,
        },
        {
          source: "route",
          sortable: true,
        },
        {
          source: "method",
          type: "select",
          sortable: true,
        },
      ],
    };
  }
};
</script>
```

</content>
</tab>

### Server Side Authentication

After all verification fields are completed on the client side, verification is performed on the server side. If your API finds a validation error, it sends the response to the client as follows, containing errors for all validation fields, with the response body always using a 400 status code.

```json
{
    "data": {
        "error": {
            "firstname": [
                "firstname: Value is required and can't be empty"
            ],
            "lastname": [
                "lastname: Value is required and can't be empty"
            ]
        }
    }
}
```

Afterwards, the function called <b>parseApiErrors</b> in the <b>useHttp.js</b> plugin analyzes the errors returned from the server and prints the errors one by one on the screen with a status message as follows.

![Form Errors](/images/form-errors.png)

If a single error is sent, the server response will be as follows. On the client side, this error will be displayed as above.

```json
{
    "data": {
        "error": "Example single line error"
    }
}
```

<kbd>src/plugins/useHttp.js</kbd>

```js
/**
 * parse validation errors
 */
function parseApiErrors(error) {
  if (error.response["data"] 
    && error.response["data"]["data"] 
    && error.response["data"]["data"]["error"]) {
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
        store.dispatch("auth/logout");
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

In accordance with the principle of separate operation of the frontend and backend, the translations of the labels of the input fields should be defined one by one in the php file called <b>label.php</b> in your backend application in order not to re-define them on the frontend side. The following example shows a translation example of the input names <b>firstname</b> and <b>lastname</b>.

```json [line-numbers] data-line="5,8"
{
    "data": {
        "error": {
            "firstname": [
                "Firstname: Value is required and can't be empty"
            ],
            "lastname": [
                "Lastname: Value is required and can't be empty"
            ]
        }
    }
}
```

<kbd>data/language/en/labels.php</kbd>

```php [line-numbers] data-line="10,11"
<?php
return [
    // login
    'username' => 'E-Mail',
    'password' => 'Password',
    'email' => 'E-Mail',

    // Account
    // 
    'firstname' => 'Firstname',
    'lastname' => 'Lastname',
];
```

