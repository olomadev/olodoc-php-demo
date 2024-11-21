
## Buttons (API)

In this section you will find reference to all key components used in Olobase Vuetify Admin.

### Action

Component that you can use for any custom action key. In the data display table rows; Can be used in the header of create, display, or edit pages.

<b>Mixins</b>

* ActionButton

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
         <td><strong>block</strong></td>
         <td><code>boolean</code></td>
         <td>Expands the button to 100% of the available space.</td>
      </tr>
      <tr>
         <td><strong>type</strong></td>
         <td><code>string</code></td>
         <td>Sets the type property of the button. (Default: button).</td>
      </tr>
      <tr>
         <td><strong>variant</strong></td>
         <td><code>string</code></td>
         <td>Applies different styles to the component. ('text' | 'flat' | 'elevated' | 'tonal' | 'outlined' | 'plain').</td>
      </tr>
      <tr>
         <td><strong>to</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Vue route to redirect on click.</td>
      </tr>
      <tr>
         <td><strong>href</strong></td>
         <td><code>string</code></td>
         <td>Converts the button to href to establish a link.</td>
      </tr>
      <tr>
         <td><strong>target</strong></td>
         <td><code>boolean</code></td>
         <td>The pinning target if href is used.</td>
      </tr>
      <tr>
         <td><strong>loading</strong></td>
         <td><code>string</code></td>
         <td>Activates the loading indication on the button.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Events</b>
<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>click</strong></td>
         <td>Triggered on click, send the relevant item if available.</td>
      </tr>
   </tbody>
</table>
</div>

### List

Button for all list source actions. Redirect to list page by default. It is shown in the top header on the internal CRUD page.

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
   </tbody>
</table>
</div>

### Show

Button for all citing actions. By default it redirects to show the page.

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the default forwarding behavior for compatible buttons.</td>
      </tr>
   </tbody>
</table>
</div>

### RowShow

Vuetify performs the action of showing details on the data table using the <a href="https://vuetifyjs.com/en/components/menus/#usage" target="_blank">v-menu</a> component.

<b>Mixins</b>

* Resource
* RedirectButton

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
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
   </tbody>
</table>
</div>

### Create

Button for all resource creation actions. By default it redirects to page creation.

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the default forwarding behavior for compatible buttons.</td>
      </tr>
   </tbody>
</table>
</div>

### CreateDialog

It allows adding resources to the VaList component from within a modal window.

<b>Mixins</b>

* Resource
* RedirectButton

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
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Events</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>last-dialog</strong></td>
         <td>It is an event bus event. Allows you to close the window opened with <code>eventBus.emit("last-dialog", false)</code> after an axios http transaction.</td>
      </tr>
   </tbody>
</table>
</div>

### RowCreate

It performs the action of adding a new source by opening a blank row in the data table.

<b>Mixins</b>

* Resource
* RedirectButton

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
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
   </tbody>
</table>
</div>

### Edit

Button for all resource editing actions. By default it redirects to the edit page.

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the default forwarding behavior for compatible buttons.</td>
      </tr>
   </tbody>
</table>
</div>

### RowSaveDialog

When clicked on the data table, it opens a new modal window and performs source <b>editing/add</b> operations.

<b>Mixins</b>

* Resource
* RedirectButton

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
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, it shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color depending on the text prop value.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the default forwarding behavior for compatible buttons.</td>
      </tr>
   </tbody>
</table>
</div>

### Clone

Button for all resource cloning actions. It redirects to create a page by default with the target ID of the original source to be copied.

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color based on text prop value.</td>
      </tr>
      <tr>
         <td><strong>disableRedirect</strong></td>
         <td><code>boolean</code></td>
         <td>Disables the default forwarding behavior for compatible buttons.</td>
      </tr>
   </tbody>
</table>
</div>

### Delete

Button for all resource deletion actions. It comes with a confirmation dialog.

<b>Mixinler</b>

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
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>iconSize</strong></td>
         <td>string</td>
         <td> x-small, small, default, large, x-large</td>
      </tr>
      <tr>
         <td><strong>query</strong></td>
         <td>object</td>
         <td>Query string params</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color based on text prop value.</td>
      </tr>
      <tr>
         <td><strong>redirect</strong></td>
         <td><code>boolean</code></td>
         <td>Redirect to source list after successful deletion. If the current page source is deleted, the default redirect is active.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Events</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>click</strong></td>
         <td>Triggered on click, send the relevant item if available.</td>
      </tr>
      <tr>
         <td><strong>delete</strong></td>
         <td>Custom delete action if item does not exist. It is used for the bulk delete button, which has its own special logic.</td>
      </tr>
	  <tr>
         <td><strong>deleted</strong></td>
         <td>Triggered after successful deletion of the source element.</td>
      </tr>
   </tbody>
</table>
</div>

### Bulk Action

Global customizable button to perform bulk actions in the VaList component. Shown after item selections. Under the hood it uses the <b>copyMany</b> or <b>deleteMany</b> data provider method.

<b>Mixins</b>

* ActionButton

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
         <td><strong>value</strong></td>
         <td><code>array</code></td>
         <td>Selected resource items.</td>
      </tr>
      <tr>
         <td><strong>action</strong></td>
         <td><code>object</code></td>
         <td>The data object to be sent in the data provider method, such as <b>copyMany</b>, <b>deleteMany</b>. Contains the resource properties to be copied or deleted.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Events</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>click</strong></td>
         <td>Triggered on click, send the relevant item if available.</td>
      </tr>
      <tr>
         <td><strong>input</strong></td>
         <td>Clear selected items.</td>
      </tr>
   </tbody>
</table>
</div>

### Bulk Delete

Button to delete batch actions for VaList. Shown after item selections. It preserves all <b>VaDeleteButton</b> properties and uses the <b>deleteMany</b> data provider method.

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
         <td><strong>value</strong></td>
         <td><code>array</code></td>
         <td>Selected resource items.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Events</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>input</strong></td>
         <td>Clear selected items.</td>
      </tr>
   </tbody>
</table>
</div>

### Bulk Copy

Button to delete batch actions for VaList. Shown after item selections. It preserves all <b>VaCopyButton</b> properties and uses the <b>deleteCopy</b> data provider method.

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
         <td><strong>value</strong></td>
         <td><code>array</code></td>
         <td>Selected resource items.</td>
      </tr>
   </tbody>
</table>
</div>

<b>Events</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>input</strong></td>
         <td>Clear selected items.</td>
      </tr>
   </tbody>
</table>
</div>

### Excel Export

In the VaList component, it allows the function to be directed to the <b>excel export</b> operation in your API service.

<b>Mixins</b>

* Resource
* Button

<b>Events</b>

<div class="table-responsive">
<table class="table">
   <thead>
      <tr>
         <th>Event</th>
         <th>Description</th>
      </tr>
   </thead>
   <tbody>
      <tr>
         <td><strong>click</strong></td>
         <td>Triggered on click, send the relevant item if available.</td>
      </tr>
   </tbody>
</table>
</div>

### Save

It is the default save key that can be used for the VaForm component. It is just a send function, the VaForm component does the real work. It triggers the following function.

```js
this.formState.submit(this.redirect)
```

<b>Mixins</b>

* Resource
* Button

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
         <td><strong>block</strong></td>
         <td><code>boolean</code></td>
         <td>Expands the button to 100% of the available space.</td>
      </tr>
      <tr>
         <td><strong>item</strong></td>
         <td><code>string</code></td>
         <td>The element added to the button.</td>
      </tr>
      <tr>
         <td><strong>icon</strong></td>
         <td><code>boolean</code></td>
         <td>If true, shows the key with the icon only.</td>
      </tr>
      <tr>
         <td><strong>color</strong></td>
         <td><code>string</code>, <code>object</code></td>
         <td>Customizable background or text color based on text prop value.</td>
      </tr>
      <tr>
         <td><strong>text</strong></td>
         <td><code>boolean</code></td>
         <td>Removes the background button.</td>
      </tr>
  		<tr>
         <td><strong>label</strong></td>
         <td><code>string</code></td>
         <td>Overrides the default tag.</td>
      </tr>
      <tr>
         <td><strong>redirect</strong></td>
         <td><code>boolean</code></td>
         <td>After successful save, it redirects to the resource list.</td>
      </tr>
   </tbody>
</table>
</div>