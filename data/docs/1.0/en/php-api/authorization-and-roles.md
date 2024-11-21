
## Authorization and Roles

After the authentication process is successful, the following operations occur respectively:

1. The roles of the authenticated user are stored in the token.
2. In the <b>AuthorizationMiddleware</b>, the <b>PermissionModel->findPermissions()</b> method reads the authorizations of the relevant roles and decides whether the user is authorized for the relevant route.

```json [line-numbers] data-line="8"
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

### AuthorizationMiddleware

In order to perform authorization control on your routes, you must attach the <kbd>Mezzio\Authorization\AuthorizationMiddleware</kbd> class to the relevant route as a middleware. This way the middleware class can start checking authorization for each role.

```php [line-numbers] data-line="3"
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
```

### SQL Codes

In order for roles and authorizations to work, the following tables must be defined in the database. These tables are already defined in the demo application. You can obtain more up-to-date SQL codes from the database file of the demo application.

```sql
/*
    Roles table
*/
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `roleId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `roleKey` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `roleName` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `roleLevel` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`roleId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `roles`(`roleId`,`roleKey`,`roleName`,`roleLevel`) VALUES 
('6be6178d-fe99-47b6-90d5-2a0c4d25b6dc','admin','Administrator',10),
('9d548023-899f-461e-bd45-c925a66499ee','sales','Sales',5),
/*
    Permissions table
*/
DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `permId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `moduleName` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `route` varchar(160) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `method` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `action` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`permId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `permissions`(`permId`,`moduleName`,`route`,`method`,`action`) values 
('060ecb64-7387-4073-8a42-5b8ce38013f9','Companies','/api/companies/findAllByPaging','GET','list');
/*
    Role Permissions assignment table
*/
DROP TABLE IF EXISTS `rolePermissions`;
CREATE TABLE `rolePermissions` (
  `roleId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `permId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`roleId`,`permId`) USING BTREE,
  KEY `fk_role_perms_to_perms` (`permId`) USING BTREE,
  CONSTRAINT `fk_role_perms_to_perms` FOREIGN KEY (`permId`) REFERENCES `permissions` (`permId`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_perms_to_roles` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `rolePermissions`(`roleId`,`permId`) VALUES 
('6be6178d-fe99-47b6-90d5-2a0c4d25b6dc','060ecb64-7387-4073-8a42-5b8ce38013f9');
/*
    User Roles table
*/
DROP TABLE IF EXISTS `userRoles`;
CREATE TABLE `userRoles` (
  `userId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `roleId` varchar(36) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`userId`,`roleId`) USING BTREE,
  KEY `fk_role_to_roles` (`roleId`) USING BTREE,
  CONSTRAINT `fk_role_to_roles` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `fk_roleUser_to_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

INSERT INTO `userRoles`(`userId`,`roleId`) values 
('--add-your--user--id--','6be6178d-fe99-47b6-90d5-2a0c4d25b6dc');
```

### Authorization

The <kbd>isGranted</kbd> method is used to check whether a role has authorization for the incoming request.

```php
declare(strict_types=1);

namespace Mezzio\Authorization;

use Psr\Http\Message\ServerRequestInterface;

interface AuthorizationInterface
{
    /**
     * Check if a role is granted for the request
     */
    public function isGranted(string $role, ServerRequestInterface $request): bool;
}
```

When the application runs, as seen in the <kbd>config\config.php</kbd> file, from Olobase components with <b>Olobase\Mezzio\ConfigProvider::class</b>;

```php [line-numbers] data-line="19"
<?php
declare(strict_types=1);

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \Mezzio\Authentication\LaminasAuthentication\ConfigProvider::class,
    \Mezzio\Authentication\ConfigProvider::class,
    /*.. */
    
    \Olobase\Mezzio\ConfigProvider::class, // Olobase php components

    /*.. */
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
```

the <b>AuthorizationFactory</b> class is included in your application as follows.

```php [line-numbers] data-line="18"
<?php
declare(strict_types=1);

namespace Olobase\Mezzio;

class ConfigProvider
{
    /**
     * Return application-level dependency configuration.
     *
     * @return ServiceManagerConfigurationType
     */
    public function getDependencyConfig()
    {
        return [
            'factories' => [
                \Mezzio\Authentication\UserInterface::class => Authentication\DefaultUserFactory::class,
                \Mezzio\Authorization\AuthorizationInterface::class => Authorization\AuthorizationFactory::class,
                Error\ErrorWrapperInterface::class => Error\ErrorWrapperFactory::class,
                Authentication\JwtEncoderInterface::class => Authentication\JwtEncoderFactory::class,
                ColumnFiltersInterface::class => ColumnFiltersFactory::class,
                DataManagerInterface::class => DataManagerFactory::class,
            ],
        ];
    }
}
```

The following code block shows the content of the <kbd>Olobase\Mezzio\Container\AuthorizationFactory</kbd> class.

```php
<?php
declare(strict_types=1);

namespace Olobase\Mezzio\Container;

use Olobase\Mezzio\Authorization\Authorization;
use Olobase\Mezzio\Authorization\PermissionModelInterface;
use Psr\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class AuthorizationFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new Authorization($container->get(PermissionModelInterface::class));
    }
}
```

As you can see, the <kbd>Olobase\Mezzio\Authorization\Authorization</kbd> class is called from the <kbd>Olobase\Mezzio\Container\AuthorizationFactory</kbd> class.

### Olobase\Mezzio\Authorization\Authorization

As in the example in the <kbd>Authorization</kbd> class of the following Olobase code, the <b>isGranted</b> method is <b>true</b> if the user role has authority to the current route, otherwise <b>false</b > returns to value.

```php [line-numbers] data-line="23,43"
<?php
declare(strict_types=1);

namespace Olobase\Mezzio\Authorization;

use Mezzio\Authorization\AuthorizationInterface;
use Mezzio\Authorization\Exception;
use Mezzio\Router\RouteResult;
use Psr\Http\Message\ServerRequestInterface;

use function sprintf;
use function in_array;

class Authorization implements AuthorizationInterface
{
    private $permissions = array();

    public function __construct(PermissionModelInterface $permissionModel)
    {
        $this->permissions = $permissionModel->findPermissions();
    }

    public function isGranted(string $role, ServerRequestInterface $request) : bool
    {
        $routeResult = $request->getAttribute(RouteResult::class, false);
        if (false === $routeResult) {
            throw new Exception\RuntimeException(sprintf(
                'The %s attribute is missing in the request; cannot perform authorizations',
                RouteResult::class
            ));
        }
        // No matching route. Everyone can access.
        if ($routeResult->isFailure()) {
            return true;
        }
        $permissions = $this->getPermissions($role);
        if (false == $permissions) {
            return false;
        }
        // Check user has permission to the route
        //
        $routeName = $routeResult->getMatchedRouteName();
        if (in_array($routeName, $permissions)) {
            return true;
        }
        return false;
    }

    private function getPermissions(string $role)
    {
        if (! empty($this->permissions[$role])) {
            return $this->permissions[$role];
        }
        return false;
    }
}
```

### PermissionModel

Your <kbd>App\Model\PermissionModel</kbd> class is called from the <kbd>Olobase\Mezzio\Authorization</kbd> class and the <b>isGranted</b> method decides which role has which privileges.

```php
$this->permissions = $permissionModel->findPermissions();
print_r($this->permissions);
/*
Array
(
    [admin] => Array
    (
        [0] => /api/companies/create^POST
        [1] => /api/companies/update/:companyId^PUT
        [2] => /api/companies/findOneById/:companyId^GET
        [3] => /api/companies/delete/:companyId^DELETE
        [4] => /api/companies/findAllByPaging^GET
        [5] => /api/companies/findAll^GET

    [sales] => Array
    (
        [0] => /api/expenses/findOneById/:expenseId^GET
    )
)
*/
```

> Authorizations are cached in the <b>PermissionModel</b> and a good amount of performance gain is achieved for each authorization request.
