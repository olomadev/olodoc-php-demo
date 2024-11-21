
## Fields

Olobase Admin field components allow specific and optimized display of specific resource properties. It is mainly designed for use in <b>show</b> and <b>list</b> views. It is used with the <b>source</b> and <b>resource</b> properties required to fetch and display data. Must be used with the <b>VaShow</b> component injector or an explicit <b>item</b> object via the <b>item</b> prop.

> <b>Cell Templating:</b> You can use these Olobase Admin fields as cell templates for <b>VaDataTableServer</b>, this is <a href="/ui/list.html#Field%20Templating" target="_blank" See >section</a>.

### Field Wrapper

Unlike Olobase Admin entries, typed Olobase Admin fields do not contain any tagged <b>wrapper</b>, only a simple inline image formatter. You can use <b>VaField</b> for this. It takes the localized tag and initializes the appropriate field component via prop <b>type</b>, which prevents us from rewriting it to the default slot.

See <a href="/ui/show.html#Field%20Wrapper" target="_blank">more</a> for more details.

### Dot Representation Support

Olobase Admin fields accept dot notation for the <b>source</b> prop. This feature is useful for objects.

```html
<template>
  <va-field source="address.street"></va-field>
  <va-field source="address.postcode"></va-field>
  <va-field source="address.city"></va-field>
</template>
```

## Olobase Admin Fields

In this section, the Olobase Admin field representation components in the <kbd>packages/admin/src/components/ui/fields</kbd> folder will be discussed.

### Text

Displays the value as simple text, creating a simple <b>span</b>. HTML tags are destroyed with the strip function.

<b>Mixins</b>

* Field
* Source
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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>truncate</strong></td>
         <td><code>number</code></td>
         <td>Shortens text.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-text-field source="name"></va-text-field>
</template>
```

Creates a simple <b>span</b>:

```html
<span>Admin</span>
```

### Email

Displays the value as a <b>mailto</b> link.

<b>Mixins</b>

* Field
* Source
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
         <td>The property of the resource to fetch the value to display. Supports dot representation for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-email-field source="email"></va-email-field>
</template>
```

Creates a simple <b>mailto</b> link:

```html
<a href="mailto:admin@example.com">admin@example.com</a>
```

### Url

It displays the value as a simple http connection.

<b>Mixins</b>

* Field
* Source
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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>string</code></td>
         <td>The target value of the link is external by default.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-url-field source="url" target="_self"></va-url-field>
</template>
```

Creates a simple <b>url</b> link:

```html
<a href="https://www.example.org">https://www.example.org</a>
```

### Rich Text

Show the value in raw format that allows HTML tags. The source value must be trusted to prevent XSS attacks.

<b>Mixins</b>

* Field
* Source
* Resource

<b>Properties</b>

The <b>source</b> and <b>item</b> properties mentioned previously.

<b>Example</b>

```html
<template>
  <va-rich-text-field source="body"></va-rich-text-field>
</template>
```

Creates a raw HTML div:

```html
<div>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>
```

### Number

Displays the value as a formatted number. It can be any local currency, decimal or percentage value. Use the Vue i18n function <b>$n</b> under the hood.

<b>Mixins</b>

* Field
* Source
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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>format</strong></td>
         <td><code>string</code></td>
         <td>The name of the number format to use. Vue i18n must be predefined in your plugin.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-number-field source="price" format="currency"></va-number-field>
</template>
```

Creates a number formatted in <b>span</b>:

```html
<span>49,92&nbsp;€</span>
```

<b>Format:</b>

For the targeted i18n locale, you first need to save a valid number format:

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

Check out the documentation for <a href="https://kazupon.github.io/vue-i18n/guide/number.html" target="_blank">Vue i18n</a>.

### Date

Displays the value as a formatted date. And <b>long</b>, <b>short</b> etc. Supports all localized formats. Basically use <b>$d</b>, <B>VueI18n</B> function.

<b>Mixins</b>

* Field
* Source
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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>format</strong></td>
         <td><code>string</code></td>
         <td>The date format to use. For example: (dd-mm-YYYY).</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-date-field source="publicationDate" format="short"></va-date-field>
</template>
```

Creates a formatted date within the range:

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

Check out the documentation for <a href="https://kazupon.github.io/vue-i18n/guide/datetime.html" target="_blank">Vue i18n</a>.

### Boolean

Displays the value as a definable <b>true/false</b> symbol.

<b>Mixins</b>

* Field
* Source
* Resource

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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>labelTrue</strong></td>
         <td><code>string</code></td>
         <td><b>true</b> text for type.</td>
      </tr>
      <tr>
         <td><strong>labelFalse</strong></td>
         <td><code>string</code></td>
         <td><b>false</b> text for type.</td>
      </tr>
      <tr>
         <td><strong>iconTrue</strong></td>
         <td><code>string</code></td>
         <td>True value icon. Must be a valid <a href="https://pictogrammers.github.io/@mdi/font/7.0.96/" target="_blank">mdi</a> icon.</td>
      </tr>
      <tr>
         <td><strong>iconFalse</strong></td>
         <td><code>string</code></td>
         <td>False value symbol. Must be a valid <a href="https://pictogrammers.github.io/@mdi/font/7.0.96/" target="_blank">mdi</a> icon.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-boolean-field source="active" icon-false="mdi-cancel"></va-boolean-field>
</template>
```

### Rating

Show the value as rating stars. If half increments are enabled, the value must be a valid integer or decimal number. Icons can be edited from Vuetify icon <a href="https://vuetifyjs.com/en/components/ratings/#icons" target="_blank">settings</a>.

<b>Mixins</b>

* Field
* Source
* Resource
* Rating

<b>Properties</b>

The <b>source</b> and <b>item</b> properties mentioned previously.

<b>Example</b>

```html
<template>
  <va-rating-field source="rating" length="10" half-increments></va-rating-field>
</template>
```

The example above creates a read-only Vuetify <a href="https://vuetifyjs.com/en/components/ratings/" target="_blank">rating</a> component.

### Chip

It displays the value inside a chip material.

<b>Mixins</b>

* Field
* Source
* Resource
* Chip

<b>Properties</b>

The <b>source</b> and <b>item</b> properties mentioned previously.

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
         <td>Chip content placeholder shows value by default for further customization.</td>
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
         <td>For further customization, the content placeholder defaults to the text of the selected selection.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

```html
<template>
  <va-chip-field source="type" color="secondary" small></va-chip-field>
</template>
```

Generates a Vuetify <a href="https://vuetifyjs.com/en/components/chips/" target="_blank">chip</a> component.

<b>Enums</b>

If you need format value in terms of selections or enumerations, use <b>VaSelectField</b> with chip prop.

### Select

Its value represents text selected from predefined <b>key-value</b> options. If no options are available, by default Vue i18n retrieves localized enumerations from your <b>resource</b> locale that contain <b>source</b> as the value.

<b>Mixins</b>

* Field
* Source
* Resource
* Choices
* Chip

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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>chip</strong></td>
         <td><code>string</code></td>
         <td>Shows text inside a chip material.</td>
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
         <td>For further customization, the content placeholder defaults to the text of the selected selection.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

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

<b>Localized Enums</b>

> You can centralize all reuse options directly in your locale as explained here. If no options are set, <b>VaSelectField</b> will look for the following valid translated key format: <kbd>resources.{resource}.enums.{source}.{value}</kbd>.

### File

Shows a list of file links pointing to the original files.

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

<b>Mixins</b>

* Field
* Source
* Resource
* Files

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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>src</strong></td>
         <td><code>string</code></td>
         <td>Source property of the file object, link via the original file.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Title attribute of the file object used for title and alt attributes.</td>
      </tr>
      <tr>
         <td><strong>fileName</strong></td>
         <td><code>string</code></td>
         <td>The file name property of the file object; shown as link text for files.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>string</code></td>
         <td>The target value for the connection is external by default.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>Mainly use for VaFileInput, allows removal of files or images.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>The name of the property sent to the API containing the IDs of the file to be deleted.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Specifies where the ID value is retrieved to identify files to be deleted.</td>
      </tr>
   </tbody>
</table>
</div>


### Image

Show a list of images as a gallery with preview support for thumbnails.

![Image Field](/images/image-field.png)

```html
<va-image-field 
  source="files" 
  :item="model" 
  table-name="employeeFiles"
></va-image-field>
```

<b>Mixins</b>

* Field
* Source
* Resource
* Files

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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>src</strong></td>
         <td><code>string</code></td>
         <td>Source property of the image object, link via original file.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Title attribute of the file object used for title and alt attributes.</td>
      </tr>
      <tr>
         <td><strong>fileName</strong></td>
         <td><code>string</code></td>
         <td>Filename property of the image object; shown as link text for files.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>string</code></td>
         <td>The target value for the connection is external by default.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>Mainly use for VaFileInput, allows removal of files or images.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>The name of the property sent to the API containing the IDs of the images to be deleted.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Specifies where the ID value is retrieved to identify images to be deleted.</td>
      </tr>
      <tr>
         <td><strong>height</strong></td>
         <td><code>string</code></td>
         <td>Maximum height of the image.</td>
      </tr>
      <tr>
         <td><strong>lg</strong></td>
         <td><code>string</code></td>
         <td>Maximum column width for image gallery.</td>
      </tr>
   </tbody>
</table>
</div>

### Array

Represent each value of the multiple array type value as a material chip group.

<b>Mixins</b>

* Chip
* Field
* Source
* Resource

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
         <td>For further customization, the content placeholder defaults to the text of the selected selection.</td>
      </tr>
   </tbody>
</table>
</div>

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
         <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element added by <code>VaShow</code>.</td>
      </tr>
      <tr>
         <td><strong>itemText</strong></td>
         <td><code>string|array|func</code></td>
         <td>The inside attribute is used if it is an object. Use a function for further customization.</td>
      </tr>
      <tr>
         <td><strong>select</strong></td>
         <td><code>string</code></td>
         <td>Use <b>enum</b> select field instead of simple text as value formatter.</td>
      </tr>
      <tr>
         <td><strong>column</strong></td>
         <td><code>string</code></td>
         <td>Show list of chips as column.</td>
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

<b>Nested object</b>

Use the default slot for internal chip templating:

```html
<template>
  <va-array-field source="formats" v-slot="{ value }">
    {{ value.date }} : {{ value.url }}
  </va-array-field>
</template>
```

For a more complex case, use a simple v-for custom template.