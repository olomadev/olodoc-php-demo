
## Show

Show sayfası, <b>getOne</b> veri sağlayıcı yöntemini kullanılarak belirli bir kaynak öğesinin tüm ayrıntılarını görüntülemek için kullanılır. Olobase Admin, <b>resource</b> özelliği kullanır ve birçok alan bileşeninin yanı sıra standart bir layout sağlayarak yazılım geliştirmeyi kolaylaştırır. Show sayfası standart bir görünüm sayfası bileşeni olması nedeni ile bu sayfa içerisinde hayal edebileceğiniz herhangi bir gelişmiş <b>detay</b> görünümünü sunmanın gerçek bir sınırı yoktur.

![Show Layout](/images/show.png)

### Show Layout

<b>VaShowLayout</b> kaynak ayrıntılarının gösterilmesi için oluşturulmuş sayfa düzenidir. Herhangi bir Olobase Admin alanının (field) yoğun kullanımın gerektiği durumlar için kullanılabilecek en iyi yerdir.

<b>Mixinler</b>

* Resource

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
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Üst başlığın solunda isteğe bağlı h1 başlığı.</td>
      </tr>
      <tr>
         <td><strong>disableCard</strong></td>
         <td><code>boolean</code></td>
         <td>V-card sarmalını kapatır/açar.</td>
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
         <td>Sayfa içeriği için yer tutucusu.</td>
      </tr>
   </tbody>
</table>
</div>

### Row Show

Eğer liste detay verileriniz çok detaylı değilse ve bu detayların hızlı bir şekilde gösterilmesini istiyorsanız, <kbd>row-show</kbd> adlı özelliği kullanabilirsiniz.


![Row Show](/images/row-show.png)

```html [line-numbers] data-line="9"
<template>
  <va-list
    disable-create
    :filters="filters"
    :fields="fields"
    :items-per-page="10"
  >
    <va-data-table-server
      row-show
      disable-clone
      disable-show
    >
    </va-data-table-server>
  </va-list>
</template>
```

<kbd>oloma-demo-ui/src/resources/Employees/RowShow.vue</kbd>

```html
<template>
  <va-show-layout
    :title="title"
    disable-card
  >
    <va-show :item="item">
      <v-row justify="center">
        <v-col>
          <v-table density="compact" class="va-row-show-table">
            <tbody>
              <tr>
                <td><b>{{ $t('resources.employees.fields.companyId') }}</b></td>
                <td>
                  <va-field class="sm-field" source="companyId"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.employeeNumber') }}</b></td>
                <td>
                  <va-field class="sm-field" source="employeeNumber"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.jobTitleId') }}</b></td>
                <td>
                  <va-field class="sm-field" source="jobTitleId"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.name') }}</b></td>
                <td>
                  <va-field class="sm-field" source="name"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.surname') }}</b></td>
                <td>
                  <va-field class="sm-field" source="surname"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.gradeId') }}</b></td>
                <td>
                  <va-field class="sm-field" source="gradeId"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.employmentStartDate') }}</b></td>
                <td>
                  <va-field class="sm-field" source="employmentStartDate"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.employmentEndDate') }}</b></td>
                <td>
                  <va-field class="sm-field" source="employmentEndDate"></va-field>
                </td>
              </tr>
              <tr>
                <td><b>{{ $t('resources.employees.fields.createdAt') }}</b></td>
                <td>
                  <va-field class="sm-field" source="createdAt"></va-field>
                </td>
              </tr>
            </tbody>
          </v-table>
        </v-col>
      </v-row>
    </va-show>
  </va-show-layout>
</template>
```

```js
<script>
export default {
  props: ["title", "item"],
};
</script>
```

### Sekme (Tab) Düzeni

Layout üzerinde tam bir özgürlüğe sahip olduğunuz için, herhangi bir vuetify veya özel bileşeni kullanarak sekmeli bir detay sayfası oluşturabilirsiniz. Aşağıdaki örneğe göz atın.

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
         <td>Tüm özelliklerin Olobase Admin alanlarına eklenmesi gereken öğe kaynak nesnesi.</td>
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

### Alan Sarmacı (Field Wrapper)

Etiket yerelleştirmesini ve desteklenen Olobase Admin alanını destekleyen alan için sarmalayıcı bileşen, esas olarak detay sayfası için kullanılır. Özel ihtiyaçlar için varsayılan slotu kullanın veya geçerli mevcut alan bileşeninin hızlı kullanımı için <b>type</b> özelliğini kullanın. Bu bileşenin diğer tüm nitelikleri alt slot ile birleştirilecektir.

<b>Mixinler</b>

* Resource

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Hiyerarşik nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><b>VaShow</b> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan etiket davranışını geçersiz kılar. Varsayılan, yerelleştirilmiş Vue I18n etiketini hem kaynaktan hem de resource kaynağından almaktır.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Çevrilen etiket olarak varsayılan kaynak anahtarını geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>Kullanılacak alan türü. Gelişmiş özel ihtiyaçlar için varsayılan slotu kullanıyorsanız kullanılmaz.</td>
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
         <td>Alan yer tutucusu. Varsayılan olarak <code>type</code> özelliklerine göre alan bileşenini diğer tüm niteliklerin birleştirilmiş olduğu şekilde kullanır.</td>
      </tr>
   </tbody>
</table>
</div>

Varsayılan bir slot sağlanmazsa <b>VaField</b>, özellik türüne göre otomatik olarak başlık altında belirli bir Va alanı bileşenini kullanacaktır.

Aşağıdaki kod:

```html
<template>
  <va-show-layout>
    <va-show :item="item">
      <va-field source="type" type="select" chip></va-field>
    </va-show>
  </va-show-layout>
</template>
```

Tam olarak bu koda eşdeğerdir:

```html
<template>
  <va-show-layout>
    <va-show :item="item">
      <va-field source="type">
        <va-select-field source="type" chip></va-select-field>
      </va-field>
    </va-show>
  </va-show-layout>
</template>
```

Ya da:

```html
<template>
  <va-show-layout>
    <va-show :item="item">
      <va-field source="type" v-slot="{ item }">
        <va-select-field source="type" :item="item" chip></va-select-field>
      </va-field>
    </va-show>
  </va-show-layout>
</template>
```

Bu bileşeni yalnızca etiket ve ürün değeri sağlayıcısı için kullanabilir ve kendi özelleştirmenizi yapabilirsiniz. Size değeri ve tam öğeyi verecek olan varsayılan slot sağlayıcısını kullanmanız yeterlidir.

```html
<template>
  <va-show-layout>
    <va-show :item="item">
      <va-field
        source="address"
        :label="$t('address')"
        v-slot="{ value }"
      >
        {{ value.street }}, {{ value.postcode }} {{ value.city }}
      </va-field>
    </va-show>
  </va-show-layout>
</template>
```

### Field Bileşenleri

Görüntüleme verileri için desteklenen tüm bileşenleri görmek için <a href="/ui/fields.html" target="_blank">fields</a> sayfasına gidin. Hiçbiri ihtiyaçlarınızı karşılamıyorsa kendi field bileşeninizi de oluşturabilirsiniz.