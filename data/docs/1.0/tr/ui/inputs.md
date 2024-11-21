
## Girdiler

Olobase Admin girdi bileşenleri, mevcut API kaynak nesnesinin belirli özelliklerinin düzenlenmesine olanak tanır. Temel olarak görünüm oluşturmak ve düzenlemek için 
[form](/ui/form.html)'larda kullanılır. <b>VaList</b> için filtre girişi olarak da kullanılabilir. Kaynak desteği için, öğe eklemeyi ve hata mesajlarıyla model sağlamayı işleyen <b>VaForm</b> bileşeni içinde kullanılması gerekir.

### Kaynak ve Model

Va girdileri hem kaynak hem de model desteğini destekler. Kaynak, değerin getirileceği orijinal özellik nesnesidir ve model, veri sağlayıcınıza gönderilecek yeni değerle birlikte son özellik adı olacaktır.

### Nokta Gösterim Desteği

Olobase Admin girişleri kaynak desteği için nokta gösterimini kabul eder. İçiçe nesne için çok kullanışlıdır:

```html
<template>
  <va-text-input source="address.street"></va-text-input>
  <va-text-input source="address.postcode"></va-text-input>
  <va-text-input source="address.city"></va-text-input>
</template>
```

Yukarıdaki örnekte görüldüğü gibi doğrudan adres nesnesinin sokak özelliğinin değerini alınıyor. Veri sağlayıcınıza gönderilecek son form model verileri de bu iç içe geçmiş yapıya uygundur.

## Olobase Admin Girdileri

Bu bölümde <kbd>packages/admin/src/components/ui/inputs</kbd> klasöründeki Olobase Admin girdi bileşenlerine değinilecektir.

### Text

Temel metin girişi yoluyla metin değeri türü için metin düzenler. Çok satırlı destek aracılığıyla uzun metinler için textarea modunu destekler. Herhangi bir tarih, tarihsaat veya saat düzenlemesi için kullanılabilir; tarih, tarihsaat-yerel veya saate göre ayarlanan türü kullanın. İşlem tarayıcı desteğine bağlı olacaktır.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>Metin girişi türü. Tüm HTML türlerine izin verilir.</td>
      </tr>
      <tr>
         <td><strong>multiline</strong></td>
         <td><code>boolean</code></td>
         <td>Metin girişini textarea'ya dönüştürün.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Text|Template</title>
<content>
![Form](/images/text-input.png)
<tcol>

```html
<template>
 <v-row>
   <v-col lg="3" md="4" sm="6">
     <va-text-input :label="$t('demo.text')" source="founder"></va-text-input>
   </v-col>
   <v-col lg="3" md="4" sm="6">
     <va-text-input :label="$t('demo.text')" source="headquarter"></va-text-input>
   </v-col>
 </v-row>
 <v-row>
   <v-col lg="3" md="4" sm="6">
     <va-text-input :label="$t('demo.text')" source="description" multiline></va-text-input>
   </v-col>
 </v-row>
</template>
```
</content>
</tab>

### Password

Şifre alanları için kullanılır. Geçerli giriş için gösterme/gizleme davranışı vardır.

<b>Mixinler</b>

* Input
* InputWrapper
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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Password|Template</title>
<content>
![Form](/images/password-input.png)
<tcol>

```html
<template>
 <v-row>
   <v-col lg="3" md="4" sm="6">
     <va-password-input label="Password" source="password"></va-password-input>
   </v-col>
 </v-row>
</template>
```
</content>
</tab>

### Number

Sayı düzenleme için optimize edilmiştir. Min, max ve step özelliklerini destekler.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>v-model</strong></td>
         <td><code>string</code></td>
         <td>Düzenlenecek metin.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
      <tr>
         <td><strong>step</strong></td>
         <td><code>number</code></td>
         <td>Aralık adımı.</td>
      </tr>
      <tr>
         <td><strong>min</strong></td>
         <td><code>number</code></td>
         <td>Kabul edilen minimum değer.</td>
      </tr>
      <tr>
         <td><strong>max</strong></td>
         <td><code>number</code></td>
         <td>Kabul edilen maksimum değer.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Number|Template</title>
<content>
![Form](/images/number-input.png)
<tcol>

```html
<template>
 <v-row>
   <v-col lg="3" md="4" sm="6">
      <va-number-input source="level" label="Level" :step="1" :min="0" :max="99"></va-number-input>
   </v-col>
 </v-row>
</template>
```
</content>
</tab>

### Date

Tarih türü değerini düzenlemek için kullanılır. Vuetify tarih seçiciyle ilişkili salt okunur bir metin alanından oluşur. Zamanı değerini desteklemez, bu durum için klasik VaTextInput'u kullanın.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>header</strong></td>
         <td><code>string</code></td>
         <td>Başlık altında gösterilen bölüme bir metin yazmanızı sağlar. Varsayılan değer boş.</td>
      </tr>
      <tr>
          <td><strong>format</strong></td>
          <td><code>string</code></td>
          <td>Kullanılacak tarih formatı. Örneğin: (dd-mm-YYYY).</td>
      </tr>
      <tr>
         <td><strong>allowedDates</strong></td>
         <td><code>function</code>, <code>array</code></td>
         <td>Hangi tarihlerin seçilebileceğini kısıtlar.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Belirtilen rengi bileşene uygular - yardımcı renkleri (örneğin success veya purple) veya css rengini (örneğin success veya purple) veya css rengini (#033 veya rgba(255, 0, 0, 0,5)) gibi destekler. Varsayılan değer: primary.</td>
      </tr>
      <tr>
         <td><strong>elevation</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşene 0 ile 24 arasında uygulanan bir yüksekliği belirtir. Daha fazla bilgiyi <a href="https://dev.vuetifyjs.com/en/styles/elevation/#usage" target="_blank">yükseklik</a> sayfasında bulabilirsiniz.</td>
      </tr>
      <tr>
         <td><strong>hideHeader</strong></td>
         <td><code>boolean</code></td>
         <td>Bileşenin başlık bölümünü tamamen gizler (Varsayılan: false).</td>
      </tr>
      <tr>
         <td><strong>height</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin yüksekliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>width</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin genişliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>max</strong></td>
         <td><code>string</code>, <code>number</code>, <code>date</code></td>
         <td>İzin verilen maksimum tarih/ay (ISO 8601 biçimi).</td>
      </tr>
      <tr>
         <td><strong>maxHeight</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin maksiumum yüksekliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>maxWidth</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin maksiumum genişliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>min</strong></td>
         <td><code>string</code>, <code>number</code>, <code>date</code></td>
         <td>İzin verilen minumum tarih/ay (ISO 8601 biçimi).</td>
      </tr>
      <tr>
         <td><strong>minHeight</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin minumum yüksekliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>minWidth</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin minumum genişliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>multiple</strong></td>
         <td><code>boolean</code></td>
         <td>Birden fazla tarih seçimine izin ver.</td>
      </tr>
      <tr>
         <td><strong>position</strong></td>
         <td><code>boolean</code></td>
         <td>Bileşenin konumunu ayarlar. (static, relative, fixed, absolute, sticky).</td>
      </tr>
      <tr>
         <td><strong>rounded</strong></td>
         <td><code>string</code>, <code>number</code>, <code>boolean</code></td>
         <td>Bileşene uygulanan kenar yarıçapını belirtir.</td>
      </tr>
      <tr>
         <td><strong>showAdjacentMonths</strong></td>
         <td><code>boolean</code></td>
         <td>Önceki ve sonraki ayların günlerinin görünürlüğünü değiştirir.</td>
      </tr>
      <tr>
         <td><strong>showWeek</strong></td>
         <td><code>boolean</code></td>
         <td>Takvimin gövdesindeki hafta numaralarının görünürlüğünü değiştirir.</td>
      </tr>
      <tr>
         <td><strong>hideActions</strong></td>
         <td><code>boolean</code></td>
         <td>Seçme eylemlerini gizler.</td>
      </tr>
      <tr>
         <td><strong>hideWeekdays</strong></td>
         <td><code>boolean</code></td>
         <td>Hafta içi günleri gizler.</td>
      </tr>
      <tr>
         <td><strong>inputPlaceholder</strong></td>
         <td><code>string</code></td>
         <td>Girdiye ait placeholder değerini atar.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
      <tr>
         <td><strong>viewMode</strong></td>
         <td><code>string</code></td>
         <td>Ay ya da yıl görünümü arasında geçiş sağlar (month, year).</td>
      </tr>
      <tr>
         <td><strong>disabled</strong></td>
         <td><code>boolean</code></td>
         <td>Bileşene tıklama özelliğini kaldırır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Date|Template</title>
<content>
![Form](/images/date-input.png)
<tcol>

```html
<template>
 <v-row>
   <v-col lg="3" md="4" sm="6">
      <va-date-input source="publishDate" label="Publish Date" format="shortFormat"></va-date-input>
   </v-col>
 </v-row>
</template>
```
</content>
</tab>

### Boolean

Boolean girdi türüne değer <b>boolean</b> ya da <b>0/1</b> olarak gönderildiğinde girdi bir düğme olarak gösterilir.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Boolean|Template</title>
<content>
![Form](/images/boolean-input.png)
<tcol>

```html
<template>
 <v-row>
   <v-col lg="3" md="4" sm="6">
      <va-boolean-input source="active" label="Active"></va-boolean-input>
   </v-col>
 </v-row>
</template>
```
</content>
</tab>

### Rating

Sayı değerini derecelendirme yıldızları olarak düzenleyin. Yarım artışlar etkinse değer geçerli bir tam sayı veya ondalık sayı olmalıdır. Simgeler, Vuetify ayarlarında $ratingFull, $ratingEmpty ve $ratingHalf aracılığıyla düzenlenebilir.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Rating
* Editable

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>active-color</strong></td>
         <td><code>string</code></td>
         <td>Bileşene etkin durumdayken uygulanan renk.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>Geçerli değere tıklanarak bileşenin temizlenmesine olanak sağlar.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Belirtilen rengi denetime uygular</td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin kullandığı dikey yüksekliği ayarlar. (default, comfortable, compact).</td>
      </tr>
      <tr>
         <td><strong>disabled</strong></td>
         <td><code>boolean</code></td>
         <td>Bileşene tıklama özelliğini kaldırır.</td>
      </tr>
      <tr>
         <td><strong>empty-icon</strong></td>
         <td><code>string</code>, <code>array</code>, <code>function</code></td>
         <td>Boş olduğunda görüntülenen simge.</td>
      </tr>
      <tr>
         <td><strong>full-icon</strong></td>
         <td><code>string</code>, <code>array</code>, <code>function</code></td>
         <td>Dolu olduğunda görüntülenen simge.</td>
      </tr>
      <tr>
         <td><strong>half-increments</strong></td>
         <td><code>boolean</code></td>
         <td>Yarım artışların seçimine izin verir.</td>
      </tr>
      <tr>
         <td><strong>hover</strong></td>
         <td><code>boolean</code></td>
         <td>Görsellik sağlar simgelerin üzerine gelindiğinde geri bildirim.</td>
      </tr>
      <tr>
         <td><strong>item-aria-label</strong></td>
         <td><code>string</code></td>
         <td>Öğe etiketlerinin ayarlar.</td>
      </tr>
      <tr>
         <td><strong>item-label-position</strong></td>
         <td><code>string</code></td>
         <td>Öğe etiketlerinin konumu 'top' ve 'bottom'ı kabul eder.</td>
      </tr>
      <tr>
         <td><strong>item-labels</strong></td>
         <td><code>array</code></td>
         <td>Her öğenin yanında görüntülenecek etiket dizisi.</td>
      </tr>
      <tr>
         <td><strong>length</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Gösterilecek öğe miktarı</td>
      </tr>
      <tr>
         <td><strong>model-value</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin v-model değeri. Bileşen çoklu desteği destekliyorsa, bu varsayılan olarak boş bir diziye dönüşür.</td>
      </tr>
      <tr>
         <td><strong>name</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin ad özelliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>readonly</strong></td>
         <td><code>boolean</code></td>
         <td>Tüm fareyle üzerine gelme efektlerini ve işaretçi olaylarını kaldırır.</td>
      </tr>
      <tr>
         <td><strong>size</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Bileşenin yüksekliğini ve genişliğini ayarlar. Varsayılan birim pikseldir. (x-small, small, default, large, x-large).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Rating|Template</title>
<content>
![Form](/images/rating-input.png)
<tcol>

```html
<template>
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-rating-input source="rating" length="10" half-increments></va-rating-input>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

### Rich Text

<a href="https://tiptap.dev/" target="_blank">Tiptap</a> kullanarak bir <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">Wysiwyg</a> HTML editörü oluşturur.

<b>Mixinler</b>

* Input
* InputWrapper
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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Rich Text|Template</title>
<content>
![Form](/images/rich-text-input.png)
<tcol>

```html
<template>
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-rich-text-editor
        :label="$t('demo.richtext')"
        source="richtext"
        v-model="model.richText"
        :active-buttons="[
          'bold',
          'italic',
          'strike',
          'underline',
          'code',
          'h1',
          'h2',
          'h3',
          'bulletList',
          'orderedList',
          'blockquote',
          'codeBlock',
          'horizontalRule',
          'undo',
          'redo',
        ]"
      >
      </va-rich-text-editor>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

### Tiny MCE

<a href="https://www.tiny.cloud/" target="_blank">Tiny MCE</a> GPL lisansını kullanarak bir <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">Wysiwyg</a> HTML editörü oluşturur.

<b>Mixinler</b>

* Input
* InputWrapper
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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
   </tbody>
</table>
</div>


<b>Örnek</b>

<tab>
<title>Tiny MCE|Template</title>
<content>
![Form](/images/tiny-mce-input.png)
<tcol>

```html
<template>
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-tiny-mce-editor
        :options="{ min_height: 250 }"
        v-model="model.richText"
      >
      </va-tiny-mce-editor>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>


### Select

Bir seçim listesinden değer veya değerler seçmenizi sağlar. Çoklu seçimleri ve referansları destekler. Hiçbir seçenek yoksa, varsayılan olarak, <kbd>src/I18n/locales/tr.json</kbd> dosyasından kaynak içeren yerelleştirilmiş listeleri alabilir.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Multiple
* Editable
* Choices
* Search

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>reference</strong></td>
         <td><code>string</code></td>
         <td>Aranacak kaynağın adı</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
      <tr>
         <td><strong>multiple</strong></td>
         <td><code>boolean</code></td>
         <td>Çoklu seçimi aktif hale getirir.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Select|Template</title>
<content>
![Form](/images/select-input.png)
<tcol>

```html
<template>
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-select-input
        label="Select"
        clearable
        multiple
        reference="employeegrades"
        v-model="model.grades"
      >
      </va-select-input>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

### Yerel Enumerik Değerler

Burada açıklandığı gibi tüm yeniden kullanım seçeneklerini doğrudan yerel ayarlarınızda merkezileştirebilirsiniz. Hiçbir seçenek ayarlanmadıysa,  <b>VaSelectInput</b> şu geçerli çevrilmiş anahtar biçimini arayacaktır: <kbd>resources.{resource}.enums.{source}.{value}</kbd>

### Referanslar

Mevcut kaynak referansından seçim yapmak istiyorsanız referans opsiyonunu aşağıdaki gibi kullanın:

```html
<template>
  <va-select-input
    source="companyId"
    model="companyId"
    reference="companies"
    :filter="{ active: true }"
  ></va-select-input>
</template>
```

Yukarıdaki örnek tüm şirketleri api servisinden getirecek ve bunları seçenek olarak listeleyecektir. Filtreleme için filtre opsiyonunu kullanın. Arka uç tarafındaki şema adının kaynaktan farklı olması durumunda model seçeneğini kullanabilirsiniz. Aksi durumda bu seçeneği kullanmanız gerekli değildir.

### İnteraktif Seçim Alanları

Bir seçim alanını seçtikten sonra başka bir seçim alanını etkileşimli olarak değiştirmek istiyorsanız aşağıdaki örnekteki koda göz atın.

![Form](/images/interactive-select-fields.jpg)

```html
<va-select-input
  source="companyId"
  v-model="model.companyId"
  reference="departments"
  variant="outlined"
></va-select-input>

<va-select-input
  source="departmentId"
  :key="model.companyId"
  :filter="{ companyId: model.companyId }"
  v-model="model.departmentId"
  reference="departments"
  variant="outlined"
></va-select-input>
```

### Radio Group

Bir seçim listesinden değer seçmenizi sağlar. Referansları destekler. Hiçbir seçenek yoksa, varsayılan olarak, <kbd>src/I18n/locales/tr.json</kbd> dosyasından kaynak içeren yerelleştirilmiş listeleri alabilir.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Choices
* Search

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>reference</strong></td>
         <td><code>string</code></td>
         <td>Aranacak kaynağın adı.</td>
      </tr>
      <tr>
         <td><strong>inline</strong></td>
         <td><code>boolean</code></td>
         <td>Seçenekleri yatay olarak gösterir. (Varsayılan: false).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Radio Group|Template</title>
<content>
![Form](/images/radio-group-input.png)
![Form](/images/radio-group-input-hr.png)
<tcol>

```html
<template>
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-radio-group-input
        clearable
        label="Currencies"
        v-model="model.radios"
        reference="currencies"
      >
      </va-radio-group-input>
    </v-col>
    <v-col lg="3" md="4" sm="6">
      <va-radio-group-input
        clearable
        inline
        label="Currencies"
        v-model="model.radios"
        reference="currencies"
      >
      </va-radio-group-input>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

<b>Referanslar</b>

Yukarıdaki ilgili <b>VaSelectInput</b> referans açıklamasının aynısı geçerlidir, çoklu seçenek desteklenmez.

### AutoComplete

Aranabilir seçenekler arasından değer veya değerler seçimi sağlar. Çoklu seçim ve referansları destekler. API servisinizden bağlantılı kaynakların aranmasına izin verir.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Multiple
* Choices
* Search

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
      <tr>
         <td><strong>reference</strong></td>
         <td><code>string</code></td>
         <td>Aranacak kaynağın adı.</td>
      </tr>
      <tr>
         <td><strong>minChars</strong></td>
         <td><code>number</code></td>
         <td>Arama sorgusu başlatılmadan önce dokunulması gereken minimum karakterler.</td>
      </tr>
      <tr>
         <td><strong>searchQuery</strong></td>
         <td><code>string</code></td>
         <td>API servisinizde arama yapmak için istek sorgusunun adı. (Varsayılan değer: "q")</td>
      </tr>
      <tr>
         <td><strong>taggable</strong></td>
         <td><code>boolean</code></td>
         <td>Etiketlenebilir modu etkinleştirin. Otomatik tamamlamayı açılan kutuya dönüştürün.</td>
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
         <td><strong>selection</strong></td>
         <td>Özel bir seçim görünümü tanımlayın.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td>Özel bir öğe görünümü tanımlama.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>AutoComplete|Template</title>
<content>
![Form](/images/autocomplete-input.png)
<tcol>

```html
<template>
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-auto-complete-input
        density="compact"
        source="userId"
        resource="employees"
        reference="employees"
        variant="outlined"
        multiple
      >
        <template v-slot:chip="{ props, item }">
          <v-chip v-if="item.raw.name"
            class="cursor-pointer"
            v-bind="props"
            :text="item.raw.name"
          >
           {{ item.raw.name }}
          </v-chip>
        </template>
      </va-auto-complete-input>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

<b>searchQuery ve minChars:</b>

Arama yapmadan önce gereken minimum karakteri ve varsayılan olarak q olan sorgu arama parametre anahtarını yapılandırmak için <b>minChars</b> ve <b>searchQuery</b>'yi kullanın. Bu element <b>GetList</b> veri sağlayıcı yöntemini özel bir arama filtresiyle yeniden kullanacak.

Daha iyi performans için API sorgusunun aşırı alımını azaltmak amacıyla <b>fields</b> opsiyonunu kullanın.

<b>taggable</b>

Otomatik tamamlama, etiketlenebilir desteği etkinleştirdiğiniz anda birleşik giriş kutusu bileşenine dönüştürülecektir. Anında yeni etiketler oluşturmanıza olanak tanır.

### File

Tek satır halinde dosya yüklemelerine izin verir. Bir veya birden fazla yüklemelerin her ikisi de aynı anda desteklenir. Yüklenen dosyaların önizlemesini göstermek için <b>VaFileField</b> veya <b>VaImageField</b>'ı bu elementle birlikte kullanın.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Multiple

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Silinecek dosyaları tanımlamak için kimlik değerinin nereden alınacağını belirtir. (Varsayılan: "id").</td>
      </tr>
      <tr>
         <td><strong>accept</strong></td>
         <td><code>string</code></td>
         <td>Basit istemci tarafı doğrulaması için HTML5 `kabul etme` özelliğini ekler.</td>
      </tr>
      <tr>
         <td><strong>base64</strong></td>
         <td><code>boolean</code></td>
         <td>Yüklemenin base64 kodlama ile yapılmasını sağlar.</td>
      </tr>
      <tr>
         <td><strong>tableName</strong></td>
         <td><code>string</code></td>
         <td>Veritabanında genel yükleme dosyalarının tutulduğu tablonun adı.</td>
      </tr>
      <tr>
         <td><strong>download</strong></td>
         <td><code>boolean</code></td>
         <td>Tıkla ve dosya indir seçeneğini aktif eder.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>File|Template</title>
<content>
![Form](/images/file-input2.png)
<tcol>

```html
<template>
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
  <v-row>
    <v-col lg="3" md="4" sm="6">
      <va-file-input
        source="files" 
        table-name="employeeFiles"
      ></va-file-input>
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

### Array Table

Tablo biçiminde dizi olarak birden fazla veri girişine izin verir. Yeni veri ekleme, silme ve veri güncellemeyi destekler.

<b>Mixinler</b>

* Input
* InputWrapper
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
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>Dizi tablosu etrafını saran div elementinin html class niteliğine bir değer atar.</td>
      </tr>
      <tr>
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slot kullanılmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Dizi tablosunun başlığını belirler.</td>
      </tr>
      <tr>
         <td><strong>headers</strong></td>
         <td><code>array</code></td>
         <td>Dizi tablosunun sütun başlıklarını belirlerir.</td>
      </tr>
      <tr>
         <td><strong>fields</strong></td>
         <td><code>array</code></td>
         <td>Dizi tablosundan kullanılacak va-girdilerini yerleştirir.</td>
      </tr>
      <tr>
         <td><strong>primaryKey</strong></td>
         <td><code>string</code></td>
         <td>Dizi'ye ait anahtar alan adını ayarlar. Bu ad arka uç taraflı doğrulama ve veritabanı kayıdı için gereklidir.</td>
      </tr>
      <tr>
         <td><strong>errorMessages</strong></td>
         <td><code>array</code></td>
         <td>Atanan form doğrulama hatalarının gösterilmesini sağlar.</td>
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
         <td><strong>top</strong></td>
         <td>İhtiyaç duyulduğunda dizi başlığına ait bölümü düzenler.</td>
      </tr>
      <tr>
         <td><strong>bottom</strong></td>
         <td>Dizi tablosunun en alt bölümünü düzenler.</td>
      </tr>
      <tr>
         <td><strong>headers</strong></td>
         <td>Dizi tablosuna ait sütunları özelleştirir.</td>
      </tr>
      <tr>
         <td><strong>item.actions</strong></td>
         <td>Dizi tablosuna ait işlemler bölümünü özelleştirir.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

Array Table olayları form kaydetme aşamadından sonra sunucudan dönen yanıtları alarak buna göre aksiyon almanızı kolaylaştırır.

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
         <td><strong>save</strong></td>
         <td>Form satırı kayıt edildikten sonra silinen veriye ait nesneye erişmenizi sağlar.</td>
      </tr>
      <tr>
         <td><strong>delete</strong></td>
         <td>Form satırı silindikten sonra silinen veriye ait nesneye erişmenizi sağlar.</td>
      </tr>
      <tr>
         <td><strong>edit</strong></td>
         <td>Form satırı açıkken düzenlenen veriye ait nesneye erişmenizi sağlar.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Array Table|Template|Script</title>
<content>
![Form](/images/array-table-input.png)
<tcol>

```html
<template>
  <v-row no-gutters>
    <v-col lg="8" md="12" sm="12">
      <va-array-table-input
        source="employeeChildren"
        :title="$t('resources.employees.fields.employeeChildren')"
        primary-key="childId"
        :headers="headers"
        :fields="fields"
        :generate-uid="true"
      >
       <template v-slot:[`input.childName`]="{ field }">
         <va-text-input
           :key="field.source"
           v-model="employeeChildrenForm.childName"
           variant="outlined"
           :error-messages="childNameErrors"
           clearable
         >
         </va-text-input>
       </template>
       <template v-slot:[`input.childBirthdate`]="{ field }">
         <va-date-input
           :key="field.source"
           v-model="employeeChildrenForm.childBirthdate"
           variant="outlined"
           :error-messages="childBirthdateErrors"
         >
         </va-date-input>
       </template>
      </va-array-table-input>
    </v-col>
  </v-row>
</template>
```
<tcol>

```js
<script>
import { useVuelidate } from "@vuelidate/core";
import { required, maxLength, numeric } from "@vuelidate/validators";
import Utils from "vuetify-admin/src/mixins/utils";
import Resource from "vuetify-admin/src/mixins/resource";
import { provide } from 'vue'

export default {
  props: ["id", "item"],
  mixins: [Utils, Resource],
  setup() {
    let vuelidate = useVuelidate();
    provide('v$', vuelidate)
    return { v$: vuelidate }
  },
  data() {
    return {
      model: {
        id: null,
        employeeChildren: null,
      },
      employeeChildrenHeaders: [
        { key: "childName", width: "40%" },
        { key: "childBirthdate", width: "40%" },
        { key: "actions" },
      ],
      employeeChildrenFields: [
        {
          source: "childName",
          type: "text",
        },
        {
          source: "childBirthdate",
          type: "date",
        },
      ]
    };
  },
  validations() {
    return {
      // model: {},
      employeeChildrenForm: {
        childName: {
          required,
        },
        childBirthdate: {
          required,
        }
      }
    }
  },
  created() {
    this.model.id = this.generateId(this);
  },
  computed: {
    employeeChildrenForm: {
      get() {
        return this.$store.getters[`${this.resource}/getRow`];
      },
      set(val) {
        this.$store.commit(`${this.resource}/setRow`, val);
      } 
    },
    childNameErrors() {
      const errors = [];
      const field = "childName";
      if (!this.v$["employeeChildrenForm"][field].$dirty) return errors;
      this.v$["employeeChildrenForm"][field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      return errors;
    },
    childBirthdateErrors() {
      const errors = [];
      const field = "childBirthdate";
      if (!this.v$["employeeChildrenForm"][field].$dirty) return errors;
      this.v$["employeeChildrenForm"][field].required.$invalid &&
        errors.push(this.$t("v.text.required"));
      return errors;
    },
  },
}
</script>
```
</content>
</tab>

### Avatar

Kesme ve küçültme seçenekleri ile kullanıcıya ait bir profil resminin oluşturulmasını kolaylaştırır.

<b>Mixinler</b>

* Input
* InputWrapper
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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>backgroundColor</strong></td>
         <td><code>string</code></td>
         <td>Arka plan rengini belirler. Varsayılan değer <b>#ededed</b> değeridir.</td>
      </tr>
      <tr>
         <td><strong>defaultSrc</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak gösterilen resmi belirler. Varsayılan değer <b>/src/assets/avatar_2x.png</b> değeridir.</td>
      </tr>
      <tr>
         <td><strong>setLabel</strong></td>
         <td><code>string</code></td>
         <td>Avatar ekleme işlemine ait tuşun etiketini belirler.</td>
      </tr>
      <tr>
         <td><strong>delLabel</strong></td>
         <td><code>string</code></td>
         <td>Avatar silme işlemine ait tuşun etiketini belirler.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Avatar|Template</title>
<content>
![Form](/images/avatar-input.png)
<tcol>

```html
<template>
  <v-row no-gutters>
    <v-col sm="3" class="mr-3">
      <va-avatar-input
        source="avatarImage"
        :set-label="$t('resources.account.fields.avatar.set')"
        :del-label="$t('resources.account.fields.avatar.delete')"
      >
      </va-avatar-input>      
    </v-col>
  </v-row>
</template>
```
</content>
</tab>

### Check List

Birinci seviyede alt alta gruplanmış checkbox input bileşenlerinin birlikte oluşturulmasını sağlar. Açılıp kapanma (toggle) özelliği, tüm girdilerin bir üst checkbox ile seçilebilmesi ve liste içinde arama gibi özellikler varsayılan olarak desteklenir.

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>disableSearch</strong></td>
         <td><code>boolean</code></td>
         <td>Üst kısımda çıkan arama özelliğini gizler/gösterir. (Varsayılan: false).</td>
      </tr>
      <tr>
         <td><strong>disableFooter</strong></td>
         <td><code>boolean</code></td>
         <td>Alt kısımda çıkan sayfalama özelliğini gizler/gösterir. (Varsayılan: false).</td>
      </tr>
      <tr>
         <td><strong>primaryKey</strong></td>
         <td><code>string</code></td>
         <td>Gruplama işlemleri için birincil anahatar adını belirler.</td>
      </tr>
      <tr>
         <td><strong>itemsPerPage</strong></td>
         <td><code>string</code></td>
         <td>Sayfalama başına gösterilecek veri sayısını belirler.</td>
      </tr>
      <tr>
         <td><strong>headers</strong></td>
         <td><code>array</code></td>
         <td>Sütun başlıklarını belirler.</td>
      </tr>
      <tr>
         <td><strong>fields</strong></td>
         <td><code>string</code></td>
         <td>Sütun alanlarını belirler.</td>
      </tr>
      <tr>
         <td><strong>initUrl</strong></td>
         <td><code>string</code></td>
         <td>Tüm listeyi getiren arka uç url adresini belirler.</td>
      </tr>
      <tr>
         <td><strong>groupBy</strong></td>
         <td><code>string</code></td>
         <td>Girilen değere göre hangi sütunun gruplanacağını belirler.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>CheckList|Template|Script</title>
<content>
![Form](/images/checklist-input.png)
<tcol>

```html
<template>
  <h2 class="h2 mb-4">
    {{ $t("menu.permissions") }}
  </h2>
  <v-row no-gutters>
    <v-col cols="6">
      <va-check-list-input
        source="rolePermissions"
        :headers="headers"
        :fields="fields"
        primary-key="permId"
        items-per-page="25"
        :group-header="$t('resources.roles.fields.moduleName')"
        group-by="moduleName"
        init-url="/permissions/findAll"
      >
      </va-check-list-input>    
    </v-col>
  </v-row>
</template>
```
<tcol>

```js
<script>
import utils from "vuetify-admin/src/mixins/utils";
import { provide } from 'vue'

export default {
  props: ["id", "item"],
  mixins: [utils],
  setup() {
    let vuelidate = useVuelidate();
    provide('v$', vuelidate)
    return { v$: vuelidate }
  },
  data() {
    return {
      rolePermissions: [],
      model: {
        rolePermissions: null,
      },
      fields: [
        { source: "moduleName" },
        { source: "action" },
        { source: "route" },
        { source: "method"},
      ],
    };
  },
  computed: {
    headers() {
      return [
        {
          key: "moduleName",
          sortable: false,
        },
        {
          key: "action",
          sortable: false,
        },
        {
          key: "route",
          sortable: false,
        },
        {
          key: "method",
          sortable: false,
        },
      ];
    }
  }
}
</script>
```
</content>
</tab>


### Color Picker

HEX renk kodlarının seçilmesini kolaylaştıran bileşeni oluşturur.

<b>Mixinler</b>

* Input
* InputWrapper
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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin genel rengini belirler.</td>
      </tr>
      <tr>
         <td><strong>border</strong></td>
         <td><code>string</code></td>
         <td>Bileşene kenarlık stilleri uygular.</td>
      </tr>
      <tr>
         <td><strong>rounded</strong></td>
         <td><code>boolean</code>, <code>string</code>, <code>number</code></td>
         <td>Bileşene uygulanan kenar yarıçapını belirtir.</td>
      </tr>
      <tr>
         <td><strong>dotSize</strong></td>
         <td><code>string</code></td>
         <td>Tuval üzerindeki seçim noktasının boyutunu değiştirir.</td>
      </tr>
      <tr>
         <td><strong>hideCanvas</strong></td>
         <td><code>boolean</code></td>
         <td>Tuvali gizler.</td>
      </tr>
      <tr>
         <td><strong>canvasHeight</strong></td>
         <td><code>string</code>, <code>Number</code></td>
         <td>Tuvalin yüksekliğini belirler.</td>
      </tr>
      <tr>
         <td><strong>mode</strong></td>
         <td><code>string</code></td>
         <td>Geçerli seçili giriş türü. <b>v-model:mode</b> ile girdi senkronize edilebilir. Alabileceği Değerler: 'rgb' | 'rgba' | 'hsl' | 'hsla' | 'hex' | 'hexa'</td>
      </tr>
      <tr>
         <td><strong>modes</strong></td>
         <td><code>Array</code></td>
         <td>Kullanılabilir giriş türlerini ayarlar. Verilebilecek Değerler: ['rgb', 'rgba', 'hsl', 'hsla', 'hex', 'hexa'].</td>
      </tr>
      <tr>
         <td><strong>hideInputs</strong></td>
         <td><code>boolean</code></td>
         <td>Girdi alanlarını gizler. (Varsayılan: false).</td>
      </tr>
      <tr>
         <td><strong>hideSliders</strong></td>
         <td><code>boolean</code></td>
         <td>Girdi alanlarını gizler. (Varsayılan: false).</td>
      </tr>
      <tr>
         <td><strong>showSwatches</strong></td>
         <td><code>boolean</code></td>
         <td>Tuval üzerinde renk örneklerini görüntüler. (Varsayılan: false).</td>
      </tr>
      <tr>
         <td><strong>swatchesMaxHeight</strong></td>
         <td><code>string</code>, <code>Number</code></td>
         <td>Renk örnekleri bölümünün maksimum yüksekliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>position</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin konumunu ayarlar. (Varsayılan: undefined). Alabileceği Değerler: 'static' | 'relative' | 'fixed' | 'absolute' | 'sticky'.</td>
      </tr>
      <tr>
         <td><strong>width</strong></td>
         <td><code>string</code></td>
         <td>Renk seçicinin genişliğini ayarlar.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Color Picker|Template</title>
<content>
![Form](/images/color-picker-input.png)
<tcol>

```html
<template>
  <v-row no-gutters>
    <v-col sm="3" class="mr-3">
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
</template>
```
</content>
</tab>

### Currency

Para birimi gösterimi için <a href="https://www.npmjs.com/package/vue-currency-input" target="_blank">vue-currency-input</a> bileşenini kullanarak mevcut değeri varolan param birimine göre biçimlendirir.

<b>Mixinler</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak <b>source</b>, create/update için API servisine gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
      </tr>
      <tr>
         <td><strong>options</strong></td>
         <td><code>object</code></td>
         <td><a href="https://www.npmjs.com/package/vue-currency-input" target="_blank">vue-currency-input</a> opsiyonlarını girmenizi sağlar. Örnek: <code>options="{ currency: "USD", precision: 2 }</code></td>
      </tr>
   </tbody>
</table>
</div>

<b>Örnek</b>

<tab>
<title>Currency|Template|Script</title>
<content>
![Form](/images/currency-input.png)
<tcol>

```html
<template>
  <v-row no-gutters>
    <v-col lg="3" md="4" sm="6">
      <va-select-input
        :label="$t('demo.currencyId')"
        reference="currencies"
        v-model="model.currencyId"
      >
      </va-select-input>
      <va-currency-input
        clearable
        :label="$t('demo.amount')"
        v-model="model.amount"
        :key="'amount_' + getCurrencyId"
        :options="{ currency: getCurrencyId, precision: 2 }"
      ></va-currency-input>
    </v-col>
  </v-row>
</template>
```
<tcol>

```js
<script>
export default {
  data() {
    return {
      model: {
        amount: 0,
        currencyId: { id: "USD", name: "Usd" },
      },
    };
  },
  computed: {
    getCurrencyId() {
      if (this.model && this.model.currencyId && this.model.currencyId.id) {
        return this.model.currencyId.id;
      }
      return "TRY";
    },
  }
};
</script>
```
</content>
</tab>

### Sheet

Yüksek sayıdaki excel verilerini okuyup <b>cli</b> modunda veritabanına eklemenize olanak sağlayan girdi bileşenidir. İçeri alınan verileri kaydetmek için kendi oluşturduğunuz bir sheet kaydetme şablonu ile kullanılmalıdır.

> Bileşenler hakkında daha detaylı örnekler görmek için anasayfadaki demo uygulamamıza gözatın.

<b>Örnek</b>

<tab>
<title>Sheet|Template|Script</title>
<content>
1. Takip eden resim dosya yükleme aşamasını gösteriyor.

![Form](/images/sheet-input-upload.png)

2. Takip eden resim dosya yüklendikten sonraki aşamayı gösteriyor.

![Form](/images/sheet-input-list.png)
<tcol>

```html
<template>
   <va-list 
      disable-create
      :filters="filters"
      :fields="fields"
      :items-per-page="50"
   >
      <va-data-table-server
         row-edit
         row-create
         disable-edit
         disable-create
         disable-clone
         disable-show
         :disable-empty-data-row-create="true"
      >
         <template v-slot:row.actions="{ item }">
            <v-btn
               :item="item"
               :label="$t('va.actions.show')"
               :color="'blue'"
               variant="text"
               exact
               @click.stop="getRoute(item)"
            >
               <v-icon size="small">mdi-eye</v-icon>
            </v-btn>
         </template>
      </va-data-table-server>
   </va-list>

 <v-card
      class="mx-auto mt-2"
      variant="flat"
   >
      <template v-slot:title>
         {{ $t("resources.jobtitles.createNewList") }}
      </template>
      <v-card-text>
         <div>
            {{ $t("resources.jobtitles.importDescription") }}
         </div>
      </v-card-text>
      <v-card-actions>
         <v-btn 
            color="primary"
            @click="downloadEmptyXls()">
            {{ $t("resources.jobtitles.downloadXls") }}
         </v-btn>
      </v-card-actions>
   </v-card>

   <v-card
      variant="flat"
      class="mt-2"
   >
      <v-card-text>
         <v-row class="mt-2">
            <v-col sm="2">
               <va-select-input
                  v-model="yearId"
                  reference="years"
                  variant="outlined"
                  clearable
                  :disabled="loadingStatus"
                  :error-messages="yearIdErrors"
               ></va-select-input>        
            </v-col>
            <v-col sm="2">
               <va-text-input
                  v-model="listName"
                  variant="outlined"
                  clearable
                  :disabled="loadingStatus"
                  :error-messages="listNameErrors"
               ></va-text-input>        
            </v-col>
            <v-col sm="8">
               <v-btn
                  v-if="loadingStatus"
                  color="primary"
                  class="mr-2"
                  @click="cancelSaveList()"
                  variant="outlined"
               >
                  {{ $t("va.actions.cancel") }}
               </v-btn>
               <v-btn 
                  :loading="loadingStatus"
                  color="primary"
                  variant="outlined" 
                  @click="saveList()">
                  {{ $t("resources.jobtitles.saveList") }}
               </v-btn>
            </v-col>
         </v-row>
      </v-card-text>
   </v-card>

   <v-card
      variant="flat"
      class="mt-2"
      v-if="!loadingStatus"
   >
      <v-card-text>
      <h5 class="h4 mb-3">Sheet Input Component</h5>
      <va-sheet-input
         icon="mdi-file-excel"
         items-per-page="100"
         upload-url="/jobtitlelists/upload"
         preview-url="/jobtitlelists/preview"
         remove-url="/jobtitlelists/remove"
         @importedItems="onItems"
      >
      </va-sheet-input>
      </v-card-text>
   </v-card>
</template>
```
<tcol>

```js
<script>
import { useVuelidate } from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import { provide } from 'vue';
import { mapActions } from "vuex"

export default {
  props: [],
  inject: ['admin'],
  setup() {
    provide('v$', useVuelidate() )
    return { v$: useVuelidate() }
  },
  provide() {
    return {
      validations: {
        form: {
          listName: {
            required
          },
        }
      },
      errors: {
        listNameErrors: (v$) => {
          const errors = [];
          if (!v$['form'].listName.$dirty) return errors;
          v$['form'].listName.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
      }
    };
  },
  validations() {
    return {
      yearId: {
        required
      },   
      listName: {
        required
      }
    }
  },
  data() {
    return {
   cancel: false,
   status: false,
   loadingStatus: false,
   listId: null,
   listName: null,
   companyId: null,
   yearId: new Date().getFullYear(),
   loading: false,
   loadingList: false,
   importData: [],
   validationError: null,
      filters: [
        {
          source: "yearId",
          type: "selectfilter",
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "years",
          }
        },
      ],
      fields: [
        {
          source: "yearId",
          type: "select",
          attributes: {
            reference: "years",
          },
          sortable: true,
        },
        {
          source: "listName",
          sortable: true,
        },
      ],
    }
  },
  computed: {
    yearIdErrors() {
      const errors = [];
      if (!this.v$.yearId.$dirty) return errors;
      this.v$.yearId.required.$invalid &&
        errors.push(this.$t("v.text.required"));
      return errors;
    },
    listNameErrors() {
      const errors = [];
      if (!this.v$.listName.$dirty) return errors;
      this.v$.listName.required.$invalid &&
        errors.push(this.$t("v.text.required"));
      return errors;
    }
  },
  methods: {
    ...mapActions({
      checkAuth: "auth/checkAuth",
    }),
   onItems(items, vError) {
      this.importData = items;
      if (items.length == 0) {
         this.validationError = null
      } else {
         this.validationError = vError
      }
   },
    getRoute(item) {
      let filter = null
      if (item.listId) {
         filter = '{ "yearId" : ["'+ item.yearId.id + '"] , "listId" : ["' + item.listId + '"] }';
      }
         this.$router.push({ name: "jobtitles_list", query: { filter: filter } });
    },
    async importStatus() {
      let Self = this;
      this.loadingStatus = true;
      try {
        //
        // get status with EventSource
        // 
        let user = await this.checkAuth();
        if (user) {
          const apiUrl = import.meta.env.VITE_API_URL;
          this.source = new EventSource(apiUrl + '/stream/events?userId=' + user.id + '&route=list');
          this.source.onmessage = function(e) {
            if (e.data) {
              let data = JSON.parse(e.data);
              if (data.status == 1 || data.status == true) {
                Self.source.close(); // lets close it when the process is done !
                Self.status = false;
                Self.loadingStatus = false
                Self.importData = []; // reset import data
                Self.admin.http({ method: "DELETE", url: "/jobtitlelists/reset" }); // reset all status
                Self.$store.dispatch("api/refresh", 'jobtitlelists');
              }
            }
          };
        }
      } catch (e) {
        if (e["response"]
          && e["response"]["status"]
          && e.response.status === 400) {
          this.admin.message("error", e.response.data.data.error);
        }
      }
    },
   saveList() {
      this.cancel = false;
      this.v$.yearId.$touch();
      this.v$.listName.$touch();
      if (this.v$.listName.$invalid || this.v$.yearId.$invalid) {
        return false;
      }
      if (this.validationError) {
         this.$store.commit("messages/show", { type: 'error', message: this.$t("employees.fixErrorsMessage") });
      } else {
         if (this.importData.length == 0) {
            this.$store.commit("messages/show", { type: 'error', message: this.$t("employees.importDataMessage") });
         } else {
            // save imported data
            // 
            this.admin.http({ method: "POST", url: "/jobtitlelists/import", data: { yearId: this.yearId, listName: this.listName } });
               // check status every 1 seconds
               // 
            this.importStatus();
         }
      }
   },
    cancelSaveList() {
      this.cancel = true;
      this.loadingStatus = false;
      this.importData = []; // reset import data
      this.admin.http({ method: "DELETE", url: "/jobtitlelists/reset" }); // reset all status
      this.$store.dispatch("api/refresh", 'jobtitlelists'); // refresh page
    },
   downloadEmptyXls() {
      window.location.href = "/src/assets/JobTitles.xlsx"
   }
  }
}
</script>
```
</content>
</tab>
