
## Alanlar

Olobase Admin alan bileşenleri, belirli kaynak özelliklerinin özel ve optimize edilmiş şekilde görüntülenmesine olanak tanır. Esas olarak <b>show</b> ve <b>list</b> görünümlerinde kullanılmak üzere tasarlanmıştır. Verileri getirmek ve görüntülemek için gerekli <b>source</b> ve <b>resource</b> özelliği ile kullanılır. <b>VaShow</b> bileşen enjektörüyle veya <b>item</b> prop aracılığıyla açık bir <b>item</b> nesnesiyle kullanılmalıdır.

> <b>Hücre Şablonlama:</b> Bu Olobase Admin alanlarını <b>VaDataTableServer</b> için hücre şablonu olarak kullanabilirsiniz, bu <a href="/ui/list.html#Alan%20Şablonlaması" target="_blank">bölüme</a> bakın.

### Alan Sarmacı (Field Wrapper)

Olobase Admin girişlerinin aksine, yazılan Olobase Admin alanları etiketli herhangi bir <b>wrapper</b> içermez, yalnızca basit satır içi görüntü biçimlendirici içerir. Bunun için <b>VaField</b>'ı kullanabilirsiniz. Yerelleştirilmiş etiketi alır ve prop <b>type</b> aracılığıyla uygun alan bileşenini başlatır, bu da onu varsayılan slota yeniden yazmamızı engeller.

Daha fazla ayrıntı için <a href="/ui/show.html#Field%20Wrapper" target="_blank">daha fazlasını</a> görün.

### Nokta Gösterim Desteği

Olobase Admin alanları <b>source</b> prop için nokta gösterimini kabul eder. Bu özellik nesneler için kullanışlıdır.

```html
<template>
  <va-field source="address.street"></va-field>
  <va-field source="address.postcode"></va-field>
  <va-field source="address.city"></va-field>
</template>
```

## Olobase Admin Alanları

Bu bölümde <kbd>packages/admin/src/components/ui/fields</kbd> klasöründeki Olobase Admin alan gösterim bileşenlerine değinilecektir.

### Text

Değeri basit metin olarak gösterir, basit bir <b>span</b> alanı oluşturur. HTML etiketleri strip fonksiyonu ile yok edilir.

<b>Mixinler</b>

* Field
* Source
* Resource

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>truncate</strong></td>
         <td><code>number</code></td>
         <td>Metni kısaltır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-text-field source="name"></va-text-field>
</template>
```

Basit bir <b>span</b> oluşturur:

```html
<span>Admin</span>
```

### Email

Değeri <b>mailto</b> bağlantısı olarak gösterir.

<b>Mixinler</b>

* Field
* Source
* Resource

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-email-field source="email"></va-email-field>
</template>
```

Basit bir <b>mailto</b> bağlantısı oluşturur:

```html
<a href="mailto:admin@example.com">admin@example.com</a>
```

### Url

Değeri basit bir http bağlantısı olarak gösterir.

<b>Mixinler</b>

* Field
* Source
* Resource

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>string</code></td>
         <td>Bağlantının hedef değeri, varsayılan olarak haricidir.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-url-field source="url" target="_self"></va-url-field>
</template>
```

Basit bir <b>url</b> bağlantısı oluşturur:

```html
<a href="https://www.example.org">https://www.example.org</a>
```

### Rich Text

HTML etiketlerine izin veren ham formatta değeri gösterir. XSS saldırılarını önlemek için kaynak değeri güvenilir olmalıdır.

<b>Mixinler</b>

* Field
* Source
* Resource

<b>Özellikler</b>

Daha önce bahsedilen <b>source</b> ve <b>item</b> özellikleri.

<b>Örnek</b>

```html
<template>
  <va-rich-text-field source="body"></va-rich-text-field>
</template>
```

Ham bir HTML div oluşturur:

```html
<div>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>
```

### Number

Değeri biçimlendirilmiş sayı olarak gösterir. Herhangi bir yerel para birimi, ondalık sayı veya yüzde değeri olabilir. Gereken yerlerde <b>$n</b> Vue i18n fonksiyonunu kullanın.

<b>Mixinler</b>

* Field
* Source
* Resource

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>format</strong></td>
         <td><code>string</code></td>
         <td>Kullanılacak sayı biçiminin adı. Vue i18n eklentinizde önceden tanımlanmış olmalıdır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-number-field source="price" format="currency"></va-number-field>
</template>
```

<b>span</b> içinde biçimlendirilmiş bir sayı oluşturur:

```html
<span>49,92&nbsp;€</span>
```

<b>Format:</b>

Hedeflenen i18n yerel ayarı için öncelikle geçerli bir sayı biçimini kaydetmeniz gerekir:

<kbd>src/i18n/rules/numbers.js</kbd>

```js
export default {
  en: {
    currencyFormat: {
      style: "currency",
      currency: "USD",
    },
  },
  tr: {
    currencyFormat: {
      style: "currency",
      currency: "TL",
    },
  },
};
```

<a href="https://kazupon.github.io/vue-i18n/guide/number.html" target="_blank">Vue i18n</a> dökümentasyonuna göz atın.

### Date

Değeri biçimlendirilmiş tarih olarak gösterir. Ve <b>long</b>, <b>short</b> vb. tüm yerelleştirilmiş formatları destekler. Temel olarak <b>$d</b>, <B>VueI18n</B> fonksiyonunu kullanın.

<b>Mixinler</b>

* Field
* Source
* Resource

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>format</strong></td>
         <td><code>string</code></td>
         <td>Kullanılacak tarih biçimi. Örneğin: (dd-mm-YYYY).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-date-field source="publicationDate" format="short"></va-date-field>
</template>
```

Aralık içinde biçimlendirilmiş bir tarih oluşturur:

```html
<span>Sunday, November 18, 1984</span>
```

<kbd>src/i18n/rules/datetime.js</kbd>

```js
export default {
  en: {
    year: {
      year: "numeric",
    },
    month: {
      month: "short",
    },
    shortFormat: {
      dateStyle: "short",
    },
    longFormat: {
      year: "numeric",
      month: "long",
      day: "numeric",
      weekday: "long",
      hour: "numeric",
      minute: "numeric",
      hour12: false,
    },
  }
}
```

<a href="https://kazupon.github.io/vue-i18n/guide/datetime.html" target="_blank">Vue i18n</a> dökümentasyonuna göz atın.

### Boolean

Değeri tanımlanabilir <b>true/false</b> simgesi olarak gösterir.

<b>Mixinler</b>

* Field
* Source
* Resource

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>labelTrue</strong></td>
         <td><code>string</code></td>
         <td><b>true</b> metni.</td>
      </tr>
      <tr>
         <td><strong>labelFalse</strong></td>
         <td><code>string</code></td>
         <td><b>false</b> metni.</td>
      </tr>
      <tr>
         <td><strong>iconTrue</strong></td>
         <td><code>string</code></td>
         <td>True değer simgesi. Geçerli bir <a href="https://pictogrammers.github.io/@mdi/font/7.0.96/" target="_blank">mdi</a> simgesi olmalıdır.</td>
      </tr>
      <tr>
         <td><strong>iconFalse</strong></td>
         <td><code>string</code></td>
         <td>False değer simgesi. Geçerli bir <a href="https://pictogrammers.github.io/@mdi/font/7.0.96/" target="_blank">mdi</a> simgesi olmalıdır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-boolean-field source="active" icon-false="mdi-cancel"></va-boolean-field>
</template>
```

### Rating

Değeri derecelendirme yıldızları olarak gösterin. Yarım artışlar etkinse değer geçerli bir tam sayı veya ondalık sayı olmalıdır. Simgeler, Vuetify icon <a href="https://vuetifyjs.com/en/components/ratings/#icons" target="_blank">ayarlarından</a> bu simgeler düzenlenebilir.

<b>Mixinler</b>

* Field
* Source
* Resource
* Rating

<b>Özellikler</b>

Daha önce bahsedilen <b>source</b> ve <b>item</b> özellikleri.

<b>Örnek</b>

```html
<template>
  <va-rating-field source="rating" length="10" half-increments></va-rating-field>
</template>
```

Yukarıdaki örnek sadece okunabilir bir Vuetify <a href="https://vuetifyjs.com/en/components/ratings/" target="_blank">rating</a> bileşeni oluşturur.

### Chip

Değeri bir çip materyalinin içinde gösterir.

<b>Mixinler</b>

* Field
* Source
* Resource
* Chip

<b>Özellikler</b>

Daha önce bahsedilen <b>source</b> ve <b>item</b> özellikleri.

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
         <td>Daha fazla özelleştirme için çip içeriği yer tutucusu, değeri varsayılan olarak gösterir.</td>
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
         <td>Daha fazla özelleştirme için içerik yer tutucusu, seçilen seçimin metnini varsayılan olarak alır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
  <va-chip-field source="type" color="secondary" small></va-chip-field>
</template>
```

Bir Vuetify <a href="https://vuetifyjs.com/en/components/chips/" target="_blank">chip</a> bileşeni üretir.

<b>Enums</b>

Seçimler veya numaralandırmalar açısından format değerine ihtiyacınız varsa, <b>VaSelectField</b>'ı chip prop ile kullanın.

### Select

Değeri, önceden tanımlanmış <b>key-value</b> seçeneklerinden seçilen metni metin olarak gösterir. Hiçbir seçenek yoksa, varsayılan olarak, Vue i18n <b>resource</b> yerel ayarlarınızdan değer olarak <b>source</b> içeren yerelleştirilmiş numaralandırmaları alır.

<b>Mixinler</b>

* Field
* Source
* Resource
* Choices
* Chip

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>chip</strong></td>
         <td><code>string</code></td>
         <td>Bir çip materyalinin içindeki metni gösterir.</td>
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
         <td>Daha fazla özelleştirme için içerik yer tutucusu, seçilen seçimin metnini varsayılan olarak alır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

```html
<template>
   <va-select-field 
     source="userRoles" 
     chip 
     multiple
     :item="item"
   >
   </va-select-field>
</template>
```

```js
<script>
export default {
  props: ["id", "item"],
}
</script>
```

<b>Yerelleştirilmiş Enumlar</b>

> Burada açıklandığı gibi tüm yeniden kullanım seçeneklerini doğrudan yerel ayarlarınızda merkezileştirebilirsiniz. Hiçbir seçenek ayarlanmadıysa <b>VaSelectField</b> şu geçerli çevrilmiş anahtar biçimini arayacaktır: <kbd>resources.{resource}.enums.{source}.{value}</kbd>.

### File

Orijinal dosyalara işaret eden dosya bağlantılarının listesini gösterir.

![File Field](/images/file-field.png)

```html
<v-row no-gutters>
 <v-col sm="3" class="mr-3">
   <va-file-field 
     source="files" 
     :item="model" 
     action-type="download"
     table-name="employeeFiles"
   ></va-file-field>
 </v-col>
</v-row>

<v-row no-gutters>
 <v-col sm="3" class="mr-3">
   <va-file-input
     source="files"
     table-name="employeeFiles"
   ></va-file-input>
 </v-col>
</v-row>
```

<b>Mixinler</b>

* Field
* Source
* Resource
* Files

<b>Özellikler</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>src</strong></td>
         <td><code>string</code></td>
         <td>Dosya nesnesinin kaynak özelliği, orijinal dosya üzerinden bağlantı.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Title ve alt nitelikleri için kullanılan dosya nesnesinin başlık niteliği.</td>
      </tr>
      <tr>
         <td><strong>fileName</strong></td>
         <td><code>string</code></td>
         <td>Dosya nesnesinin dosya adı özelliği; dosyalar için bağlantı metni olarak gösterilir.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>string</code></td>
         <td>Bağlantı için hedef değer, varsayılan olarak harici.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>Esas olarak VaFileInput için kullanın, dosyaların veya görsellerin kaldırılmasına izin verir.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Silinecek dosyanın kimliklerini içeren API'ye gönderilen özelliğin adı.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Silinecek dosyaları tanımlamak için kimlik değerinin alındığı yeri belirtir.</td>
      </tr>
   </tbody>
</table>
</div>

### Image

Küçük resimler için önizleme desteğiyle görsellerin listesini galeri olarak gösterin.

![Image Field](/images/image-field.png)

```html
<va-image-field 
  source="files" 
  :item="model" 
  table-name="employeeFiles"
></va-image-field>
```

<b>Mixinler</b>

* Field
* Source
* Resource
* Files

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>src</strong></td>
         <td><code>string</code></td>
         <td>Resim nesnesinin kaynak özelliği, orijinal dosya üzerinden bağlantı.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Title ve alt nitelikleri için kullanılan dosya nesnesinin başlık niteliği.</td>
      </tr>
      <tr>
         <td><strong>fileName</strong></td>
         <td><code>string</code></td>
         <td>Resim nesnesinin dosya adı özelliği; dosyalar için bağlantı metni olarak gösterilir.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>string</code></td>
         <td>Bağlantı için hedef değer, varsayılan olarak harici.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>Esas olarak VaFileInput için kullanın, dosyaların veya görsellerin kaldırılmasına izin verir.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Silinecek resimlerin kimliklerini içeren API'ye gönderilen özelliğin adı.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Silinecek resimleri tanımlamak için kimlik değerinin alındığı yeri belirtir.</td>
      </tr>
      <tr>
         <td><strong>height</strong></td>
         <td><code>string</code></td>
         <td>Resimin maximum yüksekliği.</td>
      </tr>
      <tr>
         <td><strong>lg</strong></td>
         <td><code>string</code></td>
         <td>Resim galerisi için maksimum sütun genişliği.</td>
      </tr>
   </tbody>
</table>
</div>

### Array

Çoklu dizi türü değerinin her bir değerini malzeme çip grubu olarak gösterin.

<b>Mixinler</b>

* Chip
* Field
* Source
* Resource

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
         <td>Daha fazla özelleştirme için içerik yer tutucusu, seçilen seçimin metnini varsayılan olarak alır.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><code>VaShow</code> tarafından eklenen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>itemText</strong></td>
         <td><code>string|array|func</code></td>
         <td>İçerideki nitelik eğer nesne ise kullanılır. Daha fazla özelleştirme için bir işlev kullanın.</td>
      </tr>
      <tr>
         <td><strong>select</strong></td>
         <td><code>string</code></td>
         <td>Değer biçimlendirici olarak basit metin yerine <b>enum</b> seçme alanını kullanın.</td>
      </tr>
      <tr>
         <td><strong>column</strong></td>
         <td><code>string</code></td>
         <td>Çiplerin listesini sütun olarak gösterin.</td>
      </tr>
   </tbody>
</table>
</div>

```html
<template>
  <va-array-field 
   source="userRoles" 
   :item="item" 
   ></va-array-field>
</template>
```

<b>İç içe geçmiş nesne</b>

İç çip şablonlaması için varsayılan slotu kullanın:


```html
<template>
  <va-array-field source="formats" v-slot="{ value }">
    {{ value.date }} : {{ value.url }}
  </va-array-field>
</template>
```

Daha karmaşık bir durum için basit bir v-for özel şablonu kullanın.