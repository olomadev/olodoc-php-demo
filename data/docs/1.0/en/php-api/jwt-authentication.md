
## Jwt Authentication

JWT (<a href="https://jwt.io/" target="_blank">JSON Web Tokens</a>) is an <a href="https://datatracker.ietf.org/doc/html/rfc7519" target="_blank">RFC7519</a> industry standard. JWT can be used in many issues such as user authentication, web service security, information security. JWT is a very popular and preferred method.

A JWT authentication method works <kbd>Session Stateless</kbd>. This means that it is stateless and the server does not store any state about the client session on the server side. In other words, user information and session expiration date are kept neither on the server nor on the client side. All information is in the token.

## JWT Advantages

1. It works <b>Session Stateless</b>. Stateless means that the server does not store any state about the client session on the server side. In other words, the information and its expiration date are kept neither on the server nor on the client side. All information is in the token.
2. Works <b>Portable</b>. It can be easily used by both your web application and mobile applications.
3. It uses <b>JSON</b> format.
4. The verification process is faster than other authentication methods. A connection to the database is not established for the verification process.
5. There is no need to use cookies. Thus, it provides an advantage for <b>mobile</b> based applications.

Click the following link for <a href="https://www.secopsolution.com/blog/jwt-weaknesses#:~:text=One%20of%20the%20most%20significant,JWT%20remains%20exposed%20in%20plaintext.
" target="_blank">Jwt disadvantages</a>.

## Security Measures Available in Olobase for JWT

We can talk about a series of measures used in Olobase to eliminate the disadvantages described above.

* <a href="https://www.scottbrady91.com/jose/jwts-which-signing-algorithm-should-i-use" target="_blank">EdDSA</a> Algorithm
* Token Validity and Refresh
* Token Encryption
* Session Lifetime
* User Browser and IP Validation

## JWT Structure

A token signed with JWT consists of 3 main parts encoded with <b>Base64</b>. These are Header, Payload and Signature sections. If we pay attention to the token example below, there are 3 fields separated by dots as aaa.bbb.ccc.

```string
Example Token: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdGF0dXMiOiJ0ZWJyaWtsZXIhIDopIn0.sTLXY5iAs1IzJJ-8GVP_pMR65qqgCUpbMl-aSPcrQHc
```

### Header

This part to be used in JWT is written in JSON format and consists of 2 fields. These are the token type and the name of the algorithm to be used for signing.

For example:

```json
{
  "typ": "JWT",
  "alg": "EdDSA"
}
```

Many different algorithms can be used in the algorithm section, such as EdDSA, HS256, HMAC SHA256 or RSA. In the Type section, it says JWT. This part is encoded with Base64 and forms the first part of the token to be created.

### Payload (Data)

This section contains claims. With the data held in this section, the token becomes unique between the client and the server. This retained claim information also provides this uniqueness. There are 3 types of claims in this section.

### Registered Claims

These are 3-letter long claims pre-reserved by JWT. In other words, you cannot use these set claim names in other claims. Use of this information is not required, but is recommended. Some of these claims are iss (issuer), exp (expiration time), sub (subject), aud (audience) and others. The most used of these is expiration time. For example, if you want your coin information to be invalid after 3 hours, you send this information in the exp field. Requests with the same token after 3 hours will be considered invalid.

### Public Claims

These are optional, openly published claims.

### Private Claims

These are secret claims used by the parties to convey information between themselves.

An example payload:

```json
{
  "sub": "1234567890",
  "name": "John Doe",
  "email": "john@example.com",
  "iat": 1516239022
}
```

This part is encoded with Base64 and forms the second part of the token to be created.

> You should not put sensitive data such as user password in the token because JWT tokens are encoded with the base64 function so they can be easily read when captured.

### Signature

This part is the last part of the coin. Header, payload and secret key (secret) are required to create this part. Data integrity is guaranteed with the signature section. The secret key we use here is used for the algorithm we specified in the Header section. Header and Payload sections are signed with this secret key.

```string
HMACSHA256(
  base64UrlEncode(header) + "." +
  base64UrlEncode(payload),
  your-256-bit-secret
)
```

### JWT Verification

As we mentioned in the scenario above, the verification process is used by the client to check the authority of the user after the token is received. Whether the token is valid or not is verified with JWT. JWT validation process is quite simple. In the incoming token, Header and Payload are signed with the secret key on our server and the 3rd part is calculated. This generated signature is then compared with the signature received by the client. If the signatures are the same, the token is considered valid and the user is granted access.

## Configuration

In this section, you will need to take the following steps before signing in to your application:

* Generating Jwt Keys
* Authorization configuration for Local Environment
* Control of SQL Table
* Configuration of Token Renewal Times
* Login Test
* JwtAuthenticationMiddleware

### Generating JWT Keys

1. Generate random 16 character srtring for <b>encryption.iv</b> key. You can use online <a href="https://www.random.org/strings/?num=2&len=16&digits=on&upperalpha=on&loweralpha=on&unique=on&format=html&rnd=new" target="_blank">random.org</a> to generate.
2. Generate a <b>encryption.secret_key</b> for token encryption:

```php
echo base64_encode(openssl_random_pseudo_bytes(32)); // ewQrCBs/3Mp7RKgtbjd4jjdOJLY8uyENcmKcssQnvWE=
```
3. The jwt encoder uses two public and private keys, <b>private_key</b> when signing tokens and <b>public_key</b> when reading tokens. Perform the following operation in any php file.

```php
$keyPair = sodium_crypto_sign_keypair();
$publicKey = base64_encode(sodium_crypto_sign_publickey($keyPair));
$privateKey = base64_encode(sodium_crypto_sign_secretkey($keyPair));

echo $publicKey."\n";  // W9JHddARm1iwrIV+DhlQ1t0vGxWwgwVTHyHpjq6n4L8=
echo $privateKey."\n"; // KXgCiGnLLkYI/j/uGOgmSn5P9lATSZcd/p86azEgwW1b0kd10BGbWLCshX4OGVDW3S8bFbCDBVMfIemOrqfgvw==
```

> You must regenerate keys in each project to avoid causing security risks in your application.

You must define the key you created in the <b>public_key</b> and <b>private_key</b> fields as follows.

### Token Configuration

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
        <th>Key</th>
        <th>Description</th>
    </thead>
    <tbody>
    <tr>
        <td>encryption.iv</td>
        <td>Generate a random 16 character srtring. You can use online <a href="https://www.random.org/strings/?num=2&len=16&digits=on&upperalpha=on&loweralpha=on&unique=on&format=html&rnd=new" target="_blank">random.org</a> to generate.</td>
    </tr>
    <tr>
        <td>encryption.enabled</td>
        <td>Turns on/off the encryption feature of the token before it is sent to the user. It is strongly recommended that encryption be turned on in the production environment.</td>
    </tr>
    <tr>
        <td>encryption.secret_key</td>
        <td>Generate a random secret password using this method. <code>base64_encode(openssl_random_pseudo_bytes(32));</code>  You should not share this password with anyone.</td>
    </tr>
    <tr>
        <td>public_key</td>
        <td>Public and private keys are expected to be Base64 encoded. Look at above the example to create public keys.</td>
    </tr>
    <tr>
        <td>private_key</td>
        <td>The secret keys generated by other tools may need to be adjusted to match the input expected by libsodium. Look at above the example to create private keys. You should not share this password with anyone.</td>
    </tr>
    <tr>
        <td>session_ttl</td>
        <td>Determines the lifetime of the session. In other words, after the token is signed, how long the user will stay in the system is recorded in the cache. As long as the user's browser is open, this time is reset each time with automatic HTTP requests sent every <b>5 minutes</b>. This ensures that users whose browsers are open remain in the system. When the browser is closed, the user session ends automatically as this cache time expires. The lifetime of the session should not be less than <b>10 minutes</b>. Otherwise, your users' sessions may terminate at unexpected times. If you still want to reduce this time, you should reduce the <b>VITE_SESSION_UPDATE_TIME</b> time defined in the <b>.env.*</b> file of your frontend application.</td>
    </tr>
    <tr>
        <td>token_validity</td>
        <td>It determines how long it takes for the tokens given to the user to be renewed. The shorter this time, the more your application security will increase, but less than 5 minutes may exhaust server and client resources.</td>
    </tr>
    <tr>
        <td>validation.user_ip</td>
        <td>If the user's current IP address does not match the IP address stored in the token, the user is logged out.</td>
    </tr>
    <tr>
        <td>validation.user_agent</td>
        <td>If the user's agent does not match the agent stored in the token, the user is logged out.</td>
    </tr>
    </tbody>
</table>
</div>

### SQL Query Table

During login, <kbd>App\Authentication\AuthenticationAdapter</kbd> performs the SQL query based on the <b>tablename</b>, <b>username</b> and <b>password</b> columns defined in the configuration.

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

Make sure that your table named <kbd>users</kbd> exists in the database.

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

### Login Test

After making your database and Jwt configuration settings, perform a login test with the <a href="https://www.postman.com/" target="_blank">Postman</a> application. Open a new tab and enter your auth url address in the url section as follows: <b>http://demo.local/api/auth/token</b>.

```string
http://demo.local/api/auth/token
```

Try logging in to the json raw body using the Http POST method with a user you select from your user table.

```json
{
  "username": "demo@example.com",
  "password": "12345678"
}
```

If the login test is successful, you will receive a response as follows.

![Postman Login Test](/images/postman-login.png)

An example token response is,

```string
eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE2OTk1MjAwNDUsImp0aSI6IjE1ZjhiNjY1MGE3ZTM3ODc2NDRhY2Y3Y2ZiMTIzNDQ2IiwiaXNzIjoiaHR0cDovL3ZhLWRlbW8tcGhwIiwibmJmIjoxNjk5NTIwMDQ1LCJleHAiOjE2OTk1MjAzNDUsImRhdGEiOnsidXNlcklkIjoiYzEzZTU1MGEtNjBlZS00OGQ1LWJmNmUtZWQyOTMxMDY0MGIyIiwiaWRlbnRpdHkiOiJkZW1vQGV4YW1wbGUuY29tIiwicm9sZXMiOlsiYWRtaW4iLCJzYWxlcyJdLCJkZXRhaWxzIjp7ImVtYWlsIjoiZGVtb0BleGFtcGxlLmNvbSIsImZpcnN0bmFtZSI6IkRlbW8iLCJsYXN0bmFtZSI6IkFkbWluIiwiaXAiOiIxOTIuMTY4LjIzMS4xIiwiZGV2aWNlS2V5IjoiMWQyMGZlMTExODBiODIxN2FkNmE0NTZlNjc0NWQ0OTkifX19._iUg9YK9DqOPEooacCTKvhzPew_vzWEplpj5Z-Sfw1Y
```

You can view each token you have obtained by decoding it with the <kbd>base64_decode</kbd> command. When you parse the above token response at <a href="https://jwt.io" target="_blank">jwt.io</a>, you will get output as in the following example.

![Postman Login Test](/images/jwt.io.png)

### Jwt Authentication Middleware

To add authentication to your routes, the <kbd>App\Middleware\JwtAuthenticationMiddleware</kbd> class must be included in each route, as in the following example.

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

If a route <b>does not require authentication</b> it will be sufficient to remove the <kbd>$auth</kbd> variable from the relevant array and just enter the handler name.

```php
// Common (public) resources
// 
$app->route('/api/stream/events', App\Handler\Common\Stream\EventsHandler::class, ['GET']);
$app->route('/api/years/findAll', App\Handler\Common\Years\FindAllHandler::class, ['GET']);
```

## Authentication Errors

In order to control the events that occur before or after the user login, the <kbd>App\Authentication\JwtAuthentication</kbd> class simply handles the following errors if it occurs for the user without requiring any event class.

<div class="table-responsive">
<table class="table">
    <tr>
        <th>Key</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>AUTHENTICATION_REQUIRED</td>
        <td>Authentication required. Please log in to your account.</td>
    </tr>
    <tr>
        <td>USERNAME_OR_PASSWORD_FIELDS_NOT_GIVEN</td>
        <td>Username and password fields must be entered.</td>
    </tr>
    <tr>
        <td>USERNAME_OR_PASSWORD_INCORRECT</td>
        <td>Username or password is incorrect.</td>
    </tr>
    <tr>
        <td>ACCOUNT_IS_INACTIVE_OR_SUSPENDED</td>
        <td>This account is pending approval or has been suspended.</td>
    </tr>
    <tr>
        <td>NO_ROLE_DEFINED_ON_THE_ACCOUNT</td>
        <td>There is no role defined for this user.</td>
    </tr>
    <tr>
        <td>IP_VALIDATION_FAILED</td>
        <td>Your IP address could not be verified and has been logged out for security reasons.</td>
    </tr>
    <tr>
        <td>USER_AGENT_VALIDATION_FAILED</td>
        <td>Your browser could not be verified and has been logged out for security reasons.</td>
    </tr>
</table>
</div>

If you are thinking of making an improvement after the authentication process, you can take a look at the <b>initAuthentication</b> method.

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

If you are planning to make more extensive arrangements for the situations described above or situations not explained here, you can use the <a href="https://docs.laminas.dev/laminas-eventmanager/tutorial/" target="_blank">Laminas EventManager</a> class. You can perform advanced event management.

### DefaultUser Class

If the user is created successfully after each authentication, a class named <kbd>Olobase\Mezzio\Authentication\DefaultUser</kbd> is created and this class is immutable.

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

The following example shows the content of the <b>App\Middleware\JwtAuthenticationMiddleware</b> class.

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

If the authentication is successful, the <b>DefaultUser</b> class is obtained with the <b>$this->auth->authenticate()</b> method; and the resulting object is recorded as a <kbd>Mezzio\Authentication\UserInterface</kbd> attribute in the <b>$request</b> class with the http middleware, ensuring that the user object can be obtained globally in all middlewares.

```php
$request->withAttribute(UserInterface::class, $user); // Set user
```

You can access the information of the authenticated user assigned to the Request class from a handler class as follows.

```php
$user = $request->getAttribute(UserInterface::class); // get DefaultUser Class
$userId = $user->getId(); // get id from current user
```

In the following example, the user's ID value is obtained in the FindMeHandler class.

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
