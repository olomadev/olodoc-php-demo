
## Schemas and Read - Write Operations

Read and write operations; It includes <kbd>Create</kbd> - <kbd>Read</kbd> - <kbd>Update</kbd> - <kbd>Delete</kbd> operations.

### Schemas

Schemas are simply designed to document the data to be sent and received to the API during write and read operations. Usually, when saving a record, the data manager class takes a reference from the schema class to ensure the existence of the relevant columns. A schema class consists of displaying the input names to be recorded in the database table or read from this table together with their types in a class.

* Schemas can contain the following two complex types in addition to <b>string</b>, <b>number</b> and <b>integer</b> formats.

<div class="table-responsive">
<table class="table">
	<thead>
		<th>Type</th>
		<th>Description</th>	
	</thead>
	<tbody>
		<tr>
			<td>array</td>
			<td>If this entity is a part of another entity of <b>array</b> type, you should select this type.</td>
		</tr>
		<tr>
			<td>object</td>
			<td>If this entity is a part of another entity of <b>object</b> type, you should select this type.</td>
		</tr>
	</tbody>
</table>
</div>

## Schemas Containing Objects

If we want to send data of type <b>object</b> in the http header, it should be written as <b>employeePersonal</b> object, as in the following example.

### EmployeeSave (Instance with Object)

<tab>
<title>Swagger|Json|Php</title>
<content>

```php
<?php
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
    * @var object
    * @OA\Property(
    *     ref="#/components/schemas/EmployeePersonalObject",
    * )
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
    "employeeId": "string",
    "name": "string",
    "surname": "string",
    "employeePersonal": [
        "militaryStatusId": "string",
        "militaryStartDate": "string",
        "militaryEndDate": "string",
        "marialStatusId": "string"
    ],
]
```
</content>
</tab>

### EmployeePersonalObject

```php
<?php
namespace App\Schema\Employees;

/**
 * @OA\Schema()
 */
class EmployeePersonalObject
{
    /**
     * @var string
     * @OA\Property()
     */
    public $militaryStatusId;
    /**
     * @var string
     * @OA\Property(
     *     format="date",
     * )
     */
    public $militaryStartDate;
    /**
     * @var string
     * @OA\Property(
     *     format="date",
     * )
     */
    public $militaryEndDate;
    /**
     * @var string
     * @OA\Property()
     */
    public $marialStatusId;
}
```

Obtaining data with the data manager according to the EmployeesSave scheme.

```php
$data = $this->dataManager->getSaveData(EmployeeSave::class, 'employees');
print_r($data);
/*
Array
(
    [employees] => Array
        (
            [name] => James
            [surname] => Brown
        ),
    [employeePersonal] => Array
        (
            [militaryStatusId] => discharge
            [militaryStartDate] => 2022-04-07
            [militaryEndDate] => 2022-04-18
            [marialStatusId] => married
        )
)
*/
```

## Schemas Containing Strings

If we want to send data of <b>array</b> type in the http header, <b>employeeChildren</b> must be written as an array, as in the following example.

### EmployeeSave (Example Containing an Array)

<tab>
<title>Swagger|Json|Php</title>
<content>

```php
<?php
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
    *           ),
    *           @OA\Property(
    *             property="childName",
    *             type="string",
    *           ),
    *           @OA\Property(
    *             property="childBirthdate",
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

Obtaining data with the data manager according to the EmployeesSave scheme.

```php
$data = $this->dataManager->getSaveData(
    EmployeeSave::class,
    'employees'
);
print_r($data);
/*
Array
(
    [employees] => Array
        (
            [name] => James
            [surname] => Brown
        )
    [employeeChildren] => Array
        (
            [0] => Array
                (
                    [childId] => ee73109a-7a02-0a9d-a7a9-0a2f3fc6eca0
                    [childNameSurname] => John Sebastian
                )

        )
)
*/
```

### Creation of Documents

To convert the annotations you create on the handler methods into documentation, the following command must be run from the console.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /var/www/project 
/var/www/project$ composer swagger
```

After running the above command in your console, you can access your open api documentation, as seen in the following picture, at <b>http://example.com/swagger/web</b> url.

![Demo Swagger Api](/images/demo-swagger.png)


This output is sent to the <kbd>CompanyModel->create($data)</kbd> or <kbd>CompanyModel->update($data)</kbd> methods.

<tab>
<title>Create (POST)|Read (GET)|Update (PUT)|Delete (DELETE)</title>
<content>

In the example, after the data coming from the <b>Create</b> handler input filter is validated, it sends the data obtained from the data manager to the <b>CompanyModel->create($data)</b> method, as in the following example.

<kbd>src/App/Handler/Companies/CreateHandler.php</kbd>

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
            $data = $this->dataManager->getSaveData(
                CompanySave::class, 
                'companies'
            );
            $this->companySaveModel->create($data);
        } else {
            return new JsonResponse($this->error->getMessages($this->filter), 400);
        }
        return new JsonResponse($response);     
    }
}
```
<tcol>

Read operations are operations that enable the data obtained from the database to be sent to the client side with a json response by using the model class related to http <b>GET</b> request parameters. Below are examples of handlers and GET methods.

* FindAll
* FindOneById
* FindAllByPaging

The following codes show an example of the <b>FindOneById</b> handler.

<kbd>src/App/Handler/Companies/FindOneByIdHandler.php</kbd>

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
            $data = $this->dataManager->getViewData(
                CompaniesFindOneById::class,
                $row
            );
            return new JsonResponse($data);   
        }
        return new JsonResponse([], 404);
    }
}
```
<tcol>

The <b>Update</b> method follows the data obtained from the data manager after the data from the input filter is validated, as in the <b>Create</b> method, as in the example <b>CompanyModel->update($data)</b > sends it to the method.

<kbd>src/App/Handler/Companies/UpdateHandler.php</kbd>

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

class UpdateHandler implements RequestHandlerInterface
{
    public function __construct(
        private CompanyModel $companyModel,
        private DataManagerInterface $dataManager,
        private SaveFilter $filter,
        private Error $error,
    ) 
    {
        $this->companyModel = $companyModel;
        $this->dataManager = $dataManager;
        $this->error = $error;
        $this->filter = $filter;
    }
    
    /**
     * @OA\Put(
     *   path="/companies/update/{companyId}",
     *   tags={"Companies"},
     *   summary="Update company",
     *   operationId="companies_update",
     *
     *   @OA\Parameter(
     *       name="companyId",
     *       in="path",
     *       required=true,
     *       @OA\Schema(
     *           type="string",
     *       ),
     *   ),
     *   @OA\RequestBody(
     *     description="Update Company",
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
            $data = $this->dataManager->getSaveData(
                CompanySave::class,
                'companies'
            );
            $this->companyModel->update($data);
        } else {
            return new JsonResponse($this->error->getMessages($this->filter), 400);
        }
        return new JsonResponse($response);   
    }
}
```
<tcol>
    
The <b>Delete</b> method runs the <b>CompanyModel->delete($id)</b> method according to the data sent with the GET parameters using the http <b>GET</b> method.

<kbd>src/App/Handler/Companies/DeleteHandler.php</kbd>

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
</content>
</tab>