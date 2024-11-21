
## Mixins (API)

Bu bölümde Olobase Admin'de kullanılan tüm <b>mixin</b> kütüphanelerinin referansını bulacaksınız.

### Page

Göster, Oluştur ve Düzenle için kullanılan CRUD eylem sayfası işlevlerini içerir.

<b>Özellikler</b>

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
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Sayfanın isteğe bağlı h1 başlığını belirler.</td>
      </tr>
   </tbody>
</table>

### Resource

Kaynakla ilgili tüm bileşenler için kullanılır.

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
         <td><strong>resource</strong></td>
         <td><code>string</code></td>
         <td>Kullanılacak kaynağın adı. Etiket yerelleştirmesi ve bağlam eylemi etkinleştiricileri için gereklidir. Varsayılan davranış  yönlendirici bağlamından getirmektir.</td>
      </tr>
   </tbody>
</table>
</div>

### Source

Kaynağın belirli özelliğini kullanması gereken bileşenler için kullanılır.

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
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slotlanmış nesne için nokta gösterimini destekler.</td>
      </tr>
   </tbody>
</table>
</div>

### Field

Veri gösterisi için kullanılan tüm alanlar için ana alan karışımı. Geçerli kaynaktan özellik kaynağı değerini otomatik olarak getirebilir. Kendi alan bileşeninizi oluşturmak için bu bileşeni kullanın.

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
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slotlanmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><b>VaShow</b> bileşeni tarafından enjekte edilen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
   </tbody>
</table>
</div>

### Input

Kaynak özelliğinin düzenlenmesi veya oluşturulması için kullanılan tüm girdiler için ana girdi karışımı. Ana formun modelini otomatik olarak günceller. Kendi giriş bileşeninizi oluşturmak için bu bileşeni kullanın.

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
         <td>Gösterilecek değeri getirmek için kaynağın özelliği. Slotlanmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan olarak kaynak, oluşturma/güncelleme için API'ye gönderilecek son ad olacaktır. Bu destek, bu varsayılan davranışı geçersiz kılmanıza olanak tanır.</td>
      </tr>
   </tbody>
</table>
</div>

### Button

Genel tuş bileşenleri için ortak özellikler sağlar.

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
         <td>Düğmeye eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Metin özellik değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
   </tbody>
</table>
</div>

### Action Button

Her tür eylem tuşu için ortak özellikler sağlar.

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
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>boolean</code></td>
         <td>Sonraki etiket simgesi veya araç ipucu olarak gösterilen düğmenin etiketi.</td>
      </tr>
      <tr>
         <td><strong>hideLabel</strong></td>
         <td><code>boolean</code></td>
         <td>Simgenin yanındaki etiketi gizle. Araç ipucu olarak görünecek.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Metin özellik değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>text</strong></td>
         <td><code>boolean</code></td>
         <td>Arka planı olmayan metin olarak göster.</td>
      </tr>
   </tbody>
</table>
</div>

### Redirect Button

Yönlendirmeyi destekleyen tuşlar için <b>disableRedirect</b> desteği etkin olmadığı sürece herhangi bir oluşturma eylemi mevcut değilse tuş otomatik olarak gizlenecektir.

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
         <td>Düğmeye eklenen öğe.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>True ise tuşu yalnızca simgeyle gösterir.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Metin özellik değerine bağlı olarak özelleştirilebilir arka plan veya metin rengi.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Uyumlu düğmeler için varsayılan yönlendirme davranışını devre dışı bırakır.</td>
      </tr>
   </tbody>
</table>
</div>

### Search

Kaynak arama bileşenleri için <b>VaList</b> veya <b>VaAutocompleteInput</b> gibi ortak özellikler sağlar. GetList veri sağlayıcısını kullanır.

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
         <td><strong>filter</strong></td>
         <td><code>object</code></td>
         <td>Dahili aktif filtre. Filtre parametrelerinin içinde veri sağlayıcınıza gönderilir.</td>
      </tr>
      <tr>
         <td><strong>fields</strong></td>
         <td><code>array</code></td>
         <td>API tarafı için seçilecek alanların listesi. İç içe alanlar için nokta gösterimini destekler. Veri sağlayıcınıza alan parametreleri içinde gönderilir.</td>
      </tr>
      <tr>
         <td><strong>sortBy</strong></td>
         <td><code>array</code></td>
         <td>Sıralanmış alanların listesi birden fazla olabilir. Sıralama parametrelerinin içinde veri sağlayıcınıza gönderilir.</td>
      </tr>
      <tr>
         <td><strong>sortDesc</strong></td>
         <td><code>array</code></td>
         <td>Sıralanan her alan için sıralama durumu listesi, <b>boolean</b> değeri <b>true</b> ise <b>DESC</b> olarak sıralanır. Sıralama parametrelerinin içinde veri sağlayıcınıza gönderilir.</td>
      </tr>
      <tr>
         <td><strong>include</strong></td>
         <td><code>array</code>, <code>object</code></td>
         <td>API tarafı için mevcut kaynağa dahil edilecek ilgili kaynaklar. Talep üzerine istekli yüklemeye izin verir, veri sağlayıcınıza <b>include</b> parametreleri içinde gönderilir.</td>
      </tr>
      <tr>
         <td><strong>itemsPerPage</strong></td>
         <td><code>number</code></td>
         <td>Her sayfa için listede gösterilecek maksimum öğe sayısı. Veri sağlayıcınıza <b>pagination.perPage</b> parametreleri içinde gönderilir.</td>
      </tr>
      <tr>
         <td><strong>disableItemsPerPage</strong></td>
         <td><code>boolean</code></td>
         <td>Sunucu tarafında zorunlu olarak sorgudaki sayfa başına öğeleri devre dışı bırakır. Düzgün istemci tarafı çağrı cihazı hesaplaması için <b>itemsPerPage</b>'in hala gerekli olduğuna dikkat edin.</td>
      </tr>
   </tbody>
</table>
</div>

### Chip

Tüm çip tabanlı alanlar için ortak özellikler sağlar.

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
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Çipin rengi, belirli bir değere göre dinamik renk için bir fonksiyon olabilir.</td>
      </tr>
      <tr>
         <td><strong>small</strong></td>
         <td><code>boolean</code></td>
         <td>Küçük çip</td>
      </tr>
      <tr>
         <td><strong>to</strong></td>
         <td><code>boolean</code></td>
         <td>Gerekirse çiple ilişkili yönlendirici bağlantısı.</td>
      </tr>
   </tbody>
</table>
</div>

### Input Wrapper

Tüm girdi alanları için ortak özellikler sağlar.

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
         <td><strong>parentSource</strong></td>
         <td><code>string</code></td>
         <td>Dizi girişi için ana kaynağın özel durumu.</td>
      </tr>
      <tr>
         <td><strong>prependIcon</strong></td>
         <td><code>string</code></td>
         <td>Bileşene baş kısmına harici bir simge ekler. Geçerli bir MDI olmalıdır.</td>
      </tr>
      <tr>
         <td><strong>appendIcon</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin son kısmına harici bir simge ekler. Geçerli bir MDI olmalıdır.</td>
      </tr>
      <tr>
         <td><strong>prependInnerIcon</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin baş kısmına dahili bir simge ekler. Geçerli bir MDI olmalıdır.</td>
      </tr>
      <tr>
         <td><strong>appendInnerIcon</strong></td>
         <td><code>string</code></td>
         <td>Bileşenin son kısmına dahili bir simge ekler. Geçerli bir MDI olmalıdır.</td>
      </tr>
      <tr>
         <td><strong>hint</strong></td>
         <td><code>string</code></td>
         <td>İpucu metni.</td>
      </tr>
      <tr>
         <td><strong>hideDetails</strong></td>
         <td><code>string</code>, <code>boolean</code></td>
         <td>İpucu ve doğrulama hatalarını gizler. Otomatik olarak ayarlandığında mesajlar yalnızca görüntülenecek bir mesaj (ipucu, hata mesajı, sayaç değeri vb.) varsa işlenir.</td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>boolean</code></td>
         <td>Giriş yüksekliğini azaltır.</td>
      </tr>
      <tr>
         <td><strong>required</strong></td>
         <td><code>boolean</code></td>
         <td>Varsayılan gerekli istemci tarafı kuralını ekler.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan etiket davranışını geçersiz kılar. Varsayılan, yerelleştirilmiş VueI18n etiketini hem kaynaktan hem de mülk kaynağından almaktır.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Çevrilen etiket olarak varsayılan kaynak anahtarını geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>placeholder</strong></td>
         <td><code>string</code></td>
         <td>Eğer girdi alanı destekliyorsa <b>placeholder</b> niteliğine girilen değeri atar.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>Girdi alanı eğer destekliyorsa silinebilir niteliğini bu alana atar.</td>
      </tr>
      <tr>
         <td><strong>index</strong></td>
         <td><code>number</code></td>
         <td>Giriş değerinin bir array olması durumunda spesifik alan indeksidir. Değeri iyi bir zamanda güncellemek için bunu parentSource prop ile kullanın ve form modeline yerleştirin.</td>
      </tr>
      <tr>
         <td><strong>errorMessages</strong></td>
         <td><code>array</code></td>
         <td>İpucu olarak gösterilecek özel hata doğrulama mesajlarının listesi.</td>
      </tr>
   </tbody>
</table>
</div>

### Rating

Derecelendirme alanı ve girdi bileşenleri için ortak özellikler sağlar.

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
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Aktif derecelendirmeler için düz renk.</td>
      </tr>
      <tr>
         <td><strong>backgroundColor</strong></td>
         <td><code>string</code></td>
         <td>Boş derecelendirmeler için kontur rengi.</td>
      </tr>
      <tr>
         <td><strong>length</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Gösterilecek derecelendirme miktarı.</td>
      </tr>
      <tr>
         <td><strong>halfIncrements</strong></td>
         <td><code>boolean</code></td>
         <td>Yarım artışların seçimine izin verir.</td>
      </tr>
   </tbody>
</table>
</div>

### Choices

Tüm seçimlere dayalı alanlar veya girdiler için ortak özellikler sağlar.

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
         <td><strong>itemText</strong></td>
         <td><code>string</code>, <code>array</code>, <code>func</code></td>
         <td>Metni gösterme özelliği.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code>, <code>array</code>, <code>func</code></td>
         <td>Değerin nereden alındığını belirtir.</td>
      </tr>
      <tr>
         <td><strong>choices</strong></td>
         <td><code>array</code></td>
         <td>Seçim için seçeneklerin listesi. Varsayılan olarak VueI18n kaynak yerel ayarlarınızdan yerelleştirilmiş numaralandırmaları alır.</td>
      </tr>
   </tbody>
</table>
</div>

### Reference

<b>VaReferenceField</b> veya <b>VaReferenceArrayField</b> olarak kaynak referansını destekleyen tüm alan bileşenleri için ortak özellikler sağlar.

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
         <td><strong>reference</strong></td>
         <td><code>string</code></td>
         <td>Bağlanılacak kaynağın adı.</td>
      </tr>
      <tr>
         <td><strong>action</strong></td>
         <td><code>string</code>, <code>array</code>, <code>func</code></td>
         <td>Bağlanacak varsayılan CRUD sayfası.</td>
      </tr>
      <tr>
         <td><strong>itemText</strong></td>
         <td><code>string</code></td>
         <td>İç hedeflenen kaynağı dizelemek için kullanılan özellik. Daha fazla özelleştirme için bir işlev kullanın. Hiçbir şey ayarlanmadıysa varsayılan olarak genel etiket özelliği kaynağını kullanın.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Bağlantı oluşturma için kimlik değerinin alındığı yeri belirtin.</td>
      </tr>
   </tbody>
</table>
</div>

### Multiple

Dizi olarak birden fazla değere izin veren girdi bileşenleri için ortak özellikler sağlar.

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
         <td><strong>v-model</strong></td>
         <td><code>string</code>, <code>array</code></td>
         <td>Düzenlenecek değer. Birden fazla ise varsayılan olarak dizidir.</td>
      </tr>
      <tr>
         <td><strong>multiple</strong></td>
         <td><code>boolean</code></td>
         <td>Girişin birden fazla değeri dizi olarak kabul etmesine izin verir.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Varyant desteği, metin alanınızın stilini özelleştirmenin kolay bir yolunu sağlar. Şu değerler geçerli seçeneklerdir: solo, filled (varsayılan), outlined, plain, underlined.</td>
      </tr>
      <tr>
         <td><strong>chips</strong></td>
         <td><code>boolean</code></td>
         <td>Her öğe için çip kullanımını sağlar. Varsayılan olarak birden fazlaysa etkindir.</td>
      </tr>
      <tr>
         <td><strong>smallChips</strong></td>
         <td><code>boolean</code></td>
         <td>Küçük çipler kullanılmasını sağlar.</td>
      </tr>
   </tbody>
</table>
</div>

### Files

Tüm dosya yükleme girişleri için ortak özellikler sağlar.

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
         <td>Gösterilecek değeri getirmek için kaynağın özelliğidir. Slotlanmış nesne için nokta gösterimini destekler.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td><b>VaShow</b> tarafından enjekte edilen varsayılan öğeyi geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>src</strong></td>
         <td><code>string</code></td>
         <td>Dosya nesnesinin kaynak özelliği, orijinal dosya kaynağının bağlantı yolu.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Başlık ve alt nitelikleri için kullanılan dosya nesnesinin başlık niteliğini ayarlar.</td>
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
         <td>Esas olarak VaFileInput için kullanılır, dosyaların veya görsellerin kaldırılmasına izin verir.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Silinecek dosyanın kimliklerini içeren API'ye gönderilen özelliğin adını belirler.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Silinecek dosyaları tanımlamak için kimlik değerinin alındığı yeri (varsayılan: "id") belirtir.</td>
      </tr>
   </tbody>
</table>
</div>

### Utils

Olobase Admin içerisindeki bazı yardımcı fonksiyonlar utils.js içerisinde varsayılan olarak yer alır.

<b>Metotlar</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Metot</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>this.generateUid()</strong></td>
         <td>Rastgele bir <a href="https://www.techtarget.com/searchwindowsserver/definition/GUID-global-unique-identifier" target="_blank">GUUID</a> üretir: xxxxxxxx-xxxx-xxxx-yxxx-xxxxxxxxxxxx. Eğer konfigürasyon dosyanızda <kbd>form.disableGenerateUid</kbd> seçeneği <b>true</b> ise bu durumda rastgele <kbd>integer</kbd> biçiminde sayılar üretir.</td>
      </tr>
      <tr>
         <td><strong>this.generateInt()</strong></td>
         <td>Rastgele <kbd>tamsayı</kbd> biçiminde sayılar üretir.</td>
      </tr>
      <tr>
         <td><strong>this.generateId(this)</strong></td>
         <td>Geçerli sayfanın rotası <b>create</b> sözcüğünü içeriyorsa <code>generateUid()</code> aksi durumda <code>this.id</code> değerine geri döner.</td>
      </tr>
      <tr>
         <td><strong>validateForm(this, formName)</strong></td>
         <td>Eğer bir sayfada birden fazla form kullanıyorsanız. Bu fonksiyon geçerli sayfada verilen form adının validasyonunu kontrol eder.</td>
      </tr>
      <tr>
         <td><strong>dateAddMonth(date, numberOfMonth)</strong></td>
         <td>Verilen tarihe girilen ay sayısı kadar ay ekler.</td>
      </tr>
      <tr>
         <td><strong>dayDiff(firstDate, secondDate = null)</strong></td>
         <td>Sadece ilk parametre girilirse bugünkü tarih ve girilen tarih arasındaki gün sayısını hesaplar. İki tarihte girilirse iki tarih arasındaki gün hesaplanır.</td>
      </tr>
      <tr>
         <td><strong>monthDiff(startDate, endDate)</strong></td>
         <td>İki tarih arasında ne kadar ay olduğunu hesaplar.</td>
      </tr>
      <tr>
         <td><strong>generatePassword(length)</strong></td>
         <td>Verilen genişlikte rastgele bir güçlü şifre oluşturur.</td>
      </tr>
   </tbody>
</table>
</div>