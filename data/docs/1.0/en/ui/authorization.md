
## Authorization

In many admin panel applications, you will need users with different roles or permissions to restrict some areas. Olobase Admin supports this feature at several levels.

### Backend Priority

> What is meant here by authorization is; It is only about displaying or hiding links, actions, UI components. You should always consider that any user can fully access the user interface if they are an Admin administrator. The entire user interface can also be unlocked by typing some javascript commands into the browser console. Therefore, you should always prioritize security of permissions on the backend before any UI concerns.

### Get User Permissions

It is recommended that you review the relevant <a href="/ui/authentication.html">authentication</a> section of this guide before continuing. The said section contains everything you need to know about user authentication and retrieving user information.

As you see in the authentication guide, each authentication provider must implement a specific <b>getPermissions()</b> method. This role obtains permissions from a valid user object returned by the API via the <b>checkAuth()</b> provider method. These permissions are returned as an <b>array</b> array. Permissions can be anything you want, from a low-level special permission like <kbd>create_book</kbd> to a more general role as <kbd>editor</kbd>. It's up to you to find the appropriate level of detail you need. For example, general role-based <kbd>["editor", "author"]</kbd> or more granular permission-based <kbd>["list_author", "show_author", "list_book", "show_book", "create_book"]</kbd> we can imagine like.

### Resources

You can define specific access permissions for each action of each resource. These permissions are reflected throughout the application. In particular, the <b>getResourceLink()</b> helper hides or shows all <b>CRUD</b> action keys linked to that resource, as well as resource-specific menus. To do this, simply define a new permission for the relevant resource object:

<kbd>src/resources/index.js</kbd>

```js
export default [
  {
    name: "reviews",
    icon: "mdi-comment",
    permissions: [
      { name: "admin", actions: ["list", "show", "create", "edit", "delete"] },
      { name: "editor", actions: ["list", "show", "edit"] },
      { name: "author", actions: ["list", "show", "edit", "delete"] },
    ],
  },
]
```

The <b>Permissions</b> property is a simple string or array of objects. If you want this permission to apply to all actions, use simple string. The object format allows you to define more detailed permissions for each action of resources. Once the user has this permission, simply use <kbd>name</kbd> for the permission name and <kbd>actions</kbd> for the list of allowed actions.

### Default Behavior

By default, if no permissions are set, all authenticated users can access all processes for this resource.

### Excluded Actions

The general actions <kbd>actions</kbd> or exception <kbd>except</kbd> properties are prioritized over the <kbd>permissions</kbd> option for excluded actions only. So if you use actions or excluded features, specific permissions for excluded actions will have no effect.

### Advanced Usage

In case the resource permission API above is not enough for you, you can still pass a specific <kbd>canAction</kbd> function to the Olobase Admin options; This gives you more control for permission action filtering. It is executed on every resource link (if you are using admin.getResourceLink or admin.getResourceLinks) or on any resource CRUD action key to know whether it should be active based on user permissions.

This customizable function takes a <kbd>params</kbd> object with 3 properties:

<div class="table-responsive">
<table class="table">
	<tr>
		<th>Argument</th>
		<th>Description</th>
	</tr>
	<tr>
		<td><b>resource</b></td>
		<td>Name of the relevant resource</td>
	</tr>
	<tr>
		<td><b>action</b></td>
		<td>Desired action</td>
	</tr>
	<tr>
		<td><b>can</b></td>
		<td>A helper function that provides the ability to obtain permission directly from the authenticated user</td>
	</tr>
</table>
</div>

<kbd>src/plugins/admin.js</kbd>

```js [line-numbers] data-line="11"
import OlobaseAdmin from "olobase-admin";
//...
let admin = new OlobaseAdmin(import.meta.env);
/**
 * Install admin plugin
 */
export default {
  install: (app, http, resources) => {
    admin.setOptions({
	  //...
	  canAction: ({ resource, action, can }) => {
	    if (can(["admin"])) {
	      return true;
	    }
	    // any other custom actions on given resource and action...
	  },
	  //...
    });
    admin.init();
    OlobaseAdmin.install(app); // install layouts & components
  },
};
```

### Override or Default

If the callback returns a valid <b>boolean</b> value, the action will be considered valid regardless of the permission value set in the relevant resource. If nothing is returned, the default behavior is executed.

### Helpers

Olobase Admin gives you a global <kbd>admin.can()</kbd> helper method that you can use anywhere, allowing you to quickly test whether the current user has the capabilities. If the authenticated user has one of these, it receives an <b>array</b> string, which is the list of permissions you want to test and return true.

```html
<template>
  <va-form :id="id" :item="item">
    <va-text-input source="isbn" v-if="admin.can(['isbn_edit'])"></va-text-input>
  </va-form>
</template>
```

```js
<script>
export default {
  inject: ['admin'],
  method() {
    onSubmit() {
      if (this.admin.can(["book_edit"])) {

      }
    },
  },
};
</script>
```

### OR and && Conditions

You can use the combinations <kbd>||</kbd> and <kbd>&&</kbd> to easily hide or show links in the sidebar within the array based on permissions as in the following example:

<kbd>src/\_nav.js</kbd>

```js
export default  {

  build: async function(t, admin) {

    const user = await admin.can(["user"]);
    const adminUser = await admin.can(["user", "admin"]);

    return [
      {
        icon: "mdi-view-dashboard",
        text: i18n.t("menu.dashboard"),
        link: "/",
      },
      ...admin.getResourceLinks(["publishers", "authors", "books", "reviews"]),
      adminUser.can(["admin"]) && {
        icon: "mdi-settings",
        text: i18n.t("menu.settings"),
        link: "/settings",
      },
      (user || adminUser.can(["admin", "editor"])) && {
        icon: "mdi-message",
        text: i18n.t("menu.feedback"),
        link: "/feedback",
      },
      { icon: "mdi-help-circle", text: i18n.t("menu.help"), link: "/help" },
    ];

  } // end func

} // end class
```