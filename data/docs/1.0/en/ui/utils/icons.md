
## Icons

In the Olobase Admin framework, the <kbd>7.0.96</kbd> version of the Material Design Icons (mdi) series is used by default for all icons. If you want to upgrade the icon version, all you have to do is;

```bash
npm remove @mdi/font
```

uninstall the current version with the command,

```bash
npm install @mdi/font --save
```

upgrade to the current version with the command. You can access the Mdi icon library from the link below.

<a href="https://pictogrammers.com/library/mdi/" target="_blank">https://pictogrammers.com/library/mdi/</a>

<a href="https://pictogrammers.com/library/mdi/" target="_blank">
![Material Design Icons](/images/mdi-icons.png)
</a>

### Examples

<tab>
<title>Icons|Template</title>
<content>
![Icons](/images/icons.png) <tcol>

```html
<template>
  <div>
    <v-card>
      <v-card-text>        
          <v-icon 
            size="large"
            icon="mdi-circle-slice-4"
            class="mb-3"
            color="success"
          >    
          </v-icon>
          <v-divider class="mb-3"></v-divider>
          <v-icon
            size="large"
            color="primary"
            class="mb-3"
            icon="mdi-circle"
          ></v-icon>
          <v-divider class="mb-3"></v-divider>
          <v-btn 
            prepend-icon="mdi-content-save-cog"
            class="mb-3"
            >
          Save
          </v-btn>
          <v-divider class="mb-3"></v-divider>
          <v-btn 
            append-icon="mdi-content-save-cog"
            class="mb-3"
            >
          Save
          </v-btn>
      </v-card-text>
    </v-card>
  </div>
</template>
```
</content>
</tab>

You can also use icons in navigation menu main links, as in the example below.

<kbd>src/\_nav.js</kbd>

```js [line-numbers] data-line="10"
export default  {

  build: async function(t, admin) {

    const user = await admin.can(["user"]);
    const adminUser = await admin.can(["user", "admin"]);

    return [
      {
        icon: "mdi-view-dashboard-outline",
        text: t("menu.dashboard"),
        link: "/dashboard",
      },
      // { divider: true },
    ]
  }
}
```
