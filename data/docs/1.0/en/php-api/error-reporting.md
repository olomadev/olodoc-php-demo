
## Error Reporting

When you transfer your project to a production server, it is impossible to see the error that every user encounters. In order to intervene early in such cases, you can create an error reporter class as in the following example and call this class from the <kbd>App\Middleware\ErrorResponseGenerator</kbd> middleware to ensure that active errors are recorded in the database once and reported by email.

```php
<?php
declare(strict_types=1);

namespace App\Middleware;

use Throwable;
use App\Utils\ErrorMailer;
use Psr\Container\ContainerInterface;
use App\Exception\ConsultationSessionException;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class ErrorResponseGenerator
{
    protected $config;
    protected $container;

    public function __construct(array $config, ContainerInterface $container)
    {
        $this->config = $config;
        $this->container = $container;
    }

    public function __invoke(Throwable $e, ServerRequestInterface $request, ResponseInterface $response)
    {
        $data = $e->getTrace();
        $trace = array_map(
            function ($a) {
                    if (isset($a['file'])) {
                        $a['file'] = str_replace(PROJECT_ROOT, '', $a['file']);
                    }
                    return $a;
                },
            $data
        );        
        $json = [
            'title' => get_class($e),
            'type' => 'https://httpstatus.es/400',
            'status' => 400,
            'file' => str_replace(PROJECT_ROOT, '', $e->getFile()),
            'line' => $e->getLine(),
            'error' => $e->getMessage(),
        ];
		if (getenv('APP_ENV') == 'local') { // enable trace on local mode
	        $json['trace'] = $trace;
	    }
        $response = $response->withHeader('Access-Control-Allow-Origin', '*');
        $response = $response->withHeader('Access-Control-Allow-Headers', '*');
        $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');
        $response = $response->withHeader('Access-Control-Expose-Headers', 'Token-Expired');
        $response = $response->withHeader('Access-Control-Max-Age', '3600');
        $response = $response->withHeader('Content-Type', 'application/json');
        $response = $response->withStatus(400);
        $response->getBody()->write(json_encode($json));

        // Error mailer
        // 
        if (getenv('APP_ENV') == 'prod') {
            $class = get_class($e);
            if (false === strpos($class, 'App\Exception') 
                AND false === strpos($class, 'Laminas\Validator\Exception')) {
                $errorMailer = $this->container->get(ErrorMailer::class);
                $errorMailer->setException($e);
                $errorMailer->setUri($request->getUri()->getPath());
                $errorMailer->setServerParams($request->getServerParams());
                $errorMailer->send();
            }
        }
        return $response;
    }
}
```

### ErrorResponseGenerator

In order for error reporting to work, the <kbd>App\Middleware\ErrorResponseGenerator</kbd> middleware must be defined at the top level in the <kbd>config/pipeline.php</kbd> file as follows.

```php
return function (Application $app, MiddlewareFactory $factory, ContainerInterface $container) : void {

    $config = $container->get('config');
    $errorHandler = new ErrorHandler(
        function () {
            return new Response;
        },
        new App\Middleware\ErrorResponseGenerator($config, $container)
    );
    $app->pipe($errorHandler);

    // This middleware registers the Mezzio\Router\RouteResult request attribute.
    $app->pipe(RouteMiddleware::class);
}
```

### ErrorMailerFactory

<kbd>App\Container\ErrorMailerFactory</kbd> Allows you to inject the ErrorMailer class into other classes.

```php
declare(strict_types=1);

namespace App\Container;

use App\Utils\SmtpMailer;
use App\Utils\ErrorMailer;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\AdapterInterface;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\I18n\Translator\TranslatorInterface;

class ErrorMailerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
    	$dbAdapter = $container->get(AdapterInterface::class);
        $errors = new TableGateway('errors', $dbAdapter, null);
        $smtpMailer = $container->get(SmtpMailer::class);
    	return new ErrorMailer($errors, $smtpMailer);
    }
}
```

The ErrorMailer object is made ready by configuring the <kbd>App\Container\ErrorMailerFactory</kbd> class to the <b>Container\ErrorMailerFactory::class</b> class in the <kbd>App\ConfigProvider.php</kbd> file.

```php
public function getDependencies() : array
{
    return [
        'factories' => [
            ErrorMailer::class => Utils\ErrorMailerFactory::class,
        ]
  	]
}
```

### Error SQL

You will need to record errors in the database to prevent the same error from being reported repeatedly via email. Create the <kbd>errors</kbd> table in your database using the following SQL.

```sql
DROP TABLE IF EXISTS `errors`;
CREATE TABLE `errors` (
  `errorId` char(32) CHARACTER SET utf8mb3 COLLATE utf8mb4_general_ci NOT NULL,
  `errorTitle` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `errorFile` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `errorLine` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `errorMessage` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `errorDate` date DEFAULT NULL,
  PRIMARY KEY (`errorId`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
```

### ErrorMailer

The following code example shows an example of the <kbd>App\Utils\ErrorMailer</kbd> class called from <b>ErrorMailerFactory</b>.

```php
namespace App\Utils;

use Laminas\Db\Sql\Sql;
use Laminas\Db\TableGateway\TableGatewayInterface;
use App\Utils\SmtpMailer;

class ErrorMailer
{
	protected $uri;
	protected $server;
	protected $errors;
	protected $mailer;
	protected $details;
	protected $exception;

	public function __construct(
		TableGatewayInterface $errors,
		SmtpMailer $mailer
	)
	{
		$this->errors = $errors;
		$this->mailer = $smtpMailer;
		$this->adapter = $errors->getAdapter();
	}

	public function setUri(string $uri)
	{
		$this->uri = $uri;
	}

	public function setServerParams($server)
	{
		$this->server = $server;
	}

	public function setException($e)
	{
		$this->exception = $e;
	}

	public function getException()
	{
		return $this->exception;
	}

	public function setDetails($details)
	{
		$this->details = $details;
	}

	public function send()
	{
		$e = $this->getException();
		$errorId = md5($e->getFile().$e->getLine().date('Y-m-d'));

		// if the "errorId" is not in the db, let's send an e-mail and save the error to the db.
		//
        $sql = new Sql($this->adapter);
        $select = $sql->select();
        $select->from('errors');
        $select->where(['errorId' => $errorId]);

        $statement = $sql->prepareStatementForSqlObject($select);
        $resultSet = $statement->execute();
        $row = $resultSet->current();
        $statement->getResource()->closeCursor();

        if (false == $row) {
		    $data = $e->getTrace();
		    $trace = array_map(
		        function ($a) {
		            if (isset($a['file'])) {
		                $a['file'] = str_replace(PROJECT_ROOT, '', $a['file']);
		            }
		            return $a;
		        },
		        $data
		    );
		    $title = get_class($e);
			$filename = str_replace(PROJECT_ROOT, '', $e->getFile());
			$line = $e->getLine();
			$message = $e->getMessage();
		    $json = [
		        'title' => $title,
		        'file'  => $filename,
		        'line'  => $line,
		        'error' => $message,
		        'trace' => $trace,
		    ];
		    $errorString = print_r($json, true);

		    // Mail body

		    $subject = 'Production Error: #'.$errorId.' #'.$filename.' #'.$line;
		    $body = '<b>Url:</b>'.$this->uri.'<br>';
		    $body.= '<b>Error id:</b> '.$errorId.'<br>';
		    $body.= '<b>Date: '.date('d-m-Y H:i:s').'</b>'.'<br><br>';
		   	$body.= '<pre>'.print_r($this->server, true).'<pre><br>';
		    $body.= '<pre>'.$errorString.'<pre><br>';
		    if (! empty($this->details)) {
		    	$body.='<pre>'.(string)$this->details.'</pre>';
		    }
            $this->mailer->to("me@example.com", "My Name Surname");
            $this->mailer->subject("Application Error");
            $this->mailer->body($body);
            $this->mailer->send();

		    // save to db
		    // 
		    $data = array();
		    $data['errorId'] = (string)$errorId;
		    $data['errorTitle'] = (string)$title;
		    $data['errorFile'] = (string)$filename;
		    $data['errorLine'] = $line;
		    $data['errorMessage'] = (string)$message;
		    $data['errorDate'] = date('Y-m-d');
		    $this->errors->insert($data);
        }
	}
}
```

In order for error submissions to work, index.php error reporting must be enabled in the prod environment as follows.

```php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', 1);
```