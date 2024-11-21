
## Resources

<b>Resource</b> means a specific server asset that can be managed by Olobase Admin, i.e. <kbd>created/read/updated/deleted</kbd>. The resources must correspond to a valid API endpoint that allows all these CRUD operations. The following code example represents an example of the expected structure that should be sent to the Olobase Admin constructor method as seen before:

<kbd>src/resources/index.js</kbd>

```js
export default [
  {
    name: "users",
    icon: "mdi-account",
    label: "name",
    routes: ["list"],
    permissions: ["admin"],
  },
  {
    name: "userss",
    icon: "mdi-alien",
    label: "name",
    translatable: true,
    permissions: ["admin", "anotherrole"],
  },
  {
    name: "users-children",
    icon: "mdi-baby-carriage",
    label: "name",
    except: ["delete"],
  },
];
```

### Resource Object Structure

A resource object must follow this structure:

<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th>Key</th>
			<th>Type</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong>name</strong>
			</td>
			<td><code>string</code></td>
			<td>A mandatory unique resource name to use for the client-side router base path.</td>
		</tr>
		<tr>
			<td><strong>api</strong></td>
			<td><code>string</code></td>
			<td>Corresponds to API base path calls. By default it is equal to the name above.</td></tr>
			<tr>
				<td><strong>icon</strong></td>
				<td><code>string</code>
			</td>
			<td>Descriptive icon in the sidebar or list page. It must be one of the icons in the <a href="https://pictogrammers.com/library/mdi/" target="_blank">MDI</a> icon list.
			</td>
		</tr>
		<tr>
			<td><strong>label</strong></td>
			<td><code>string</code>, <code>function</code></td>
			<td>A name that identifies an instantiated resource.</td>
		</tr>
		<tr>
			<td><strong>include</strong></td>
			<td><code>array</code>, <code>object</code></td>
			<td>Some additional object or arrays to be added to data providers for all <code>GET</code> based methods for other actions within the data provider.</td>
		</tr>
		<tr>
			<td><strong>routes</strong></td>
			<td><code>array</code></td>
			<td>List of available routes for this resource.</td>
		</tr>
		<tr>
			<td><strong>actions</strong></td>
			<td><code>array</code></td>
			<td>List of valid actions for this resource.</td>
		</tr>
		<tr>
			<td><strong>except</strong></td>
			<td><code>array</code></td>
			<td>Denied actions are not used if <code>actions</code> is explicitly set.</td>
		</tr>
		<tr>
			<td><strong>translatable</strong></td>
			<td><code>boolean</code></td>
			<td>Specifies whether this resource can be translated.</td>
		</tr>
		<tr>
			<td><strong>permissions</strong></td>
			<td><code>array</code></td>
			<td>Role list that enables activating the resource based on user permissions.</td>
		</tr>
		<tr>
			<td><strong>autocompleteFields</strong></td>
			<td><code>array</code></td>
			<td>List of source fields to return from API in VaAutocompleteInput to prevent overfetching.</td>
		</tr>
		</tbody>
</table>
</div>

### Label

The label property can take a string or a function and is equal to the label property by default. As the name of a user resource, use a string for the simple case that represents a valid property of the targeted resource. Using a function, which is a simple callback that takes the full source API object, allows you to return a more complex combination of properties, such as (r) => `${r.title} (${r.isbn})`.

This tag will be used as the default page title for all reference-based fields and entries (<b>VaReferenceField, VaReferenceArrayField, VaAutocompleteInput, VaSelectInput, VaRadioGroupInput</b>) as well as displaying and organizing each CRUD page.

### Actions

For actions you must choose between list <b>/ show / create / edit / delete</b>. If no actions or exceptions are set, all 5 actions are enabled by default. All removed actions will be reflected in all crud pages and Vue Router will adapt accordingly. For example, if you set anything other than ["show"], showing the route will be disabled and any show actions (mostly buttons) associated with that resource will be disabled.

### Disabling Actions

> Note that this will only disable client-side rendering routes and change the behavior of action buttons. The all actions method is always available in the source API module. Adapt the permissions in your backend accordingly to prevent unwanted actions.

### Reuse API Endpoints

You can perfectly reuse the same backend resource API endpoint for different resources. Imagine a first set of crud pages showing only active sources, and a separate second set of crud pages showing only archived ones. Use the API feature for this. It will override the API default base path in the resource repository module. Then every CRUD page in <b>src/resources/{name-1}</b> and <b>src/resources/{name-2}</b> will use the same API endpoint.

Check out the following example:

```js [line-numbers] data-line="11"
export default [
  {
    name: "users",
    icon: "mdi-account",
    label: "name",
    routes: ["list"],
    permissions: ["admin"],
  },
  {
    name: "archived-users",
    api: "users",
    icon: "mdi-account",
    label: "name",
    routes: ["list"],
    permissions: ["admin"],
  },
];
```

With the above configuration, the <b>archived-users</b> resource will be able to reuse the same API endpoints as the <b>users</b> resource.

### Resource CRUD Pages and API Modules

The above source information is basically enough for Olobase Admin to recreate all the necessary CRUD routes and API action structures. Each CRUD route looks for a component named <kbd>${ResourceName}${Action}</kbd>. And 4 action pages are supported: <b>List</b>, <b>Show</b>, <b>Create</b> and <b>Edit</b>. Therefore, for a specific resource called <b>users</b> and a creation route, Olobase Admin searches the <b>UsersCreate</b> page component. If not found, it returns to a 404 error page. So all you have to do is save all your CRUD source pages with this component naming convention in mind. To make this tedious task easier, the <kbd>src/plugins/loader.js</kbd> file imports these files and searches for all <v>.vue</v> files in the <kbd>src/resources</kbd>directory and <b>automatically</b> saves them in the main Vue instance, giving them an appropriate component name. So you just need to create a <b>.vue</b> component that will get the name of the resource for each action within a resource folder.

An example of Users resources:

```html
resources
├── users-children (Kebab case format of source information or name)
│   ├── Create.vue
│   ├── Edit.vue
│   ├── Form.vue (Reused form component for both Create.vue and Edit.vue views)
│   ├── List.vue
│   └── Show.vue
│
├── users (There is no need for Create.vue or Edit.vue files here as we use the direct listing feature for this)
│   ├── Form.vue
│   ├── List.vue
│   └── Show.vue
│
└── index.js (Resources file descriptor as seen above)
```

### Compound Name

> If the name source is a compound format, use a hyphen or dash between each word (this is the kebab case format). Example: <b>users-children</b>.

### Action Mapping

Some quick tables to persist (we take the resource name <b>users-children</b> as an example).

### Action Route and API Mapping

<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th>Action</th>
			<th>Vue Route</th>
			<th>API Call Format</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong>list</strong>
			</td>
			<td><code>/users-children</code></td>
			<td><strong>GET</strong> <code>/users-children</code></td>
		</tr>
		<tr>
			<td><strong>show</strong></td>
			<td><code>/users-children/{id}</code></td>
			<td><strong>GET</strong> <code>/users-children/{id}</code></td>
		</tr>
		<tr>
			<td><strong>create</strong></td>
			<td><code>/users-children/create</code></td>
			<td><strong>POST</strong> <code>/users-children</code></td>
		</tr>
		<tr>
			<td><strong>edit</strong></td>
			<td><code>/users-children/{id}/edit</code></td>
			<td><strong>PUT</strong> <code>/users-children/{id}</code></td>
		</tr>
		<tr>
			<td><strong>delete</strong></td>
			<td>-</td>
			<td><strong>DELETE</strong> <code>/users-children/{id}</code></td>
		</tr>
	</tbody>
</table>
</div>

### Action Component Mapping

<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th>Action</th>
			<th>Vue Component</th>
			<th>"src/resources" file path</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>list</strong></td>
			<td><code>UsersChildrenList</code></td>
			<td><code>/users-children/List.vue</code></td>
		</tr>
		<tr>
			<td><strong>show</strong></td>
			<td><code>UsersChildrenShow</code></td>
			<td><code>/users-children/Show.vue</code></td>
		</tr>
		<tr>
			<td><strong>create</strong></td>
			<td><code>UsersChildrenCreate</code></td>
			<td><code>/users-children/Create.vue</code></td>
		</tr>
		<tr>
			<td><strong>edit</strong></td>
			<td><code>UsersChildrenEdit</code></td>
			<td><code>/users-children/Edit.vue</code></td>
		</tr>
	</tbody>
</table>
</div>

### Injected Props

The following accessories are added to each CRUD page for easy reuse:

<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th>Eylem</th>
			<th>Vue Component Name</th>
			<th>"src/Resources" File Path</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><strong>resource</strong></td>
			<td><code>object</code></td>
			<td>Source object identifier based on the current route</td>
		</tr>
		<tr>
			<td><strong>title</strong></td>
			<td><code>string</code></td>
			<td>Localized title of the source action page</td>
		</tr>
		<tr>
			<td><strong>id</strong></td>
			<td><code>id</code></td>
			<td>The ID of the current resource to view or edit</td>
		</tr>
		<tr>
			<td><strong>item</strong></td>
			<td><code>object</code></td>
			<td>Current item to view, edit or copy</td>
		</tr>
		<tr>
			<td><strong>permissions</strong></td>
			<td><code>array</code></td>
			<td>Current user permissions</td>
		</tr>
	</tbody>
</table>
</div>

### Link Helpers

You may need to place some links in your app, especially in the sidebar, that point to listing or creating resource pages. For this, you can use the <b>getResourceLink()</b> and <b>getResourceLinks()</b> helper methods that will create this format for you. Additionally these helpers will test the permissions of existing users for this particular action of this resource and return <code>false</code> if it fails.

The code example that follows will return a link object to the user page list with the resource icon as well as the localized resource tag. Simply embed this function into any valid layout menu prop as it is a link object. You don't need to mess around with permissions or add a <b>null</b> test because an incorrect menu will not be created.

```js
[
  //...
  this.admin.getResourceLink("users"),
  //...
]
```

Use <b>getResourceLinks()</b> to create many resource links at once. This method will only return links for which users have resource action permissions.

```js
[
  //...
  ...this.admin.getResourceLinks([
    "publishers",
    "authors",
    "books",
    "reviews",
  ]),
  //...
]
```

For these helpers, you can pass the full connection object instead of the resource name, which will override the generated default. For example, this code will create a new link to the user creation page with a plus symbol and <b>"Create new user"</b> as text:

```js
[
  //...
  this.admin.getResourceLink({ name: "users", action: "create", icon: "mdi-plus", text: "Create new user" }),
  //...
]
```

The <b>getResourceLinks()</b> helper accepts a hierarchical menu as follows:

```js
[
  //...
  ...admin.getResourceLinks([
    {
      icon: "mdi-globe-model",
      text: "Publishers",
      expanded: true,
      children: [
        admin.getResourceLink({ name: "publishers", icon: "mdi-view-list", text: "List" }),
        admin.getResourceLink({ name: "publishers", icon: "mdi-plus", text: "Create" }),
      ],
    },
    "authors",
    "books",
    "reviews",
  ]),
  //...
]
```