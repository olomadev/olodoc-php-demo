
## Olobase Bileşen Listesi

1. <a href="/ui/all-components.html#Layout">Layout</a>
		- <a href="/ui/all-components.html#AppBar">AppBar</a>
		- <a href="/ui/all-components.html#Aside">Aside</a>
		- <a href="/ui/all-components.html#Breadcrumbs">Breadcrumbs</a>
		- <a href="/ui/all-components.html#Footer">Footer</a>
		- <a href="/ui/all-components.html#Messages">Messages</a>

2. <a href="/ui/all-components.html#Listeleme">Listeleme</a>
		- <a href="/ui/all-components.html#DataTableServer">DataTableServer</a>
		- <a href="/ui/all-components.html#DataIteratorServer">DataIteratorServer</a>

3. <a href="/ui/all-components.html#Girdiler">Girdiler</a>
		- <a href="/ui/all-components.html#ArrayTableInput">ArrayTableInput</a>
		- <a href="/ui/all-components.html#AutoCompleteInput">AutoCompleteInput</a>
		- <a href="/ui/all-components.html#AvatarInput">AvatarInput</a>
		- <a href="/ui/all-components.html#BooleanInput">BooleanInput</a>
		- <a href="/ui/all-components.html#CheckListInput">CheckListInput</a>
		- <a href="/ui/all-components.html#ColorPickerInput">ColorPickerInput</a>
		- <a href="/ui/all-components.html#CurrencyInput">CurrencyInput</a>
		- <a href="/ui/all-components.html#DateInput">DateInput</a>
		- <a href="/ui/all-components.html#FileInput">FileInput</a>
		- <a href="/ui/all-components.html#NumberInput">NumberInput</a>
		- <a href="/ui/all-components.html#PasswordInput">PasswordInput</a>
		- <a href="/ui/all-components.html#RadioGroupInput">RadioGroupInput</a>
		- <a href="/ui/all-components.html#RatingInput">RatingInput</a>
		- <a href="/ui/all-components.html#RichTextInput">RichTextInput</a>
		- <a href="/ui/all-components.html#TinyMceInput">TinyMceInput</a>
		- <a href="/ui/all-components.html#SelectInput">SelectInput</a>
		- <a href="/ui/all-components.html#SheetInput">SheetInput</a>
		- <a href="/ui/all-components.html#TextInput">TextInput</a>

4. <a href="/ui/all-components.html#Diğerleri">Diğerleri</a>
		- <a href="/ui/all-components.html#LanguageSwitcher">LanguageSwitcher</a>

## Layout

Layout, diğer adı ile <b>VaLayout</b>, takip eden örneklerde gösterilen bileşenleri sarmalayan ana layout bileşenidir.

### AppBar

Vuetify <a href="https://vuetifyjs.com/en/components/navigation-drawers/#usage" target="_blank">VNavigationDrawer</a> bileşeni ile hiyerarşik menü ve kullanıcı profili gibi bileşenleri oluşturan ana bileşenlerden biridir.

![AppBar](/images/sidebar.png)

### Aside

Bazı ek bilgiler koyabileceğiniz özelleştirilebilir görünümdür. Herhangi bir bağlamda, herhangi bir yerden içerik entegrasyonu için VaAsideLayout bileşeni kullanılır.

![Aside](/images/aside.png)

### Breadcrumbs

Breadcrumb'lar için <a href="https://vuetifyjs.com/en/components/breadcrumbs/#usage" target="_blank">v-breadcrumbs</a> bileşenini kullananarak geçerli rotadan otomatik olarak hiyerarşik bağlantılar oluşturur.

![Breadcrumbs](/images/breadcrumbs.png)

### Footer

Bu alan <a href="https://vuetifyjs.com/en/components/footers/" target="_blank">VFooter</a> bileşeni içinde bazı kurumsal bilgilerin gösterilmesini sağlayan altbilgi alanıdır.

![SideBar](/images/footer.png)


### Messages

Bu bileşen vuetify <a href="https://vuetifyjs.com/en/components/snackbars/#usage" target="_blank">v-snackbar</a> bileşenini kullanarak <b>info, error, warning, success</b> gibi özel durum mesajlarını göstermek için kullanılır.

![Messages](/images/success.png)


## Listeleme

List bileşeni veri tablosuna ait ayarlar, filtreler ve üst seçeneklerin görüntülenmesini sağlar.

### DataTableServer

Vuetify <a href="https://vuetifyjs.com/en/components/data-tables/server-side-tables/#examples" target="_blank">v-data-table-server</a> bileşenini kullanarak ızgara yapısına uyan bir listenin sayfalanması için kullanılır. Sıralama, arama, sayfalandırma, filtreleme ve seçim gibi özellikleri içerir. Varsayılan slot içinde liste düzeni tamamen özelleştirilebilir.

![Advanced Filters](/images/advanced-filters.png)

### DataIteratorServer

Vuetify <a href="https://vuetifyjs.com/en/components/data-iterators/#usage" target="_blank">v-data-iterator</a> bileşenini kullanarak ızgara yapısına uymayan veya özelleştirilmesi gereken verileri görüntülemek için kullanılır ve işlevsellik yönünden <b>va-data-table-server</b> bileşenine benzer. Sıralama, arama, sayfalandırma, filtreleme ve seçim gibi özellikleri de içerir. Varsayılan slot içindeki liste düzeni tamamen özelleştirilebilir.

![Data Iterator Server](/images/data-iterator-server.png)

## Girdiler

Girdi bileşenleri, mevcut API kaynak nesnesinin belirli özelliklerinin düzenlenmesine olanak tanır. Temel olarak görünüm oluşturmak ve düzenlemek için <a href="/ui/form.html" target="_blank">form</a>'larda kullanılır. 

### ArrayTableInput

Tablo biçiminde dizi olarak birden fazla veri girişine izin verir. Yeni veri ekleme, silme ve veri güncellemeyi destekler.
 
![ArrayTableInput](/images/array-table-input.png)

### AutoCompleteInput

Aranabilir seçenekler arasından değer veya değerler seçimi sağlar. Çoklu seçim ve referansları destekler. API servisinizden bağlantılı kaynakların aranmasına izin verir.

![AutoCompleteInput](/images/autocomplete-input.png)

### AvatarInput

Kesme ve küçültme seçenekleri ile kullanıcıya ait bir profil resminin oluşturulmasını kolaylaştırır.

![AvatarInput](/images/avatar-input.png)

### BooleanInput

Boolean girdi türüne değer <b>boolean</b> ya da <b>0/1</b> olarak gönderildiğinde girdi bir toggle düğme olarak gösterilir.

![BooleanInput](/images/boolean-input.png)

### CheckListInput

Birinci seviyede alt alta gruplanmış checkbox input bileşenlerinin birlikte oluşturulmasını sağlar. Açılıp kapanma (toggle) özelliği, tüm girdilerin bir üst checkbox ile seçilebilmesi ve liste içinde arama gibi özellikler varsayılan olarak desteklenir.

![CheckListInput](/images/checklist-input.png)

### ColorPickerInput

HEX renk kodlarının seçilmesini kolaylaştıran bileşeni oluşturur.

![ColorPickerInput](/images/color-picker-input.png)

### CurrencyInput

<a href="https://www.npmjs.com/package/vue-currency-input" target="_blank">vue-currency-input</a> bileşenini kullanarak kendisine gönderilen para birimini istenilen formata göre görüntüler.

![CurrencyInput](/images/currency-input.png)

### DateInput

Tarih türü değerini düzenlemek için kullanılır. Vuetify tarih seçiciyle ilişkili salt okunur bir metin alanından oluşur. Zamanı değerini desteklemez, bu durum için klasik VaTextInput'u kullanın.

![DateInput](/images/date-input.png)

### FileInput

Tek satır halinde dosya yüklemelerine izin verir. Bir veya birden fazla yüklemelerin her ikisi de aynı anda desteklenir. Yüklenen dosyaların önizlemesini göstermek için <b>VaFileField</b> veya <b>VaImageField</b>'ı bu elementle birlikte kullanın.

![FileInput](/images/file-input2.png)

### NumberInput

Sayı düzenleme için optimize edilmiştir. Min, max ve step özelliklerini destekler.

![NumberInput](/images/number-input.png)

### PasswordInput

Şifre alanları için kullanılır. Geçerli giriş için gösterme/gizleme davranışı vardır.

![PasswordInput](/images/password-input.png)

### RadioGroupInput

Bir seçim listesinden değer seçmenizi sağlar. Referansları destekler. Hiçbir seçenek yoksa, varsayılan olarak, <b>src/I18n/locales/tr.json</b> dosyasından kaynak içeren yerelleştirilmiş listeleri alabilir.

![RadioGroupInput](/images/radio-group-input.png)
![RadioGroupInput Horizontal](/images/radio-group-input-hr.png)

### RatingInput

Sayı değerini derecelendirme yıldızları olarak düzenleyin. Yarım artışlar etkinse değer geçerli bir tam sayı veya ondalık sayı olmalıdır. Simgeler, Vuetify ayarlarında $ratingFull, $ratingEmpty ve $ratingHalf aracılığıyla düzenlenebilir.

![RatingInput](/images/rating-input.png)

### RichTextInput

<a href="https://trix-editor.org/" target="_blank">Trix</a> kullanarak bir <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">Wysiwyg</a> HTML editörü oluşturur.

![RichTextInput](/images/rich-text-input.png)

### TinyMceInput

Create a <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">WYSIWYG</a> HTML editor using <a href="https://tiny.cloud/" target="_blank">Tinc MCE</a> GPL license.

![TinyMceInput](/images/tiny-mce-input.png)

### SelectInput

Bir seçim listesinden değer veya değerler seçmenizi sağlar. Çoklu seçimleri ve referansları destekler. Hiçbir seçenek yoksa, varsayılan olarak, <b>src/I18n/locales/tr.json</b> dosyasından kaynak içeren yerelleştirilmiş listeleri alabilir.

![SelectInput](/images/select-input.png)

### SheetInput

Yüksek sayıdaki excel verilerini okuyup cli modunda veritabanına eklemenize olanak sağlayan girdi bileşenidir. İçeri alınan verileri kaydetmek için kendi oluşturduğunuz bir sheet kaydetme şablonu ile kullanılmalıdır.

![SheetInput](/images/sheet-input-list2.png)

### TextInput

Temel metin girişi yoluyla metin değeri türü için metin düzenler. Çok satırlı destek aracılığıyla uzun metinler için textarea modunu destekler. Herhangi bir tarih, tarihsaat veya saat düzenlemesi için kullanılabilir; tarih, tarihsaat-yerel veya saate göre ayarlanan türü kullanın. İşlem tarayıcı desteğine bağlı olacaktır.

![TextInput](/images/text-input.png)

## Diğerleri

Yukarıdaki 3 maddeye de uymayan bileşenler "Diğerleri" başlığı altında burada listelenmiştir.

### LanguageSwitcher

LanguageSwitcher bileşeni kullanıcının varsayılan dil değerini belirlemesini sağlar.

![LanguageSwitcher](/images/switch-locale.png)

