
## Şemalar ve Okuma - Yazma Operasyonları

Okuma ve yazma operasyonları; <kbd>Create</kbd> - <kbd>Read</kbd> - <kbd>Update</kbd> - <kbd>Delete</kbd> işlemlerini içerir.

### Şemalar

Şemalar basitçe yazma ve okuma işlemlerinde api ya gönderilecek ve alınacak verileri belgelemek için tasarlanmışlardır. Genellikle bir kayıt kayıt edilirken veri yöneticisi sınıfı ilgili sütunların varlığından emin olmak için şema sınıfından referans alır. Bir şema sınıfı veritabanı tablosuna kayıt edilecek veya bu tablodan okunacak girdi adlarının türleri ile birlikte bir sınıf içerisinde gösterilmesinden ibarettir.

* Şemalar <b>string</b>, <b>number</b> ve <b>integer</b> biçimleri dışında aşağıdaki iki kompleks türü içerebilirler.

<div class="table-responsive">
<table class="table">
	<thead>
		<th>Tür</th>
		<th>Açıklama</th>	
	</thead>
	<tbody>
		<tr>
			<td>array</td>
			<td>Eğer bu varlık bir başka bir varlığın <b>dizi</b> türünden bir parçası ise bu türü seçmelisiniz.</td>
		</tr>
		<tr>
			<td>object</td>
			<td>Eğer bu varlık bir başka bir varlığın <b>nesne</b> türünden bir parçası ise bu türü seçmelisiniz.</td>
		</tr>
	</tbody>
</table>
</div>

## Nesne İçeren Şemalar

Eğer http başlığında <b>nesne</b> türünde bir veri gönderilmek istiyorsak, takip eden örnekte oluduğu gibi <b>employeePersonal</b> nesne olarak yazılmalıdır. 

### EmployeeSave (Nesne İçeren Örnek)

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

EmployeesSave şemasına göre veri yöneticisi ile verilerin elde edilmesi.

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

## Dizi İçeren Şemalar

Eğer http başlığında <b>dizi</b> türünde bir veri gönderilmek istiyorsak, takip eden örnekte oluduğu gibi <b>employeeChildren</b> dizi olarak yazılmalıdır. 

### EmployeeSave (Dizi İçeren Örnek)

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

EmployeesSave şemasına göre veri yöneticisi ile verilerin elde edilmesi.

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

### Belgelerin Yaratılması

İşleyici metotları üzerinde oluşturduğunuz anotasyonlar dökümentasyona dönüştürülmesi için aşağıdaki komutun konsoldan çalıştırılması gerekir.

```bash [no-line-numbers] [command-line] data-user="root" data-host="localhost"
cd /var/www/project 
/var/www/project$ composer swagger
```

Yukarıdaki komutu konsolonuzda çalıştırdıktan sonra takip eden resimde görüldüğü open api dökümentasyonunuza <b>http://example.com/swagger/web</b> url adresinden ulaşabilirsiniz

![Demo Swagger Api](/images/demo-swagger.png)


Elde edilen bu çıktı <kbd>CompanyModel->create($data)</kbd> veya <kbd>CompanyModel->update($data)</kbd>metotlarına gönderilir. 


<tab>
<title>Yaratma (POST)|Okuma (GET)|Güncelleme (PUT)|Silme (DELETE)</title>
<content>

Örnekte <b>Create</b> handler girdi filtresinden gelen veri doğrulandıktan sonra veri yöneticisinden elden edilen verileri takip eden örnekte olduğu gibi <b>CompanyModel->create($data)</b> metoduna gönderir.

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
Okuma işlemleri http <b>GET</b> isteği parametreleri ile ilgili model sınıfı kullanılarak veritabanından elde edilen verinin json yanıtı ile istemci tarafına yanıt gönderilmesini sağlayan işlemlerdir. Aşağıda işleyiciler GET metotlarına örnek gösterilebilir.

* FindAll
* FindOneById
* FindAllByPaging

Takip eden kodlarda <b>FindOneById</b> işleyicisine ait örnek gösteriliyor.

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
<b>Update</b> metodu <b>Create</b> metodunda olduğu gibi girdi filtresinden gelen veri doğrulandıktan sonra veri yöneticisinden elden edilen verileri takip eden örnekte olduğu gibi <b>CompanyModel->update($data)</b> metoduna gönderir.

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
<b>Delete</b> metodu http <b>GET</b> yöntemini kullanarak GET parametreleri ile gönderilen veriye göre <b>CompanyModel->delete($id)</b> metodunu çalıştırır.

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