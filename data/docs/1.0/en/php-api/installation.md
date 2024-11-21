
## Installation

To install PHP libraries, the <a href="https://getcomposer.org/" target="_blank">composer</a> package must be installed on your computer.

### Requirements

Before installation, please install the following components in your working environment.

* Composer
* Php 8.0 or higher versions
* Apache 2 or higher
* Apache Mod Rewrite
* Redis Server
* Php Redis Extension

To create an Olobase project backend application, first copy the clone link from <a href="https://github.com/olomadev/olobase-skeleton-php" target="_blank">github php repository</a> and then paste it into your console along with the following git clone command.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git clone --branch 1.3.1 git@github.com:olomadev/olobase-skeleton-php.git example-php
```

Install composer packages.

```sh
/var/www/example-php$ composer install
```

Give 777 permision for <b>/data/tmp</b> cache folder.

```sh
chmod 777 -R /var/www/example-php/data/tmp
```

> In general, we'd advise you to try setting the permissions of the <b>cache/</b> directory to <b>755</b> and the files inside it - to <b>644</b>. If you absolutely must use higher permissions, try using <b>777</b> for the <b>cache/</b> directory and <b>666</b> for the files in it. Avoid setting the permissions of regular files to <b>777</b>.

### Useful Resources About Mezzio

Olobase uses the <a href="https://docs.mezzio.dev/mezzio/" target="_blank">Mezzio Framework</a> in the backend. If you would like to get more detailed information about the Mezzio framework, you can take a look at the resources below.

<div class="table-responsive">
<table class="table">
    <tr>
        <th>Source Type</th>
        <th>Url</th>
        <th>Description</th>
    </tr>
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
</table>
</div>

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
    DocumentRoot /var/www/olobase-skeleton-php/public/
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

After this definition, you can access your application from your browser with the project name as follows.

```bash [no-line-numbers]
http://example.local/
```

### Local Environment Configuration

To work in a local environment, copy the <kbd>local.php.dist</kbd> file in the <kbd>/config/autoload/</kbd> folder in your project and save it with the name <kbd>local.php</kbd>.

```php
<?php
declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    // Toggle the configuration cache. Set this to boolean false, or remove the
    // directive, to disable configuration caching. Toggling development mode
    // will also disable it by default; clear the configuration cache using
    // `composer clear-config-cache`.
    ConfigAggregator::ENABLE_CACHE => false,

    // Enable debugging; typically used to provide debugging information within templates.
    'debug' => true,
    'token' => [
        // Cookie encryption
        'encryption' => [
            'iv' => '', // generate random 16 chars
            'enabled' => false, // it should be true in production environment
            'secret_key' => '',
        ],
        // Public and private keys are expected to be Base64 encoded.
        // The last non-empty line is used so that keys can be generated with
        'public_key' => '',
        // The secret keys generated by other tools may
        // need to be adjusted to match the input expected by libsodium.
        'private_key' => '',
        //
        // for strong security reason it should be less
        'session_ttl' => 15, // in minutes (TTL cannot be less then 10 minute)
        // you can reduce the time for higher security
        // for how long the token will be valid in the app.
        // in every "x" time the token will be refresh. 
        'token_validity' => 1, // in minutes
        // whether to check the IP and User Agent when the token is resolved.
        //
        'validation' => [
            'user_ip' => true,
            'user_agent' => true,
        ],
    ],
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'driver_options' => [
            // PDO::ATTR_PERSISTENT => true,
            // https://www.php.net/manual/tr/mysqlinfo.concepts.buffering.php
            // 
            PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false,  // should be false

            // https://stackoverflow.com/questions/20079320/php-pdo-mysql-how-do-i-return-integer-and-numeric-columns-from-mysql-as-int
            // 
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_STRINGIFY_FETCHES => false,
            
            // Enable exceptions
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ],
        'database' => 'olobase_default',
        'hostname' => 'localhost',
        'username' => '',
        'password' => '',
        'platform' => 'Mysql',
    ],
    'redis' => [
        'host' => 'localhost',
        'port' => '6379',
        'timeout' => 60,
        'password' => '',
    ]
];
```

For more detailed information about the configuration of environments, you can browse the <a href="/php-api/environments.html">environments</a> section.

### Generating JWT Keys

The jwt encoder uses two public and private keys, <b>private_key</b> when signing tokens and <b>public_key</b> when reading tokens. You need to create different keys for each project. You can create public and private keys [using this link](/php-api/jwt-authentication.html#Configuration).

### Creating the Default Database

Before running the file named <b>default.sql</b> in the <a href="https://github.com/olomadev/olobase-skeleton-php" target="_blank">olobase-skeleton-php</a> project create a database named <b>olobase_default</b>.

```sql
CREATE DATABASE olobase_default;
```

Then run <b>default.sql</b> SQL codes for this database.

### Database Configuration

The example link above is for the Mysql driver for more examples you can visit the <a href="https://docs.laminas.dev/laminas-db/adapter/#creating-an-adapter-using-configuration" target="_blank">laminas-db</a> link.

### Login to Your Application

```bash [no-line-numbers]
http://example.local/api/auth/token
```

You can test your application using software such as <a href="https://www.postman.com/downloads/postman-agent/" target="_blank">Postman</a> as in the following example.

* <b>Username:</b> demo@example.com
* <b>Password:</b> 12345678

![image info](/images/demo-login.png)