
## Tuşlar (API)

Bu bölümde Olobase Vuetify Admin'de kullanılan tüm tuş bileşenleri referansını bulacaksınız.

### Action

Herhangi bir özel eylem tuşu için kullanabileceğiniz bileşen. Veri gösterme tablosu satırlarında; oluşturma, gösterme veya düzenleme sayfalarının üst başlığında kullanılabilir.

<b>Mixinler</b>

* ActionButton

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
         <td><strong>block</strong></td>
         <td><code>boolean</code></td>
         <td>Tuşu kullanılabilir alanın %100'üne kadar genişletir.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>Tuşun tür özelliğini ayarlar. (Varsayılan: button).</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Bileşene farklı stiller uygular. ('text' | 'flat' | 'elevated' | 'tonal' | 'outlined' | 'plain').</td>
      </tr>
      <tr>
         <td><strong>to</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Tıklamada yönlendirmek için Vue rotası.</td>
      </tr>
      <tr>
         <td><strong>href</strong></td>
         <td><code>string</code></td>
         <td>Bağlantı kurmak için tuşu href'e çevirir.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>boolean</code></td>
         <td>Href kullanılırsa sabitleme hedefi.</td>
      </tr>
      <tr>
         <td><strong>loading</strong></td>
         <td><code>string</code></td>
         <td>Tuş üzerindeki yükleme gösterimini etkinleştirir.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>click</strong></td>
         <td>Tıklandığında tetiklenir, varsa ilgili öğeyi gönderin.</td>
      </tr>
   </tbody>
</table>
</div>

### List

Tüm liste kaynağı eylemlerine yönelik düğme. Varsayılan olarak liste sayfasına yönlendirin. Dahili CRUD sayfasında üst başlıkta gösterilir.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
   </tbody>
</table>
</div>

### Show

Tüm kaynak gösterme eylemlerine yönelik tuş. Varsayılan olarak sayfayı göstermeye yönlendirir.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Uyumlu tuşlar için varsayılan yönlendirme davranışını devre dışı bırakır.</td>
      </tr>
   </tbody>
</table>
</div>

### RowShow

Vuetify <a href="https://vuetifyjs.com/en/components/menus/#usage" target="_blank">v-menu</a> bileşenini kullanarak veri tablosu üzerinde detay gösterme eylemini gerçekleştirir.

<b>Mixinler</b>

* Resource
* RedirectButton

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
   </tbody>
</table>
</div>

### Create

Tüm kaynak oluşturma eylemlerine yönelik tuş. Varsayılan olarak sayfa oluşturmaya yönlendirir.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Uyumlu tuşlar için varsayılan yönlendirme davranışını devre dışı bırakır.</td>
      </tr>
   </tbody>
</table>
</div>

### CreateDialog

VaList bileşeninde kaynak ekleme işlemlerini bir modal pencere içerisinden yapılmasını sağlar.

<b>Mixinler</b>

* Resource
* RedirectButton

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
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>last-dialog</strong></td>
         <td>Bir event bus olayıdır. <code>eventBus.emit("last-dialog", false)</code> ile açılan pencereyi bir axios http işleminden sonra kapatmanızı sağlar.</td>
      </tr>
   </tbody>
</table>
</div>

### RowCreate

Veri tablosu üzerinde boş bir satır açarak yeni bir kaynak eklenmesine yönelik eylemi gerçekleştirir.

<b>Mixinler</b>

* Resource
* RedirectButton

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
   </tbody>
</table>
</div>

### Edit

Tüm kaynak düzenleme eylemlerine yönelik düğme. Varsayılan olarak düzenleme sayfasına yönlendirir.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Uyumlu tuşlar için varsayılan yönlendirme davranışını devre dışı bırakır.</td>
      </tr>
   </tbody>
</table>
</div>

### RowSaveDialog

Veri tablosu üzerinde tıklandığında yeni bir modal penceresi açarak kaynak <b>düzenlenme/ekleme</b> işlemlerini gerçekleştirir.

<b>Mixinler</b>

* Resource
* RedirectButton

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Uyumlu tuşlar için varsayılan yönlendirme davranışını devre dışı bırakır.</td>
      </tr>
   </tbody>
</table>
</div>

### Clone

Tüm kaynak klonlama eylemlerine yönelik tuş. Kopyalanacak orijinal kaynağın hedef kimliğiyle varsayılan olarak sayfa oluşturmaya yönlendirir.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Uyumlu tuşlar için varsayılan yönlendirme davranışını devre dışı bırakır.</td>
      </tr>
   </tbody>
</table>
</div>

### Delete

Tüm kaynak silme eylemlerine yönelik tuş. Onaylama iletişim kutusuyla birlikte gelir.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>query</strong></td>
         <td>object</td>
         <td>Query string parametreleri</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>redirect</strong></td>
         <td><code>boolean</code></td>
         <td>Başarılı silme işleminden sonra kaynak listesine yönlendirir. Geçerli sayfa kaynak siliniyorsa varsayılan yönlendirme etkindir.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>click</strong></td>
         <td>Tıklandığında tetiklenir, varsa ilgili öğeyi gönderin.</td>
      </tr>
      <tr>
         <td><strong>delete</strong></td>
         <td>Öğe yoksa özel silme eylemi. Kendi özel mantığına sahip olan toplu silme butonu için kullanılır.</td>
      </tr>
	  <tr>
         <td><strong>deleted</strong></td>
         <td>Kaynak öğesinin başarıyla silinmesi sonrası tetiklenir.</td>
      </tr>
   </tbody>
</table>
</div>

### Bulk Action

VaList bileşenindeki toplu eylemleri gerçekleştirmek için genel özelleştirilebilir tuş. Öğe seçimlerinden sonra gösterilir. Başlık altında <b>copyMany</b> veya <b>deleteMany</b> veri sağlayıcı yöntemini kullanır.

<b>Mixinler</b>

* ActionButton

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
         <td><strong>value</strong></td>
         <td><code>array</code></td>
         <td>Seçilen kaynak öğeleri.</td>
      </tr>
      <tr>
         <td><strong>action</strong></td>
         <td><code>object</code></td>
         <td><b>copyMany</b>, <b>deleteMany</b> gibi veri sağlayıcı yönteminde gönderilecek veri nesnesi. Kopyalanacak veya silinecek kaynak özelliklerini içerir.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>click</strong></td>
         <td>Tıklandığında tetiklenir, varsa ilgili öğeyi gönderin.</td>
      </tr>
      <tr>
         <td><strong>input</strong></td>
         <td>Seçili öğeleri temizle.</td>
      </tr>
   </tbody>
</table>
</div>

### Bulk Delete

VaList'e yönelik toplu işlemleri silme düğmesi. Checkbox seçimi ile gözükür. Tüm <b>VaDeleteButton</b> özelliklerini korur ve <b>deleteMany</b> veri sağlayıcı yöntemini kullanır.

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
         <td><strong>value</strong></td>
         <td><code>array</code></td>
         <td>Seçilen kaynak öğeleri.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>input</strong></td>
         <td>Seçili öğeleri temizle.</td>
      </tr>
   </tbody>
</table>
</div>

### Bulk Copy

VaList'e yönelik toplu işlemleri silme düğmesi. Checkbox seçimi ile gözükür. Tüm <b>VaCopyButton</b> özelliklerini korur ve <b>deleteCopy</b> veri sağlayıcı yöntemini kullanır.

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
         <td><strong>value</strong></td>
         <td><code>array</code></td>
         <td>Seçilen kaynak öğeleri.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>input</strong></td>
         <td>Seçili öğeleri temizle.</td>
      </tr>
   </tbody>
</table>
</div>

### Excel Export

VaList bileşeninde işlevin api servisinizdeki <b>excel export</b> operasyonuna yönlendirilmesini sağlar.

<b>Mixinler</b>

* Resource
* Button

<b>Olaylar</b>

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
         <td><strong>click</strong></td>
         <td>Tıklandığında tetiklenir, varsa ilgili öğeyi gönderin.</td>
      </tr>
   </tbody>
</table>
</div>

### Save

VaForm bileşeni için kullanılabilecek varsayılan kaydetme tuşudur. Sadece bir gönder işlevinden ibarettir, asıl işi VaForm bileşeni yapar. Aşağıdaki işlevi tetikler.

```js
this.formState.submit(this.redirect)
```

<b>Mixinler</b>

* Resource
* Button

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
         <td><strong>block</strong></td>
         <td><code>boolean</code></td>
         <td>Tuşu kullanılabilir alanın %100'üne kadar genişletir.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>Tuşa eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise, tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Metin prop değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>text</strong></td>
         <td><code>boolean</code></td>
         <td>Arka plan tuşunu kaldırır.</td>
      </tr>
  		<tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan etiketi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>redirect</strong></td>
         <td><code>boolean</code></td>
         <td>Başarılı kaydetme işleminden sonra kaynak listesine yönlendirir.</td>
      </tr>
   </tbody>
</table>
</div>