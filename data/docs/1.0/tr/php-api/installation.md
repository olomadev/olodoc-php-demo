
## Kurulum

Php kütüphanelerinin kurulumu için <a href="https://getcomposer.org/" target="_blank">composer</a> paketi bilgisayarınızda kurulu olmalıdır. 

### Gereksinimler

Kurulumdan önce lütfen aşağıdaki bileşenleri çalışma ortamınıza yükleyin.

* Composer
* Php 8.0 veya üstü sürümler
* Apache 2 veya üstü sürümler
* Apache Mod Rewrite
* Redis Server
* Php Redis Extension

Olobase projesi arka uç uygulaması oluşturmak için önce <a href="https://github.com/olomadev/olobase-skeleton-php" target="_blank">github php depo</a> sundan clone bağlantısını kopyalayın ve ardından aşağıdaki <b>git clone</b> komutuyla birlikte konsolunuza yapıştırın.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
git clone --branch 1.3.1 git@github.com:olomadev/olobase-skeleton-php.git example-php
```

Composer paketlerini yükleyin.

```sh
/var/www/example-php$ composer install
```

<b>/data/tmp</b> önbellek klasörü için 777 iznini verin.

```sh
chmod 777 -R /var/www/example-php/data/tmp
```

> Genel olarak, <b>önbellek</b> dizinin izinlerini <b>755</b>'e ve içindeki dosyaların izinlerini <b>644</b>'e ayarlamayı denemenizi öneririz. Kesinlikle daha yüksek izinler kullanmanız gerekiyorsa, önbellek dizini için <b>777</b> ve dosyalar için <b>666</b> kullanmayı deneyin. Normal dosyaların izinlerini <b>777</b> olarak ayarlamaktan kaçının.

### Mezzio Hakkında

Olobase, arka uçta <a href="https://docs.mezzio.dev/mezzio/" target="_blank">Mezzio Çerçevesini</a> kullanır. Mezzio framework'ü hakkında daha detaylı bilgi almak isterseniz aşağıdaki kaynaklara göz atabilirsiniz.

<div class="table-responsive">
<table class="table">
    <tr>
        <th>Kaynak</th>
        <th>Url</th>
        <th>Açıklama</th>
    </tr>
    <tr>
        <td>Dökümentasyon</td>
        <td><a href="https://docs.mezzio.dev/" target="_blank">https://docs.mezzio.dev/</a></td>
        <td>Mezzio resmi dökümentasyon web adresi</td>
    </tr>
    <tr>
        <td>Kurulum</td>
        <td><a href="https://matthewsetter.com/how-to-create-a-mezzio-application/" target="_blank">https://matthewsetter.com/how-to-create-a-mezzio-application/</a></td>
        <td>Mezzio'nun yaratıcısı tarafından yazılmış ve Mezzio kurulumu hakkında geniş bilgi içeren blog adresi</td>
    </tr>
</table>
</div>

### Apache2 Konfigürasyonu

Apache mod_rewrite eklentisini etkileştirin.

```bash [no-line-numbers]
sudo a2enmod rewrite
```

<b>apache2.conf</b> dosyasında dizinler için <kbd>AllowOverride</kbd> seçeneği <b>All</b> değerinde olmalıdır.

```bash [no-line-numbers]
vim /etc/apache2/apache2.conf
```

Varsayılan <b>None</b> olan bu seçeneği <b>All</b> olarak değiştirin.

```apacheconf [line-numbers] data-line="3"
<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Bir host dosyası oluşturun

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /etc/apache2/sites-available
cp 00-default.conf example.local.conf
vim example.local.conf
```

Apache host dosyanızda <b>DocumentRoot</b> konfigürasyonu <b>projeniz/public/</b> klasörüne ayarlanmış olmalıdır. <b>DirectoryIndex</b> değerini <b>index.php</b> değerine ayarlamanız önerilir. ServerName bu örnekte <b>example.local</b> olarak ayarlanmıştır.

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

vhost dosyasınızı kaydedin ve apache sunucusunu yeniden başlatın.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
a2ensite example.local.conf
sudo service apache2 restart
```

### .htaccess

Konfigurasyon aşağıdaki gibi <kbd>.htaccess</kbd> dosyasını gerektirir. Bu dosya <kbd>/public</kbd> klasöründe mevcuttur.

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

### Linux Host Dosyası

Bu örnekte <kbd>/etc/hosts</kbd> dosyasına proje <kbd>example.local</kbd> olarak tanımlanmıştır.

```bash [no-line-numbers]
127.0.1.1       example.local
```

Bu tanımlamadan sonra tarayıcınızdan aşağıdaki gibi proje ismi ile uygulamanıza ulaşabilirsiniz.

```bash [no-line-numbers]
http://example.local/
```

### Yerel Ortam Konfigürasyonu

Yerel ortamda çalışmak için projeniz içinde <kbd>/config/autoload/</kbd> klasöründeki <kbd>local.php.dist</kbd> dosyasını kopyalayıp <kbd>local.php</kbd> adı ile kaydedin.

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

Ortamların konfigürasyonu hakkında daha detaylı bilgi için <a href="/php-api/environments.html">ortamlar</a> bölümüne gözatabilirsiniz.

### JWT Anahtarlarının Oluşturulması

Jwt kodlayıcı, belirteçleri imzalarken <b>private_key</b> ve belirteçleri okurken <b>public_key</b> olmak üzere iki genel ve özel anahtar kullanır. Her proje için farklı anahtarlar oluşturmanız gerekir. [Bu bağlantıyı kullanarak](/php-api/jwt-authentication.html#Konfigürasyon) genel ve özel anahtarlar oluşturabilirsiniz.

### Varsayılan Veritabanının Yaratılması

<a href="https://github.com/olomadev/olobase-skeleton-php" target="_blank">olobase-skeleton-php</a> projesi içerisinde <b>default.sql</b> adındaki dosyayı çalıştırmadan önce <b>olobase_default</b> adında bir veritabanı yaratın.

```sql
CREATE DATABASE olobase_default;
```
Daha sonra <b>default.sql</b> sql kodlarını bu veritabanı için çalıştırın.

### Veritabanı Konfigürasyonu

Yukarıdaki örnek bağlantı Mysql sürücüsü içindir daha fazla örnek için <a href="https://docs.laminas.dev/laminas-db/adapter/#creating-an-adapter-using-configuration" target="_blank">laminas-db</a> bağlantısını ziyaret edebilirsiniz.

### Uygulamanıza Giriş

```bash [no-line-numbers]
http://example.local/api/auth/token
```

Takip eden örnekte olduğu gibi <a href="https://www.postman.com/downloads/postman-agent/" target="_blank">Postman</a> benzeri yazılımları kullanarak uygulamanızı test edebilirsiniz.

* <b>Kullanıcı adı:</b> demo@example.com
* <b>Şifre:</b> 12345678

![image info](/images/demo-login.png)
