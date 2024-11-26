
# Extended Syntax

The basic syntax outlined in the original Markdown design document includes many elements needed in everyday life, but for some people it was not enough. This is where the extended syntax comes in.

Many people and organizations have undertaken to extend the basic syntax by adding additional elements such as tables, alerts, code blocks, syntax highlighting, tabs etc.

## Tables

To create stylish html tables you should use <b>boostrap</b> css names in the html table code class attribute.

### Basic Table

Basic table example:

```html
<table class="table">
  <thead>
    <tr>
      <th>Syntax</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Header</td>
      <td>Title</td>
    </tr>
    <tr>
      <td>Paragraph</td>
      <td>Text</td>
    </tr>
  </tbody>
</table>
```
The rendered output looks like this:

<table class="table">
  <thead>
    <tr>
      <th>Syntax</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Header</td>
      <td>Title</td>
    </tr>
    <tr>
      <td>Paragraph</td>
      <td>Text</td>
    </tr>
  </tbody>
</table>

### Bordered Table 

Bordered table example:

```html
<table class="table table-bordered">
  <thead>
    <tr>
      <th>Syntax</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Header</td>
      <td>Title</td>
    </tr>
    <tr>
      <td>Paragraph</td>
      <td>Text</td>
    </tr>
  </tbody>
</table>
```

The rendered output looks like this:

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Syntax</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Header</td>
      <td>Title</td>
    </tr>
    <tr>
      <td>Paragraph</td>
      <td>Text</td>
    </tr>
  </tbody>
</table>

### Highlighted Table

```html
<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Syntax</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Header</td>
      <td>Title</td>
    </tr>
    <tr>
      <td>Paragraph</td>
      <td>Text</td>
    </tr>
  </tbody>
</table>
```

The rendered output looks like this:

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Syntax</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Header</td>
      <td>Title</td>
    </tr>
    <tr>
      <td>Paragraph</td>
      <td>Text</td>
    </tr>
  </tbody>
</table>

> You can find more examples at <a href="https://getbootstrap.com/docs/5.3/content/tables/">https://getbootstrap.com/docs/5.3/content/tables/</a>.


## Code Higlighting

To denote a word or phrase as code, enclose it in 3 backticks (<kbd>```</kbd>).

```sh
\```php
echo "Hello World !"
\```
```

The rendered output looks like this:

```php 
echo "Hello World !"
```

### Escaping Backticks

If the word or phrase you want to denote as code includes one or more backticks, you can escape it by enclosing the word or phrase in double backticks (``).

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
      <th>Markdown</th>
      <th>HTML</th>
      <th>Rendered Output</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>``Use `code` in your Markdown file.``</code></td>
      <td><code>&lt;code&gt;Use `code` in your Markdown file.&lt;/code&gt;</code></td>
      <td><code>Use `code` in your Markdown file.</code></td>
    </tr>
  </tbody>
</table>

### Language Coloring

If you want the code you wrote to be colored in any language, specify the code in lower case letters immediately after the back tick like below the format.

> \```<b>lang</b>

Example:

```sh
\```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9........",
    "user": {
        "id": "21615870-4f89-4ab8-b91e-af6370a3089e",
        "firstname": "Demo",
        "lastname": "Admin",
        "email": "demo@example.com",
        "roles": [
            "admin"
        ]
    },
    "expiresAt": "2022-08-03 11:58:22"
}
\```
```

The rendered output looks like this:

```json 
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9........",
    "user": {
        "id": "21615870-4f89-4ab8-b91e-af6370a3089e",
        "firstname": "Demo",
        "lastname": "Admin",
        "email": "demo@example.com",
        "roles": [
            "admin"
        ]
    },
    "expiresAt": "2022-08-03 11:58:22"
}
```

## Line Numbers

To show line numbers use below the format.

> \```lang <b>[line-numbers]</b>

Example:

```sh
\```php [line-numbers]
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
\```
```

The rendered output looks like this:

```php [line-numbers]
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
```

### Marking Line Numbers

To mark your line number use below the format.

> \```lang <b>[line-numbers] data-line="n"</b>

Example:

```sh
\```php [line-numbers] data-line="3"
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
\```
```

The rendered output looks like this:

```php [line-numbers] data-line="3"
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
```

### Marking Multiple Line Numbers

Example:

```sh
\```php [line-numbers] data-line="2,4"
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
\```
```

The rendered output looks like this:

```php [line-numbers] data-line="2,4"
$companies = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
    App\Handler\Api\CompanyHandler::class
];
$app->route('/api/companies/create', $companies, ['POST']);
```

## Command Line

To mark your coding example is a command line use below the format.

> \```lang <b>[command-line] data-user="root" data-host="localhost"</b>

Example:

```sh
\```bash [command-line] data-user="root" data-host="localhost"
git clone git@github.com:olomadev/olodoc-skeleton.git
\```
```

The rendered output looks like this:

```bash [command-line] data-user="root" data-host="localhost"
git clone git@github.com:olomadev/olodoc-skeleton.git
```

## Alerts

Alerts are a custom Markdown extension based on the blockquote syntax that you can use to emphasize critical information. To show yours users to alerts use below the format.

> \> [!TYPE]<br>
> \> Message here !

### Note

Example:

```
> [!NOTE]
> Useful information that users should know, even when skimming content.
```

The rendered output looks like this:

> [!NOTE]
> Useful information that users should know, even when skimming content.

### Tip

Example:

```
> [!TIP]
> Helpful advice for doing things better or more easily.
```

The rendered output looks like this:

> [!TIP]
> Helpful advice for doing things better or more easily.


### Important

Example:

```
> [!IMPORTANT]
> Key information users need to know to achieve their goal.
```

The rendered output looks like this:

> [!IMPORTANT]
> Key information users need to know to achieve their goal.

### Warning

Example:

```
> [!WARNING]
> Urgent info that needs immediate user attention to avoid problems.
```
The rendered output looks like this:

> [!WARNING]
> Urgent info that needs immediate user attention to avoid problems.

### Caution

Example:

```
> [!CAUTION]
> Advises about risks or negative outcomes of certain actions.
```

The rendered output looks like this:

> [!CAUTION]
> Advises about risks or negative outcomes of certain actions.


## Tabs

You can create bootstrap tabs using the following <b>Olodoc-specific</b> tab tags.

### Basic Tabs

Basic tab example:

```sh
<tab>
    <tab-title>Tab Title 1|Tab Title 2|Tab Title 3</tab-title>
    <tab-content>
        <tab-column>Tab content 1</tab-column>
        <tab-column>Tab content 2</tab-column>
        <tab-column>Tab content 3</tab-column>
    </tab-content>
</tab>
```

> [!WARNING]
> These tags are not supported by markdown language, only compatible with Olodoc.

The rendered output looks like this:

<tab>
    <tab-title>Tab Title 1|Tab Title 2|Tab Title 3</tab-title>
    <tab-content>
        <tab-column>Tab content 1</tab-column>
        <tab-column>Tab content 2</tab-column>
        <tab-column>Tab content 3</tab-column>
    </tab-content>
</tab>


### Tabs with Code Blocks

You can use <b>code blocks</b> within tab tags as follows.

Advanced tab example:

```sh
<tab>
<tab-title>Json|Php</tab-title>
<tab-content>
<tab-column>
\```json
{
    "name":"John", 
    "age":30
}
\```
</tab-column>
<tab-column>
\```php [line-numbers] data-line="2"
[
    "name" => "John",
    "age" =>  "30",
]
\```
</tab-column>
</tab-content>
</tab>
```

The rendered output looks like this:

<tab>
<tab-title>Json|Php</tab-title>
<tab-content>
<tab-column>
```json
{
    "name":"John", 
    "age":30
}
```
</tab-column>
<tab-column>
```php [line-numbers] data-line="2"
[
    "name" => "John",
    "age" =>  "30",
]
```
</tab-column>
</tab-content>
</tab>