
## İkonlar

Olobase Admin çerçevesinde, tüm ikonlar için varsayılan olarak Material Design Icons (mdi) serisinin <kbd>7.0.96</kbd> versiyonunu kullanılmaktadır. Eğer ikon versiyonunu yükseltmek istiyorsanız tek yapmanız gereken;

```bash
npm remove @mdi/font
```

komutu ile geçerli versiyonu kaldırıp,

```bash
npm install @mdi/font --save
```

komutu ile güncel versiyona yükseltmek. Mdi ikon kütüphanesine aşağıdaki linkten ulaşabilirsiniz.

<a href="https://pictogrammers.com/library/mdi/" target="_blank">https://pictogrammers.com/library/mdi/</a>

<a href="https://pictogrammers.com/library/mdi/" target="_blank">
![Material Design Icons](/images/mdi-icons.png)
</a>

### Örnekler

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

İkonları navigasyon menü ana linklerde de aşağıdaki örnekte olduğu gibi kullanabilirsiniz.

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
