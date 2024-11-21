
## Ara Katmanlar

Mezzio, pipeline ve yönlendirilmiş ara katman yazılımı dışında uygulamalar oluşturmanıza olanak tanır. Pipeline ara katmanı, uygulamanızın iş akışını tanımlayan ara katman yazılımıdır. Bunlar genellikle uygulamanın her yürütülmesinde çalışır ve aşağıdaki gibi örnek işlevler içerir:

* Error işleyici
* Dil belirleme
* Oturum ayarları
* Kimlik doğrulama ve yetkilendirme

Yönlendirilmiş ara yazılım, yalnızca belirli URI yollarına ve HTTP yöntemlerine yanıt veren ara katman yazılımıdır. Örnek olarak, /users yoluna yalnızca HTTP POST isteklerine yanıt veren bir ara katman yazılımı isteyebilirsiniz.

Mezzio, aşağıdakilerden herhangi birini kullanarak ara katman yazılımı tanımlamanıza olanak tanır:

### PSR-15 Ara Katman Örneği

<a href="https://www.php-fig.org/psr/psr-15/" target="_blank">PSR-15 spesifikasyonu</a>, HTTP sunucusu ara katmanını ve <a href="https://www.php-fig.org/psr/psr-7/" target="_blank">PSR-7 HTTP mesajlarını</a> tüketen istek işleyicilerini kapsar. Mezzio, hem MiddlewareInterface'i uygulayan ara yazılımı hem de RequestHandlerInterface'i uygulayan istek işleyicilerini kabul eder.

Örnek olarak:

<kbd>src/App/Middleware/SomeMiddleware.php</kbd>

```php
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SomeMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        // do something and return a response, or
        // delegate to another request handler capable
        // of returning a response via:
        //
        // return $handler->handle($request);
    }
}
```

### Konfigürasyon

Uygulamanızda Mezzio ara katmanlarının uygulamaya dahil edilmesi ve çıkartılması gibi işlemler takip eden örnekte olduğu gibi <b>config/pipeline.php</b> dosyası içerisinde yapılır.

<kbd>config/pipeline.php</kbd>

```php
// Pipeline middleware:
$app->pipe([
    FirstMiddleware::class,
    SecondMiddleware::class,
]);

// Routed middleware:
$app->get('/foo', [
    FirstMiddleware::class,
    SecondMiddleware::class,
]);
```

Bu dizilerdeki değerler, bu bölümde tanımlandığı gibi herhangi bir geçerli ara katman yazılımı türü olabilir.

### Yetki Doğrulama Katmanı

Aşağıda uygulamanızda yetki doğrulama kontrollerini yapan ve yaygın olarak kullanılan <b>JwtAuthenticationMiddleware</b> katmanı örnek olarak gösteriliyor.

<kbd>src/App/Middleware/JwtAuthenticationMiddleware.php</kbd>

```php
<?php

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

Takip eden örnekte yukarıdaki yetki doğrulama katmanına ait bir konfigürasyon gösteriliyor.

```php
return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {

    $auth = [
        JwtAuthenticationMiddleware::class,
        Mezzio\Authorization\AuthorizationMiddleware::class,
    ];
    // Account
    $app->route('/api/account/findMe', [...$auth, ...[App\Handler\Account\FindMeHandler::class]], ['GET']);
    $app->route('/api/account/update', [...$auth, ...[App\Handler\Account\UpdateHandler::class]], ['PUT']);
    $app->route('/api/account/updatePassword', [...$auth, ...[App\Handler\Account\UpdatePasswordHandler::class]], ['PUT']);
};
```

Örnekte görüldüğü gibi <b>account</b> modülüne ait tüm rota adreslerinde yapılacak olan CRUD işlemlerinde yetki doğrulama katmanı devreye sokularak kullanıcının oturum açıp açmadığı kontrol edilmektedir. Oturumunun süresi dolmuş bir kullanıcıya ise katman sayesinde aşağıdaki gibi bir <b>401</b> yanıtı gönderilmektedir.

```php
return new JsonResponse(
    [
        'data' => [
            'error' => $this->translator->translate('Token Expired')
        ]
    ], 
    401, 
    [
        'Token-Expired' => 1
    ]
);
```

### Çağrılabilir Ara Katman

Bazen tek seferlik ara katman yazılımı için bir sınıf oluşturmak istemeyebilirsiniz. Bu nedenle Mezzio, <kbd>Psr\Http\Server\MiddlewareInterface</kbd> ile aynı imzayı kullanan çağrılabilir bir PHP sağlamanıza izin verir:

```php
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

function (ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
{
    // do something and return a response, or
    // delegate to another request handler capable
    // of returning a response via:
    //
    // return $handler->handle($request);
}
```

Bir not: her iki argüman da bir yazım ipucu gerektirmez ve kılavuzdaki örnekler, çağrılabilir ara yazılımı gösterirken yazım ipuçlarını atlayacaktır.

### Servis Tabanlı Ara Katman

Ara katman yazılımınızı sağlamak için bir bağımlılık ekleme kapsayıcısı kullanılmasını teşvik ediyoruz. Bu nedenle Mezzio, hem işlem hattı hem de yönlendirilmiş ara katman yazılımı için hizmet adlarını kullanmanıza da olanak tanır. Genel olarak hizmet adları, belirli ara katman sınıfı adları olacaktır, ancak bir hizmete çözümlenen geçerli herhangi bir dize olabilir.

Mezzio'ya ara katman yazılımı için bir hizmet adı sağlandığında, ara yazılımı bir <kbd>Mezzio\Middleware\LazyLoadingMiddleware</kbd> örneğinde dahili olarak dekore eder ve yalnızca gönderildiğinde yüklenmesine izin verir.

Daha fazla ayrıntı için aşağıdaki  <a href="https://docs.mezzio.dev/mezzio/v3/cookbook/host-segregated-middleware/" target="_blank">bağlantıya tıklayın</a>.

