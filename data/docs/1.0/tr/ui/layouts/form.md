
## Form

<b>Create</b> ve <b>Edit</b> sayfaları, sırasıyla veri sağlayıcı oluşturma ve güncelleme yöntemlerini kullanarak yeni kaynak öğesinin oluşturulmasına veya mevcut yöntemin değiştirilmesine olanak tanır. Genel olarak bu sayfalar zorunlu olmasa da aynı formu paylaşacaktır. Olobase Admin ile mevcut form bağlamı bilgisine sahip birçok mevcut giriş bileşeni sayesinde form geliştirme minimum kodla yapılabilir.

![Form](/images/form.png)

### Layoutlar

Hem <b>create</b> hem de <b>edit</b> layoutları, belirli bağlama dayalı eylemler içeren <a href="/ui/show.html" target="_blank">show</a> sayfasıyla benzer düzeni paylaşır. <b>VaForm</b> asıl işi yapacağından onlar hakkında söylenecek başka bir şey yok.

### Create Layout

Veri oluşturma için sayfa layout'u.

<b>Mixinler</b>

* Resource

<b>Özellikler</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özelikkler</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Üst başlığın solunda gösterilen isteğe bağlı h1 başlığı.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td><strong>actions</strong></td>
         <td>Ek özel eylem düğmeleri yer tutucusu.</td>
      </tr>
      <tr>
         <td><strong>default</strong></td>
         <td>Sayfa içeriği yer tutucusu.</td>
      </tr>
   </tbody>
</table>
</div>

### Klonlama

Geçerli bir mevcut kimliğe sahip belirli bir kaynak sorgu dizesi mevcut olur olmaz, oluşturma sayfasının diğer mevcut kaynaklardan gelen değerlerin kopyasını (yani klonlamayı) desteklediğini unutmayın. Bu, <b>VaDataTableServer</b>'da varsayılan olarak bulunan <b>VaCloneButton</b> aracılığıyla otomatik olarak yapılır. <b>Create</b> vue bileşeninde onu <b>VaForm</b>'a enjekte etmenize olanak tanıyan bir öğe desteğinin bulunmasının nedeni budur.

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

Veri düzenleme için sayfa layout'u.

<b>Mixinler</b>

* Resource

<b>Özellikler</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özelikkler</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Üst başlığın solunda gösterilen isteğe bağlı h1 başlığı.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td><strong>actions</strong></td>
         <td>Ek özel eylem düğmeleri yer tutucusu.</td>
      </tr>
      <tr>
         <td><strong>default</strong></td>
         <td>Sayfa içeriği yer tutucusu.</td>
      </tr>
   </tbody>
</table>
</div>

### ID

Sayfa oluşturmayla karşılaştırıldığında, API tarafında düzenlenecek ve eklenecek kaynağa karşılık gelen yeni bir <b>id</b> özelliği vardır. Başlık altında veri sağlayıcı güncelleme yöntemini kullanmak için <b>id</b> özelliğini forma koymayı unutmayın.

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

Layout üzerinde tam bir özgürlüğe sahip olduğunuz için, herhangi bir vuetify veya özel bileşeni kullanarak sekmeli bir detay sayfası oluşturmak gerçekten kolaydır. Aşağıdaki örneğe göz atın.

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

### Enjektör

Takip eden örnekte Olobase Admin bileşen alanlarını kullanarak kaynak görüntülemeyi kolaylaştıran bileşen enjektörünü gösteriliyor. Her Olobase Admin alanı için bu öğeyi enjekte edin.

```js
<script>
export default {
  props: ["id", "item"],
}
</script>
```

<b>Özellikler</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özellikler</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>item</strong></td>
         <td><code>object</code></td>
         <td>Tüm özelliklerin Olobase Admin alanlarına eklenmesi gereken açık öğe kaynak nesnesi.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td>Tüm içerik, tüm iç alanlarla birlikte oluşturulur. Öğe her alana enjekte edilir.</td>
      </tr>
   </tbody>
</table>
</div>

Tahmin edebileceğiniz gibi VaShow'un ana rolü, her Olobase Admin alanı bileşenine tam öğe kaynak nesnesini enjekte etmektir, bu da minimum standart kod demektir. Daha sonra Olobase Admin alanı, kaynak özelllikte belirtilen kaynak özelliğinin değerini yakalayabilecektir.

### Input Bileşenleri

Verileri düzenlemek için desteklenen tüm bileşenleri görmek için <a href="/ui/inputs.html" target="_blank">inputs</a> sayfasına gidin. Eğer burada gösterilenlerin hiçbiri ihtiyaçlarınızı karşılamıyorsa kendi girdi bileşeninizi de oluşturabilirsiniz.

### Kaydet ve Yönlendir

Varsayılan kaydet düğmesi olarak <b>VaSaveButton</b>'u kullanmanız tavsiye edilir. Bu tuş API'ye kaydederken ana formla ve form state verileri ile otomatik olarak senkronize olacaktır.

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

<b>VaForm</b>'a yukarıdaki gibi açık bir yönlendirme ayarlamadığınız sürece başarılı bir kaydetme, varsayılan olarak kaynak listesi sayfasına yönlendirilir. Bu desteğin yalnızca kaydet tuşu için etkili olduğunu unutmayın. Ayrıca <b>VaSaveButton</b> üzerinden yönlendirmeyi ayarlayabilirsiniz.

Takip eden örnek birden fazla yönlendirme işlemine ihtiyacınız olduğunda kullanışlı olabilir:

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

Görüldüğü üzere yukarıdaki kod iki farklı düğme oluşturur. Varsayılan olan mevcut kaydetme davranışı tetiklerken diğer düğme ise kaydet ve listeye yönlendir eylemini tetikler.

![Save and Create](/images/save-and-create.png)


### Varsayılan Yönlendirmeyi Kapatmak

Varsayılan gönderme yönlendirmesini önlemek için VaForm'da <kbd>disable-redirect</kbd> özelliğini kullanın. Bu eylemin yönlendirmeli kaydetme tuşları üzerinde hiçbir etkisi yoktur.

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

### Snackbar Mesajını Devre Dışı Bırakma

Varsayılan snackbar çubuğu mesajını önlemek için VaForm'daki <kbd>disable-save-message</kbd> özelliğini kullanabilirsiniz.

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

### Form Olayları

Form olayları form kaydetme aşamadından sonra sunucudan dönen yanıtları alarak buna göre aksiyon almanızı kolaylaştırır.

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
         <th>Olay Adı</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>model</strong></td>
         <td>Sunucuya gönderilen veri nesnesine erişmenizi sağlar.</td>
      </tr>
      <tr>
         <td><strong>saved</strong></td>
         <td>Form kayıt edildikten sonra sunucu tarafından dönen yanıt nesnesine erişmenizi sağlar.</td>
      </tr>
      <tr>
         <td><strong>error</strong></td>
         <td>Varsa sunucu tarafından dönen istisnai hatalara erişmenizi sağlar.</td>
      </tr>
   </tbody>
</table>
</div>

### Form Model

Form içerisindeki girdilerin v-model özelliği tümüyle <b>va-form</b> içerisinde kontrol edilebilmesi için form tagında <b>v-model</b> niteliğini kullanın.
Böylece her bir girdi için v-model yazamk zorunda kalmayacaksınız. Eğer yine de bir girdi içinde v-model kullanmanız gerekiyorsa bunun için bir engel tabiki yok.

Bir örnek:

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

### Form Doğrulama

VaForm, <a href="https://vuelidate-next.netlify.app/" target="_blank">vuelidate</a> doğrulama kütüphanesini kullanır. Takip eden örnekte <b>Vuelidate</b> kütüphanesi ile bir form doğrulama örneği gösteriliyor:

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

### Liste Görünümü Satır Doğrulama

Liste görünümlü veri güncelleme tablolarında form doğrulama yapabilmek için Vue.js provide metodundan yararlanılır. Doğrulamaya ait <b>validations</b> kuralları ve <b>errors</b> mesajları <b>provide</b> metodunda ilan edilmelidir.

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

### Sunucu Tarafında Doğrulama

İstemci tarafında tüm doğrulama alanları tamalandıktan sonra sunucu tarafında doğrulama yapılır. API'niz, doğrulama hatası bulduysa her zaman 400 durum kodu kullanan yanıt gövdesi ile tüm doğrulama alanlarına ait hataları içeren yanıtı aşağıdaki gibi istemciye gönderir.

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

Sonrasında <b>useHttp.js</b> eklentisi içerisindeki <b>parseApiErrors</b> adlı fonksiyon sunucudan dönen hataları çözümleyerek bir durum mesajı ile hataları aşağıdaki gibi alt alta ekrana yazdırır.

![Form Errors](/images/form-errors.png)

Tek bir hata gönderilmesi durumunda sunucu yanıtı aşağıdaki gibi olacaktır. İstemci tarafında bu hata yine yukarıdaki gibi görüntülenecektir.

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

Önyüz ve arkayüzün ayrı çalışmaları ilkesi gereğince girdi alanlarına ait etiketlerin çevirilerini tekrar önyüz tarafında yeniden tanımlamamak için bu çeviriler, arka uç uygulamanızdaki <b>label.php</b> adlı php dosyasında tek tek tanımlanmalıdır. Aşağıdaki örnekte <b>firstname</b> ve <b>lastname</b> girdi adlarına ait bir çeviri örneği gösteriliyor.

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

