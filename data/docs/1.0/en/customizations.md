
# Boostrap Templating

Olodoc is written with <a href="https://getbootstrap.com/docs/5.3/getting-started/introduction/" target="_blank">Boostrap 5</a> css framework and supports extensive customizations. Before creating a new documentation project, you may want to customize the colors or components of your project. Customization operations can be easily done with the <a href="https://github.com/olomadev/olodoc-bootstrap" target="_blank">Olodoc Boostrap + Vite Skelethon</a> template generation tool, follow the steps below.

## Template Generator Installation 

Run the template generator by following the steps below. First clone the olodoc-bootstrap repository.

```sh
git cloone git@github.com:olomadev/olodoc-bootstrap.git
```

Enter your project root.

```sh
cd /var/www/olodoc-bootstrap
```

Install node modules.

```sh
npm i
```

Run the application

```sh
npm run dev
```

Visit your local address from your browser.

![Localhost](/images/localhost.png)

## Customize Your Template

The template generator allows you to create your documentation using the colors and fonts you want by changing the values of the <b>.scss</b> variables.

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

Open your <b>\_variables.scss</b> file and change the <b>$primary:  #0a7248;</b> variable's value as <b>#f75b00</b>.

```scss [line-numbers] data-line="5"
//
// All Boostrap Variables: 
// Here -->  https://github.com/twbs/bootstrap/blob/main/scss/_variables.scss
//
$primary: #f75b00; //  #0a7248;
$secondary: #636363;
$success: #42ba96;
$info: #7c69ef;
$warning: #fad776;
$danger: #df4759;
// ...
```

Run the application again

```sh
npm run dev
```

![Localhost](/images/localhost.png)

Visit your local address from your browser, if everything went well you will see that the template main colors have changed as below.

![Boostrap Sass Customization](/images/bootstrap-sass-customization.png)

## Exporting Production Ready Css Files

1. Go to your command line type build command.

```sh
npm run build
```

if everything went well you will see the built message like below.

```sh
✓ 92 modules transformed.
dist/index.html                  14.69 kB │ gzip:  4.21 kB
dist/assets/index-BJBYL9CF.css  313.94 kB │ gzip: 41.29 kB
dist/assets/index-C1TT0zOb.js   121.41 kB │ gzip: 25.79 kB
✓ built in 4.17s
root@localhost:/var/www/olodoc-bootstrap# 
```

2. Copy your generated <b>index-\**.css</b> and <b>index-\**.js</b> files.

```sh
- olodoc-bootstrap
  - dist
  	- assets
  		index-BJBYL9CF.css
  		index-C1TT0zOb.js
  	index.html
  + node_modules
  + views
  .gitignore
  package.json
  server.js
  vite.config.js
```

3. Then paste them into your php project <kbd>/public/assets/</kbd> directory.

```sh
- olodoc-skeleton
  + bin
  + config
  + data
  - public
  	- assets
  		+ css
  		+ img
  		+ js
  		index-BJBYL9CF.css
  		index-C1TT0zOb.js
	  + images
	  .htaccess
	  index.php
	  robots.txt
	  sitemap.xml
  + src
  + templates
  + vendor
  .gitignore
  composer.json
```

4. Finally you need update new filenames which they located in <kbd>/templates/layouts/default.phtml</kbd> file.

```html [line-numbers] data-line="11,12"
<!DOCTYPE html>
<html lang="<?php echo LANG_ID?>">
<head>
  <?php echo $this->headTitle().PHP_EOL; ?>
  <meta charset="utf-8" />
  <meta name="author" content="Oloma Software">
  <?php echo $this->headMeta().PHP_EOL; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php echo $this->headLink().PHP_EOL; ?>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script type="module" crossorigin src="/assets/index-C1TT0zOb.js"></script>
  <link rel="stylesheet" crossorigin href="/assets/index.BJBYL9CF.css">
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-touch-icon.png">
```

Visit your php application from your browser.

![Skeleton Php Application Localhost](/images/example-local.png)