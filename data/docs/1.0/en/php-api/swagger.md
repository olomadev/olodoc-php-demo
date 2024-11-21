
## Open Api

<a href="https://swagger.io/specification/" target="_blank">OpenAPI</a> Specification (OAS) allows both humans and computers to discover the capabilities of the service through source code, documentation, or network traffic inspection and It defines a standard, language-independent interface to RESTful APIs that allows When defined correctly, a consumer can understand and interact with the remote service with a minimal amount of application logic.

An OpenAPI definition then generates <a href="https://petstore.swagger.io/" target="_blank">documentation</a> tools to display the API, code to create servers and clients in various programming languages It can be used by tools, testing tools, and many other use cases.

![Demo Swagger Api](/images/demo-swagger.png)

### Swagger - PHP

The <a href="https://zircote.github.io/swagger-php/" target="_blank">Swagger - php</a> library allows you to create OpenAPI documentation for your RESTful API.
Swagger-php comes installed in the <kbd>package.json</kbd> file in your Olobase project. You should use <kbd>composer swagger</kbd> to create/update documentation with pre-existing swagger schemas.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost" data-output="4">
cd /var/www/olobase-demo-php
composer swagger
```

output:

```txt
> vendor/bin/openapi /var/www/olobase-demo-php -e vendor -o public/swagger/web/swagger.json
```

To view the documentation you created, you must visit http://example.com/swagger/web as follows.

```bash [no-line-numbers]
http://demo.local/swagger/web/
```

### Annotations

In the following codes, we have exemplified the most commonly used annotations in an Olobase backend application, one by one.

<tab>
<title>CreateHandler|DeleteHandler|FindAllHandler|FindAllByPagingHandler|FindOneByIdHandler</title>
<content>
<kbd>src/App/Handler/CreateHandler.php</kdd>

```php
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use App\Schema\Companies\CompanySave;
use App\Filter\Companies\SaveFilter;
use Olobase\Mezzio\DataManagerInterface;
use Olobase\Mezzio\Error\ErrorWrapperInterface as Error;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CreateHandler implements RequestHandlerInterface
{
    public function __construct(
        private CompanyModel $companySaveModel,
        private DataManagerInterface $dataManager,
        private SaveFilter $filter,
        private Error $error,
    ) 
    {
        $this->companySaveModel = $companySaveModel;
        $this->dataManager = $dataManager;
        $this->error = $error;
        $this->filter = $filter;
    }
    
    /**
     * @OA\Post(
     *   path="/companies/create",
     *   tags={"Companies"},
     *   summary="Create a new company",
     *   operationId="companies_create",
     *
     *   @OA\RequestBody(
     *     description="Create new Company",
     *     @OA\JsonContent(ref="#/components/schemas/CompanySave"),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad request, returns to validation errors"
     *   )
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->filter->setInputData($request->getParsedBody());
        $data = array();
        $response = array();
        if ($this->filter->isValid()) {
            $this->dataManager->setInputFilter($this->filter);
            $data = $this->dataManager->getSaveData(CompanySave::class, 'companies');
            $this->companySaveModel->create($data);
        } else {
            return new JsonResponse($this->error->getMessages($this->filter), 400);
        }
        return new JsonResponse($response);     
    }
}
```
<tcol>
    
<kbd>src/App/Handler/DeleteHandler.php</kbd>

```php
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use App\Filter\Companies\DeleteFilter;
use Olobase\Mezzio\Error\ErrorWrapperInterface as Error;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DeleteHandler implements RequestHandlerInterface
{
    public function __construct(
        private CompanyModel $companyModel,        
        private DeleteFilter $filter,
        private Error $error,
    ) 
    {
        $this->companyModel = $companyModel;
        $this->filter = $filter;
        $this->error = $error;
    }

    /**
     * @OA\Delete(
     *   path="/companies/delete/{companyId}",
     *   tags={"Companies"},
     *   summary="Delete company",
     *   operationId="companyies_delete",
     *
     *   @OA\Parameter(
     *       in="path",
     *       name="companyId",
     *       required=true,
     *       description="Company uuid",
     *       @OA\Schema(
     *           type="string",
     *           format="uuid",
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *   )
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {   
        $this->filter->setInputData($request->getQueryParams());
        if ($this->filter->isValid()) {
            $this->companyModel->delete(
                $this->filter->getValue('id')
            );
        } else {
            return new JsonResponse($this->error->getMessages($this->filter), 400);
        }
        return new JsonResponse([]);
    }
}
```
<tcol>
<kbd>src/App/Handler/FindAllHandler.php</kbd>

```php
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FindAllHandler implements RequestHandlerInterface
{
    public function __construct(CompanyModel $companyModel)
    {
        $this->companyModel = $companyModel;
    }

    /**
     * @OA\Get(
     *   path="/companies/findAll",
     *   tags={"Companies"},
     *   summary="Find all companies",
     *   operationId="companies_findAll",
     *   
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CommonFindAll"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="No result found"
     *   )
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = $this->companyModel->findCompanies();
        return new JsonResponse([
            'data' => $data,
        ]);
    }

}
```
<tcol>
<kbd>src/App/Handler/FindAllByPagingHandler.php</kbd>

```php
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FindAllByPagingHandler implements RequestHandlerInterface
{
    public function __construct(CompanyModel $companyModel)
    {
        $this->companyModel = $companyModel;
    }
    
    /**
     * @OA\Get(
     *   path="/companies/findAllByPaging",
     *   tags={"Companies"},
     *   summary="Find all companies by pagination",
     *   operationId="companies_findAllByPaging",
     *
     *   @OA\Parameter(
     *       name="q",
     *       in="query",
     *       required=false,
     *       description="Search string",
     *       @OA\Schema(
     *           type="string",
     *       ),
     *   ),
     *   @OA\Parameter(
     *       name="_page",
     *       in="query",
     *       required=false,
     *       description="Page number",
     *       @OA\Schema(
     *           type="integer",
     *       ),
     *   ),
     *   @OA\Parameter(
     *       name="_perPage",
     *       in="query",
     *       required=false,
     *       description="Per page",
     *       @OA\Schema(
     *           type="integer",
     *       ),
     *   ),
     *   @OA\Parameter(
     *       name="_sort",
     *       in="query",
     *       required=false,
     *       description="Order items",
     *       @OA\Schema(
     *           type="array",
     *           @OA\Items()
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CompaniesFindAllByPaging"),
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="No result found"
     *   )
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $get = $request->getQueryParams();
        $page = empty($get['_page']) ? 1 : (int)$get['_page'];
        $perPage = empty($get['_perPage']) ? 5 : (int)$get['_perPage'];

        // https://docs.laminas.dev/tutorials/pagination/
        $paginator = $this->companyModel->findAllByPaging($get);

        $page = ($page < 1) ? 1 : $page;
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($perPage);

        return new JsonResponse([
            'page' => $paginator->getCurrentPageNumber(),
            'perPage' => $paginator->getItemCountPerPage(),
            'totalPages' => $paginator->count(),
            'totalItems' => $paginator->getTotalItemCount(),
            'data' => paginatorJsonDecode($paginator->getCurrentItems()),
        ]);
    }
}
```
<tcol>
<kbd>src/App/Handler/FindOneByIdHandler.php</kbd>

```php
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use Olobase\Mezzio\DataManagerInterface;
use App\Schema\Companies\CompaniesFindOneById;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FindOneByIdHandler implements RequestHandlerInterface
{
    public function __construct(
        private CompanyModel $companyModel,
        private DataManagerInterface $dataManager
    )
    {
        $this->companyModel = $companyModel;
        $this->dataManager = $dataManager;
    }

    /**
     * @OA\Get(
     *   path="/companies/findOneById/{companyId}",
     *   tags={"Companies"},
     *   summary="Find company data",
     *   operationId="companies_findOneById",
     *
     *   @OA\Parameter(
     *       name="companyId",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *           type="string",
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CompaniesFindOneById"),
     *   ),
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $row = $this->companyModel->findOneById($request->getAttribute("companyId"));
        if ($row) {
            $data = $this->dataManager->getViewData(CompaniesFindOneById::class, $row);
            return new JsonResponse($data);   
        }
        return new JsonResponse([], 404);
    }
}
```
</content>
</tab>

## Schemas and Dependent Items

Schemas coded as descriptions on handlers in your application are connected to schema classes as follows.

<kbd>src/App/Handler/FindOneByIdHandler.php</kbd>

```php [line-numbers] data-line="43"
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use Olobase\Mezzio\DataManagerInterface;
use App\Schema\Companies\CompaniesFindOneById;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FindOneByIdHandler implements RequestHandlerInterface
{
    public function __construct(
        private CompanyModel $companyModel,
        private DataManagerInterface $dataManager
    )
    {
        $this->companyModel = $companyModel;
        $this->dataManager = $dataManager;
    }

    /**
     * @OA\Get(
     *   path="/companies/findOneById/{companyId}",
     *   tags={"Companies"},
     *   summary="Find company data",
     *   operationId="companies_findOneById",
     *
     *   @OA\Parameter(
     *       name="companyId",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *           type="string",
     *       ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Successful operation",
     *     @OA\JsonContent(ref="#/components/schemas/CompaniesFindOneById"),
     *   ),
     *)
     **/
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $row = $this->companyModel->findOneById($request->getAttribute("companyId"));
        if ($row) {
            $data = $this->dataManager->getViewData(CompaniesFindOneById::class, $row);
            return new JsonResponse($data);   
        }
        return new JsonResponse([], 404);
    }
}
```

The saving location of your schemas is the <kbd>App/src/Schema</kbd> folder.

```txt
- src
	- App
		- Schema
            - Companies
                CompaniesFindAllByPaging.php
                CompaniesFindAllByPagingObject.php
    			CompaniesFindOneById.php
    			CompaniesFindOneByIdObject.php
    			CompanySave.php
```

<tab>
<title>CompaniesFindAllByPaging|CompaniesFindOneById|CompanySave</title>
<content>

```php
<?php
namespace App\Schema\Companies;

/**
 * @OA\Schema()
 */
class CompaniesFindAllByPaging
{
    /**
     * @var array
     * @OA\Property(
     *      type="array",
     *      @OA\Items(
     *          type="object",
     *          ref="#/components/schemas/CompaniesFindAllByPagingObject",
     *      ),
     * )
     */
    public $data;
    /**
     * @var integer
     * @OA\Property()
     */
    public $page;
    /**
     * @var integer
     * @OA\Property()
     */
    public $perPage;
    /**
     * @var integer
     * @OA\Property()
     */
    public $totalPages;
    /**
     * @var integer
     * @OA\Property()
     */
    public $totalItems;
}
```

The above <kbd>Object</kbd> type link calls the following <kbd>CompaniesFindAllByPagingObject</kbd> scheme.

```php
<?php
namespace App\Schema\Companies;

/**
 * @OA\Schema()
 */
class CompaniesFindAllByPagingObject
{
    /**
     * @var string
     * @OA\Property(
     *     format="uuid"
     * )
     */
    public $id;
    /**
     * @var string
     * @OA\Property()
     */
    public $companyName;
    /**
     * @var string
     * @OA\Property()
     */
    public $companyShortName;
    /**
     * @var string
     * @OA\Property()
     */
    public $taxOffice;
    /**
     * @var string
     * @OA\Property()
     */
    public $taxNumber;
    /**
     * @var string
     * @OA\Property()
     */
    public $address;
    /**
     * @var string
     * @OA\Property(
     *     format="date-time",
     * )
     */
    public $createdAt;
}
```
<tcol>

```php
<?php
namespace App\Schema\Companies;

/**
 * @OA\Schema()
 */
class CompaniesFindOneById
{
    /**
     * @var object
     * @OA\Property(
     *     ref="#/components/schemas/CompaniesFindOneByIdObject",
     * )
     */
    public $data;
}
```

The above <kbd>Object</kbd> type link calls the following <kbd>CompaniesFindOneByIdObject</kbd> scheme.

```php
<?php
namespace App\Schema\Companies;

/**
 * @OA\Schema()
 */
class CompaniesFindOneByIdObject
{
    /**
     * @var string
     * @OA\Property(
     *     format="uuid"
     * )
     */
    public $id;
    /**
     * @var string
     * @OA\Property()
     */
    public $companyName;
    /**
     * @var string
     * @OA\Property()
     */
    public $companyShortName;
    /**
     * @var string
     * @OA\Property()
     */
    public $taxOffice;
    /**
     * @var string
     * @OA\Property()
     */
    public $taxNumber;
    /**
     * @var string
     * @OA\Property()
     */
    public $address;
    /**
     * @var string
     * @OA\Property(
     *     format="date-time",
     * )
     */
    public $createdAt;
}
```
<tcol>

```php
<?php
namespace App\Schema\Companies;

/**
 * @OA\Schema()
 */
class CompanySave
{
    /**
     * @var string
     * @OA\Property(
     *     format="uuid"
     * )
     */
    public $companyId;
    /**
     * @var string
     * @OA\Property()
     */
    public $companyName;
    /**
     * @var string
     * @OA\Property()
     */
    public $companyShortName;
    /**
     * @var string
     * @OA\Property()
     */
    public $taxOffice;
    /**
     * @var string
     * @OA\Property()
     */
    public $taxNumber;
    /**
     * @var string
     * @OA\Property()
     */
    public $address;
    /**
     * @var string
     * @OA\Property()
     */
    public $createdAt;
}
```
</content>
</tab>

All schema files you write in PHP must be converted to json format within the project with the following command so that they can be understood by the Swagger documentation tool.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost" data-output="4">
cd /var/www/demo
composer swagger
```

When this command is run, swagger creates the documentation by combining all schemas in the <kbd>/example.com/public/swagger/web/swagger.json</kbd> file.

> To keep the schema files and documentation up to date, you must re-run this command from the console whenever you make any changes to your schema files.

In fact, this command calls the following command defined in the script section of your composer file.

```bash
> vendor/bin/openapi /var/www/demo -e vendor -o public/swagger/web/swagger.json
```

So the <kbd>composer swagger</kbd> command acts as a shortcut for the long post above.

![image info](/images/companies-swagger.png)

### Object Types

If we want to send data of type <b>object</b> in the http header, it should be written as <b>employeePersonal</b> object, as in the following example.

<tab>
<title>Swagger|Json|Php</title>
<content>

```php
namespace App\Schema;

/**
 * @OA\Schema()
 */
class EmployeeSave
{
    /**
     * @var string
     * @OA\Property(
     *     format="uuid"
     * )
     */
    public $employeeId;
    /**
     * @var string
     * @OA\Property()
     */
    public $name;
    /**
     * @var string
     * @OA\Property()
     */
    public $surname;
    /**
    *  @var object
    *  @OA\Property(
    *      @OA\Property(
    *          property="militaryStatusId",
    *          type="string",
    *      ),
    *      @OA\Property(
    *          property="militaryStartDate",
    *          type="string",
    *      ),
    *      @OA\Property(
    *          property="militaryEndDate",
    *          type="string",
    *      ),
    *      @OA\Property(
    *          property="marialStatusId",
    *          type="string",
    *      ),
    *  );
    */
    public $employeePersonal;
}
```
<tcol>

```json
{
  "employeeId": "string",
  "name": "string",
  "surname": "string",
  "employeePersonal": {
    "militaryStatusId": "string",
    "militaryStartDate": "string",
    "militaryEndDate": "string",
    "marialStatusId": "string"
  }
}
```
<tcol>

```php
[
    "employeeId" => "string",
    "name" => "string",
    "surname" => "string",
    "employeePersonal" => [
        "militaryStatusId" =>  "string",
        "militaryStartDate" => "string",
        "militaryEndDate" => "string",
        "marialStatusId" => "string"
    ],
]
```
</content>
</tab>

### ObjectId

If you refer to the object name <b>ObjectId</b> in your PHP schema file, as in the following example, the <b>DataManager</b> class decides that the sent value is an object type containing <b>id</b> and returns the message. It analyzes the data as follows.

```php
array(
    ['companyId'] => [
        'id' => '77d3134e-f334-40a4-b4b3-e2d70087dfe4',
        'name' => 'Demo',
    ]
)
```

You can see most of the ObjectId examples in the <kbd>src/App/Employees/EmployeesFindOneByIdObject.php</kbd> file.

```php
<?php
namespace App\Schema\Employees;

/**
 * @OA\Schema()
 */
class EmployeesFindOneByIdObject
{
    /**
     * @var string
     * @OA\Property(
     *     format="uuid"
     * )
     */
    public $id;
    /**
     * @var string
     * @OA\Property()
     */
    public $name;
    /**
     * @var string
     * @OA\Property()
     */
    public $surname;
    /**
    * @var object
    * @OA\Property(
    *     ref="#/components/schemas/ObjectId",
    *     format="uuid",
    * )
    */
    public $companyId;
    /**
    * @var object
    * @OA\Property(
    *     ref="#/components/schemas/ObjectId",
    *     format="uuid",
    * )
    */
    public $jobTitleId;
    /**
    * @var object
    * @OA\Property(
    *     ref="#/components/schemas/ObjectId",
    *     format="uuid",
    * )
    */
    public $gradeId;
    /*
    ...
    */
}
```

### Array Types

If we want to send data of <b>array</b> type in the http header, <b>employeeChildren</b> must be written as an array, as in the following example.

<tab>
<title>Swagger|Json|Php</title>
<content>

<kbd>src/App/Employees/Employees/EmployeeSave.php</kbd>

```php
namespace App\Schema\Employees;

/**
 * @OA\Schema()
 */
class EmployeeSave
{
    /**
     * @var string
     * @OA\Property(
     *     format="uuid"
     * )
     */
    public $employeeId;
    /**
     * @var string
     * @OA\Property()
     */
    public $name;
    /**
     * @var string
     * @OA\Property()
     */
    public $surname;
    /**
    *  @var array
    *  @OA\Property(
    *      type="array",
    *      @OA\Items(
    *           @OA\Property(
    *             property="childId",
    *             type="string",
    *             format="uuid"
    *           ),
    *           @OA\Property(
    *             property="childNameSurname",
    *             type="string",
    *           ), 
    *     ),
    *  );
    */
    public $employeeChildren;
}
```
<tcol>

```json
{
  "employeeId": "string",
  "name": "string",
  "surname": "string",
  "employeeChildren": [
      {
        "childId" : "string",
        "childNameSurname" : "string"
      }
  ]
}
```
<tcol>

```php
[
    "employeeId" =>  "string",
    "name" =>  "string",
    "surname" =>  "string",
    "employeeChildren" =>  [
        [
            "childId" => "string",
            "childNameSurname" =>  "string",
        ]
    ],
]
```
</content>
</tab>