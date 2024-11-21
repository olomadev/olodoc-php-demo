
## Olobase Component List

1. <a href="/ui/all-components.html#Layout">Layout</a>
		- <a href="/ui/all-components.html#AppBar">AppBar</a>
		- <a href="/ui/all-components.html#Aside">Aside</a>
		- <a href="/ui/all-components.html#Breadcrumbs">Breadcrumbs</a>
		- <a href="/ui/all-components.html#Footer">Footer</a>
		- <a href="/ui/all-components.html#Messages">Messages</a>

2. <a href="/ui/all-components.html#Listing">Listing</a>
		- <a href="/ui/all-components.html#DataTableServer">DataTableServer</a>
		- <a href="/ui/all-components.html#DataIteratorServer">DataIteratorServer</a>

3. <a href="/ui/all-components.html#Inputs">Inputs</a>
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

4. <a href="/ui/all-components.html#Others">Others</a>
		- <a href="/ui/all-components.html#LanguageSwitcher">LanguageSwitcher</a>

## Layout

Layout, also known as <b>VaLayout</b>, is the main layout component that wraps the components shown in the following examples.

### AppBar

AppBar is one of the main component that create components such as hierarchical menu and user profile with the Vuetify <a href="https://vuetifyjs.com/en/components/navigation-drawers/#usage" target="_blank">VNavigationDrawer</a> component.

![AppBar](/images/sidebar.png)

### Aside

It is a customizable view where you can put some additional information. VaAsideLayout component is used to integrate content from anywhere, in any context.

![Aside](/images/aside.png)

### Breadcrumbs

Breadcrumbs utomatically creates hierarchical links from the current route using the <a href="https://vuetifyjs.com/en/components/breadcrumbs/#usage" target="_blank">v-breadcrumbs</a> component.

![Breadcrumbs](/images/breadcrumbs.png)

### Footer

This area is the footer area that allows some corporate information to be displayed within the <a href="https://vuetifyjs.com/en/components/footers/" target="_blank">VFooter</a> component.

![SideBar](/images/footer.png)

### Messages

This component is used to show special status messages such as <b>info, error, warning, success</b> using the vuetify <a href="https://vuetifyjs.com/en/components/snackbars/#usage" target="_blank">v-snackbar</a> component.

![Messages](/images/success.png)


## Listing

The List component allows displaying the settings, filters and parent options of the data table.

### DataTableServer

Using the Vuetify <a href="https://vuetifyjs.com/en/components/data-tables/server-side-tables/#examples" target="_blank">v-data-table-server</a> component it is used to paginate a list that follows a grid structure. It includes features such as sorting, search, pagination, filtering and selection. The list layout within the default slot is fully customizable.

![Advanced Filters](/images/advanced-filters.png)

### DataIteratorServer

Viewing data that does not fit the grid structure or needs to be customized using the Vuetify <a href="https://vuetifyjs.com/en/components/data-iterators/#usage" target="_blank">v-data-iterator</a> component and is similar to the <b>va-data-table-server</b> component in terms of functionality. It also includes features such as sorting, search, pagination, filtering and selection. The list layout within the default slot is fully customizable.

![Data Iterator Server](/images/data-iterator-server.png)

## Inputs

Input components allow editing of specific properties of the current API resource object. It is mainly used in <a href="/ui/form.html" target="_blank">form</a>s to create and edit views.

### ArrayTableInput

It allows multiple data entries as arrays in tabular format. Supports adding new data, deleting and updating data.
 
![ArrayTableInput](/images/array-table-input.png)

### AutoCompleteInput

Allows selection of value or values from searchable options. Supports multiple selections and references. Allows searching for linked resources from your API service.

![AutoCompleteInput](/images/autocomplete-input.png)

### AvatarInput

It facilitates the creation of a user's profile picture with cutting and shrinking options.

![AvatarInput](/images/avatar-input.png)

### BooleanInput

When a value is sent to a boolean input type as <b>boolean</b> or <b>0/1</b>, the input is displayed as a toggle button.

![BooleanInput](/images/boolean-input.png)

### CheckListInput

It enables the creation together of checkbox input components grouped under each other at the first level. Features such as the toggle feature, the ability to select all entries with a higher checkbox, and searching within the list are supported by default.

![CheckListInput](/images/checklist-input.png)

### ColorPickerInput

It creates the component that makes it easy to select HEX color codes.

![ColorPickerInput](/images/color-picker-input.png)

### CurrencyInput

It displays the currency sent to it according to the desired format using the <a href="https://www.npmjs.com/package/vue-currency-input" target="_blank">vue-currency-input</a> component.

![CurrencyInput](/images/currency-input.png)

### DateInput

It is used to edit the date type value. Vuetify consists of a read-only text field associated with the date picker. It does not support time value, use classic VaTextInput for this case.

![DateInput](/images/date-input.png)

### FileInput

Allows single line file uploads. Single or multi uploads are supported simultaneously. Use <b>VaFileField</b> or <b>VaImageField</b> with this element to show a preview of uploaded files.

![FileInput](/images/file-input2.png)

### NumberInput

Optimized for number editing. Supports min, max and step features.

![NumberInput](/images/number-input.png)

### PasswordInput

Used for password fields. There is show/hide behavior for the current input.

![PasswordInput](/images/password-input.png)

### RadioGroupInput

Bir seçim listesinden değer seçmenizi sağlar. Referansları destekler. Hiçbir seçenek yoksa, varsayılan olarak, <b>src/I18n/locales/tr.json</b> dosyasından kaynak içeren yerelleştirilmiş listeleri alabilir.

Lets you select values from a selection list. Supports references. If no options are available, by default it can retrieve localized lists containing resources from <b>src/I18n/locales/tr.json</b>.

![RadioGroupInput](/images/radio-group-input.png)
![RadioGroupInput Horizontal](/images/radio-group-input-hr.png)

### RatingInput

Edit the number value as rating stars. If half increments are enabled, the value must be a valid integer or decimal number. Icons can be edited via $ratingFull, $ratingEmpty and $ratingHalf in Vuetify settings.

![RatingInput](/images/rating-input.png)

### RichTextInput

Create a <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">WYSIWYG</a> HTML editor using <a href="https://trix-editor.org/" target="_blank">Trix</a>.

![RichTextInput](/images/rich-text-input.png)

### TinyMceInput

Create a <a href="https://en.wikipedia.org/wiki/WYSIWYG" target="_blank">WYSIWYG</a> HTML editor using <a href="https://tiny.cloud/" target="_blank">Tinc MCE</a> GPL license.

![TinyMceInput](/images/tiny-mce-input.png)]

### SelectInput

Lets you select a value or values from a selection list. Supports multiple selections and references. If no options are available, by default it can retrieve localized lists containing resources from <b>src/I18n/locales/en.json</b>.

![SelectInput](/images/select-input.png)

### SheetInput

It is the input component that allows you to read large amounts of Excel data and add it to the database in CLI mode. To save the imported data, it should be used with a sheet saving template that you have created yourself.

![SheetInput](/images/sheet-input-list2.png)

### TextInput

Edits text for text value type via basic text input. Supports textarea mode for long texts via multi-line support. Can be used for any date, datetime or time arrangement; Use date, datetime-local, or time-based type. Processing will depend on browser support.

![TextInput](/images/text-input.png)

## Others

Components that do not meet all 3 items above are listed here under "Others".

### LanguageSwitcher

The LanguageSwitcher component allows the user to specify the default language value.

![LanguageSwitcher](/images/switch-locale.png)