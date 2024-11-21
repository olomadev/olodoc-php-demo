
## Mixins (API)

In this section you will find the reference of all <b>mixin</b> libraries used in Olobase Admin.

### Page

Contains CRUD action sheet functions used for View, Create, and Edit.

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
         <td>Sets the optional h1 title of the page.</td>
      </tr>
   </tbody>
</table>
</div>

### Resource

Used for all welding related components.

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
         <td><strong>resource</strong></td>
         <td><code>string</code></td>
         <td>The name of the resource to use. Required for good tag localization and context action activators. The default behavior is to fetch it from the router context.</td>
      </tr>
   </tbody>
</table>
</div>

### Source

It is used for components that need to use the specific feature of the resource.

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
         <td>The property of the resource to fetch the value to display. Supports dot representation for slotted object.</td>
      </tr>
   </tbody>
</table>
</div>

### Field

Master field mix for all fields used for data show. It can automatically fetch the property source value from the current source. Use this component to create your own field component.

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
         <td>The property of the resource to fetch the value to display. Supports dot representation for slotted object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element injected by the <b>VaShow</b> component.</td>
      </tr>
   </tbody>
</table>
</div>

### Input

The master input mix for all inputs used to edit or create the resource feature. Automatically updates the main form's model. Use this component to create your own login component.

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
         <td>The property of the resource to fetch the value to display. Supports dot representation for slotted object.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>By default resource will be the last name sent to the API for creation/update. This support allows you to override this default behavior.</td>
      </tr>
   </tbody>
</table>
</div>

### Button

Provides common properties for common key components.

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
         <td><code>string</code></td>
         <td>Item added to button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the button only with the icon.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Customizable background or text color based on the text property value.</td>
      </tr>
   </tbody>
</table>
</div>

### Action Button

Provides common features for all types of action button.

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
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the button only with the icon</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>boolean</code></td>
         <td>The label of the button shown as the next label icon or tooltip.</td>
      </tr>
      <tr>
         <td><strong>hideLabel</strong></td>
         <td><code>boolean</code></td>
         <td>Hide the label next to the icon. It will appear as a tooltip.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Customizable background or text color based on the text property value.</td>
      </tr>
      <tr>
         <td><strong>text</strong></td>
         <td><code>boolean</code></td>
         <td>Show as text without background.</td>
      </tr>
   </tbody>
</table>
</div>

### Redirect Button

For keys that support routing. Unless <b>DisableRedirect</b> support is enabled, the button will be automatically hidden if no rendering action is available.

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
         <td><code>string</code></td>
         <td>Item added to button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the button only with the icon.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Customizable background or text color based on the text property value.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disable default redirect behavior for compatible buttons.</td>
      </tr>
   </tbody>
</table>
</div>

### Search

Provides common properties for resource search components, such as <b>VaList</b> or <b>AutocompleteInput</b>. It uses the GetList data provider.

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
         <td><strong>filter</strong></td>
         <td><code>object</code></td>
         <td>Built-in active filter. Inside the filter parameters the data is sent to your provider.</td>
      </tr>
      <tr>
         <td><strong>fields</strong></td>
         <td><code>array</code></td>
         <td>List of fields to select for the API side. Supports dot notation for nested fields. The data is sent to your provider within the field parameters.</td>
      </tr>
      <tr>
         <td><strong>sortBy</strong></td>
         <td><code>array</code></td>
         <td>The list of sorted fields can be more than one. Inside the sorting parameters the data is sent to your provider.</td>
      </tr>
      <tr>
         <td><strong>sortDesc</strong></td>
         <td><code>array</code></td>
         <td>The sort state list for each sorted field is sorted as <b>DESC</b> if the <b>boolean</b> value is <b>true</b>. Inside the sorting parameters the data is sent to your provider.</td>
      </tr>
      <tr>
         <td><strong>include</strong></td>
         <td><code>array</code>, <code>object</code></td>
         <td>Relevant resources to be included in the existing resource for the API side. Allows eager loading on demand, data is sent to your provider within <b>include</b> parameters.</td>
      </tr>
      <tr>
         <td><strong>itemsPerPage</strong></td>
         <td><code>number</code></td>
         <td>The maximum number of items to show in the list for each page. The data is sent to your provider within <b>pagination.perPage</b> parameters.</td>
      </tr>
      <tr>
         <td><strong>disableItemsPerPage</strong></td>
         <td><code>boolean</code></td>
         <td>It necessarily disables per-page items in the query on the server side. Note that <b>itemsPerPage</b> is still required for proper client-side pager calculation.</td>
      </tr>
   </tbody>
</table>
</div>

### Chip

It provides common features for all chip-based fields.

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
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>The color of the chip can be a function for dynamic color according to a specific value.</td>
      </tr>
      <tr>
         <td><strong>small</strong></td>
         <td><code>boolean</code></td>
         <td>Small chip.</td>
      </tr>
      <tr>
         <td><strong>to</strong></td>
         <td><code>boolean</code></td>
         <td>Router connection associated with the chip, if necessary.</td>
      </tr>
   </tbody>
</table>
</div>

### Input Wrapper

Provides common properties for all input fields.

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
         <td><strong>parentSource</strong></td>
         <td><code>string</code></td>
         <td>Special case of main source for array entry.</td>
      </tr>
      <tr>
         <td><strong>prependIcon</strong></td>
         <td><code>string</code></td>
         <td>Adds an external icon at the head of the component. Must be a valid MDI.</td>
      </tr>
      <tr>
         <td><strong>appendIcon</strong></td>
         <td><code>string</code></td>
         <td>Adds an external icon to the last part of the component. Must be a valid MDI.</td>
      </tr>
      <tr>
         <td><strong>prependInnerIcon</strong></td>
         <td><code>string</code></td>
         <td>Adds an internal icon to the head of the component. Must be a valid MDI.</td>
      </tr>
      <tr>
         <td><strong>appendInnerIcon</strong></td>
         <td><code>string</code></td>
         <td>Adds an internal icon to the last part of the component. Must be a valid MDI.</td>
      </tr>
      <tr>
         <td><strong>hint</strong></td>
         <td><code>string</code></td>
         <td>Hint text.</td>
      </tr>
      <tr>
         <td><strong>hideDetails</strong></td>
         <td><code>string</code>, <code>boolean</code></td>
         <td>Hides hint and validation errors. When set to automatic, messages are processed only if there is a message to be displayed (hint, error message, counter value, etc.).</td>
      </tr>
      <tr>
         <td><strong>density</strong></td>
         <td><code>boolean</code></td>
         <td>Reduces entry height.</td>
      </tr>
      <tr>
         <td><strong>required</strong></td>
         <td><code>boolean</code></td>
         <td>Adds the default required client-side rule.</td>
      </tr>
      <tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Overrides the default tag behavior. The default is to get the localized VueI18n tag from both the source and the property source.</td>
      </tr>
      <tr>
         <td><strong>labelKey</strong></td>
         <td><code>string</code></td>
         <td>Overrides the default source key as the translated label.</td>
      </tr>
      <tr>
         <td><strong>placeholder</strong></td>
         <td><code>string</code></td>
         <td>If the input field supports it, it assigns the value entered to the <b>placeholder</b> attribute.</td>
      </tr>
      <tr>
         <td><strong>clearable</strong></td>
         <td><code>boolean</code></td>
         <td>If the input field supports it, it assigns the deletable attribute to this field.</td>
      </tr>
      <tr>
         <td><strong>index</strong></td>
         <td><code>number</code></td>
         <td>If the input value is an array, it is the specific field index. Use this with the parentSource prop to update the value at a good time and place it in the form model.</td>
      </tr>
      <tr>
         <td><strong>errorMessages</strong></td>
         <td><code>array</code></td>
         <td>List of custom error verification messages to show as hints.</td>
      </tr>
   </tbody>
</table>
</div>

### Rating

Provides common properties for the rating field and input components.

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
         <td><strong>color</strong></td>
         <td><code>string</code></td>
         <td>Solid color for active ratings.</td>
      </tr>
      <tr>
         <td><strong>backgroundColor</strong></td>
         <td><code>string</code></td>
         <td>Stroke color for empty graduations.</td>
      </tr>
      <tr>
         <td><strong>length</strong></td>
         <td><code>string</code>, <code>number</code></td>
         <td>Amount of ratings to show.</td>
      </tr>
      <tr>
         <td><strong>halfIncrements</strong></td>
         <td><code>boolean</code></td>
         <td>Allows selection of half increments.</td>
      </tr>
   </tbody>
</table>
</div>

### Choices

Provides common properties for all selection-based fields or entries.

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
         <td><strong>itemText</strong></td>
         <td><code>string</code>, <code>array</code>, <code>func</code></td>
         <td>Ability to show text.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code>, <code>array</code>, <code>func</code></td>
         <td>Specifies where the value is taken from.</td>
      </tr>
      <tr>
         <td><strong>choices</strong></td>
         <td><code>array</code></td>
         <td>List of options to choose from. By default VueI18n imports localized enums from your source locale.</td>
      </tr>
   </tbody>
</table>
</div>

### Reference

Provides common properties for all field components that support resource reference as <b>VaReferenceField</b> or <b>VaReferenceArrayField</b>.

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
         <td><strong>reference</strong></td>
         <td><code>string</code></td>
         <td>Name of the resource to connect to.</td>
      </tr>
      <tr>
         <td><strong>action</strong></td>
         <td><code>string</code>, <code>array</code>, <code>func</code></td>
         <td>Default CRUD page to link to.</td>
      </tr>
      <tr>
         <td><strong>itemText</strong></td>
         <td><code>string</code></td>
         <td>Property used to string the internal targeted resource. For more customization, use a function. If nothing is set, use the global tag property resource by default.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Specify where the ID value is retrieved for link creation.</td>
      </tr>
   </tbody>
</table>
</div>

### Multiple

Provides common properties for input components that allow multiple values as arrays.

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
         <td><strong>v-model</strong></td>
         <td><code>string</code>, <code>array</code></td>
         <td>The value to be edited. If more than one, it is array by default.</td>
      </tr>
      <tr>
         <td><strong>multiple</strong></td>
         <td><code>boolean</code></td>
         <td>Allows input to accept multiple values as an array.</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Variant support provides an easy way to customize the style of your text field. The following values are valid options: solo, filled (default), outlined, plain, underlined.</td>
      </tr>
      <tr>
         <td><strong>chips</strong></td>
         <td><code>boolean</code></td>
         <td>Enables chip usage for each item. Enabled by default if more than one.</td>
      </tr>
      <tr>
         <td><strong>smallChips</strong></td>
         <td><code>boolean</code></td>
         <td>Allows the use of small chips.</td>
      </tr>
   </tbody>
</table>
</div>

### Files

Provides common properties for all file upload entries.

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
         <td>It is the property of the resource to fetch the value to be displayed. Supports dot representation for slotted object.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>null</code></td>
         <td>Overrides the default element injected by <b>VaShow</b>.</td>
      </tr>
      <tr>
         <td><strong>src</strong></td>
         <td><code>string</code></td>
         <td>Source property of the file object, link path of the original file source.</td>
      </tr>
      <tr>
         <td><strong>title</strong></td>
         <td><code>string</code></td>
         <td>Sets the title attribute of the file object used for title and alt attributes.</td>
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
         <td>Mainly uses for VaFileInput, allows removal of files or images.</td>
      </tr>
      <tr>
         <td><strong>model</strong></td>
         <td><code>string</code></td>
         <td>Determines the name of the property sent to the API that contains the IDs of the file to be deleted.</td>
      </tr>
      <tr>
         <td><strong>itemValue</strong></td>
         <td><code>string</code></td>
         <td>Specifies where the ID value is retrieved (default: "id") to identify files to be deleted.</td>
      </tr>
   </tbody>
</table>
</div>

### Utils

Some helper functions in Olobase Admin are included in utils.js by default.

<b>Methods</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Method</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>this.generateUid()</strong></td>
         <td>Generates a random <a href="https://www.techtarget.com/searchwindowsserver/definition/GUID-global-unique-identifier" target="_blank">GUUID</a>: xxxxxxxx-xxxx-xxxx-yxxx-xxxxxxxxxxxx. If the <kbd>form.disableGenerateUid</kbd> option in your configuration file is <b>true</b>, it will generate random numbers of <kbd>integer</kbd> type.</td>
      </tr>
      <tr>
         <td><strong>this.generateInt()</strong></td>
         <td>Generates random numbers in <kbd>integer</kbd> format.</td>
      </tr>
      <tr>
         <td><strong>this.generateId(this)</strong></td>
         <td><code>generateUid()</code> if the current page's route contains the word <b>create</b>, otherwise it returns <code>this.id</code>.</td>
      </tr>
      <tr>
         <td><strong>validateForm(this, formName)</strong></td>
         <td>If you are using more than one form on one page. This function checks the validation of the form name given on the current page.</td>
      </tr>
      <tr>
         <td><strong>dateAddMonth(date, numberOfMonth)</strong></td>
         <td>Adds the number of months entered to the given date.</td>
      </tr>
      <tr>
         <td><strong>dayDiff(firstDate, secondDate = null)</strong></td>
         <td>If only the first parameter is entered, it calculates the number of days between today's date and the entered date. If two dates are entered, the days between the two dates are calculated.</td>
      </tr>
      <tr>
         <td><strong>monthDiff(startDate, endDate)</strong></td>
         <td>Calculates how many months are between two dates.</td>
      </tr>
      <tr>
         <td><strong>generatePassword(length)</strong></td>
         <td>Generates a random strong password of the given width.</td>
      </tr>
   </tbody>
</table>
</div>