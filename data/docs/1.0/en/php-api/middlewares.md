
## Middlewares

Mezzio allows you to build applications outside of pipeline and routed middleware. Pipeline middleware is the middleware that defines your application's workflow. These typically run on every execution of the application and include example functions such as:

* Error handler
* Language determination
* Session settings
* Authentication and authorization

Routed middleware is middleware that responds only to certain URI paths and HTTP methods. As an example, you might want a middleware that only responds to HTTP POST requests to the /users path.

Mezzio allows you to define middleware using any of the following:

### PSR-15 Middleware Example

The <a href="https://www.php-fig.org/psr/psr-15/" target="_blank">PSR-15 specification</a> covers the HTTP server middleware and request handlers that consume <a href="https://www.php-fig.org/psr/psr-7/" target="_blank">PSR-7 HTTP messages</a>. Mezzio accepts both middleware that implements MiddlewareInterface and request handlers that implement RequestHandlerInterface.

For example:

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

### Configuration

In your application, operations such as including and removing Mezzio middle middleware are done in the <b>config/pipeline.php</b> file, as in the example below.

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

Values in these arrays can be any valid middleware type as defined in this section.

### Authentication Middleware

Below is an example of the widely used <b>JwtAuthenticationMiddleware</b> class, which performs authentication checks in your application.

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

The following example shows a configuration of the above authentication middleware.

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

As seen in the example, in CRUD operations to be performed on all route addresses of the <b>account</b> module, the authorization layer is activated to check whether the user is logged in or not. Thanks to the middleware, a <b>401</b> response is sent to a user whose session has expired, as shown below.

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

### Callable Middleware

Sometimes you may not want to create a class for a one-off middleware. So Mezzio allows you to provide a PHP callable that uses the same signature as <kbd>Psr\Http\Server\MiddlewareInterface</kbd>:

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

One note: neither argument requires a spelling hint, and the examples in the manual will omit the spelling hints when pointing to the callable middleware.

### Service Based Middleware

We encourage using a dependency injection container to provision your middleware. Therefore, Mezzio also allows you to use service names for both pipeline and routed middleware. Generally service names will be specific middleware class names, but can be any valid string that resolves to a service.

When Mezzio is provided with a service name for the middleware, it internally decorates the middleware in a <kbd>Mezzio\Middleware\LazyLoadingMiddleware</kbd> instance and only allows it to be loaded when sent.

Click on the following link <a href="https://docs.mezzio.dev/mezzio/v3/cookbook/host-segregated-middleware/" target="_blank">for more details</a>.