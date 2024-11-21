
## Hızlı Başlangıç

<a href="/ui/installation.html">Kurulum</a> bölümünü tamamladıktan sonra çevre ortamlarınızı yapılandırın ve demo uygulamayı çalıştırarak örnekleri inceleyin. Dökümentasyondan anlayamadığınız bölümler için destek talebi açabilir ya da <a href="https://github.com/olomadev/olobase-skeleton-ui/discussions" target="_blank">Github Tarrışmalar</a> sayfasından daha önce sorulmuş sorulara göz atabilirsiniz.

### CRUD Sayfalarına Giriş

1. adım, yönetmek istediğiniz arka uç kaynaklarını tanımlamaktır.

<kbd>src/resources/index.js</kbd> dosyasına gidin.

```js
export default [
  {
    name: "companies",
    icon: "mdi-city",
    label: "name",
  },
  {
    name: "users",
    icon: "mdi-account",
    permissions: ["admin"],
  },
  {
    name: "roles",
    icon: "mdi-account-key",
    label: "name",
    permissions: [
      { name: "admin", actions: ["show","list","edit","delete", "create"] },
    ],
    actions: ["show","list", "edit", "delete", "create"],
  }
];
```

> Olobase Admin uygulamanızda yetkiler yukarıda görüldüğü gibi "pernissions" dizisi içerisinde tanımlanır. Önyüzde kullanıcının yetkisi olmayan öğeler <kbd>show</kbd> / <kbd>hide</kbd> edilerek basitçe gizlenir ya da gösterilir. Arka uçta ise kullanıcıya yetkisi olmayan her bir işlem için 403 Forbidden durumunda yanıt gönderilir.

2. adım, şu adlandırma kuralını izleyerek her kaynak için CRUD sayfalarını tanımlamaktır: 

```bash
src/resources/{Resource}/{action}.vue.
```

## Aksiyonlar

* List.vue
* Create.vue
* Edit.vue
* Form.vue
* Show.vue

Örneğin List askiyonu için bir <kbd>src/resources/Users/</kbd> klasörü altında <kbd>List.vue</kbd> adında bir dosya oluşturun.

#### List.vue

<kbd>src/resources/Users/List.vue</kbd>

<tab>
<title>List|Settings|Template|Script</title>
<content>
![Users List](/images/users-list.png) <tcol>
![Users Settings](/images/users-settings.png) <tcol>

```js
<template>
  <div>
    <v-card>
      <v-card-text>        
        <va-list 
            :fields="fields"
            :filters="filters"
            :disable-global-search="false"
            :disable-actions="false"
          >
          <va-data-table-server>
          </va-data-table-server>
        </va-list>
      </v-card-text>
    </v-card>
  </div>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["resource"],
  data() {
    return {
      filters: [
        { source: "firstname", label: this.$t("users.firstname"), col: 2 },
        { source: "lastname", label: this.$t("users.lastname") },
        { source: "email", label: this.$t("users.email") },
        { source: "active", label: this.$t("users.active"), type: "boolean" },
      ],
      fields: [
        {
          source: "firstname",
          label: this.$t("users.firstname"),
          sortable: true,
          width: "5%"
        },
        {
          source: "lastname",
          label: this.$t("users.lastname"),
          sortable: true,
        },
        {
          source: "email",
          label: this.$t("users.email"),
          sortable: true,
        },
        {
          source: "active",
          label: this.$t("users.active"),
          sortable: true,
        }
      ],
    };
  },
};
</script>
```
</content>
</tab>

#### Show.vue

<kbd>src/resources/Users/Show.vue</kbd>

<tab>
<title>Show|Template|Script</title>
<content>![Users Show](/images/users-show.png) <tcol>

```js
<template>
  <v-card>
    <v-card-text>
      <va-show-layout :title="title">
        <va-show :item="item">
          <v-row justify="left">
            <v-col cols="4">
              <v-table density="compact" class="va-show-table">
                <tbody>
                  <tr>
                    <td><b>{{ $t('users.firstname') }}</b></td>
                    <td>
                      <va-field
                        source="firstname"
                      ></va-field>
                    </td>
                  </tr>
                  <tr>
                    <td><b>{{ $t('users.lastname') }}</b></td>
                    <td>
                      <va-field
                        source="lastname"
                        :label="$t('users.lastname')"
                      ></va-field>
                    </td>
                  </tr>
                  <tr>
                    <td><b>{{ $t('users.email') }}</b></td>
                    <td>
                      <va-field
                        source="email"
                        :label="$t('users.email')"
                      ></va-field>
                    </td>
                  </tr>
                  <tr>
                    <td><b>{{ $t('users.active') }}</b></td>
                    <td>
                      <va-field
                        source="active"
                        type="boolean"
                      ></va-field>
                    </td>
                  </tr>
                  <tr>
                    <td><b>{{ $t('users.createdAt') }}</b></td>
                    <td>
                      <va-field
                        source="createdAt"
                        :label="$t('users.createdAt')"
                      ></va-field>
                    </td>
                  </tr>
                </tbody>
              </v-table>
            </v-col>
          </v-row>
        </va-show>
      </va-show-layout>
    </v-card-text>
  </v-card>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["title", "item"],
};
</script>
```
</content>
</tab>

#### Create.vue

<kbd>src/resources/Users/Create.vue</kbd>

<tab>
<title>Create|Template|Script</title>
<content>![Users Create](/images/users-create.png) <tcol>

```js
<template>
  <va-create-layout :title="title">
    <users-form :item="item"></users-form>
  </va-create-layout>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["title", "item"],
};
</script>
```
</content>
</tab>


#### Edit.vue

<kbd>src/resources/Users/Edit.vue</kbd>

<tab>
<title>Edit|Template|Script</title>
<content>![Users Create](/images/users-edit.png) <tcol>

```js
<template>
  <va-edit-layout :title="title">
    <users-form :id="id" :item="item"></users-form>
  </va-edit-layout>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["id", "title", "item"],
};
</script>
```
</content>
</tab>

#### Form.vue

<kbd>src/resources/Users/Form.vue</kbd>

<tab>
<title>Form|Template|Script</title>
<content>![Users Form](/images/users-form.png) <tcol>

```js
<template>
  <va-form :id="id" :item="item" v-model="model">
    <v-row no-gutters>
      <v-col lg="3" md="3" sm="8">
        <va-avatar-input
          source="avatar.image"
        >
        </va-avatar-input>

        <va-text-input
          source="firstname"
          :error-messages="firstnameErrors"
        ></va-text-input>

        <va-text-input
          source="lastname"
          :error-messages="lastnameErrors"
        ></va-text-input>

        <va-text-input
          source="email"
          :error-messages="emailErrors"
        ></va-text-input>

        <va-text-input
          source="password"
          :error-messages="passwordErrors"
        ></va-text-input>

        <va-select-input
          source="userRoles"
          reference="roles"
          :error-messages="userRoleErrors"
          multiple
          clearable
        ></va-select-input>

        <va-boolean-input
          source="active"
          hide-details
          class="mb-2"
        ></va-boolean-input>

        <va-boolean-input 
          source="emailActivation"
          class="mb-1"
        >  
        </va-boolean-input>
      </v-col>
    </v-row>
    <va-save-button class="mr-2"></va-save-button>
  </va-form>
</template>
```
<tcol>

```js
<script>
import { provide } from 'vue';
import { useVuelidate } from "@vuelidate/core";
import { required, email, minLength, maxLength } from "@vuelidate/validators";
import Utils from "olobase-admin/src/mixins/utils";

export default {
  props: ["id", "item"],
  mixins: [Utils],
  setup() {
    let vuelidate = useVuelidate();
    provide('v$', vuelidate)
    return { v$: vuelidate }
  },
  validations: {
    model: {
      firstname: {
        required,
        minLength: minLength(2),
      },
      lastname: {
        required,
        minLength: minLength(2),
        maxLength: maxLength(120),
      },
      userRoles: {
        required,
      },
      email: {
        required,
        email,
      },
      password: {
        minLength: minLength(8),
        maxLength: maxLength(16),
      },
    }
  },
  data() {
    return {
      model: {
        id: null,
        firstname: null,
        lastname: null,
        email: null,
        password: null,
        active: 0,
        emailActivation: 0,
        userRoles: null,
        avatar: {
          image: null
        }
      },
    };
  },
  created() {
    this.model.id = this.generateId(this);
    if (!this.id) {
      this.model.password = this.generatePassword(8);
    }
  },
  computed: {
    firstnameErrors() {
      const errors = [];
      if (!this.v$['model'].firstname.$dirty) return errors;
      this.v$['model'].firstname.required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$['model'].firstname.minLength.$invalid &&
        errors.push(this.$t("v.string.minLength", { min: "2" }));
      return errors;
    },
    lastnameErrors() {
      const errors = [];
      if (!this.v$['model'].lastname.$dirty) return errors;
      this.v$['model'].lastname.required.$invalid &&
        errors.push(this.$t("v.text.required"));
      this.v$['model'].lastname.minLength.$invalid &&
        errors.push(this.$t("v.string.minLength", { min: "2" }));
      this.v$['model'].lastname.maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "120" }));
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.v$['model'].email.$dirty) return errors;
      this.v$['model'].email.required.$invalid &&
        errors.push(this.$t("v.email.required"));
      this.v$["model"].email.email.$invalid && 
        errors.push(this.$t("v.email.invalid"));
      return errors;
    },
    passwordErrors() {
      const errors = [];
      if (!this.v$["model"].password.$dirty) return errors;
      this.v$["model"].password.minLength.$invalid &&
        errors.push(this.$t("v.string.minLength", { min: "8" }));
      this.v$["model"].password.maxLength.$invalid &&
        errors.push(this.$t("v.string.maxLength", { max: "16" }));
      return errors;
    },
    userRoleErrors() {
      const errors = [];
      if (!this.v$["model"].userRoles.$dirty) return errors;
      this.v$["model"].userRoles.required.$invalid &&
        errors.push(this.$t("v.text.required"));
      return errors;
    },
  },
}
</script>
```
</content>
</tab>