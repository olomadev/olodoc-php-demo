
## Data Providers

The main purpose of Olobase Admin is to manage remote resources from a specific API. When it needs to communicate with your backend API for any standardized CRUD operation, it calls the adapted method in your provider that will be responsible for fetching or updating the resource data.

```html
- packages
	- admin
		- providers
			- data
				jsonServer.js
```

<tab>
<title>List|Create|Update|Delete</title>
<content>

```js
// Fetching books
let { data, total } = await provider.getList("books", { page: 1, perPage: 10 });
console.log(data);

// Fetching one book
let { data } = await provider.getOne("books", { id: 1 });
console.log(book)
```
<tcol>

```js
// Create new book
await provider.create("books", { data: { title: "My title" } })
```
<tcol>

```js
// Update title book
await provider.update("books", { id: book.id, data: { title: "New title" } });
```
<tcol>

```js
// Delete book
await provider.delete("books", { id: book.id });
```
</content>
</tab>

All fetch methods of a data provider are standardized to ensure compatibility of Olobase Admin with any API server. This is the adapter model that allows for all kinds of different providers for each type of backend of any exchange protocol, whether it's REST, GraphQL, or even SOAP.

![Data Providers](/images/data-providers.jpg)

To give Olobase Admin the ability to retrieve remote source data, a specific data provider needs to be injected into the constructor method as explained in the next section. This data provider defaults to <kbd>JsonServerProvider</kbd>.

### API Contract

As always with any adapter model approach, all data providers must comply with a specific contract to allow communication with Olobase Admin. The next object represents the minimum contract that must be implemented:

```js [line-numbers]
const dataProvider = {
  getList:    (resource, params) => Promise,
  getOne:     (resource, params) => Promise,
  getMany:    (resource, params) => Promise,
  create:     (resource, params) => Promise,
  update:     (resource, params) => Promise,
  updateMany: (resource, params) => Promise,
  delete:     (resource, params) => Promise,
  deleteMany: (resource, params) => Promise,
  copy:       (resource, params) => Promise,
  copyMany:   (resource, params) => Promise,
}
```

### Supported API Operation Methods

<div class="table-responsive">
<table class="table">
  <tr>
    <td><b>getList</b></td>
    <td>
      <kbd>Data Iterator</kbd> component for displaying a list of resources within a data table or any custom list layout components. It also supports searching, filtering, sorting, and optional relationship fetching.
    </td>
  </tr>
  <tr>
    <td><b>getOne</b></td>
    <td>It is used to show details of the resource, especially the <kbd>Show</kbd> action or the data table show actions.</td>
  </tr>
  <tr>
    <td><b>getMany</b></td>
    <td>It is used only for the <kbd>AutoCompleter</kbd> component to fetch all available selections by IDs on initial load, whether in editing page content or query context filtering.</td>
  </tr>
  <tr>
    <td><b>create</b></td>
    <td>Used by <kbd>VaForm</kbd> to create new resources.</td>
  </tr>
  <tr>
    <td><b>update</b></td>
    <td>Used by <kbd>VaForm</kbd> to update the existing resource.</td>
  </tr>
  <tr>
    <td><b>delete</b></td>
    <td>Simple delete action called when interacting with <kbd>Delete Button</kbd>.</td>
  </tr>
</table>
</div>

### Setting Up a Data Provider

Data providers are very simple to use. They can take a simple API URL or a custom HTTP client of your choice as the first <kbd>constructor</kbd> argument. If you need to share some headers throughout the admin application, use the full object; It's especially useful for authentication-related topics.

<kbd>src/plugins/admin.js</kbd>

```js [line-numbers] data-line="27"
import {
  jsonServerDataProvider,
  jwtAuthProvider,
} from "olobase-admin/src/providers";
import { en, tr } from "olobase-admin/src/locales";
import config from "@/_config";

let admin = new OlobaseAdmin(import.meta.env);
/**
 * Install admin plugin
 */
export default {
  install: (app, http, resources) => {
    // console.error(app.config.globalProperties)
    admin.setOptions({
      app,
      router,
      resources,
      store,
      i18n,
      dashboard: "dashboard",
      downloadUrl: "/files/findOneById/",
      readFileUrl: "/files/readOneById/",
      title: "Demo",
      routes,
      locales: { en, tr },
      dataProvider: jsonServerDataProvider(http),
      authProvider: jwtAuthProvider(http),
      http,
      canAction: null,
      // canAction: ({ resource, action, can }) => {
      //   if (can(["admin"])) {
      //     return true;
      //   }
      //   // any other custom actions on given resource and action...
      // },
      options: config,
    });
    admin.init();
    OlobaseAdmin.install(app); // install layouts & components
    app.provide("i18n", i18n);
    app.provide("router", router);
    app.provide("admin", admin); // make injectable
    app.component("PageNotFound", PageNotFound);
  },
};
```

### Writing Your Own Data Provider

Writing your own data provider is pretty simple. Note the method call signatures by copying the JsonServerProvider.
As mentioned before each provider method takes 2 arguments:

* resource: represents the string name of the relevant resource and must be the resource API URL base for each call.
* params : a specific object tailored to each type of API call.

### Method Call Signatures

The following table lists which parameters can be sent in the second parameter for each provider method.

<div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th>Method</th>
      <th>Description</th>
      <th>Parameter Format</th>
      <th>Response</th>
    </tr>  
  </thead>
  <tbody>
    <tr>
      <td>getList</td>
      <td>Lists data</td>
      <td>
        { pagination: { page: Number , perPage: Number }, sort: [{ by: String, desc: Boolean }], filter: Object }, include: String[], fields: { [resource]: String[] } }
      </td>
      <td>{ data: Resource[], total: Number }</td>
    </tr>
    <tr>
      <td>getOne</td>
      <td>Returns a resource (data) by id</td>
      <td>{ id: Any }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>getMany</td>
      <td>Returns multiple data based on id</td>
      <td>{ ids: Array, include: String[], fields: { [resource]: String[] } }</td>
      <td>{ data: Resource[] }</td>
    </tr>
    <tr>
      <td>create</td>
      <td>Creates new data</td>
      <td>{ data: Object }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>update</td>
      <td>Updates a default resource (data)</td>
      <td>{ id: Any, data: Object }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>updateMany</td>
      <td>Updates multiple data</td>
      <td>{ ids: Array, data: Object }</td>
      <td>empty</td>
    </tr>
    <tr>
      <td>delete</td>
      <td>Deletes current data</td>
      <td>{ id: Any }</td>
      <td>empty</td>
    </tr>
    <tr>
      <td>deleteMany</td>
      <td>Deletes multiple data</td>
      <td>{ ids: Array }</td>
      <td>empty</td>
    </tr>
    <tr>
      <td>copy</td>
      <td>Copies the selected data</td>
      <td>{ id: Any }</td>
      <td>{ data: Resource }</td>
    </tr>
    <tr>
      <td>copyMany</td>
      <td>Copies multiple selected data</td>
      <td>{ ids: Array }</td>
      <td>{ data: Resource }</td>
    </tr>
  </tbody>
</table>
</div>

Here are some valid examples of calls to Olobase Admin in each resource repository module:

```js
dataProvider.getList("books", {
  pagination: { page: 1, perPage: 15 },
  sort: [{ by: "publication_date", desc: true }, { by: "title", desc: false }],
  filter: { author: "Cassandra" },
  include: ["media", "reviews"],
  fields: { books: ["isbn", "title"], reviews: ["status", "author"] }
});
dataProvider.getOne("books", { id: 1 });
dataProvider.getMany("books", { ids: [1, 2, 3] });
dataProvider.create("books", { data: { title: "Lorem ipsum" } });
dataProvider.update("books", { id: 1, data: { title: "New title" } });
dataProvider.updateMany("books", { ids: [1, 2, 3], data: { commentable: true } });
dataProvider.delete("books", { id: 1 });
dataProvider.deleteMany("books", { ids: [1, 2, 3] });
```

### Handling Errors

In case of any server side errors, i.e. when the response status is outside the 2xx range, you simply return a rejection promise with a specific Object containing at least a descriptive error message as well as the HTTP status code. This status is passed to the authentication provider to allow you to perform a specific authentication action based on a specific status code.

In case of multiple errors, we return to <kbd>error</kbd>, and in case of an empty response or server error from the server, we return to the general <kbd>error</kbd> error.

```js
try {
  let response = await this.admin.http('post', url, data);
} catch (e) {
    if (
      && e.response 
      && e.response.status === 400 
      && e.response["data"] 
      && e.response["data"]["data"]
      && e.response["data"]["data"]["error"]
      ) {
      this.admin.message("error", e.response.data.data.error);
    }
}
```
Expected error object format:

<div class="table-responsive">
<table class="table">
  <tr>
    <th>Key</th>
    <th>Type</th>
    <th>Description</th>
  </tr>
  <tr>
    <td>error</td>
    <td>string</td>
    <td>Error message to be displayed in Snackbar</td>
  </tr>
  <tr>
    <td>status</td>
    <td>number</td>
    <td>Response status code sent by the server</td>
  </tr>
  <tr>
    <td>errors</td>
    <td>array</td>
    <td>Error objects sent by the server for client-side validation support</td>
  </tr>
</table>
</div>

### Store

You can use all data provider methods for each resource in your custom <b>CRUD</b> pages or any authenticated custom page directly from the <b>Vuex</b> store. You have 2 different methods, one with the mapActions <b>Vuex</b> helper and the other with the global <b>$store</b> instance where you can use dispatch.

The following code shows both ways of getting data from your providers under one example:

```js [line-numbers]
<template>
  <v-row>
    <v-col v-for="item in data" :key="item.id">
      {{ item.name }}
    </v-col>
  </v-row>
</template>

<script>
import { mapActions } from "vuex";

export default {
  data() {
    return {
      data: [],
    }
  },
  async mounted() {
    /**
     * Use the global vuex store instance.
     * You need to provide the name of the resource followed by the provider method you want to call.
     * Each provider methods needs a `params` argument which is the same object described above.
     */
    this.data = await this.$store.dispatch("publishers/getList", {
      pagination: {
        page: 1,
        perPage: 5,
      },
    });

    /**
     * Use the registered global method which use global `api` store module.
     * Then you need to provide a object argument of this format : `{ resource, params }`
     */
    this.data = await this.getList({
      resource: "publishers",
      params: {
        pagination: {
          page: 1,
          perPage: 5,
        },
      },
    });
  },
  methods: {
    ...mapActions({
      getList: "api/getList",
    }),
  },
};
</script>
```

