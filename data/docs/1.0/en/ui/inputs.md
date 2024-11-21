
## Inputs

Olobase Admin input components allow editing of specific properties of the current API resource object. Mainly for creating and editing views
It is used in [form](/ui/form.html). It can also be used as a filter entry for <b>VaList</b>. For resource support, it must be used within the <b>VaForm</b> component, which handles adding elements and providing the model with error messages.

### Source and Model

Va entries support both source and model sup

port. The source is the original feature object from which the value will be fetched and the model will be the final feature name with the new value to be sent to your data provider.

### Dot Representation Support

Olobase Admin inputs accept dot notation for source support. Very useful for nested object:

```html
<template>
	<va-text-input source="address.street"></va-text-input>
	<va-text-input source="address.postcode"></va-text-input>
	<va-text-input source="address.city"></va-text-input>
</template>
```

As seen in the example above, the value of the street property of the address object is directly taken. The final form model data to be sent to your data provider also complies with this nested structure.

## Olobase Admin Inputs

In this section, Olobase Admin input components in the <kbd>packages/admin/src/components/ui/inputs</kbd> folder will be discussed.

### Text

Edits text for text value type via basic text input. Supports textarea mode for long texts via multi-line support. Can be used for any date, datetime or time arrangement; Use date, datetime-local, or time-based type. Processing will depend on browser support.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>type</strong></td>
				 <td><code>string</code></td>
				 <td>Text input type. All HTML types are allowed.</td>
			</tr>
			<tr>
				 <td><strong>multiline</strong></td>
				 <td><code>boolean</code></td>
				 <td>Convert text input to textarea.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

<b>Mixins</b>

* Input
* InputWrapper
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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

Optimized for number editing. Supports min, max and step features.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>v-model</strong></td>
				 <td><code>string</code></td>
				 <td>Text to be edited.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
			<tr>
				 <td><strong>step</strong></td>
				 <td><code>number</code></td>
				 <td>Interval step.</td>
			</tr>
			<tr>
				 <td><strong>min</strong></td>
				 <td><code>number</code></td>
				 <td>Minimum accepted value.</td>
			</tr>
			<tr>
				 <td><strong>max</strong></td>
				 <td><code>number</code></td>
				 <td>Maximum accepted value.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

It is used to edit the date type value. Vuetify consists of a read-only text field associated with the date picker. It does not support time value, in this case use classic VaTextInput.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>header</strong></td>
				 <td><code>string</code></td>
				 <td>Allows you to write text in the section shown under the title. The default value is empty.</td>
			</tr>
			<tr>
				 <td><strong>format</strong></td>
				 <td><code>string</code></td>
				 <td>The date format to use. For example: (dd-mm-YYYY).</td>
			</tr>
			<tr>
				 <td><strong>allowedDates</strong></td>
				 <td><code>function</code>, <code>array</code></td>
				 <td>Restricts which dates can be selected.</td>
			</tr>
			<tr>
				 <td><strong>color</strong></td>
				 <td><code>string</code></td>
				 <td>Applies the specified color to the component - supports auxiliary colors (e.g. success or purple) or css color (e.g. success or purple) or css color (like #033 or rgba(255, 0, 0, 0.5)). Default value: primary.</td>
			</tr>
			<tr>
				 <td><strong>elevation</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Specifies a height applied to the component, from 0 to 24. More information can be found on <a href="https://dev.vuetifyjs.com/en/styles/elevation/#usage" target="_blank">elevation</a>.</td>
			</tr>
			<tr>
				 <td><strong>hideHeader</strong></td>
				 <td><code>boolean</code></td>
				 <td>Completely hides the header section of the component. (Default: false).</td>
			</tr>
			<tr>
				 <td><strong>height</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the height of the component.</td>
			</tr>
			<tr>
				 <td><strong>width</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the width of the component.</td>
			</tr>
			<tr>
				 <td><strong>max</strong></td>
				 <td><code>string</code>, <code>number</code>, <code>date</code></td>
				 <td>Maximum date/month allowed. (ISO 8601 format).</td>
			</tr>
			<tr>
				 <td><strong>maxHeight</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the maximum height of the component.</td>
			</tr>
			<tr>
				 <td><strong>maxWidth</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the maximum width of the component.</td>
			</tr>
			<tr>
				 <td><strong>min</strong></td>
				 <td><code>string</code>, <code>number</code>, <code>date</code></td>
				 <td>Minimum date/month allowed (ISO 8601 format).</td>
			</tr>
			<tr>
				 <td><strong>minHeight</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the minimum height of the component.</td>
			</tr>
			<tr>
				 <td><strong>minWidth</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the minimum width of the component.</td>
			</tr>
			<tr>
				 <td><strong>multiple</strong></td>
				 <td><code>boolean</code></td>
				 <td>Allow multiple date selections.</td>
			</tr>
			<tr>
				 <td><strong>position</strong></td>
				 <td><code>boolean</code></td>
				 <td>Sets the position of the component (static, relative, fixed, absolute, sticky).</td>
			</tr>
			<tr>
				 <td><strong>rounded</strong></td>
				 <td><code>string</code>, <code>number</code>, <code>boolean</code></td>
				 <td>Specifies the edge radius applied to the component.</td>
			</tr>
			<tr>
				 <td><strong>showAdjacentMonths</strong></td>
				 <td><code>boolean</code></td>
				 <td>Toggles the visibility of previous and next months' days.</td>
			</tr>
			<tr>
				 <td><strong>showWeek</strong></td>
				 <td><code>boolean</code></td>
				 <td>Toggles the visibility of week numbers in the body of the calendar.</td>
			</tr>
			<tr>
				 <td><strong>hideActions</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hides select actions.</td>
			</tr>
			<tr>
				 <td><strong>hideWeekdays</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hides weekdays.</td>
			</tr>
			<tr>
				 <td><strong>inputPlaceholder</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the placeholder value for the entry.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
			<tr>
				 <td><strong>viewMode</strong></td>
				 <td><code>string</code></td>
				 <td>Switches between month or year view (month, year).</td>
			</tr>
			<tr>
				 <td><strong>disabled</strong></td>
				 <td><code>boolean</code></td>
				 <td>Removes the ability to click on the component.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

When a value is sent to a boolean input type as <b>boolean</b> or <b>0/1</b>, the input is displayed as a toggle button.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

Edit the number value as rating stars. If half increments are enabled, the value must be a valid integer or decimal number. Icons can be edited via $ratingFull, $ratingEmpty and $ratingHalf in Vuetify settings.

<b>Mixins</b>

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>active-color</strong></td>
				 <td><code>string</code></td>
				 <td>Color applied to the component while it is active.</td>
			</tr>
			<tr>
				 <td><strong>clearable</strong></td>
				 <td><code>boolean</code></td>
				 <td>Allows the component to be cleared by clicking on the current value.</td>
			</tr>
			<tr>
				 <td><strong>color</strong></td>
				 <td><code>string</code></td>
				 <td>Applies the specified color to the control.</td>
			</tr>
			<tr>
				 <td><strong>density</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the vertical height used by the component. (default, comfortable, compact).</td>
			</tr>
			<tr>
				 <td><strong>disabled</strong></td>
				 <td><code>boolean</code></td>
				 <td>Removes the ability to click on the component.</td>
			</tr>
			<tr>
				 <td><strong>empty-icon</strong></td>
				 <td><code>string</code>, <code>array</code>, <code>function</code></td>
				 <td>Icon displayed when empty.</td>
			</tr>
			<tr>
				 <td><strong>full-icon</strong></td>
				 <td><code>string</code>, <code>array</code>, <code>function</code></td>
				 <td>Icon displayed when full.</td>
			</tr>
			<tr>
				 <td><strong>half-increments</strong></td>
				 <td><code>boolean</code></td>
				 <td>Allows selection of half increments.</td>
			</tr>
			<tr>
				 <td><strong>hover</strong></td>
				 <td><code>boolean</code></td>
				 <td>Provides visual feedback when hovering over icons.</td>
			</tr>
			<tr>
				 <td><strong>item-aria-label</strong></td>
				 <td><code>string</code></td>
				 <td>Settings for item tags.</td>
			</tr>
			<tr>
				 <td><strong>item-label-position</strong></td>
				 <td><code>string</code></td>
				 <td>Position of element labels accepts 'top' and 'bottom'.</td>
			</tr>
			<tr>
				 <td><strong>item-labels</strong></td>
				 <td><code>array</code></td>
				 <td>Array of labels to display next to each item.</td>
			</tr>
			<tr>
				 <td><strong>length</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Amount of items to display.</td>
			</tr>
			<tr>
				 <td><strong>model-value</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>The v-model value of the component. If the component supports multitasking, this defaults to an empty array.</td>
			</tr>
			<tr>
				 <td><strong>name</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the name property of the component.</td>
			</tr>
			<tr>
				 <td><strong>readonly</strong></td>
				 <td><code>boolean</code></td>
				 <td>Removes all hover effects and pointer events.</td>
			</tr>
			<tr>
				 <td><strong>size</strong></td>
				 <td><code>string</code>, <code>number</code></td>
				 <td>Sets the height and width of the component. The default unit is pixels. (x-small, small, default, large, x-large).</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

Creates a <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">WYSIWYG</a> HTML editor using the <a href="https://tiptap.dev/" target="_blank">Tiptap</a>.

<b>Mixins</b>

* Input
* InputWrapper
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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

Creates a <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">WYSIWYG</a> HTML editor using the <a href="https://www.tiny.cloud/" target="_blank">Tiny MCE</a>  GPL license.

<b>Mixins</b>

* Input
* InputWrapper
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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

Lets you select a value or values from a selection list. Supports multiple selections and references. If no options are available, by default it can retrieve localized lists containing resources from <kbd>src/I18n/locales/en.json</kbd>.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Multiple
* Editable
* Choices
* Search

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>reference</strong></td>
				 <td><code>string</code></td>
				 <td>Name of the resource to search for.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
			<tr>
				 <td><strong>multiple</strong></td>
				 <td><code>boolean</code></td>
				 <td>Activates multiple selection.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

### Local Enumeric Values

You can centralize all reuse options directly in your locale as described here. If no options are set, <b>VaSelectInput</b> will search for the following valid translated key format: <kbd>resources.{resource}.enums.{source}.{value}</kbd>

### References

If you want to select from the current source reference, use the reference option as follows:

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

The example above will fetch all companies from the api service and list them as options. For filtering, use the filter option. In case the schema name on the backend side is different from the source, you can use the model option. Otherwise, you do not need to use this option.

### Interactive Select Fields

If you want to change another selection field interactively after selecting a selection field, take a look at the code in the example below.

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

Lets you select values from a selection list. Supports references. If no options are available, by default it can retrieve localized lists containing resources from <kbd>src/I18n/locales/en.json</kbd>.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Choices
* Search

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>reference</strong></td>
				 <td><code>string</code></td>
				 <td>Name of the resource to search for.</td>
			</tr>
			<tr>
				 <td><strong>inline</strong></td>
				 <td><code>boolean</code></td>
				 <td>Shows options horizontally. (Default: false).</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

<b>References</b>

The same reference description for <b>VaSelectInput</b> as above applies, multi-selection is not supported.

### AutoComplete

Allows selection of value or values from searchable options. Supports multiple selections and references. Allows searching for linked resources from your API service.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Multiple
* Choices
* Search

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
			<tr>
				 <td><strong>reference</strong></td>
				 <td><code>string</code></td>
				 <td>Name of the resource to search for.</td>
			</tr>
			<tr>
				 <td><strong>minChars</strong></td>
				 <td><code>number</code></td>
				 <td>Minimum characters that must be tapped before the search query is initiated.</td>
			</tr>
			<tr>
				 <td><strong>searchQuery</strong></td>
				 <td><code>string</code></td>
				 <td>The name of the request query to search your API service. (Default: "q").</td>
			</tr>
			<tr>
				 <td><strong>taggable</strong></td>
				 <td><code>boolean</code></td>
				 <td>Enable taggable mode. Convert autocomplete to combo box.</td>
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
				 <th>Description</th>
			</tr>
	 </thead>
	 <tbody>
			<tr>
				 <td><strong>selection</strong></td>
				 <td>Define a custom selection view.</td>
			</tr>
			<tr>
				 <td><strong>item</strong></td>
				 <td>Define a custom item view</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

<tab>
<title>AutoComplete|Template</title>
<content>
![Form](/images/autocomplete-input.png)
<tcol>

```html
<template>
	<v-row>
		<v-col lg="3" md="4" sm="6">
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
		</v-col>
	</v-row>
</template>
```
</content>
</tab>

<b>searchQuery and minChars:</b>

Use <b>minChars</b> and <b>searchQuery</b> to configure the minimum characters required before searching and the query search parameter key, which defaults to q. This element will reuse the <b>GetList</b> data provider method with a custom search filter.

For better performance, use the <b>fields</b> option to reduce API query overload.

<b>taggable</b>

Autocomplete will be converted to a combo box component as soon as you enable taggable support. It allows you to create new tags instantly.

### File

Allows single line file uploads. One or both installations are supported simultaneously. Use <b>VaFileField</b> or <b>VaImageField</b> with this element to show a preview of uploaded files.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Multiple

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
			<tr>
				 <td><strong>itemValue</strong></td>
				 <td><code>string</code></td>
				 <td>Specifies where to retrieve the ID value to identify files to delete (Default: "id").</td>
			</tr>
			<tr>
				 <td><strong>accept</strong></td>
				 <td><code>string</code></td>
				 <td>Adds HTML5 `accept` feature for simple client-side validation.</td>
			</tr>
			<tr>
				 <td><strong>base64</strong></td>
				 <td><code>boolean</code></td>
				 <td>Enables uploading with base64 encoding.</td>
			</tr>
			<tr>
				 <td><strong>tableName</strong></td>
				 <td><code>string</code></td>
				 <td>Name of the table in the database where global installation files are kept.</td>
			</tr>
			<tr>
				 <td><strong>download</strong></td>
				 <td><code>boolean</code></td>
				 <td>Activates the click and download file option.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

It allows multiple data entries as arrays in tabular format. Supports adding new data, deleting and updating data.

<b>Mixins</b>

* Input
* InputWrapper
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
				 <td><strong>class</strong></td>
				 <td><code>String</code></td>
				 <td>The array table assigns a value to the html class attribute of the div element surrounding it.</td>
			</tr>
			<tr>
				 <td><strong>source</strong></td>
				 <td><code>string</code></td>
				 <td>The property of the resource to fetch the value to display. Supports dot display for slot used object.</td>
			</tr>
			<tr>
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>title</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the header of the array table.</td>
			</tr>
			<tr>
				 <td><strong>headers</strong></td>
				 <td><code>array</code></td>
				 <td>Determines the column headers of the array table.</td>
			</tr>
			<tr>
				 <td><strong>fields</strong></td>
				 <td><code>array</code></td>
				 <td>Places the va-entries to use from the array table.</td>
			</tr>
			<tr>
				 <td><strong>primaryKey</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the key field name for the Array. This name is required for backend side validation and database registration.</td>
			</tr>
		  <tr>
	       <td><strong>errorMessages</strong></td>
	       <td><code>array</code></td>
	       <td>Allows display of assigned form validation errors.</td>
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
				 <th>Description</th>
			</tr>
	 </thead>
	 <tbody>
			<tr>
				 <td><strong>top</strong></td>
				 <td>Edits the section of the series title when needed.</td>
			</tr>
			<tr>
				 <td><strong>bottom</strong></td>
				 <td>Arranges the bottom section of the array table.</td>
			</tr>
			<tr>
				 <td><strong>headers</strong></td>
				 <td>Customizes the columns of the array table.</td>
			</tr>
			<tr>
				 <td><strong>item.actions</strong></td>
				 <td>Customizes the operations section of the array table.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Events</b>

After the form saving stage of the Array Table events, it receives the responses returned from the server and organizes the actions accordingly.

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event Name</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>save</strong></td>
         <td>It allows you to access the object of the saved data after the form row is saved.</td>
      </tr>
      <tr>
         <td><strong>delete</strong></td>
         <td>It allows you to access the object of the deleted data after the form row is deleted.</td>
      </tr>
      <tr>
         <td><strong>edit</strong></td>
         <td>It allows you to store the object belonging to the data edited while the form row is open.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Example</b>

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

It facilitates the creation of a user's profile picture with cutting and shrinking options.

<b>Mixins</b>

* Input
* InputWrapper
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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>backgroundColor</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the background color. The default value is <b>#ededed</b>.</td>
			</tr>
			<tr>
				 <td><strong>defaultSrc</strong></td>
				 <td><code>string</code></td>
				 <td>Determines the image shown by default. The default value is <b>/src/assets/avatar_2x.png</b>.</td>
			</tr>
			<tr>
				 <td><strong>setLabel</strong></td>
				 <td><code>string</code></td>
				 <td>Determines the label of the button for adding an avatar.</td>
			</tr>
			<tr>
				 <td><strong>delLabel</strong></td>
				 <td><code>string</code></td>
				 <td>Avatar determines the label of the button for deletion.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

It enables the creation together of checkbox input components grouped under each other at the first level. Features such as the toggle feature, the ability to select all entries with a higher checkbox, and searching within the list are supported by default.

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>disableSearch</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hide/show the search feature at the top. (Default: false).</td>
			</tr>
			<tr>
				 <td><strong>disableFooter</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hide/show the pagination feature that appears at the bottom (Default: false).</td>
			</tr>
			<tr>
				 <td><strong>primaryKey</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the primary key name for grouping operations.</td>
			</tr>
			<tr>
				 <td><strong>itemsPerPage</strong></td>
				 <td><code>string</code></td>
				 <td>Determines the number of data to display per page.</td>
			</tr>
			<tr>
				 <td><strong>headers</strong></td>
				 <td><code>array</code></td>
				 <td>Determines column headers.</td>
			</tr>
			<tr>
				 <td><strong>fields</strong></td>
				 <td><code>string</code></td>
				 <td>Determines column fields.</td>
			</tr>
			<tr>
				 <td><strong>initUrl</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the backend url address that fetches the entire list.</td>
			</tr>
			<tr>
				 <td><strong>groupBy</strong></td>
				 <td><code>string</code></td>
				 <td>Determines which column will be grouped based on the entered value.</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

It creates the component that makes it easy to select HEX color codes.

<b>Mixins</b>

* Input
* InputWrapper
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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>color</strong></td>
				 <td><code>string</code></td>
				 <td>Determines the overall color of the component.</td>
			</tr>
			<tr>
				 <td><strong>border</strong></td>
				 <td><code>string</code></td>
				 <td>Applies border styles to the component.</td>
			</tr>
			<tr>
				 <td><strong>rounded</strong></td>
				 <td><code>boolean</code>, <code>string</code>, <code>number</code></td>
				 <td>Specifies the edge radius applied to the component.</td>
			</tr>
			<tr>
				 <td><strong>dotSize</strong></td>
				 <td><code>string</code></td>
				 <td>Changes the size of the selection point on the canvas.</td>
			</tr>
			<tr>
				 <td><strong>hideCanvas</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hides the canvas.</td>
			</tr>
			<tr>
				 <td><strong>canvasHeight</strong></td>
				 <td><code>string</code>, <code>Number</code></td>
				 <td>Determines the height of the canvas.</td>
			</tr>
			<tr>
				 <td><strong>mode</strong></td>
				 <td><code>string</code></td>
				 <td>The currently selected entry type. Input can be synchronized with <b>v-model:mode</b>. Possible Values: 'rgb' | 'rgba' | 'hsl' | 'hsla' | 'hex' | 'hexa'.</td>
			</tr>
			<tr>
				 <td><strong>modes</strong></td>
				 <td><code>Array</code></td>
				 <td>Sets the available input types. Values that can be given: ['rgb', 'rgba', 'hsl', 'hsla', 'hex', 'hexa'].</td>
			</tr>
			<tr>
				 <td><strong>hideInputs</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hides input fields. (Default: false).</td>
			</tr>
			<tr>
				 <td><strong>hideSliders</strong></td>
				 <td><code>boolean</code></td>
				 <td>Hides input fields. (Default: false).</td>
			</tr>
			<tr>
				 <td><strong>showSwatches</strong></td>
				 <td><code>boolean</code></td>
				 <td>Displays swatches on canvas. (Default: false).</td>
			</tr>
			<tr>
				 <td><strong>swatchesMaxHeight</strong></td>
				 <td><code>string</code>, <code>Number</code></td>
				 <td>Sets the maximum height of the swatches section.</td>
			</tr>
			<tr>
				 <td><strong>position</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the location of the component (Default: undefined). Possible Values: 'static' | 'relative' | 'fixed' | 'absolute' | 'sticky'.</td>
			</tr>
			<tr>
				 <td><strong>width</strong></td>
				 <td><code>string</code></td>
				 <td>Sets the width of the color picker.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

For currency representation, use the <a href="https://www.npmjs.com/package/vue-currency-input" target="_blank">vue-currency-input</a> component to display the current value relative to the existing currency. formats.

<b>Mixins</b>

* Input
* InputWrapper
* Source
* Resource
* Editable

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
				 <td><strong>model</strong></td>
				 <td><code>string</code></td>
				 <td>By default <b>source</b> will be the last name sent to the API service for create/update. This support allows you to override this default behavior.</td>
			</tr>
			<tr>
				 <td><strong>variant</strong></td>
				 <td><code>string</code></td>
				 <td>Applies different styles to the component. (outlined, plain, underlined, solo, filled, solo-filled, solo-inverted).</td>
			</tr>
			<tr>
				 <td><strong>options</strong></td>
				 <td><code>object</code></td>
				 <td>Allows you to enter <a href="https://www.npmjs.com/package/vue-currency-input" target="_blank">vue-currency-input</a> options. Example: <code>options="{ currency: "USD", precision: 2 }</code></td>
			</tr>
	 </tbody>
</table>
</div>

<b>Example</b>

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

It is the input component that allows you to read large amounts of Excel data and add it to the database in <b>cli</b> mode. To save the imported data, it should be used with a sheet saving template that you have created yourself.

> To see more detailed examples of the components, check out our demo application on the homepage.

<b>Example</b>

<tab>
<title>Sheet|Template|Script</title>
<content>
1. The following image shows the file uploading stage.

![Form](/images/sheet-input-upload.png)

2. The following image shows the next step after the file is uploaded.

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
