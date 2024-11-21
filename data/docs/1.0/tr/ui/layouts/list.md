
## List

Liste sayfası, sayfalandırma, sıralama, filtreleme, dışa aktarma vb. gibi işlemleri gerçekleştirebileceğiniz temel sayfalardır. Liste seçeneklerini kullanmak için bir <kbd>VaList</kbd> bileşeni ve <kbd>VaDataTableServer</kbd> bileşeni ile sunucu taraflı bir veri tablosunu kolayca oluşturabilirsiniz.

<kbd>/olobase-demo-ui/src/resources/Employees/List.vue</kbd>

```html
<template>
  <va-list
    :filters="filters"
    :fields="fields"
    :items-per-page="10"
    disable-create
    enable-save-dialog
  >
   <va-data-table-server
     row-show
     row-save-dialog
     row-save-dialog-width="1024"
     row-save-dialog-height="600"
     disable-clone
     disable-show
   >
   </va-data-table-server>
  </va-list>
</template>
```

### Sayfa Özelleştirme

Her CRUD sayfası için istediğiniz her şeyi koymakta özgür olduğunuzu ve sağlanan optimize edilmiş bileşenleri kullanmak zorunda olmadığınızı unutmayın. Tüm veri sağlayıcı yöntemleri, her kaynak için özel bir depolama modülünde mevcut olduğundan, verilerinizi getirecek kendi liste bileşenlerinizi oluşturmak o kadar da karmaşık değildir. Veri sağlayıcı mantığından çıkan her türlü özel veriyi getirmeniz gerekiyorsa elbette mevcut global <kbd>$axios</kbd> örneğini kullanabilirsiniz. Bunun için store bölümündeki kullanıma bakın.

## VaList

List bileşeni veri tablosuna ait ayarlar, filtreler ve üst seçeneklerin görüntülenmesini sağlar.

```html
<va-list
  :filters="filters"
  :fields="fields"
  disable-settings
  hide-header
>
  <va-data-table-server></data-va-data-table-server>
</va-list>
```

<b>Seçenekler</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özellik</th>
         <th>Tür</th>
         <th>Açıklama</th>
         <th>Varsayılan</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>Bileşene bir css sınıfı atamanızı sağlar.</td>
         <td><kbd>mb-0</kbd></td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>String</code></td>
         <td>Liste başlığını belirler eğer bu değer boş ise geçerli kaynağın başlığı <kbd>titles.resource</kbd> nesnesi ile çevirilir.</td>
         <td><kbd>null</kbd></td>
      </tr>
      <tr>
         <td><strong>filters</strong></td>
         <td><code>array</code></td>
         <td>Veri sağlayıcınıza <code>filter</code> parametrelerinin içinde gönderilir. Geçerli özellikler şunlardır: <code>source</code>, <code>type</code>, <code>label</code>, <code>attributes</code>.
         </td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>fields</strong></td>
         <td><code>Array</code></td>
         <td>Kaynak verilerinin oluşturabilmesi için gereken sütunların listesi. Her sütun basit bir dize veya gelişmiş alan özelliklerine sahip tam bir nesne olabilir. <kbd>`source`, `type`, `label`, `sortable`, `align`, `link`, `attributes`, `editable`, `width`</kbd>.</td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>hideTitle</strong></td>
         <td><code>Boolean</code></td>
         <td>Liste başlığını görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>hideHeader</strong></td>
         <td><code>boolean</code></td>
         <td>Başlık araç çubuğunu gizler; böylece filtreler ve ayarlar gibi eylemler gizlenmiş olurlar.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>hideBulkDelete</strong></td>
         <td><code>boolean</code></td>
         <td>Seçim listesinden bir kayıt seçildiğinde ortaya çıkan çoklu silme tuşunu görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
     <tr>
         <td><strong>hideBulkCopy</strong></td>
         <td><code>boolean</code></td>
         <td>Seçim listesinden bir kayıt seçildiğinde ortaya çıkan çoklu kopyalama tuşunu görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableSettings</strong></td>
         <td><code>Boolean</code></td>
         <td>Ayarlar tuşunu görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableCreate</strong></td>
         <td><code>Boolean</code></td>
         <td>Standart kayıt etme tuşunu görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowCreate</strong></td>
         <td><code>Boolean</code></td>
         <td>Düzenlenebilir bir tablo kullanıyorsanız ayarlar butonunun yanında Satır Ekle butonunun aktif hale getirmenizi sağlar.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableCreateRedirect</strong></td>
         <td><code>Boolean</code></td>
         <td>Yaratma aksiyonundan sonraki yönlendirme işlemini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableQueryString</strong></td>
         <td><code>boolean</code></td>
         <td>Sayfalandırma, sıralama, filtreleme vb. gibi bir işlemde URL sorgu dizesinin gönderilmesini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>defaultQueryString</strong></td>
         <td><code>object</code></td>
         <td>Kaynak çağırma url adresinizin örneğin; <kbd>/api/example/findAllByPaging</kbd> gibi arka uç adresinizin sonuna varsayılan olarak <kbd>/api/example/findAllByPaging?a=1</kbd> gibi query string ekler. Örnek değer: { id: 4fd4eeac-8ab2-48b9-99e5-fbfd14334ff3 }.</td>
         <td><kbd>{}</kbd></td>
      </tr>
      <tr>
         <td><strong>disableActions</strong></td>
         <td><code>boolean</code></td>
         <td>Tüm aksiyonlara ait bölümü görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableGlobalSearch</strong></td>
         <td><code>boolean</code></td>
         <td>Genel aramayı devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableItemsPerPage</strong></td>
         <td><code>boolean</code></td>
         <td>Arka uca gönderilen perPage parametresini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>globalSearchQuery</strong></td>
         <td><code>string</code></td>
         <td>Genel arama sorgusunun anahtar adını belirler. Varsayılan değeri değiştirmek bazı ön ve arka taraf fonksiyonlarda değişikliği gerektirebilir.</td>
         <td><kbd>q</kbd></td>
      </tr>
      <tr>
         <td><strong>disablePositioning</strong></td>
         <td><code>boolean</code></td>
         <td>Ayarlar panelinde pozisyonlama satırını gizler.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableVisibility</strong></td>
         <td><code>boolean</code></td>
         <td>Ayarlar panelinde görünürlülük satırını gizler.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>enableSaveDialog</strong></td>
         <td><code>boolean</code></td>
         <td>Sağ köşedeki iletişim kutusunda kaydetme özelliği için oluştur düğmesini gösterir/gizler.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>itemsPerPage</strong></td>
         <td><code>array</code></td>
         <td>Sayfa başına mevcut öğe seçimlerinin listesi.</td>
         <td><kbd>10</kbd></td>
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
         <td>Liste içinde görüntülenen tuşların yanına yeni tuşlar eklenebilmesini sağlar.</td>
      </tr>
	  <tr>
         <td><strong>content</strong></td>
         <td>Liste şablonu içerisinde veri tablosu eklemenizi sağlar.</td>
      </tr>
    </tbody>
</table>
</div>

## Data Table Server

<kbd>VaDataTableServer</kbd> ızgara yapısına uyan bir listenin sayfalanması ve herhangi bir kaynak tarama ve listeleme için kullanılır. Sıralama, arama, sayfalandırma, filtreleme ve seçim gibi özellikleri içerir. Varsayılan slot içinde liste düzeni tamamen özelleştirilebilir.

<b>Mixinler</b>

* Resource
* Search

<b>Seçenekler</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özellik</th>
         <th>Tür</th>
         <th>Açıklama</th>
         <th>Varsayılan</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>Data table etrafını saran div elementinin html class niteliğine bir değer atar.</td>
         <td><kbd>va-data-table</kbd></td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>String</code></td>
         <td>Vuetify orjinal <a href="https://vuetifyjs.com/en/components/text-fields/#density" target="_blank">density</a> özelliğini seçmenizi sağlar. Alınabileck değerler: <kbd>default</kbd>, <kbd>comfortable</kbd>, ve <kbd>compact</kbd>.</td>
         <td><kbd>compact</kbd></td>
      </tr>
      <tr>
         <td><strong>rowClick</strong></td>
         <td><code>String</code>, <code>Boolean</code></td>
         <td>Her satırı tıklanabilir hale getirir. Düzenleme veya gösterme olarak önceden tanımlanmış işlevi kullanın.</td>
         <td><kbd>null</kbd></td>
      </tr>
      <tr>
         <td><strong>rowCreate</strong></td>
         <td><code>boolean</code></td>
         <td>Güncellenebilir bir veri tablosu listesi eylemlerinde satır yaratma tuşunu görünür/görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowEdit</strong></td>
         <td><code>boolean</code></td>
         <td>Güncellenebilir bir veri tablosu listesi eylemlerinde satır düzenleme tuşunu görünür/görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowSaveDialog</strong></td>
         <td><code>boolean</code></td>
         <td>Bir veri tablosu listesi eylemlerinde kayıt düzenlemenin/yaratmanın bir pencere içerisinde gerçekleşmesini sağlayan tuşu görünür/görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowSaveDialogWidth</strong></td>
         <td><code>boolean</code></td>
         <td>rowSaveDialog tuşuna ait pencerenin genişliğini ayarlar.</td>
         <td><kbd>1024</kbd></td>
      </tr>
      <tr>
         <td><strong>rowSaveDialogHeight</strong></td>
         <td><code>boolean</code></td>
         <td>rowSaveDialog tuşuna ait pencerenin yüksekliğini ayarlar.</td>
         <td><kbd>600</kbd></td>
      </tr>
      <tr>
         <td><strong>rowClone</strong></td>
         <td><code>boolean</code></td>
         <td>Güncellenebilir bir veri tablosu listesi eylemlerinde satır kopyalama tuşunu görünür/görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowShow</strong></td>
         <td><code>boolean</code></td>
         <td>Güncellenebilir bir veri tablosu listesi eylemlerinde satır detay penceresi açan tuşu görünür/görünmez hale getirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>showExpand</strong></td>
         <td><code>boolean</code></td>
         <td>Hızlı ayrıntılı görünüm için satır genişletme modunu etkinleştirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>expandOnClick</strong></td>
         <td><code>boolean</code></td>
         <td>Tablo satırlarına tıklanıldığında satırın genişletilir olmasını sağlar.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>groupBy</strong></td>
         <td><code>array</code></td>
         <td>Vuetify orjinal <a href="https://vuetifyjs.com/en/components/data-tables/basics/#group-header-slot" target="_blank">groupBy</a> fonksiyonunu kullanarak tablo verilerini klasörler. Birden fazla değer alabilir.</td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>visible</strong></td>
         <td><code>boolean</code></td>
         <td>Veri tablosunun görünürlüğünü kontrol eder.</td>
         <td><kbd>true</kbd></td>
      </tr>
      <tr>
         <td><strong>disableSelect</strong></td>
         <td><code>boolean</code></td>
         <td>Hepsini seç seçim listesini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>selectStrategy</strong></td>
         <td><code>boolean</code></td>
         <td>Listedeki öğeleri seçme stratejisini tanımlar. Olası değerler: <kbd>single</kbd>, <kbd>page</kbd>, <kbd>all</kbd>.</td>
         <td><kbd>page</kbd></td>
      </tr>
      <tr>
         <td><strong>disableSort</strong></td>
         <td><code>boolean</code></td>
         <td>Liste sıralama fonksiyonunu devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableShow</strong></td>
         <td><code>boolean</code></td>
         <td>Standart detay aksiyonuna ait tuşu devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableEdit</strong></td>
         <td><code>boolean</code></td>
         <td>Standart kayıt düzenleme aksiyonuna ait tuşu devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableClone</strong></td>
         <td><code>boolean</code></td>
         <td>Standart kayıt kopyalama aksiyonuna ait tuşu devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableDelete</strong></td>
         <td><code>boolean</code></td>
         <td>Standart kayıt silme aksiyonuna ait tuşu devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableCreateRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Standart yaratma aksiyonundan sonraki yönlendirme işlemini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableShowRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Standart detay aksiyonundan sonraki yönlendirme işlemini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableEditRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Standart güncelleme aksiyonundan sonraki yönlendirme işlemini devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>enableDeleteRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Standart silme aksiyonundan sonraki yönlendirme işlemini etkinleştirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>multiSort</strong></td>
         <td><code>boolean</code></td>
         <td>Varsayılan olarak etkin olan çoklu sıralama özelliğini etkinleştirir/devre dışı bırakır.</td>
         <td><kbd>true</kbd></td>
      </tr>
      <tr>
         <td><strong>disableGenerateUid</strong></td>
         <td><code>boolean</code></td>
         <td>Güncellenebilir bir veri tablosu listesi kayıt eyleminde <a href="https://guidgenerator.com/" target="_blank">Uid</a> oluşturmayı devre dışı bırakır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>itemsPerPageOptions</strong></td>
         <td><code>array</code></td>
         <td>Sayfa başına mevcut öğe seçimlerinin listesi</td>
         <td><kbd>[5, 10, 15, 20, 25, 50, 100]</kbd></td>
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
         <td><strong>cell.actions</strong></td>
         <td>Veri tablosu standart aksiyonlar bölümü içinde görüntülenen tuşların yanına yeni tuşlar eklenebilmesini sağlar.</td>
      </tr>
      <tr>
         <td><strong>row.actions</strong></td>
         <td>Güncelenebilir veri tablosunda aksiyonlar bölümü içinde görüntülenen tuşların yanına yeni tuşlar eklenebilmesini sağlar.</td>
      </tr>
	  <tr>
         <td><strong>no-data</strong></td>
         <td>Herhangi veri bulunamadığında görüntülenen bölümü özelleştirmenizi sağlar.</td>
      </tr>
    </tbody>
</table>
</div>

<b>Olaylar</b>

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
         <td><strong>update:options</strong></td>
         <td>Sayfalandırma değişikliğinde tetiklenir.</td>
      </tr>
      <tr>
         <td><strong>update:filter</strong></td>
         <td>Filtreleme değişiminde tetiklenir.</td>
      </tr>
      <tr>
         <td><strong>selected</strong></td>
         <td>Seçim listesinden kayıt seçildiğinde tetiklenir. Bu olay, dizi türünde kayıt edilir.</td>
      </tr>
      <tr>
         <td><strong>item-action</strong></td>
         <td>Belirli bir satırdaki eylemde tetiklenir. Bu olay, API'nizden yenilenmiş bir nesne döndürecektir.</td>
      </tr>
      <tr>
         <td><strong>save</strong></td>
         <td>Güncellenebilir listede kayıt etme aşamasından önce tetiklenir.</td>
      </tr>
      <tr>
         <td><strong>saved</strong></td>
         <td>Güncellenebilir listede kayıt etme aşamasından sonra tetiklenir.</td>
      </tr>
    </tbody>
</table>
</div>

### Sütunlar

Tüm sütunları tanımlamak için <kbd>fields</kbd> niteliğini kullanın. En azından getirmek istediğiniz kaynak alanını tanımlayan kaynak özelliğini, ardından basit metin formatından farklıysa veri formatlayıcının türünü ayarlamanız gerekir. Desteklenen tüm alanlar için <a href="/ui/fields.html">fields</a> bölümünü kontrol edin.

<kbd>/olobase-demo-ui/src/resources/Employees/List.vue</kbd>

<tab>
<title>Template|Script</title>
<content>

```html
<template>
  <va-list
    disable-create
    enable-save-dialog
   :filters="filters"
   :fields="fields"
   :items-per-page="10"  
  >
   <va-data-table-server
     row-show
     row-save-dialog
     row-save-dialog-width="1024"
     row-save-dialog-height="600"
     disable-clone
     disable-show
   >
   </va-data-table-server>
  </va-list>
</template>
```
<tcol>

```js
<script>
import { required } from "@vuelidate/validators";

export default {
  props: ["resource", "title"],
  provide() {
    return {
      validations: {
        form: {
          companyId: {
            required
          },
          employeeNumber: {
            required
          },
          name: {
            required
          },
          surname: {
            required
          },
        }
      },
      errors: {
        companyIdErrors: (v$) => {
          const errors = [];
          if (!v$['form'].companyId.$dirty) return errors;
          v$['form'].companyId.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        employeeNumberErrors: (v$) => {
          const errors = [];
          if (!v$['form'].employeeNumber.$dirty) return errors;
          v$['form'].employeeNumber.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        nameErrors: (v$) => {
          const errors = [];
          if (!v$['form'].name.$dirty) return errors;
          v$['form'].name.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        },
        surnameErrors: (v$) => {
          const errors = [];
          if (!v$['form'].surname.$dirty) return errors;
          v$['form'].surname.required.$invalid &&
            errors.push(this.$t("v.text.required"));
          return errors;
        }
      }
    };
  },
  data() {
    return {
      loading: false,
      yearId: new Date().getFullYear(),
      filters: [
        {
          source: "companyId",
          type: "select",
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "companies",
          }
        },
        {
          source: "jobTitleId",
          type: "select",
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "jobtitles",
          }
        },
        {
          source: "gradeId",
          type: "select",
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "employeegrades",
          }
        },
      ],
      fields: [
        {
          source: "companyId",
          type: "select",
          attributes: {
            reference: "companies",
          },
          sortable: true,
          width: "10%"
        },
        {
          source: "employeeNumber",
          sortable: true,
          width: "10%"
        },
        {
          source: "name",
          sortable: true,
          width: "10%"
        },
        {
          source: "surname",
          sortable: true,
          width: "10%"
        },
        {
          source: "jobTitleId",
          type: "select",
          attributes: {
            reference: "jobtitles",
          },
          sortable: true,
          width: "20%"
        },
        {
          source: "gradeId",
          type: "select",
          attributes: {
            reference: "employeegrades",
          },
          sortable: true,
          width: "10%"
        },
      ],
    };
  }
};
</script>
```

</content>
</tab>

<b>Alan Nitelikleri</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Nitelik</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Görüntülenecek kaynağın anahtar adı.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>Kullanılacak <a href="/ui/fields.html">field</a> türü.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Sütun başlığı başlığı, varsayılan olarak <a href="/ui/i18n.html">yerelleştirilmiş özellik kaynağını</a> kullanın.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan kaynağı i18n anahtar mesajı olarak geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>sortable</strong></td>
         <td><code>boolean</code></td>
         <td>Sunucu tarafı sıralamayı etkinleştirir.</td>
      </tr>
      <tr>
         <td><strong>align</strong></td>
         <td><code>string</code></td>
         <td>Her hücrenin <code>align</code> özelliği için <kbd>left</kbd>, <kbd>right</kbd>, <kbd>center</kbd>'ı kullanabilirsiniz.</td>
      </tr>
      <tr>
         <td><strong>link</strong></td>
         <td><code>string</code></td>
         <td>Alanı kaynak eylemi bağlantısının içine sarmak istiyorsanız geçerli herhangi bir <code>göster</code> veya <code>düzenle</code> eylemini kullanın.</td>
      </tr>
      <tr>
         <td><strong>input</strong></td>
         <td><code>string</code></td>
         <td>Düzenlenebilir form satırları için kullanılacak <a href="/ui/inputs.html" class="">input</a> türü. Varsayılan olarak kullanılan <kbd>type</kbd> değerini geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>attributes</strong></td>
         <td><code>object</code></td>
         <td>Alt alan veya giriş bileşeniyle birleştirilecek tüm öznitelikler veya nitelikler.</td>
      </tr>
      <tr>
         <td><strong>editable</strong></td>
         <td><code>boolean</code></td>
         <td>Alanı canlı düzenleme giriş alanı ile değiştirin. Hızlı canlı güncellemeler için idealdir.</td>
      </tr>
   </tbody>
</table>
</div>

### Özel Satır Aksiyonları

<b>row.actions</b> slotu kullanılarak satır aksiyonları özelleştirebilir. Takip eden örnekte yazılımcılara ait bir veri tablosunda özel bir silme tuşu <kbd>developerId</kbd> parametresi ile <b>delete-developer</b> adlı bir rotaya yönlendiriliyor. 

![Custom Row Actions](/images/custom-row-actions.png)

```html
<template>
  <div> 
    <va-list 
      disable-settings
      hide-bulk-copy
      :filters="filters"
      :fields="fields"
      :items-per-page="50"
      >
        <va-data-table-server
          disable-show
          disable-clone
          disable-delete
        >
          <template v-slot:row.actions="{ item }">
            <va-action-button
              icon="mdi-delete-forever"
              :color="color || 'red'"
              text
              :to="{ name: 'delete-developer', params: { developerId: item.id  } }"
            ></va-action-button>
          </template>
        </va-data-table-server>
    </va-list>
  </div>
</template>
```

### Alan Şablonlaması

Yukarıdaki tüm alan seçeneklerinin ihtiyaçlarınızı karşılamaması durumunda, her alan için gelişmiş <b>slot</b> şablonlamasını kullanabilirsiniz. Hatta içindeki tüm Olobase Admin alanlarını bile kullanabilirsiniz. Bu alan bileşenini, aşağıda gösterildiği gibi ana bileşenin içine yerleştirmeniz gerektiğinde çok kullanışlıdır:

<tab>
<title>Template|Script</title>
<content>

```html
<template>
  <va-list
    :fields="fields"
  >
    <va-data-table-server
    >
      <template v-slot:[`field.authors`]="{ value }">
        <v-chip-group column>
          <va-reference-field
            reference="authors"
            v-for="(item, i) in value"
            :key="i"
            color="primary"
            small
            chip
            :item="item"
          >
          </va-reference-field>
        </v-chip-group>
      </template>
    </va-data-table-server>
  </va-list>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["resource", "title"],
  data() {
    return {
      fields: [
        //...
        "authors",
        //...
      ],
      //...
    };
  },
  //...
};
</script>
```

</content>
</tab>

Bunun için <kbd>field.{source}</kbd> adında bir slotunu kullanmanız yeterlidir; burada <b>source</b>, alanın adıdır. Bu slot size tam satır kaynak öğesini ve varsayılan olarak işlenecek hücrenin değerini sağlayacaktır.

Bir başka örnek:

<tab>
<title>DataGrid|Template|Script</title>
<content>

![Field Templating](/images/field-labeling.png)

<tcol>

```html
<template>
  <va-list
    :fields="fields"
  >
    <va-data-table-server
    >
      <template v-slot:[`field.orderStatusId`]="{ item }">
        <v-chip 
          label
          :color="getOrderStatusColor(item.orderStatusId)"
          >
          <v-icon icon="mdi-label" start></v-icon>
          {{ $t("resources.orders.chips." + item.orderStatusId) }}
        </v-chip>
      </template>
    </va-data-table-server>
  </va-list>
</template>
```

<tcol>

```js
<script>
export default {
  props: ["resource", "title"],
  methods: {
    getOrderStatusColor(val) {
      if (val == "waiting") {
        return 'orange-darken-1';
      }
      if (val == "canceled") {
        return 'red-darken-1';
      }
      if (val == "completed") {
        return 'green-darken-1';
      }
    },
  }
  //...
};
</script>
```

</content>
</tab>

### Genişletilebilir Satır

Öğe satırının altında ek bir tam <b>colspan</b> hücresi için genişletilmiş öğe özelliğini <kbd>show-expand</kbd> desteğiyle kullanabilirsiniz. Bu yöntem satır verisinin uzun olduğu durumlarda ya da hızlı görüntüleme için kullanılabilir.

![Expanded Table](/images/expanded-table.png)

```html
<template>
  <va-list 
   :filters="filters"
   :fields="fields"
   >
      <va-data-table-server 
         disable-show
        :show-expand="true"
        :expand-on-click="true"
        :disable-actions="false"
      >
        <template v-slot:top>
          <v-toolbar flat>
            <v-toolbar-title>Expandable Table</v-toolbar-title>
          </v-toolbar>
        </template>
        <template v-slot:expanded-row="{ columns, item }">
          <tr>
            <td :colspan="columns.length">
              More info about {{ item.raw.roleName }}
            </td>
          </tr>
        </template>
      </va-data-table-server>
  </va-list>
</template>
```

### Güncellenebilir Satırlar

Güncelenebilir satırları olan bir veri tablosu yaratmak için aşağıdaki nitelikleri <kbd>VaDataTableServer</kbd> bileşeninde kullanmalısınız. Bu nitelikleri kullanılırken standart <kbd>disable-edit</kbd>, <kbd>disable-show</kbd> ve <kbd>disable-clone</kbd> gibi işlemleri pasif hale getirmeniz gerekir.

<b>Güncellenebilir bir tablo aşağıdaki aksiyonları içerebilir:</b>

* row-create
* row-clone
* row-edit
* row-show
* row-delete

![Editable Rows](/images/editable-rows.png)

```html
<template>
  <va-list 
    disable-create
    :fields="fields"
    :items-per-page="50"
  >
    <va-data-table-server
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

### Güncellenebilir Etkileşimli Satırlar

Bir seçim alanını seçtikten sonra başka bir seçim alanının etkileşimli olarak değişmesini istiyorsanız, aşağıdaki örnekte yer alan koda göz atın.

![Editable Interactive Rows](/images/editable-interactive-rows.png)

```js [line-numbers] data-line="22,23"
<script>
export default {
  props: ["resource", "title"],
  data() {
    return {
      fields: [
        {
          source: "companyId",
          type: "select",
          attributes: {
            reference: "companies",
          },
          sortable: true,
          width: "15%"
        },
        {
          source: "departmentId",
          type: "select",
          attributes: {
            reference: "departments",
          },
          key: "companyId",
          filters: ["companyId"],
          sortable: true,
          width: "15%"
        },
      ],
    };
  }
};
</script>
```

> Daha kapsamlı bir örneği <b>demo</b> uygulaması içinde yer alan <kbd>/resources/Employees/List.vue</kbd> dosyasında bulabilirsiniz.

### Dialog İçerisinde Kayıt

Eğer veri listesinde sıralanan her bir kayıt için güncelleme işleminin yeni bir pencere içerisinde yapılmasını istiyorsanız aşağıdaki nitelikleri kullanmalısınız.

![Save Dialog Action](/images/save-dialog-action.png)

* rowSaveDialog
* rowSaveDialogWidth
* rowSaveDialogHeight

![Save Dialog Action](/images/save-dialog.png)

<kbd>/va-demo/src/resources/Employees/List.vue</kbd>

```html
<template>
  <va-list
    disable-create
    enable-save-dialog
   :filters="filters"
   :fields="fields"
   :items-per-page="10"
  >
   <va-data-table-server
     row-show
     row-save-dialog
     row-save-dialog-width="1024"
     row-save-dialog-height="600"
     disable-clone
     disable-show
   >
   </va-data-table-server>
  </va-list>
</template>
```

## Data Iterator Server

<kbd>VaDataIteratorServer</kbd> bileşeni, ızgara yapısına uymayan veya özelleştirilmesi gereken verileri görüntülemek için kullanılır ve işlevsellik yönünden v-data-table bileşenine benzer. Sıralama, arama, sayfalandırma, filtreleme ve seçim gibi özellikleri içerir. Varsayılan slot içindeki liste düzeni tamamen özelleştirilebilir.

<b>Mixinler:</b>

* Resource
* Search

![Data Iterator Server](/images/data-iterator-server.png)

<tab>
<title>Template|Script</title>
<content>

```html
<template>
  <va-list
    :filters="filters"
    :fields="fields"
    disable-create
    disable-positioning
    disable-visibility
    :items-per-page="2"
  >
    <va-data-iterator-server
      :pagination="{ 
        density: 'default',
        activeColor: 'primary',
        top: false,
        bottom: true,
        rounded: 'pill',
      }"
    >
      <template v-slot:default="{ items }">
        <v-row no-gutters class="bordered pt-1 pb-1 justify-center" v-if="$store.state.api.loading">
          <v-progress-circular
            color="primary"
            indeterminate
          ></v-progress-circular>
        </v-row>
        <v-row no-gutters v-else>
          <v-col
            v-for="(item, i) in items"
            :key="i"
            cols="12"
            sm="6"
            xl="3"
            class="mb-3"
          >
            <v-sheet border rounded :class="(isOdd(i)) ? '' : 'mr-5'">
              <v-list-item
                :title="item.raw.username"
                :subtitle="item.raw.id"
                lines="two"
                density="comfortable"
              >
                <template v-slot:title>
                  <strong class="text-h6">
                    {{ item.raw.username }}
                  </strong>
                </template>
              </v-list-item>
              <v-table density="compact" class="text-caption">
                <tbody>
                  <tr align="right">
                    <th width="20%">{{ $t("resources.failedlogins.fields.attemptedAt") }}:</th>
                    <td>{{ item.raw.attemptedAt }}</td>
                  </tr>
                  <tr align="right">
                    <th>{{ $t("resources.failedlogins.fields.ip") }}:</th>
                    <td>{{ item.raw.ip }}</td>
                  </tr>
                  <tr align="right">
                    <th>{{ $t("resources.failedlogins.fields.userAgent") }}:</th>
                    <td>{{ item.raw.userAgent }}</td>
                  </tr>
                </tbody>
              </v-table>
            </v-sheet>
          </v-col>
        </v-row>              
      </template>
      <template v-slot:bottom.pagination.header="{ page, pageCount }">
        <v-footer class="text-body-3 mt-6 mb-2" style="padding:0;">
          <div>{{ $t("dataiterator.displaying_page", {page, pageCount}) }}</div>
        </v-footer>
      </template>
      <template v-slot:no-data>
        <v-row no-gutters class="bordered pt-1 pb-1 justify-center" v-if="$store.state.api.loading">
          <v-progress-circular
            color="primary"
            indeterminate
          ></v-progress-circular>
        </v-row>
        <v-row no-gutters class="bordered pt-2 pb-2 justify-center" v-else>
          {{ $t("va.datatable.nodata")}}
        </v-row>
      </template>
    </va-data-iterator-server>
  </va-list>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["resource", "title"],
  data() {
    return {
      filters: [
        {
          source: "username",
          type: "select",
          attributes: {
            reference: "failedloginusernames",
            multiple: true,  
          }
        },
        {
          source: "ip",
          type: "select",
          attributes: {
            reference: "failedloginips",
            multiple: true,  
          }
        },
        {
          source: "attemptedAtStart",
          type: "date",
        },
        {
          source: "attemptedAtEnd",
          type: "date",
        }
      ],
      fields: [
        {
          source: "username",
          type: "text",
          sortable: true,
          width: "10%"
        },
        {
          source: "attemptedAt",
          type: "date",
          sortable: true,
          width: "10%"
        },
        {
          source: "userAgent",
          sortable: true,
          width: "10%"
        },
        {
          source: "ip",
          sortable: true,
          width: "10%"
        },
      ],
    };
  },
  methods: {
    isOdd(number) {
      return (number & 1) === 1;
    }
  }
};
</script>
```

</content>
</tab>

<b>Seçenekler</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Özellik</th>
         <th>Tür</th>
         <th>Açıklama</th>
         <th>Varsayılan</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>Data table etrafını saran div elementinin html class niteliğine bir değer atar.</td>
         <td><kbd>va-data-table</kbd></td>
      </tr>
      <tr>
         <td><strong>pagination</strong></td>
         <td><code>object</code></td>
         <td>Sayfalama bileşenlerine ait özelleştiribilen değişkenlerini kontrol eder. <b>Top</b> ve <b>bottom</b> seçenekleri <b>true</b> olduğunda hem altta hem de üst bölümde sayfalama görüntülenebilir.
         </td>
         <td><kbd>{ 
              density: 'default',
              activeColor: 'primary',
              top: false,
              bottom: true,
              rounded: 'pill',
            }</kbd></td>
      </tr>
      <tr>
         <td><strong>showExpand</strong></td>
         <td><code>boolean</code></td>
         <td>Hızlı ayrıntılı görünüm için satır genişletme modunu etkinleştirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>expandOnClick</strong></td>
         <td><code>boolean</code></td>
         <td>Tablo satırlarına tıklanıldığında satırın genişletilir olmasını sağlar.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>groupBy</strong></td>
         <td><code>array</code></td>
         <td>Vuetify orjinal <a href="https://vuetifyjs.com/en/components/data-tables/basics/#group-header-slot" target="_blank">groupBy</a> fonksiyonunu kullanarak tablo verilerini klasörler. Birden fazla değer alabilir.</td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>selectStrategy</strong></td>
         <td><code>boolean</code></td>
         <td>Listedeki öğeleri seçme stratejisini tanımlar. Olası değerler: <kbd>single</kbd>, <kbd>page</kbd>, <kbd>all</kbd>.</td>
         <td><kbd>page</kbd></td>
      </tr>
      <tr>
         <td><strong>returnObject</strong></td>
         <td><code>boolean</code></td>
         <td>Öğe değeriyle belirtilen değer yerine doğrudan nesneyi döndürmek için seçim davranışını değiştirir.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>mustSort</strong></td>
         <td><code>boolean</code></td>
         <td>Değer true ise sıralama devre dışı bırakılamaz, her zaman artan ve azalan arasında geçiş yapılır.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>multiSort</strong></td>
         <td><code>boolean</code></td>
         <td>Varsayılan olarak etkin olan çoklu sıralama özelliğini etkinleştirir/devre dışı bırakır.</td>
         <td><kbd>true</kbd></td>
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
         <td><strong>top.pagination.header</strong></td>
         <td>Üst sayfalamanın üst kısmının özelleştirilmesini sağlar.</td>
      </tr>
      <tr>
         <td><strong>top.pagination.footer</strong></td>
         <td>Üst sayfalamanın alt kısmının özelleştirilmesini sağlar.</td>
      </tr>
      <tr>
         <td><strong>bottom.pagination.header</strong></td>
         <td>Alt sayfalamanın üst kısmının özelleştirilmesini sağlar.</td>
      </tr>
      <tr>
         <td><strong>bottom.pagination.footer</strong></td>
         <td>Alt sayfalamanın alt kısmının özelleştirilmesini sağlar.</td>
      </tr>
      <tr>
         <td><strong>no-data</strong></td>
         <td>Herhangi veri bulunamadığında görüntülenen bölümü özelleştirmenizi sağlar</td>
      </tr>
    </tbody>
</table>
</div>

### Arama

Genel arama filtresi varsayılan olarak etkin olacaktır. Bunu devre dışı bırakmak için, <kbd>disableGlobalSearch</kbd> özelliğini kullanın. Bu filtre, varsayılan olarak <kbd>q</kbd> olan ve <kbd>globalSearchQuery</kbd> değişkeninde yapılandırılan anahtar aracılığıyla arka uca arama sorgusunu gönderecektir. Daha sonra <b>SQL</b> işleme için arka uç tarafında, örneğin çok sütunlu <b>LIKE</b> aramasını ilgili model <kbd>Olobase\Mezzio\ColumnFilters</kbd> sınıfı sayesinde otomatik olarak yapılacaktır.

![Search](/images/search.png)

<tab>
<title>Template|Script|Model</title>
<content>

```html
<template>
  <va-list 
  :fields="fields"
  :filters="filters"
  >
    <va-data-table-server 
       disable-show
      :disable-actions="false"
    >
    </va-data-table-server>
  </va-list>
</template>
```
<tcol>

```js
<script>
export default {
  props: ["resource"],
  data() {
    return {
      filters: [],
      fields: [
        {
          source: "roleName",
          sortable: true,
        },
        {
          source: "roleKey",
          sortable: true,
        },
        {
          source: "roleLevel",          
          sortable: true,
        },
      ],
    };
  }
};
</script>
```
<tcol>

```php
<?php
namespace App\Model;

use Exception;
use Olobase\Mezzio\ColumnFiltersInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Expression;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Cache\Storage\StorageInterface;
use Laminas\Db\TableGateway\TableGatewayInterface;

class RoleModel
{
    private $conn;
    private $roles;
    private $rolePermissions;
    private $cache;
    private $adapter;
    private $columnFilters;

    public function __construct(
        TableGatewayInterface $roles,
        TableGatewayInterface $rolePermissions,
        StorageInterface $cache,
        ColumnFiltersInterface $columnFilters
    )
    {
        $this->roles = $roles;
        $this->rolePermissions = $rolePermissions;
        $this->cache = $cache;
        $this->adapter = $roles->getAdapter();
        $this->columnFilters = $columnFilters;
        $this->conn = $this->adapter->getDriver()->getConnection();
    }

    public function findAllBySelect()
    {
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->columns([
            'id' => 'roleId',
            'roleKey',
            'roleName',
            'roleLevel',
        ]);
        $select->from(['r' => 'roles']);
        return $select;
    }

    public function findAllByPaging(array $get)
    {
        $select = $this->findAllBySelect();
        $this->columnFilters->clear();
        $this->columnFilters->setColumns([
            'roleKey',
            'roleName',
            'roleLevel',
        ]);
        $this->columnFilters->setData($get);
        $this->columnFilters->setSelect($select);

        if ($this->columnFilters->searchDataIsNotEmpty()) {
            $nest = $select->where->nest();
            foreach ($this->columnFilters->getSearchData() as $col => $words) {
                $nest = $nest->or->nest();
                foreach ($words as $str) {
                    $nest->or->like(new Expression($col), '%'.$str.'%');
                }
                $nest = $nest->unnest();
            }
            $nest->unnest();
        }
        if ($this->columnFilters->orderDataIsNotEmpty()) {
            foreach ($this->columnFilters->getOrderData() as $order) {
                $select->order(new Expression($order));
            }
        }
        // echo $select->getSqlString($this->adapter->getPlatform());
        // die;
        $paginatorAdapter = new DbSelect(
            $select,
            $this->adapter
        );
        $paginator = new Paginator($paginatorAdapter);
        return $paginator;
    }
}
```

</content>
</tab>

Varsayılan olarak gözüken filtrelere ek olarak, kullanıcının kullanıcı arayüzü aracılığıyla değiştiremeyeceği bazı dahili filtrelere de ihtiyacınız olabilir. Bunun için <b>filter</b> özelliğini kullanın. Bu, veri sağlayıcınıza otomatik olarak gönderilecek ve diğer etkin filtrelerle birleştirilecek basit bir <b>key/value</b> nesnesidir.

## Filtreler

Eklediğiniz tüm filtereler varsayılan olarak aktifdir. Aktif olan bu filterler ve sütunlar ayarlar tabında kullanıcı tarafından göster/gizle eylemleri ile özelleşririlebilir. Küresel aramaya ek olarak <kbd>VaDataTableServer</kbd>, burada gösterildiği gibi birçok desteklenen girişle birlikte gelişmiş özel filtreleri de destekler:

![Filters](/images/advanced-filters.png)

Filtreleme için desteklenen girişler aşağıdaki gibidir: 

* text
* number
* boolean
* date
* rating
* select (varsayılan olarak nesneye döner)
* autocompleter

Yeni filtreler tanımlamak için filtre özelliklerini kullanın. Bu gelişmiş filtrelerin kod örneği kullanımını burada bulabilirsiniz:

```js
<script>
export default {
  props: ["resource", "title"],
  data() {
    return {
      loading: false,
      yearId: new Date().getFullYear(),
      filters: [
        {
          source: "companyId",
          type: "select",
          col: 2,
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "companies",
          }
        },
        {
          source: "jobTitleId",
          type: "select",
          col: 2,
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "jobtitles",
          }
        },
        {
          source: "gradeId",
          type: "select",
          returnObject: false, // sends ids as array
          col: 3,
          attributes: {
            optionText: "name",
            multiple: true,
            reference: "employeegrades",
          }
        },
      ],
    };
  }
};
</script>
```

Giriş türü için esas olarak zorunlu kaynak özelliğinin yanı sıra türü de kullanmalısınız. Belirli nitelikleri giriş bileşeniyle birleştirmek için <kbd>attributes</kbd> özelliğini kullanın. 

Desteklenen tüm alan özelliklerine bakın:

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Nitelik</th>
         <th>Tür</th>
         <th>Açıklama</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Görüntülenecek kaynak özelliği.</td>
      </tr>
      <tr>
         <td><strong>col</strong></td>
         <td><code>number</code></td>
         <td>Filtrenin sütün sayısını yani diğer bir deyişle çoklu aygıt duyarlılığına ait genişliğini belirler.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>Kullanılacak <a href="/ui/inputs.html" target="_blank">girdi</a> türü.</td>
      </tr>
      <tr>
         <td><strong>returnObject</strong></td>
         <td><code>boolean</code></td>
         <td>Eğer bu değeri false olarak ayarlarsanız, id değeri/değerleri nesne içerisinde değil dizi içerisinde gönderilir.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Sütun başlığı, varsayılan olarak <a href="/ui/i18n.html" target="_blank">yerelleştirilmiş özellik kaynağını</a> kullanır.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Varsayılan kaynağı i18n anahtar mesajı olarak geçersiz kılar.</td>
      </tr>
      <tr>
         <td><strong>attributes</strong></td>
         <td><code>object</code></td>
         <td><a href="/ui/inputs.html" target="_blank">Giriş bileşeniyle</a> birleştirilecek tüm nitelikler veya özellikleri bu nesne içinde tanımlamalısnız.</td>
      </tr>
   </tbody>
</table>
</div>

### Etkileşimli Filtreler

Eğer bir filtreyi seçtikten sonra diğer bir filtrenin/filtrelerin etkileşimli olarak değişmesini istiyorsanız takip eden örnekteki kodu inceleyelin.

![Interactive Filters](/images/interactive-filters.png)

```js [line-numbers] data-line="25,26"
<script>
export default {
  props: ["resource", "title"],
  data() {
    return {
      filters: [
        {
          source: "yearId",
          type: "select",
          attributes: {
            optionText: "name",
            multiple: false,
            reference: "years",
          },
          label: this.$t("employees.yearId"),
        },
        {
          source: "salaryListId",
          type: "select",
          attributes: {
            optionText: "name",
            multiple: false,
            reference: "salarylists",
          },
          key: "yearId",
          filters: ['yearId'],
          label: this.$t("salaries.salaryListId"),
        },
      ]
    };
  },
};
</script>
```

### İki Tarih Arası Filtreleme

Eğer bir tarih sütununu belirtilen iki tarih sütunu aralığında filtrelemek istiyorsanız sütun adının sonlarına <b>Start</b> ve <b>End</b> önadlarını eklemelisiniz.

![Two Date Filters](/images/two-date-filters.png)

Takip eden örnekte <b>attemptedAt</b> sütun adı için <b>attemptedAtStart</b> ve <b>attemptedAtEnd</b> adlı 2 adet tarih filtresi ekleniyor.

```js [line-numbers] data-line="12,16"
<script>
export default {
  props: ["resource", "title"],
  data() {
    return {
      filters: [
        {
          source: "username",
          type: "text",
        },
        {
          source: "attemptedAtStart",
          type: "date",
        },
        {
          source: "attemptedAtEnd",
          type: "date",
        }
      ],
      fields: [
        {
          source: "username",
          type: "text",
          sortable: true,
          width: "10%"
        },
        {
          source: "attemptedAt",
          type: "date",
          sortable: true,
          width: "10%"
        },
      ],
    };
  },
};
</script>
```

### Evrensel Eylemler

Bu <b>VaList</b> bileşeni, <b>create</b> adında sadece 1 küresel eylemle birlikte gelir. Oluştur düğmesi yalnızca mevcut kaynağın oluşturma eylemi varsa ve kimliği doğrulanmış kullanıcının bu kaynak üzerinde oluşturma izni varsa görünecektir.

![Create](/images/create.png)

<b>Aksiyon Olayları</b>

Varsayılan yönlendirme davranışına uymak zorunda değilsiniz. Bir oluşturma eylemi tercih ederseniz, yalnızca eylem olayına abone olun ve oluşturma tuşunun bağlantılı eylem sayfasına yönlendirmesini önlemek için, <b>disableCreateRedirect</b> özelliği ile yönlendirme oluşturmayı devre dışı bırakın. <b>VaDataTableServer</b>'ın içindeki <b>show</b>, <b>edit</b> ve <b>clone</b> eylemleri için de aynı davranış geçerlidir. Bir Aside veya diyalog içerisinde özel bir davranışa ihtiyacınız varsa, <b>item-action</b> olayını kullanın ve varsayılan yönlendirmeyi devre dışı bırakın. İlgili tuşlar için herhangi bir işlem yapılmaması durumunda tüm bu tuşların otomatik olarak gizleneceğini unutmayın. İlgili eylem yönlendirmelerinin her birinin devre dışı bırakılması, tuşların yeniden görünmesine neden olur.

Bu eylem etkinlikleri size her zaman API'dan yenilenen öğenin yanı sıra uyarlanmış CRUD başlığını da sağlayacaktır.

### Özelleştirilebilir Eylemler

Standart eylemlere ek olarak başka öğe eylemlerine ihtiyacınız varsa, özel <kbd>item.actions</kbd> slotunu kullanın. Güncellenebilir bir veri tablosu için ise <kbd>row.actions</kbd> slotunu kullanmalısınız.

```html [line-numbers] data-line="6"
<template>
  <va-list
   :fields="fields"
  >
    <va-data-table-server>
      <template v-slot:[`item.actions`]="{ resource, item }">
        <va-my-custom-button
          :resource="resource"
          :item="item"
        ></va-my-custom-button>
      </template>
    </va-data-table-server>
  </va-list>
</template>
```

### Toplu Eylemler

Veri listeleme, ister kopyalama ister silme olsun, her türlü toplu işlemi destekler. Bu özellik, veri sağlayıcınızın <b>copyMany</b>, <b>updateMany</b> ve <b>deleteMany</b> yöntemlerini kullanacaktır. Bazı öğeleri seçtiğinizde, mevcut tüm toplu işlemler başlıkta görünecektir.

![Bulk Actions](/images/bulk-actions.png)

### Özelleştirilebilir Toplu Eylemler

Varsayılan olarak Olobase Admin toplu silme eylemi sağlar, ancak <kbd>bulk.actions</kbd> slotlarını ve <b>updateMany</b>'yi kullanacak <b>VaBulkActionButton</b>'u kullanarak gerektiği gibi birden fazla toplu eylem ekleyebilirsiniz. Bu son bileşen, API'nize gönderilecek nesne olacak gerekli bir eylem desteğine ihtiyaç duyar. Bu nesne, toplu güncellemek istediğiniz tüm özellikleri içerecektir. Bir sonraki örnekte size toplu yayınlama/yayından kaldırma toplu işlemlerine ait bir örnek gösterilecektir:

```html [line-numbers] data-line="7"
<template>
  <va-list
   :filters="filters"
   :fields="fields"
   :items-per-page="10"          
  >
    <template v-slot:bulk.actions="{ selected }">
      <va-bulk-action-button
       :label="$t('users.enable')"
       icon="mdi-publish"
       color="success"
       :value="selected"
       :action="{ active: true }"
       text
      ></va-bulk-action-button>
     <va-bulk-action-button
       :label="$t('users.disable')"
       icon="mdi-download"
       color="orange"
       :value="selected"
       :action="{ active: false }"
       text
      ></va-bulk-action-button>
    </template>
    <va-data-table-server
       row-create
       row-show
       row-edit
       disable-clone
       disable-show
       disable-edit
     >
    </va-data-table-server>
  </va-list>
</template>
```