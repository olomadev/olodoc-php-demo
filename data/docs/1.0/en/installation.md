
## Setup

To install the olodoc app, the <b>Php</b> and composer package must be installed on your computer.

### Requirements

Only <b>Php 7</b> and above are supported.

Follow the steps below to create an Olodoc project.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git clone git@github.com:olomadev/olodoc-skelethon myproject
```

Go to your project root

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /var/www/myproject
```

Install composer packages

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
/var/www/myproject$ composer install
```

Give 777 permision for <b>/data/tmp</b> cache folder.

```sh
chmod 777 -R /var/www/myproject/data/tmp
```

> [!CAUTION]
> In general, we'd advise you to try setting the permissions of the <b>cache/</b> directory to <b>755</b> and the files inside it - to <b>644</b>. If you absolutely must use higher permissions, try using <b>777</b> for the <b>cache/</b> directory and <b>666</b> for the files in it. Avoid setting the permissions of regular files to <b>777</b>.


### Apache2 Configuration

Enable Apache mod_rewrite plugin.

```bash [no-line-numbers]
sudo a2enmod rewrite
```

The <kbd>AllowOverride</kbd> option for directories in the <b>apache2.conf</b> file must be <b>All</b>.

```bash [no-line-numbers]
vim /etc/apache2/apache2.conf
```

Change this option from the default <b>None</b> to <b>All</b>.

```apacheconf [line-numbers] data-line="3"
<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Create a hosts file.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /etc/apache2/sites-available
cp 00-default.conf example.local.conf
vim example.local.conf
```
In your Apache host file, the <b>DocumentRoot</b> configuration must be set to the <b>yourproject/public/</b> folder. It is recommended to set <b>DirectoryIndex</b> to <b>index.php</b>. ServerName is set to <b>example.local</b> in this example.

```apacheconf
<VirtualHost *:80>

    SetEnv "APP_ENV" "local"
    ServerName example.local
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/myproject/public/
    DirectoryIndex index.php

    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined

</VirtualHost>
```

Save your vhost file and restart the apache server.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
a2ensite example.local.conf
sudo service apache2 restart
```

### .htaccess

Configuration requires the <kbd>.htaccess</kbd> file as follows. This file is located in the <kbd>/public</kbd> folder.

```bash
# Disable directory indexing
# Options -Indexes
# Options +FollowSymLinks
# Options -MultiViews

php_value post_max_size 10M
php_value upload_max_filesize 10M

RewriteEngine On
#
# Redirect www to non-www
#
RewriteCond %{HTTP_HOST} ^www\.(.*)$ [NC]
RewriteRule ^(.*)$ https://%1/$1 [R=301,L]

# The following rule allows authentication to work with fast-cgi
RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
# The following rule tells Apache that if the requested filename
# exists, simply serve it.
RewriteCond %{REQUEST_FILENAME} -s [OR]
RewriteCond %{REQUEST_FILENAME} -l [OR]
RewriteCond %{REQUEST_FILENAME} -d
RewriteRule ^.*$ - [NC,L]

# The following rewrites all other queries to index.php. The
# condition ensures that if you are using Apache aliases to do
# mass virtual hosting, the base path will be prepended to
# allow proper resolution of the index.php file; it will work
# in non-aliased environments as well, providing a safe, one-size
# fits all solution.

RewriteCond %{REQUEST_URI} !/api/
RewriteRule ^(.*)$ %{ENV:BASE}index.html [NC,L]
RewriteCond %{REQUEST_URI}::$1 ^(/.+)(.+)::\2$
RewriteRule ^(.*) - [E=BASE:%1]
RewriteRule ^(.*)$ %{ENV:BASE}index.php [NC,L]
```

### Linux Host File

In this example, the project is defined as <kbd>example.local</kbd> in the <kbd>/etc/hosts</kbd> file.

```bash [no-line-numbers]
127.0.1.1       example.local
```

If you are setting up a <b>multilingual project via a subdomain</b>, add the languages you plan to support as follows.

```bash [no-line-numbers]
127.0.1.1       example.local
127.0.1.1       en.example.local
127.0.1.1       tr.example.local
```

### Windows Host File

If you works on a Linux Virtual Machine under the Windows OS you must define a host name in <kbd>C:\Windows\System32\drivers\etc\hosts</kbd> file like below.

```sh
# Copyright (c) 1993-2009 Microsoft Corp.
#
# This is a sample HOSTS file used by Microsoft TCP/IP for Windows.
#
# This file contains the mappings of IP addresses to host names. Each
# ...
# ...
#
# For example:
#
#      102.54.94.97     rhino.acme.com          # source server
#       38.25.63.10     x.acme.com              # x client host
# localhost name resolution is handled within DNS itself.
# 127.0.0.1       localhost
# ::1             localhost
  192.168.231.130 example.local       # Your Linux virtual machine ip address
  192.168.231.130 tr.example.local
  192.168.231.130 en.example.local
```

### Local Environment Configuration

To work in a local environment, 

Copy the <kbd>local.php.dist</kbd> file in the <kbd>/config/autoload/</kbd> folder in your project and save it with the name <kbd>local.php</kbd>.


```php
<?php
/**
 * Development-only configuration.
 *
 * Put settings you want enabled when under development mode in this file, and
 * check it into your repository.
 *
 * Developers on your team will then automatically enable them by calling on
 * `composer development-enable`.
 */

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    //
    // olodoc
    // 
    'olodoc' => [
        'default_version' => '1.0',
        'available_versions' => [
            '1.0',
            '2.0'
        ],
        'default_locale' => 'en',
        'available_locales' => [
            'en',
            'tr'
        ],
        'http_prefix' => 'http://', // http(s) prefix
        'base_url' => '{locale}.example.local/', // or "example.local/{locale}"
        'images_folder' => '/public/', // location of your "/images" folder
        'remove_default_locale' => true, // removes default locale from base url: "en.example.local" => "example.local"
        'root_path' => '/var/www/myproject', // your project root 
        'html_path' => '/data/docs/', // save location for your ".html" document files
        'xml_path' => '/public/sitemap.xml',
        'build_sitemapxml' => true,
        'base64_convert' => false, // if true all images are converted to base64 encoded strings
        'anchor_generations' => true, // it will enable anchor generations for all routes
        'anchor_parse_query' => '//h2|//h3|//h4|//h5|//h6',
        'anchors_for_index_pages' => true, // if false anchors will not be created in index.html routes
    ],
    
    // Toggle the configuration cache. Set this to boolean false, or remove the
    // directive, to disable configuration caching. Toggling development mode
    // will also disable it by default; clear the configuration cache using
    // `composer clear-config-cache`.
    ConfigAggregator::ENABLE_CACHE => false,

    // Enable debugging; typically used to provide debugging information within templates.
    'debug' => true,
];
```

### Run Your Application

If everything went well, you can run your first application by typing your project address into your browser as follows:

![Example Local Project](/images/example.local.png)


### About Php Mezzio Framework

Olodoc uses the super fast micro framework called <a href="https://docs.mezzio.dev/mezzio/" target="_blank">Mezzio</a>. If you would like to get more detailed information about the Mezzio framework, you can take a look at the resources below.

<table class="table table-bordered">
  <thead class="table-light">
    <tr>
        <th>Source</th>
        <th>Url</th>
        <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>Documents</td>
        <td><a href="https://docs.mezzio.dev/" target="_blank">https://docs.mezzio.dev/</a></td>
        <td>Mezzio official documentation web address.</td>
    </tr>
    <tr>
        <td>Installation</td>
        <td><a href="https://matthewsetter.com/how-to-create-a-mezzio-application/" target="_blank">https://matthewsetter.com/how-to-create-a-mezzio-application/</a></td>
        <td>Blog address written by the creator of Mezzio and containing extensive information about Mezzio installation.</td>
    </tr>
  </tbody>
</table>

