
## Routes

Routes are configured within the application from the <kbd>/config/routes.php</kbd> file. For private routes that require authentication, <kbd>App\Middleware\JwtAuthenticationMiddleware</kbd> is used.

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

Another private route example;

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

### Route Options

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

For more detailed information about the routes, see the link <a href="https://docs.laminas.dev/laminas-router/routing/#http-routing-examples" target="_blank">Laminas Router</a>.

### An Example

To test whether the <kbd>/api/:version/.\*</kbd> route shown above works or not, let's create a middleware named <b>RouteTestMiddleware</b> in the <kbd>App\Middleware\</kbd> folder.

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

We must define this middleware, which we created for testing purposes, in the pipeline.php file as follows.

<kbd>config/pipeline.php</kbd>

```php
use App\Middleware\RouteTestMiddleware;

// Register your middleware in the middleware pipeline.
$app->pipe(RouteTestMiddleware::class);
```

Test the middleware by visiting the route address.

```txt
http://demo.local/api/1.0/index.html
```

As a result of the test, you should get an output like the following.

```php
/*
[version] => 1.0
*/
```

## Route Methods

#### $route->getPath(): string

Returns the current url path value.

```php
echo $route->getPath(); //  /docs/php-api/routes
```

#### $route->setName(string $name): void

Assigns a name to the route.

```php
$route->setName('auth');
```
  
#### $route->getName(): string
    
Returns to route name.

```php
echo $route->getName(); // 'auth'
```

#### $route->getMiddleware(): MiddlewareInterface

Returns to route middleware.

```php
$route->getMiddleware();
```

#### $route->getAllowedMethods(): ?array
    
Returns route specific methods.

```php
$route->getAllowedMethods(); // ['POST', 'GET']
```

#### $route->allowsMethod(string $method): bool

Lets you understand whether the specified method is allowed by the route.

```php
$route->allowsMethod('POST'); // true
```

#### $route->allowsAnyMethod(): bool

Lets you know if any method is allowed by the route.

```php
$route->allowsAnyMethod(); // true
```

#### $route->setOptions(array $options): void

Allows you to assign options to the route.

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

Returns to route options.

## RouteResult

```php
$result = $request->getAttribute(Mezzio\Router\Result::class);
```

## RouteResult Methods

#### $result->isSuccess(): bool

If the result represents successful redirection, it returns <kbd>true</kbd>.

```php
var_dump($result->isSuccess());
// true
```

#### $result->getMatchedRoute()

Returns the route object that resulted in the route match.

```php
echo get_class($result->getMatchedRoute()); // Mezzio\Router\Route
```

#### $result->getMatchedRouteName()

Allows you to get the matching route name. If this result is unsuccessful, set to false; otherwise, it returns the matching route name.

```php
echo $result->getMatchedRouteName(); // /api/auth/token^POST
```

#### $result->getMatchedParams(): array

Matching route returns parameters. It is guaranteed to return an array even if the parameter is empty.

```php
print_r(array_keys($result->getMatchedParams())); // Array ([0] => middleware)
```

#### $result->isFailure(): bool

If this route match fails, it returns <kbd>true</kbd>.

```php
var_dump($result->isFailure());
// false
```

#### $result->isMethodFailure(): bool

The result returns <kbd>false</kbd> if there is a redirect failure due to the HTTP method.

```php
var_dump($result->isMethodFailure());
// false
```

#### $result->getAllowedMethods(): ?array

Returns the methods allowed for this route.

```php
print_r($result->getAllowedMethods()); // Array ([0] => POST)
```

For more information you can visit <a href="https://docs.mezzio.dev/mezzio/v3/features/router/intro/">https://docs.mezzio.dev/mezzio/v3/features/router/intro</a>.