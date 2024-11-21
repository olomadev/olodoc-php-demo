
## Jwt Kimlik Doğrulama

JWT (<a href="https://jwt.io/" target="_blank">JSON Web Tokens</a>), bir <a href="https://datatracker.ietf.org/doc/html/rfc7519" target="_blank">RFC7519</a> endüstri standartıdır. JWT, kullanıcının doğrulanması, web servis güvenliği, bilgi güvenliği gibi birçok konuda kullanılabilir. JWT oldukça popüler ve tercih edilen bir yöntemdir.

Bir JWT kimlik doğrulama yöntemi <kbd>Session Stateless</kbd> çalışır. Bu durum bilgisi olmadığı ve sunucunun, sunucu tarafında istemci oturumu hakkında herhangi bir durumu saklamadığı anlamına gelir. Yani kullanıcı bilgileri ve oturum son geçerlilik tarihi ne sunucuda, ne de istemci tarafında tutulur. Tüm bilgiler jeton içerisindedir.

## JWT Avantajları

1. <b>Session Stateless</b> çalışır. Durum bilgisi olmayan, sunucunun, sunucu tarafında istemci oturumu hakkında herhangi bir durumu saklamadığı anlamına gelir. Yani bilgiler ve son geçerlilik tarihi ne sunucuda, ne de client tarafında tutulur. Tüm bilgiler jeton içerisindedir.
2. <b>Taşınabilir</b> çalışır. Hem web uygulamanız hem de mobil uygulamalarınız tarafından rahatlıkla kullanılabilir.
3. <b>JSON</b> formatını kullanır.
4. Doğrulama işlemi diğer kimlik doğrulama yöntemlerine göre daha <b>hızlıdır</b>. Doğrulama işlemi için veritabanı ile bağlantı kurulmaz.
5. Çerezleri kullanmaya gerek yoktur. Böylece <b>mobil</b> tabanlı uygulamalar için avantaj sağlar.

Jwt dezavantajları için takip eden <a href="https://www.secopsolution.com/blog/jwt-weaknesses#:~:text=One%20of%20the%20most%20significant,JWT%20remains%20exposed%20in%20plaintext.
" target="_blank">bağlantıyı tıklayın</a>.

## JWT için Olobase'da Mevcut Güvenlik Önlemleri

Yukarıda anlatılan dezavantajları ortadan kaldırmak için Olobase'da kullanılan bir dizi önlemden bahsedebiliriz.

* <a href="https://www.scottbrady91.com/jose/jwts-which-signing-algorithm-should-i-use" target="_blank">EdDSA</a> Algoritması
* Jeton Geçerliliği ve Yenileme
* Jeton Şifreleme
* Oturumun Yaşam Süresi
* Kullanıcı Tarayıcısı ve IP Doğrulama

## JWT Yapısı

JWT ile imzalanmış bir jeton <b>Base64</b> ile kodlanmış 3 ana kısımdan oluşmaktadır. Bunlar Header(Başlık), Payload(Veri), Signature(İmza) kısımlarıdır. Aşağıdaki jeton örneğinde dikkat edecek olursak aaa.bbb.ccc şeklinde noktalarla ayrılmış 3 alan bulunmaktadır.

```string
Örnek Jeton: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdGF0dXMiOiJ0ZWJyaWtsZXIhIDopIn0.sTLXY5iAs1IzJJ-8GVP_pMR65qqgCUpbMl-aSPcrQHc
```

### Header (Başlık)

JWT'de kullanılacak bu kısım JSON formatında yazılmakta ve 2 alandan oluşmaktadır. Bunlar jeton tipi ve imzalama için kullanılacak algoritmanın adı. 

Örnek olarak:

```json
{
  "typ": "JWT",
  "alg": "EdDSA"
}
```

Algoritma kısmında EdDSA, HS256, HMAC SHA256 ya da RSA gibi birçok farklı algoritma kullanılabilir. Type kısmında ise JWT yazmakta. Bu kısım Base64 ile encode edilir ve oluşturulacak jetonun ilk parçasını oluşturur.

### Payload (Veri)

Bu kısım claim'leri içerir. Bu kısımda tutulan veriler ile jeton istemci ve sunucu arasında eşsiz olur. Bu tutulan claim bilgileri de bu eşsizliği sağlar. Bu kısımda 3 tip claim bulunmaktadır.

### Registered (Kayıtlı) Claims

JWT tarafından önceden rezerve edilmiş 3 harf uzunluğunda claim 'lerdir. Yani bu ayarlanmış belli claim isimlerini diğer claim lerde kullanamazsınız. Bu bilgilerin kullanılması zorunlu değildir ama önerilmektedir. Bu claimlerden bazıları iss (issuer), exp (expiration time), sub (subject), aud(audience) ve diğerleri. Bunlardan en çok kullanılanı expiration time yani son geçerlilik tarihidir. Örneğin jeton bilginizin 3 saat sonra geçersiz olmasını isterseniz bu bilgiyi exp alanında gönderirsiniz. 3 saat ardından aynı jeton ile gelen isteklerde jeton geçersiz olarak değerlendirilir.

### Public (Açık) Claims

İsteğe bağlı, açık yayınlanan claimlerdir.

### Private (Gizli) Claims

Tarafların kendi aralarında bilgi taşımak için kullandığı gizli claim lerdir.

Örnek bir payload alanı:

```json
{
  "sub": "1234567890",
  "name": "John Doe",
  "email": "john@example.com",
  "iat": 1516239022
}
```

Bu kısım Base64 ile encode edilir ve oluşturulacak jetonun ikinci parçasını oluşturur.

> Jeton içerisine kullanıcı şifresi gibi hassas verileri koymamalısınız çünkü JWT jetonları base64 fonksiyonu ile kodlandıkları için ele geçirildiklerinde kolayca okunabilirler.

### Signature (İmza)

Bu kısım jetonun son kısmıdır. Bu kısmın oluşturulabilmesi için header, payload ve gizli anahtar(gizli) gereklidir. İmza kısmı ile veri bütünlüğü garanti altına alınır. Burada kullandığımız gizli anahtar Header kısmında belirttiğimiz algoritma için kullanılır. Header ve Payload kısımları bu gizli anahtar ile imzalanır

```string
HMACSHA256(
  base64UrlEncode(header) + "." +
  base64UrlEncode(payload),
  your-256-bit-secret
)
```

### JWT Doğrulama

Doğrulama işlemi üstteki senaryoda da belirttiğimiz gibi istemci tarafından jeton geldikten sonra kullanıcının yetkisini kontrol etmek için kullanılır. jetonun geçerli olup olmadığı JWT ile doğrulanır. JWT doğrulama işlemi oldukça basittir. Gelen jetonda Header ve Payload sunucumuzda bulunan gizli anahtar ile imzalanır ve 3. kısım hesaplanır. Daha sonra bu oluşturulan imza istemci tarafından gelen imza ile karşılaştırılır. Eğer imzalar aynı ise jeton geçerli sayılır ve kullanıcıya erişim verilir.

## Konfigürasyon

Bu bölümde uygulamanızda oturum açmadan önce yapmanız gereken aşağıdaki adımlara değilecek:

* Jwt Anahtarlarının Oluşturulması
* Yerel Ortam İçin Yetkilendirme konfigürasyonu
* SQL Tablosunun Kontolü
* Jeton Yenileme Sürelerinin Konfigürasyonu
* Oturum Açma Testi
* JwtAuthenticationMiddleware Katmanı

### JWT Anahtarlarının Oluşturulması

1. <b>encryption.iv</b> anahtarı için rastgele 16 karakterlik bir dizi oluşturun. Çevrimiçi <a href="https://www.random.org/strings/?num=2&len=16&digits=on&upperalpha=on&loweralpha=on&unique=on&format=html&rnd=new" target="_blank">random.org</a> adresini kullanabilirsiniz.
2. Jeton şifrelemesi için bir <b>encryption.secret_key</b> oluşturun:

```php
echo base64_encode(openssl_random_pseudo_bytes(32)); // ewQrCBs/3Mp7RKgtbjd4jjdOJLY8uyENcmKcssQnvWE=
```
3. Jwt kodlayıcı, jetonları imzalarken <b>private_key</b> ve jetonları okurken <b>public_key</b> olmak üzere iki genel ve özel anahtar kullanır. Herhangi bir php dosyasında aşağıdaki işlemi gerçekleştirin.

```php
$keyPair = sodium_crypto_sign_keypair();
$publicKey = base64_encode(sodium_crypto_sign_publickey($keyPair));
$privateKey = base64_encode(sodium_crypto_sign_secretkey($keyPair));

echo $publicKey."\n";  // W9JHddARm1iwrIV+DhlQ1t0vGxWwgwVTHyHpjq6n4L8=
echo $privateKey."\n"; // KXgCiGnLLkYI/j/uGOgmSn5P9lATSZcd/p86azEgwW1b0kd10BGbWLCshX4OGVDW3S8bFbCDBVMfIemOrqfgvw==
```

> Uygulamanızda güvenlik risklerine yol açmamak için her projede anahtarları yeniden oluşturmalısınız.

Oluşturduğunuz anahtarı aşağıdaki gibi <b>public_key</b> ve <b>private_key</b> alanlarına tanımlamalısınız. 

### Jeton Konfigürasyonu

<kbd>config/autoload/local.php</kbd>

```php
// local.php
// 
'token' => [
    // Cookie encryption
    'encryption' => [
        'iv' => '', // generate random 16 chars
        'enabled' => false, // it should be true in production environment
        'secret_key' => '',
    ],
    // Public and private keys are expected to be Base64 encoded.
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
    'token_validity' => 5, // in minutes
    // whether to check the IP and User Agent when the token is resolved.
    //
    'validation' => [
        'user_ip' => true,
        'user_agent' => true,
    ],
],
```

<div class="table-responsive">
<table class="table">
    <thead>
        <th>Anahtar</th>
        <th>Açıklama</th>
    </thead>
    <tbody>
    <tr>
        <td>encryption.iv</td>
        <td>Rastgele 16 karakterlik bir dizilim oluşturun. Çevrimiçi <a href="https://www.random.org/strings/?num=2&len=16&digits=on&upperalpha=on&loweralpha=on&unique=on&format=html&rnd=new" target="_blank">random.org</a> adresini kullanabilirsiniz.</td>
    </tr>
    <tr>
        <td>encryption.enabled</td>
        <td>Kullanıcıya gönderilmeden önce belirtecin şifreleme özelliğini açar/kapatır. Üretim ortamında şifrelemenin açılması önemle tavsiye edilir.</td>
    </tr>
    <tr>
        <td>encryption.secret_key</td>
        <td>Bu yöntemi kullanarak rastgele bir gizli şifre oluşturun. <code>base64_encode(openssl_random_pseudo_bytes(32));</code> Bu şifreyi hiç kimseyle paylaşmamalısınız.</td>
    </tr>
    <tr>
        <td>public_key</td>
        <td>Genel ve özel anahtarların Base64 kodlu olması bekleniyor. Genel anahtarlar oluşturmak için yukarıdaki örneğe bakın.</td>
    </tr>
    <tr>
        <td>private_key</td>
        <td>Diğer araçlar tarafından oluşturulan gizli anahtarların, libsodium tarafından beklenen girdiyle eşleşecek şekilde ayarlanması gerekebilir. Özel anahtarlar oluşturmak için yukarıdaki örneğe bakın.</td>
    </tr>
    <tr>
        <td>session_ttl</td>
        <td>Oturumun yaşam süresini belirler. Yani jeton imzalandıktan sonra kullanıcının ne kadar süre sistemde kalacağının süresi önbelleğe kayıt edilir. Kullanıcının tarayıcısı açık oluduğu sürece bu süre, her <b>5 dakika</b> da bir atılan otomatik http istekleri ile her seferinde başa döndürülmüş olur. Böylece tarayıcısı açık olan kullanıcıların sistemde kalması sağlanır. Tarayıcının kapatıldığı durumda ise önbellekteki bu süre sona ereceğinden kullanıcı oturumu otomatik olarak sonlanır. Oturumun yaşam süresi <b>10 dakika</b> dan az olmamalıdır. Aksi durumda kullanıcılarınızın oturumları beklenmeyen zamanlarda sonlanabilir. Yine de bu süreyi düşürmek istiyorsanız önyüz uygulamanızın <b>.env.*</b> dosyasında tanımlı olan <b>VITE_SESSION_UPDATE_TIME</b> süresini düşürmelisiniz.</td>
    </tr>
    <tr>
        <td>token_validity</td>
        <td>Kullanıcıya verilen jetonların ne kadar süre içinde yenileceğini belirler. Bu süre ne kadar az olursa uygulama güvenliğiniz o kadar artmış olur fakat sürenin <b>5 dakika</b> dan az olması sunucu ve istemci kaynaklarını yorabilir.</td>
    </tr>
    <tr>
        <td>validation.user_ip</td>
        <td>Kullanıcının mevcut IP adresi jeton içinde saklanan IP adresiyle eşleşmiyorsa kullanıcının oturumu kapatılır.</td>
    </tr>
    <tr>
        <td>validation.user_agent</td>
        <td>Kullanıcının tarayıcı adı, jeton içine kaydedilen değer ile eşleşmiyorsa kullanıcının oturumu kapatılır.</td>
    </tr>
    </tbody>
</table>
</div>

### SQL Sorgu Tablosu

<kbd>App\Authentication\AuthenticationAdapter</kbd> yetkilendirme bağdaştırıcısı oturum açma sırasında , yapılandırmada tanımlanan <b>tablename</b>, <b>username</b> ve <b>password</b> sütunlarına göre SQL sorgusunu gerçekleştirir.

<kbd>config/autoload/mezzio.global.php</kbd>

```php
// mezzio.global.php
// 
'authentication' => [
    'tablename' => 'users', 
    'username' => 'email',  // identity table column
    'password' => 'password', // password table column
    'form' => [
        'username' => 'username', // username form input name
        'password' => 'password', // password form input name
    ]
],
```

<kbd>users</kbd> isimli tablonuzun veritabanında mevcut olduğundan emin olun.

```sql
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `userId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(160) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `firstname` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `lastname` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '0',
  `themeColor` char(7) DEFAULT NULL,
  PRIMARY KEY (`userId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

/*Data for the table `users` */

INSERT INTO `users`(`userId`,`email`,`password`,`firstname`,`lastname`,`createdAt`,`active`,`themeColor`) VALUES 
(
    '21615870-4f89-4ab8-b91e-af6370a3089e',
    'demo@example.com',
    '$2y$10$sXQiNPPK5TQFIORtQ4fxKex4GJkHMa7h5loGHB0Ea.fj4dQWlKZn.',
    'Demo',
    'Login',
    '2021-12-22 12:32:17',
    1,
    '#0a7248'
),
```

### Oturum Açma Testi

Veritabanı ve Jwt konfigürasyon ayarlarınızı yaptıktan sonra <a href="https://www.postman.com/" target="_blank">Postman</a> uygulaması ile oturum açma testi gerçekleştirin. Yeni bir sekme açarak aşağıdaki gibi url kısmına <b>http://demo.local/api/auth/token</b> auth url adresinizi girin.

```string
http://demo.local/api/auth/token
```

Http POST yöntemiyle json raw gövdesine kullanıcı tablonuzdan seçtiğiniz bir kullanıcı ile giriş yapmayı deneyin.

```json
{
  "username": "demo@example.com",
  "password": "12345678"
}
```

Giriş testi başarılı ise aşağıdaki gibi bir yanıt alacaksınız.

![Postman Login Test](/images/postman-login.png)

Örnek bir jeton yanıtı,

```string
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2OTk1MjAwNDUsImp0aSI6IjE1ZjhiNjY1MGE3ZTM3ODc2NDRhY2Y3Y2ZiMTIzNDQ2IiwiaXNzIjoiaHR0cDovL3ZhLWRlbW8tcGhwIiwibmJmIjoxNjk5NTIwMDQ1LCJleHAiOjE2OTk1MjAzNDUsImRhdGEiOnsidXNlcklkIjoiYzEzZTU1MGEtNjBlZS00OGQ1LWJmNmUtZWQyOTMxMDY0MGIyIiwiaWRlbnRpdHkiOiJkZW1vQGV4YW1wbGUuY29tIiwicm9sZXMiOlsiYWRtaW4iLCJzYWxlcyJdLCJkZXRhaWxzIjp7ImVtYWlsIjoiZGVtb0BleGFtcGxlLmNvbSIsImZpcnN0bmFtZSI6IkRlbW8iLCJsYXN0bmFtZSI6IkFkbWluIiwiaXAiOiIxOTIuMTY4LjIzMS4xIiwiZGV2aWNlS2V5IjoiMWQyMGZlMTExODBiODIxN2FkNmE0NTZlNjc0NWQ0OTkifX19._iUg9YK9DqOPEooacCTKvhzPew_vzWEplpj5Z-Sfw1Y
```

Elde ettiğiniz her jetonu <kbd>base64_decode</kbd> komutu ile çözümleyerek görüntüleyebilirsiniz. Yukarıdaki jeton yanıtını <a href="https://jwt.io" target="_blank">jwt.io</a> adresinde çözümlediğinizde takip eden örnekte olduğu gibi çıktı alacaksınız. 

![Postman Login Test](/images/jwt.io.png)

### Jwt Doğrulama Katmanı

Rotalarınıza kimlik doğrulama eklemek için her rotaya <kbd>App\Middleware\JwtAuthenticationMiddleware</kbd> sınıfı, takip eden örnekte olduğu gibi dahil edilmedilir.

```php  
$auth = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
];
// Companies
// 
$app->route('/api/companies/create', [...$auth, [App\Handler\Companies\CreateHandler::class]], ['POST']);
$app->route('/api/companies/update/:companyId', [...$auth, [App\Handler\Companies\UpdateHandler::class]], ['PUT']);
$app->route('/api/companies/delete/:companyId', [...$auth, [App\Handler\Companies\DeleteHandler::class]], ['DELETE']);
$app->route('/api/companies/findAll', [JwtAuthenticationMiddleware::class, App\Handler\Companies\FindAllHandler::class], ['GET']);
$app->route('/api/companies/findAllByPaging', [...$auth, [App\Handler\Companies\FindAllByPagingHandler::class]], ['GET']);
$app->route('/api/companies/findOneById/:companyId', [...$auth, [App\Handler\Companies\FindOneByIdHandler::class]], ['GET']);
```

Eğer bir rota <b>kimlik doğrulama gerektirmiyorsa</b> <kbd>$auth</kbd> değişkenini ilgili diziden kaldırıp sadece handler ismini girmeniz yeterli olacaktır.

```php
// Common (public) resources
// 
$app->route('/api/stream/events', App\Handler\Common\Stream\EventsHandler::class, ['GET']);
$app->route('/api/years/findAll', App\Handler\Common\Years\FindAllHandler::class, ['GET']);
```

## Kimlik Doğrulama Hataları

Kulanıcı girişinin öncesinde veya sonrasında gelişen olayları kontrol etmek için <kbd>App\Authentication\JwtAuthentication</kbd> sınıfı herhangi bir event sınıfını gerektirmeden basitçe kullanıcı için oluşmuşsa aşağıdaki ilgili hataları işler.

<div class="table-responsive">
<table class="table">
    <tr>
        <th>Anahtar</th>
        <th>Açıklama</th>
    </tr>
    <tr>
        <td>AUTHENTICATION_REQUIRED</td>
        <td>Kimlik doğrulama gerekli. Lütfen hesabınızda oturum açın.</td>
    </tr>
    <tr>
        <td>USERNAME_OR_PASSWORD_FIELDS_NOT_GIVEN</td>
        <td>Kullanıcı adı ve şifre alanları girilmelidir.</td>
    </tr>
    <tr>
        <td>USERNAME_OR_PASSWORD_INCORRECT</td>
        <td>Kullanıcı adı veya şifre yanlış.</td>
    </tr>
    <tr>
        <td>ACCOUNT_IS_INACTIVE_OR_SUSPENDED</td>
        <td>Bu hesap onay bekliyor veya askıya alındı.</td>
    </tr>
    <tr>
        <td>NO_ROLE_DEFINED_ON_THE_ACCOUNT</td>
        <td>Bu kullanıcı için tanımlanmış bir rol yok.</td>
    </tr>
    <tr>
        <td>IP_VALIDATION_FAILED</td>
        <td>IP adresiniz doğrulanamadı ve güvenlik nedeniyle çıkış yapıldı.</td>
    </tr>
    <tr>
        <td>USER_AGENT_VALIDATION_FAILED</td>
        <td>Tarayıcınız doğrulanamadı ve güvenlik nedeniyle çıkış yapıldı.</td>
    </tr>
</table>
</div>

Eğer kimlik doğrulama işleminden sonra bir geliştirme yapmayı düşünüyorsanız <b>initAuthentication</b> metodunu gözatabilirsiniz.

```php [line-numbers] data-line="27,43"
public function initAuthentication(ServerRequestInterface $request) : ?UserInterface
{
    $post = $request->getParsedBody();
    $usernameField = $this->config['authentication']['form']['username'];
    $passwordField = $this->config['authentication']['form']['password'];
    
    // credentials are given ? 
    //
    if (! isset($post[$usernameField]) || ! isset($post[$passwordField])) {
        $this->error(Self::USERNAME_OR_PASSWORD_FIELDS_NOT_GIVEN);
        return null;
    }
    $this->authAdapter->setIdentity($post[$usernameField]);
    $this->authAdapter->setCredential($post[$passwordField]);

    $eventParams = [
        'request' => $request,
        'username' => $post[$usernameField],
    ];
    // credentials are correct ? 
    //
    $result = $this->authAdapter->authenticate();
    if (! $result->isValid()) {
        //
        // failed attempts event start
        //
        $results = $this->events->trigger(LoginListener::onFailedLogin, null, $eventParams);
        $failedResponse = $results->last();
        if ($failedResponse['banned']) {
            $this->error($failedResponse['message']);
            return null;
        }
        //
        // default behaviour
        //
        $this->error(Self::USERNAME_OR_PASSWORD_INCORRECT);
        return null;
    }
    $rowObject = $this->authAdapter->getResultRowObject();
    //
    // successful login event
    //
    $this->events->trigger(LoginListener::onSuccessfullLogin, null, $eventParams);
    //
    // user is active ? 
    //
    if (empty($rowObject->active)) {
        $this->error(Self::ACCOUNT_IS_INACTIVE_OR_SUSPENDED);
        return null;
    }
    //
    // is the role exists ?
    // 
    $roles = $this->authModel->findRolesById($rowObject->userId);
    if (empty($roles)) {
        $this->error(Self::NO_ROLE_DEFINED_ON_THE_ACCOUNT);
        return null;
    }
    $details = [
        'email' => $rowObject->email,
        'fullname' => $rowObject->fullname,
        'ip' => $this->getIpAddress(),
        'deviceKey' => $this->getDeviceKey($request),
    ];
    return ($this->userFactory)(
        $rowObject->userId,
        $result->getIdentity(),
        $roles,
        $details
    );
}
```

Yukarıdaki anlatılanlar veya burada anlatılmayan durumlar için daha geniş kapsamlı düzenlemeler yapmayı planlıyorsanız <a href="https://docs.laminas.dev/laminas-eventmanager/tutorial/" target="_blank">Laminas EventManager</a> sınıfı ile daha ileri düzeyde bir olay yönetimi gerçekleştirebilirsiniz.

### DefaultUser Sınıfı

Her kimlik doğrulama sonrasında kullanıcı başarılı bir şekilde yaratıldıysa <kbd>Olobase\Mezzio\Authentication\DefaultUser</kbd> isimli sınıf oluşturulur ve bu sınıf değiştirelemez niteliktedir.

```php
<?php
declare(strict_types=1);

namespace Olobase\Mezzio\Authentication;

use Mezzio\Authentication\UserInterface;

/**
 * Default implementation of UserInterface.
 *
 * This implementation is modeled as immutable, to prevent propagation of
 * user state changes.
 *
 * We recommend that any details injected are serializable.
 */
final class DefaultUser implements UserInterface
{
    /**
     * User id
     * @var string
     */
    private $id;

    /**
     * User email
     * @var string
     */
    private $identity;

    /**
     * User roles
     * @var string[]
     */
    private $roles;

    /**
     * User details
     * @var array
     */
    private $details;

    /**
     * Constuctor
     *
     * @param string $id        user_id
     * @param string $identity  user email
     * @param array  $roles     user roles for frontend
     * @param array  $details   extra details
     */
    public function __construct(
        string $id, 
        string $identity, 
        array $roles = [], 
        array $details = []
    )
    {
        $this->id = $id;
        $this->identity = $identity;
        $this->roles = $roles;
        $this->details= $details;
    }

    public function getId() : string
    {
        return $this->id;
    }

    public function getIdentity() : string
    {
        return $this->identity;
    }

    public function getRoles() : array
    {
        return $this->roles;
    }

    public function getDetails() : array
    {
        return $this->details;
    }
    
    public function getDetail(string $name, $default = null)
    {
        return isset($this->details[$name]) ? $this->details[$name] : $default;
    }
}
```

Takip eden örnekte <b>App\Middleware\JwtAuthenticationMiddleware</b> sınıfının içeriği gösteriliyor.

```php [line-numbers] data-line="5,34,36"
declare(strict_types=1);

namespace App\Middleware;

use Mezzio\Authentication\UserInterface;
use Mezzio\Authentication\AuthenticationInterface;
use Firebase\JWT\ExpiredException;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\I18n\Translator\TranslatorInterface as Translator;

class JwtAuthenticationMiddleware implements MiddlewareInterface
{
    /**
     * @var AuthenticationInterface
     */
    protected $auth;

    public function __construct(AuthenticationInterface $auth, Translator $translator)
    {
        $this->auth = $auth;
        $this->translator = $translator;
    }

    /**
     * {@inheritDoc}
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {        
        try {
            $user = $this->auth->authenticate($request);
            if (null !== $user) {
                return $handler->handle($request->withAttribute(UserInterface::class, $user));
            }
        } catch (ExpiredException $e) {

            // 401 Unauthorized response
            // Response Header = 'Token-Expired: true'

            return new JsonResponse(['data' => ['error' => $this->translator->translate('Token Expired')]], 401, ['Token-Expired' => 1]);
        }
        return $this->auth->unauthorizedResponse($request);
    }
}
```

Kimlik doğrulama başarılı ise <b>$this->auth->authenticate()</b> metodu ile <b>DefaultUser</b> sınıfı elde ediliyor; ve elde edilen nesne http ara katmanı ile <b>$request</b> sınıfına <kbd>Mezzio\Authentication\UserInterface</kbd> nitelik olarak kayıt edilerek kullanıcı nesnesinin tüm katmanlarda evrensel olarak elde edilebilmesi sağlanıyor.

```php
$request->withAttribute(UserInterface::class, $user); // Set user
```

Request sınıfına atanan doğrulanmış kullanıcının bilgilerine bir handler sınıfı içerisinden aşağıdaki gibi ulaşabilirsiniz.

```php
$user = $request->getAttribute(UserInterface::class); // get DefaultUser Class
$userId = $user->getId(); // get id from current user
```

Takip eden örnekte FindMeHandler sınıfı içerisinde kullanıcının id değeri elde ediliyor.

<kbd>src/App/Handler/Account/FindMeHandler.php</kbd>

```php [line-numbers] data-line="9,42,43"
<?php
declare(strict_types=1);

namespace App\Handler\Account;

use App\Model\AccountModel;
use Olobase\Mezzio\DataManagerInterface;
use App\Schema\Account\AccountFindMe;
use Mezzio\Authentication\UserInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FindMeHandler implements RequestHandlerInterface
{
    public function __construct(
        private AccountModel $accountModel,
        private DataManagerInterface $dataManager
    ) 
    {
        $this->dataManager = $dataManager;
        $this->accountModel = $accountModel;
    }

    /**
     * @OA\Get(
     *   path="/account/findMe",
     *   tags={"Account"},
     *   summary="Find my account data",
     *   operationId="account_findOneById",
     *
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/AccountFindMe"),
     *   )
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $user = $request->getAttribute(UserInterface::class); // get user from current token
        $userId = $user->getId();
        $row = $this->accountModel->findMe($userId);
        if ($row) {
            $data = $this->dataManager->getViewData(
                AccountFindMe::class,
                $row
            );
            return new JsonResponse($data);            
        }
        return new JsonResponse([], 404);
    }
}
```
