
## Show

The Show page is used to display all the details of a particular resource item using the <b>getOne</b> data provider method. Olobase Admin uses the <b>resource</b> feature and simplifies software development by providing a standard layout as well as many field components. Since the Show page is a standard view page component, there is no real limit to how you can present any advanced <b>detail</b> view you can imagine within this page.

![Show Layout](/images/show.png)

### Show Layout

<b>VaShowLayout</b> is the page layout created to display resource details. It is the best place to use any Olobase Admin fields when heavy use is required.

<b>Mixins</b>

* Resource

<b>Properties</b>

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
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Optional h1 heading to the left of the header.</td>
      </tr>
      <tr>
         <td><strong>disableCard</strong></td>
         <td><code>boolean</code></td>
         <td>Closes/opens v-card wrapper.</td>
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
         <td><strong>default</strong></td>
         <td>Placeholder for page content.</td>
      </tr>
   </tbody>
</table>
</div>

### Row Show

If your detail data in the list is not very detailed and you want these details to be displayed quickly, you can use the feature called <kbd>row-show</kbd>.

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

### Tabbed layout

Since you have complete freedom over the layout, you can create a tabbed detail page using any vuetify or custom component. Check out the example below.

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

### Injector

The following example shows the component injector that facilitates resource visualization using Olobase Admin component fields. Inject this element for each Olobase Admin field.

```js
<script>
export default {
  props: ["id", "item"],
}
</script>
```

<b>Properties</b>

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
         <td><strong>item</strong></td>
         <td><code>object</code></td>
         <td>The element resource object where all properties must be added to Olobase Admin layouts.</td>
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
         <td><strong>default</strong></td>
         <td>All content is rendered with all internal fields. The element is recorded in each field.</td>
      </tr>
   </tbody>
</table>
</div>

As you might guess, VaShow's main role is to inject the full element resource object into each Olobase Admin component, resulting in minimal standard code. The Olobase Admin layout will then be able to capture the value of the resource property specified in the resource property.

### Field Wrapper

Wrapper component for domain supporting tag localization and supported Olobase Admin layout, mainly used for detail page. Use the default slot for special needs or use the <b>type</b> attribute for quick use of the currently available Olobase Admin component. All other attributes of this component will be combined with the subslot.

<b>Mixins</b>

* Resource

<b>Properties</b>

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
         <td>The property of the resource to fetch the value to display. Supports dot representation for hierarchical object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <b>VaShow</b>.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Overrides the default tag behavior. The default is to get the localized Vue I18n tag from both source and source.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Overrides the default source key as the translated label.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>The type of field to use. Not used if you are using the default slot for advanced special needs.</td>
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
         <td><strong>default</strong></td>
         <td>Field slot. By default it uses the field component based on <code>type</code> attributes with all other attributes combined.</td>
      </tr>
   </tbody>
</table>
</div>

If a default slot is not provided, <b>VaField</b> will automatically use a specific Va field component under the hood based on the property type.

Code below:

```html
<template>
  <va-show-layout>
    <va-show :item="item">
      <va-field source="type" type="select" chip></va-field>
    </va-show>
  </va-show-layout>
</template>
```

It is exactly equivalent to this code:

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

Or:

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

You can use this component only for the label and product value provider and do your own customization. Just use the default slot provider which will give you the value and exact item.

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

### Field Components

To see all supported components for view data, go to <a href="/ui/fields.html" target="_blank">fields</a>. If none of them meet your needs, you can also create your own field component.