
# Prism Js

<a href="https://prismjs.com/" target="_blank">Prism</a> is a lightweight, extensible syntax highlighter, built with modern web standards in mind. It’s used in millions of websites, including some of those you visit daily.

## Changing Your Theme

To change your default theme go to:

1. Prism js <a href="https://prismjs.com/download.html" target="_blank">download page</a>. And click on a theme you like on the right side of the page.

![Prism Download](/images/prism-download.png)

2. Then you need to click on the <b>download css button</b> as seen in the following image.

![Prism Download Buttons](/images/prism-download-buttons.png)

3. Finally copy your new <b>prism.css</b> file and paste it to <kbd>/src/css/</kbd> folder in your <b>olodoc-boostrap</b> template generator project.

```sh
- olodoc-bootstrap
  + node_modules
  - src
  	- css
  		_variables.scss
  		fonts.scss
  		olodoc.css
  		prism.css
  		styles.scss
  	+ dist
  	+ images
  	+ js
  + views
  .gitignore
  package.json
  server.js
  vite.config.js
```

To create <b>production-ready</b> css files, you need to refer to the <a href="/customizations.html">customizations</a> page.