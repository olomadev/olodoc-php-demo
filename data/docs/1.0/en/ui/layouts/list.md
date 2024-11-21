
## List

A List page; These are the basic pages where you can perform operations such as pagination, sorting, filtering and exporting. You can easily create a server-side data table with a <kbd>VaList</kbd> component and a <kbd>VaDataTableServer</kbd> component to use list options.

<kbd>/olobase-demo-ui/src/resources/Employees/List.vue</kbd>

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

### Page Customization

Note that you are free to put whatever you want for each CRUD page and you do not have to use the optimized components provided. Since all data provider methods are available in a dedicated storage module for each source, it's not that complicated to create your own list components that will fetch your data. You can of course use the existing global <kbd>$axios</kbd> instance if you need to fetch any custom data coming out of the data provider logic. See usage in the store section.

## VaList

The List component allows displaying the settings, filters and parent options of the data table.

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

<b>Options</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Property</th>
         <th>Type</th>
         <th>Description</th>
         <th>Default</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>It allows you to assign a css class to the component.</td>
         <td><kbd>mb-0</kbd></td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>String</code></td>
         <td>It determines the list title. If this value is empty, the title of the current resource is translated with the <kbd>titles.resource</kbd> object.</td>
         <td><kbd>null</kbd></td>
      </tr>
      <tr>
         <td><strong>filters</strong></td>
         <td><code>array</code></td>
         <td>The data is sent to your provider within the <code>filter</code> parameters. Valid attributes are: <code>source</code>, <code>type</code>, <code>label</code>, <code>attributes</code>.
         </td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>fields</strong></td>
         <td><code>Array</code></td>
         <td>A list of columns required to render resource data. Each column can be a simple string or a complete object with advanced field properties. <kbd>`source`, `type`, `label`, `sortable`, `align`, `link`, `attributes`, `editable`, `width`</kbd>.</td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>hideTitle</strong></td>
         <td><code>Boolean</code></td>
         <td>Makes the list title invisible.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>hideHeader</strong></td>
         <td><code>boolean</code></td>
         <td>The title hides the header; so actions such as filters and settings are hidden.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>hideBulkDelete</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the multi-delete button that appears when a record is selected from the selection list invisible.</td>
         <td><kbd>false</kbd></td>
      </tr>
     <tr>
         <td><strong>hideBulkCopy</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the multi-copy button that appears when a record is selected from the selection list invisible.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableSettings</strong></td>
         <td><code>Boolean</code></td>
         <td>Makes the settings button invisible.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableCreate</strong></td>
         <td><code>Boolean</code></td>
         <td>Makes the standard save button invisible.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowCreate</strong></td>
         <td><code>Boolean</code></td>
         <td>If you are using an editable table, it enables you to activate the Add Row button near by settings button.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableCreateRedirect</strong></td>
         <td><code>Boolean</code></td>
         <td>Disables redirection after creation action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableQueryString</strong></td>
         <td><code>boolean</code></td>
         <td>Pagination, sorting, filtering, etc. Disables the sending of the URL query string in an action like.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>defaultQueryString</strong></td>
         <td><code>object</code></td>
         <td>Your resource call url address, for example; By default, it adds a query string such as <kbd>/api/example/findAllByPaging?a=1</kbd> to the end of your backend address, such as <kbd>/api/example/findAllByPaging</kbd>. Example value: { id: 4fd4eeac-8ab2-48b9-99e5-fbfd14334ff3 }</td>
         <td><kbd>{}</kbd></td>
      </tr>
      <tr>
         <td><strong>disableActions</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the section of all actions invisible.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableGlobalSearch</strong></td>
         <td><code>boolean</code></td>
         <td>Disables global search.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableItemsPerPage</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the perPage parameter sent to the backend.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>globalSearchQuery</strong></td>
         <td><code>string</code></td>
         <td>Determines the key name of the general search query. Changing the default value may require changes to some front and backside functions.</td>
         <td><kbd>q</kbd></td>
      </tr>
      <tr>
         <td><strong>disablePositioning</strong></td>
         <td><code>boolean</code></td>
         <td>Hides the positioning row in the settings panel.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableVisibility</strong></td>
         <td><code>boolean</code></td>
         <td>Hides the visibility row in the settings panel.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>enableSaveDialog</strong></td>
         <td><code>boolean</code></td>
         <td>Shows/hides the create button for the save feature in the dialog in the right corner.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>itemsPerPage</strong></td>
         <td><code>array</code></td>
         <td>List of available item selections per page.</td>
         <td><kbd>10</kbd></td>
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
         <td>Allows new buttons to be added next to the buttons displayed in the list.</td>
      </tr>
	  <tr>
         <td><strong>content</strong></td>
         <td>Allows you to add a data table within the list template.</td>
      </tr>
    </tbody>
</table>
</div>

## Data Table Server

<kbd>VaDataTableServer</kbd> is used for pagination of a list that fits the grid structure and for browsing and listing any resources. It includes features such as sorting, search, pagination, filtering and selection. The list layout in the default slot is fully customizable.

<b>Mixins</b>

* Resource
* Search

<b>Options</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Property</th>
         <th>Type</th>
         <th>Description</th>
         <th>Default</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>It assigns a value to the HTML class attribute of the div element surrounding the data table.</td>
         <td><kbd>va-data-table</kbd></td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>String</code></td>
         <td>Vuetify allows you to select the original <a href="https://vuetifyjs.com/en/components/text-fields/#density" target="_blank">density</a> property. Possible values: <kbd>default</kbd>, <kbd>comfortable</kbd>, and <kbd>compact</kbd>.</td>
         <td><kbd>compact</kbd></td>
      </tr>
      <tr>
         <td><strong>rowClick</strong></td>
         <td><code>String</code>, <code>Boolean</code></td>
         <td>Makes each row clickable. Use predefined function as edit or show.</td>
         <td><kbd>null</kbd></td>
      </tr>
      <tr>
         <td><strong>rowCreate</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the row creation button visible/invisible in an updatable data table list actions.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowEdit</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the row edit key visible/invisible in an updatable data table list actions.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowSaveDialog</strong></td>
         <td><code>boolean</code></td>
         <td>Makes visible/invisible the button that allows editing/creating a record in a data table list actions within a window.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowSaveDialogWidth</strong></td>
         <td><code>boolean</code></td>
         <td>Sets the width of the window for the rowSaveDialog button.</td>
         <td><kbd>1024</kbd></td>
      </tr>
      <tr>
         <td><strong>rowSaveDialogHeight</strong></td>
         <td><code>boolean</code></td>
         <td>Sets the height of the window for the rowSaveDialog button.</td>
         <td><kbd>600</kbd></td>
      </tr>
      <tr>
         <td><strong>rowClone</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the row copy button visible/invisible in an updatable data table list actions.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>rowShow</strong></td>
         <td><code>boolean</code></td>
         <td>Makes the button that opens the row detail window visible/invisible in an updatable data table list actions.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>showExpand</strong></td>
         <td><code>boolean</code></td>
         <td>Enables line expansion mode for quick detailed view.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>expandOnClick</strong></td>
         <td><code>boolean</code></td>
         <td>Allows the row to be expanded when the table rows are clicked.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>groupBy</strong></td>
         <td><code>array</code></td>
         <td>Vuetify folders table data using the original <a href="https://vuetifyjs.com/en/components/data-tables/basics/#group-header-slot" target="_blank">groupBy</a> function. It can take more than one value.</td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>visible</strong></td>
         <td><code>boolean</code></td>
         <td>Controls the visibility of the data table.</td>
         <td><kbd>true</kbd></td>
      </tr>
      <tr>
         <td><strong>disableSelect</strong></td>
         <td><code>boolean</code></td>
         <td>Select all disables the selection list.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>selectStrategy</strong></td>
         <td><code>boolean</code></td>
         <td>Defines the strategy for selecting items in the list. Possible values: <kbd>single</kbd>, <kbd>page</kbd>, <kbd>all</kbd>.</td>
         <td><kbd>page</kbd></td>
      </tr>
      <tr>
         <td><strong>disableSort</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the list sorting function.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableShow</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the button for the standard detail action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableEdit</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the button for the standard record editing action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableClone</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the button for the standard record copy action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableDelete</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the button for the standard deregistration action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableCreateRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the redirection process after the standard creation action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableShowRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the redirect action after the standard detail action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>disableEditRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the redirect action after the standard update action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>enableDeleteRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Enables the redirect action after the standard delete action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>multiSort</strong></td>
         <td><code>boolean</code></td>
         <td>Enables/disables the multisorting feature, which is enabled by default.</td>
         <td><kbd>true</kbd></td>
      </tr>
      <tr>
         <td><strong>disableGenerateUid</strong></td>
         <td><code>boolean</code></td>
         <td>Disables <a href="https://guidgenerator.com/" target="_blank">Uid</a> generation in an updatable data table list save action.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>itemsPerPageOptions</strong></td>
         <td><code>array</code></td>
         <td>List of available item selections per page.</td>
         <td><kbd>[5, 10, 15, 20, 25, 50, 100]</kbd></td>
      </tr>
   </tbody>
</table>
</div>

<b>Slots</b>

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
         <td>The data table allows new buttons to be added next to the buttons displayed in the standard actions section.</td>
      </tr>
      <tr>
         <td><strong>row.actions</strong></td>
         <td>It allows new buttons to be added next to the buttons displayed in the actions section in the updatable data table.</td>
      </tr>
	  <tr>
         <td><strong>no-data</strong></td>
         <td>Allows you to customize the section displayed when no data is found.</td>
      </tr>
    </tbody>
</table>
</div>

<b>Events</b>

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
         <td><strong>update:options</strong></td>
         <td>Triggered on pagination change.</td>
      </tr>
      <tr>
         <td><strong>update:filter</strong></td>
         <td>Triggered on filtering change.</td>
      </tr>
      <tr>
         <td><strong>selected</strong></td>
         <td>Triggered when the record is selected from the selection list. This event is recorded in array type.</td>
      </tr>
      <tr>
         <td><strong>item-action</strong></td>
         <td>Triggered on action on a specific row. This event will return a refreshed object from your API.</td>
      </tr>
      <tr>
         <td><strong>save</strong></td>
         <td>Triggered before the save phase in the updatable list.</td>
      </tr>
      <tr>
         <td><strong>saved</strong></td>
         <td>Triggered after saving in the updatable list.</td>
      </tr>
    </tbody>
</table>
</div>


### Columns

Use the <kbd>fields</kbd> attribute to define all columns. You need to at least set the source property that defines the source field you want to fetch, then the type of data formatter if it is different from simple text format. Check <a href="/ui/fields.html">fields</a> for all supported fields.

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

<b>Field Attributes</b>

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Key name of the resource to display.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>The <a href="/ui/fields.html">field</a> type to use.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Column header title, use <a href="/ui/i18n.html">localized attribute source</a> by default.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Overrides default source to i18n key message.</td>
      </tr>
      <tr>
         <td><strong>sortable</strong></td>
         <td><code>boolean</code></td>
         <td>Enables server-side sorting.</td>
      </tr>
      <tr>
         <td><strong>align</strong></td>
         <td><code>string</code></td>
         <td>You can use <kbd>left</kbd>, <kbd>right</kbd>, <kbd>center</kbd> for the <code>align</code> property of each cell.</td>
      </tr>
      <tr>
         <td><strong>link</strong></td>
         <td><code>string</code></td>
         <td>If you want to wrap the field inside the source action link, use any valid <code>show</code> or <code>edit</code> action.</td>
      </tr>
      <tr>
         <td><strong>input</strong></td>
         <td><code>string</code></td>
         <td>The <a href="/ui/inputs.html" class="">input</a> type to use for editable form rows. Overrides the default <kbd>type</kbd>.</td>
      </tr>
      <tr>
         <td><strong>attributes</strong></td>
         <td><code>object</code></td>
         <td>Any attributes or attributes that will be combined with the subdomain or input component.</td>
      </tr>
      <tr>
         <td><strong>editable</strong></td>
         <td><code>boolean</code></td>
         <td>Replace the field with the live edit input field. Ideal for fast live updates.</td>
      </tr>
   </tbody>
</table>
</div>

### Custom Row Actions

Row actions can be customized using the <b>row.actions</b> slot. In the following example, a special delete button in a data table belonging to software developers is directed to a route named <b>delete-developer</b> with the <kbd>developerId</kbd> parameter.

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

### Field Templating

In case all the slot options above do not meet your needs, you can use the advanced <b>slot</b> templating for each slot. You can even use all the Olobase Admin fields in it. This is very useful when you need to place the field component inside the parent component as shown below:

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

To do this, simply use a slot called <kbd>field.{source}</kbd>; where <b>source</b> is the name of the field. This slot will provide you with the full row source element and the value of the cell to render by default.

Another example:

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


### Expandable Row

You can use the extended element property with <kbd>show-expand</kbd> support for an additional full <b>colspan</b> cell below the element row. This method can be used when row data is long or for quick viewing.

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

### Editable Rows

To create a data table with editable rows, you must use the following attributes in the <kbd>VaDataTableServer</kbd> component. When using these attributes, you must disable standard operations such as <kbd>disable-edit</kbd>, <kbd>disable-show</kbd> and <kbd>disable-clone</kbd>.

<b>An editable table may include the following actions:</b>

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

### Editable Interactive Rows

If you want to change another selection field interactively after selecting a selection field, take a look at the code in the example below.

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

> You can find a more comprehensive example in the <b>demo</b> application in <kbd>/resources/Employees/List.vue</kbd> file.

### Save in Dialog

If you want the update process to be done in a new window for each record listed in the data list, you should use the following attributes.

![Save Dialog Action](/images/save-dialog-action.png)

* rowSaveDialog
* rowSaveDialogWidth
* rowSaveDialogHeight

![Save Dialog Action](/images/save-dialog.png)

<kbd>/olobase-demo-ui/src/resources/Employees/List.vue</kbd>

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

The <kbd>VaDataIteratorServer</kbd> component is used to display data that does not fit into the grid structure or needs to be customized and is similar in functionality to the v-data-table component. It includes features such as sorting, search, pagination, filtering and selection. The list layout in the default slot is fully customizable.

<b>Mixins:</b>

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

<b>Options</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Property</th>
         <th>Type</th>
         <th>Description</th>
         <th>Default</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>class</strong></td>
         <td><code>String</code></td>
         <td>It assigns a value to the HTML class attribute of the div element surrounding the data table.</td>
         <td><kbd>va-data-table</kbd></td>
      </tr>
      <tr>
         <td><strong>pagination</strong></td>
         <td><code>object</code></td>
         <td>Controls customizable variables of paging components. When the <b>top</b> and <b>bottom</b> options are <b>true</b>, pagination can be displayed both at the bottom and at the top.
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
         <td>Enables row expansion mode for quick detailed view.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>expandOnClick</strong></td>
         <td><code>boolean</code></td>
         <td>Allows the row to be expanded when the table rows are clicked.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>groupBy</strong></td>
         <td><code>array</code></td>
         <td>Vuetify folders table data using the original <a href="https://vuetifyjs.com/en/components/data-tables/basics/#group-header-slot" target="_blank">groupBy</a> function. It can take more than one value.</td>
         <td><kbd>[]</kbd></td>
      </tr>
      <tr>
         <td><strong>selectStrategy</strong></td>
         <td><code>boolean</code></td>
         <td>Defines the strategy for selecting items in the list. Possible values: <kbd>single</kbd>, <kbd>page</kbd>, <kbd>all</kbd>.</td>
         <td><kbd>page</kbd></td>
      </tr>
      <tr>
         <td><strong>returnObject</strong></td>
         <td><code>boolean</code></td>
         <td>Changes the selection behavior to directly return the object rather than the value specified by the element value.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>mustSort</strong></td>
         <td><code>boolean</code></td>
         <td>If true, sorting cannot be disabled, it will always switch between ascending and descending.</td>
         <td><kbd>false</kbd></td>
      </tr>
      <tr>
         <td><strong>multiSort</strong></td>
         <td><code>boolean</code></td>
         <td>Enables/disables the multisorting feature, which is enabled by default.</td>
         <td><kbd>true</kbd></td>
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
         <td><strong>top.pagination.header</strong></td>
         <td>Allows customization of the top of the parent pagination.</td>
      </tr>
      <tr>
         <td><strong>top.pagination.footer</strong></td>
         <td>Allows customization of the bottom of the parent pagination.</td>
      </tr>
      <tr>
         <td><strong>bottom.pagination.header</strong></td>
         <td>Allows customization of the top of the sub-pagination.</td>
      </tr>
      <tr>
         <td><strong>bottom.pagination.footer</strong></td>
         <td>Allows customization of the bottom part of sub-pagination.</td>
      </tr>
      <tr>
         <td><strong>no-data</strong></td>
         <td>Allows you to customize the section displayed when no data is found.</td>
      </tr>
    </tbody>
</table>
</div>

### Search

The global search filter will be enabled by default. To disable this, use the <kbd>disableGlobalSearch</kbd> property. This filter will send the search query to the backend via the key configured in the <kbd>globalSearchQuery</kbd> variable, which is <kbd>q</kbd> by default. Then, on the backend side for <b>SQL</b> processing, for example, the multi-column <b>LIKE</b> search will be done automatically, thanks to the relevant model <kbd>Olobase\Mezzio\ColumnFilters</kbd> class.

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

In addition to the filters that appear by default, you may also need some built-in filters that the user cannot change through the user interface. Use the <b>filter</b> feature for this. This is a simple <b>key/value</b> object that will be automatically sent to your data provider and combined with other active filters.

## Filters

Any filters you add are active by default. These active filters and columns can be customized by the user with show/hide actions in the settings tab. In addition to global search, <kbd>VaDataTableServer</kbd> also supports advanced custom filters with many supported entries as shown here:

![Filters](/images/advanced-filters.png)

Supported inputs for filtering are as follows:

* text
* number
* boolean
* date
* rating
* select (returns to object as default)
* autocompleter

Use filter properties to define new filters. Here's a code sample usage of these advanced filters:

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

For the input type, you should mainly use the type as well as the mandatory source attribute. Use the <kbd>attributes</kbd> property to combine specific attributes with the input component.

See all supported domain features:

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
         <td><strong>source</strong></td>
         <td><code>string</code></td>
         <td>Source property to display.</td>
      </tr>
      <tr>
         <td><strong>col</strong></td>
         <td><code>number</code></td>
         <td>Determines the number of columns of the filter, i.e. its width for multi-device support.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>The <a href="/ui/inputs.html" target="_blank">input</a> type to use.</td>
      </tr>
      <tr>
         <td><strong>returnObject</strong></td>
         <td><code>boolean</code></td>
         <td>If you set this value to false, the id value(s) are sent in the array, not in the object.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>The column header uses the <a href="/ui/i18n.html" target="_blank">localized attribute source</a> by default.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Overrides the default source to i18n key message.</td>
      </tr>
      <tr>
         <td><strong>attributes</strong></td>
         <td><code>object</code></td>
         <td>You must define any attributes or properties that will be combined with the <a href="/ui/inputs.html" target="_blank">input component</a> within this object.</td>
      </tr>
   </tbody>
</table>
</div>

### Interactive Filters

If you want another filter(s) to change interactively after selecting a filter, take a look at the code in the following example.

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

### Filtering Between Two Date

If you want to filter a date column between two specified date columns, you must add <b>Start</b> and <b>End</b> to the end of the column name.

![Two Date Filters](/images/two-date-filters.png)

In the following example, two date filters named <b>attemptedAtStart</b> and <b>attemptedAtEnd</b> are added for the <b>attemptedAt</b> column name.

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

### Universal Actions

This <b>VaList</b> component comes with only 1 global action called <b>create</b>. The Create button will only appear if the current resource has a create action and the authenticated user has create permission on that resource.

![Create](/images/create.png)

<b>Action Events</b>

You don't have to follow the default redirect behavior. If you prefer a create action, simply subscribe to the action event and disable redirect generation with the <b>disableCreateRedirect</b> property to prevent the create button from redirecting to the linked action page. The same behavior applies to the <b>show</b>, <b>edit</b> and <b>clone</b> actions inside the <b>VaDataTableServer</b>. If you need a custom behavior within an Aside or dialog, use the <b>item-action</b> event and disable the default redirect. Note that all these keys will be automatically hidden if no action is taken for the relevant keys. Disabling each relevant action redirect will force the keys to reappear.

These action events will always provide you with the adapted CRUD header as well as the refreshed element from the API.

### Customizable Actions

If you need other item actions in addition to the standard actions, use the special <kbd>item.actions</kbd> slot. For an updatable data table, you should use the <kbd>row.actions</kbd> slot.

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

### Class Actions

Data listing supports all kinds of bulk operations, whether copying or deleting. This feature will use your data provider's <b>copyMany</b>, <b>updateMany</b> and <b>deleteMany</b> methods. When you select some items, all available bulk actions will appear in the header.

![Bulk Actions](/images/bulk-actions.png)

### Customizable Bulk Actions

By default Olobase Admin provides the bulk delete action, but you can add multiple bulk actions as required using the <b>VaBulkActionButton</b> which will use the <kbd>bulk.actions</kbd> slots and <b>updateMany</b> . This last component needs a necessary action prop that will be the object to send to your API. This object will contain all the properties you want to bulk update. The next example will show you an example of a bulk publish/unpublish bulk action:

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