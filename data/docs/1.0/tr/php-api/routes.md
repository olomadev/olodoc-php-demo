
## Rotalar

Rotalar uygulama içerisinde <kbd>/config/routes.php</kbd> dosyasından konfigüre edilirler. Authentication gerektiren private rotalar için <kbd>App\Middleware\JwtAuthenticationMiddleware</kbd> kullanılır.

```php
declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use App\Middleware\JwtAuthenticationMiddleware;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {

	// public
	$app->route('/api/auth/token', App\Handler\Api\AuthHandler::class, ['POST']);
	$app->route('/api/auth/refresh', [App\Handler\Api\AuthHandler::class], ['POST']);

	// private
	$app->route('/api/auth/changePassword', [JwtAuthenticationMiddleware::class, App\Handler\Api\AuthHandler::class], ['PUT']);
	$app->route('/api/auth/logout', [JwtAuthenticationMiddleware::class, App\Handler\Api\AuthHandler::class], ['GET']);
}
```

Bir başka private rota örneği;

```php
return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {

	// private
    $companies = [
        JwtAuthenticationMiddleware::class,
        Mezzio\Authorization\AuthorizationMiddleware::class,
        App\Handler\Api\CompanyHandler::class
    ];
    $app->route('/api/companies/create', $companies, ['POST']);
    $app->route('/api/companies/update/:companyId', $companies, ['PUT']);
    $app->route('/api/companies/delete/:companyId', $companies, ['DELETE']);
    $app->route('/api/companies/findAll', $companies, ['GET']);
    $app->route('/api/companies/findAllByPaging',$companies, ['GET']);
    $app->route('/api/companies/findOneById/:companyId', $companies, ['GET']);
}
```

### Route Opsiyonları

```php
$apiHandler = [
    App\Middleware\SetLocaleMiddleware::class,
    App\Middleware\VersionValidateMiddleware::class,
    App\Handler\ApiIndexHandler::class
];
$app->route('/api/:version/.*', $apiHandler, ['GET'], 'doc_index')
    ->setOptions(
    [
        'constraints' => [
            'version' => '\d.{1,4}',
        ],
    ]
);
```

Rotalar hakkında daha detaylı bilgi için <a href="https://docs.laminas.dev/laminas-router/routing/#http-routing-examples" target="_blank">Laminas Router</a> bağlantısına göz atın.

### Bir Örnek

Yukarıda gösterilen <kbd>/api/:version/.\*</kbd> rotasını çalışıp çalışmadığını test etmek için <kbd>App\Middleware\</kbd> klasörü içerisinde <b>RouteTestMiddleware</b> isimli bir ara katman yaratalım.

```php
declare(strict_types=1);

namespace App\Middleware;

use Mezzio\Router\RouterInterface;
use Mezzio\Router\Result as RouteResult;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\I18n\Translator\TranslatorInterface;

class RouteTestMiddleware implements MiddlewareInterface
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : ResponseInterface
    {
        $routeResult = $request->getAttribute(RouteResult::class);
        $params = $routeResult->getMatchedParams();
        print_r($params);
        return $handler->handle($request);
    }
}
```

Test amaçlı oluşturduğumuz bu ara katmanı pipeline.php dosyası içerisinde aşağıdaki gibi tanımlamalıyız. 

<kbd>config/pipeline.php</kbd>

```php
use App\Middleware\RouteTestMiddleware;

// Register your middleware in the middleware pipeline.
$app->pipe(RouteTestMiddleware::class);
```

Rota adresini ziyaret ederek ara katmanı test edin.

```txt
http://demo.local/api/1.0/index.html
```

Test sonucunda aşağıdaki gibi bir çıktı elde etmiş olmalısınız.

```php
/*
[version] => 1.0
*/
```

## Route Metotları

#### $route->getPath(): string

Geçerli url path değerine geri döner.

```php
echo $route->getPath(); //  /docs/php-api/routes
```

#### $route->setName(string $name): void

Rotaya bir isim atar.

```php
$route->setName('auth');
```
  
#### $route->getName(): string
    
Rota ismine geri döner.

```php
echo $route->getName(); // 'auth'
```

#### $route->getMiddleware(): MiddlewareInterface

Rota ara katmanlarına geri döner.

```php
$route->getMiddleware();
```

#### $route->getAllowedMethods(): ?array
    
Rotaya tanımlı metotlara geri döner.

```php
$route->getAllowedMethods(); // ['POST', 'GET']
```

#### $route->allowsMethod(string $method): bool

Belirtilen yönteme rota tarafından izin verilip verilmediğini anlamanızı sağlar.

```php
$route->allowsMethod('POST'); // true
```

#### $route->allowsAnyMethod(): bool

Rota tarafından herhangi bir yönteme izin verilip verilmediğini anlamanızı sağlar.

```php
$route->allowsAnyMethod(); // true
```

#### $route->setOptions(array $options): void

Rotaya opsiyonlar atamanızı sağlar.

```php
$route->setOptions(
    [
        'constraints' => [
            'version' => '\d.{1,4}',
        ],
    ]
);
```

#### $route->getOptions(): array

Rotaya opsiyonlarına geri döner.

## RouteResult

```php
$result = $request->getAttribute(Mezzio\Router\Result::class);
```

## RouteResult Metotları

#### $result->isSuccess(): bool

Sonuç başarılı yönlendirmeyi temsil ediyorsa <kbd>true</kbd> değerine döner.

```php
var_dump($result->isSuccess());
// true
```

#### $result->getMatchedRoute()

Rota eşleşmesiyle sonuçlanan rota nesnesine geri döner.

```php
echo get_class($result->getMatchedRoute()); // Mezzio\Router\Route
```

#### $result->getMatchedRouteName()

Eşleşen rota adını almanızı sağlar. Bu sonuç başarısız ise, false değerine; aksi takdirde, eşleşen rota adına döner.

```php
echo $result->getMatchedRouteName(); // /api/auth/token^POST
```

#### $result->getMatchedParams(): array

Eşleşen rota parametrelere geri döner. Parametre boş bile olsa bir dizi dönmek garanti edilir.

```php
print_r(array_keys($result->getMatchedParams())); // Array ([0] => middleware)
```

#### $result->isFailure(): bool

Bu rota eşleşmesi başarısız ise <kbd>true</kbd> değerine geri döner.

```php
var_dump($result->isFailure());
// false
```

#### $result->isMethodFailure(): bool

Sonuç, HTTP yöntemi nedeniyle yönlendirme başarısızlığı varsa <kbd>false</kbd> değerine geri döner.

```php
var_dump($result->isMethodFailure());
// false
```

#### $result->getAllowedMethods(): ?array

Bu rota için izin verilen yöntemlere geri döner.

```php
print_r($result->getAllowedMethods()); // Array ([0] => POST)
```

Daha fazla bilgi için <a href="https://docs.mezzio.dev/mezzio/v3/features/router/intro/">https://docs.mezzio.dev/mezzio/v3/features/router/intro/</a> adresini ziyaret edebilirsiniz.