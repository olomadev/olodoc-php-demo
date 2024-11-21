
## İşleyiciler

Http yanıtları sağlamak, http isteklerini kontrol etmek için işleyici sınıfları kullanılır. Bir işleyici sadece bir http metodu içerebilir.

<div class="table-responsive">
  <table class="table">
  	<thead>
      <th>Rota</th>
      <th>Handler</th>
  		<th>Açıklama</th>	
  	</thead>
  	<tbody>
  		<tr>
        <td>/api/companies/findAll</td>
  			<td>FindAllHandler</td>
  			<td>Veri <b>okuma</b> işlemlerinde tüm opsiyonları almak için kullanılır.</td>
  		</tr>
      <tr>
        <td>/api/companies/findAllByPaging</td>
        <td>FindAllByPagingHandler</td>
        <td>Veri <b>okuma</b> işlemlerinde tüm verileri sayfa sayfa almak için kullanılır.</td>
      </tr>
      <tr>
        <td>/api/companies/findOneById/:companyId</td>
        <td>FindOneByIdHandler</td>
        <td>Veri <b>okuma</b> işlemlerinde id değerine göre sadece bir veriyi almak için kullanılır.</td>
      </tr>
  		<tr>
        <td>/api/companies/create</td>
  			<td>CreateHandler</td>
  			<td>Veri <b>yaratma</b> işlemlerinde bir veriyi yaratmak için kullanılır.</td>
  		</tr>
  		<tr>
        <td>/api/companies/update/:companyId</td>
  			<td>UpdateHandler</td>
  			<td>Veri <b>güncelleme</b> işlemlerinde bir veriyi güncellemek kullanılır.</td>
  		</tr>
  		<tr>
        <td>/api/companies/delete/:companyId</td>
  			<td>DeleteHandler</td>
  			<td>Veri <b>silme</b> işlemlerine bir veriyi silmek için kullanılır.</td>
  		</tr>
  	</tbody>
  </table>
</div>

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


### Enjeksiyon

Bir işleyiciye çağırmak istediğiniz sınıfların enjekte edilebilmesi için ilk adımda işleyiciye ait aşağıdaki gibi bir <b>Factory</b> sınıfı yaratın.

```sh
- src
    - App
        - Handler
            - Companies
                CreateHandler.php
                CreateHandlerFactory.php
```

<kbd>src/App/Handler/CreateHandlerFactory.php</kdd>

```php
<?php
declare(strict_types=1);

namespace App\Handler\Companies;

use App\Model\CompanyModel;
use App\Filter\Companies\SaveFilter;
use Olobase\Mezzio\DataManagerInterface;
use Olobase\Mezzio\Error\ErrorWrapperInterface as Error;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\InputFilter\InputFilterPluginManager;

class CreateHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $companyModel = $container->get(CompanyModel::class);
        $error = $container->get(Error::class);
        $dataManager = $container->get(DataManagerInterface::class);

        $pluginManager = $container->get(InputFilterPluginManager::class);
        $inputFilter   = $pluginManager->get(SaveFilter::class);

        return new CreateHandler($companyModel, $dataManager, $inputFilter, $error);
    }
}
```

Son adımda <b>CreateHandlerFactory</b> sınıfını aşağıdaki gibi <kbd>App/ConfigProvider.php</kbd> dosyasına tanımlayın.

<kbd>src/App/ConfigProvider.php</kdd>

```php [line-numbers] data-line="25"
declare(strict_types=1);

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;

namespace App;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'input_filters' => [],
        ];
    }

    public function getDependencies() : array
    {
        return [
            'factories' => [
                // Handlers
                //
                Handler\Companies\CreateHandler::class => Handler\Companies\CreateHandlerFactory::class,
                Handler\Companies\UpdateHandler::class => Handler\Companies\UpdateHandlerFactory::class,
                Handler\Companies\DeleteHandler::class => Handler\Companies\DeleteHandlerFactory::class,
                Handler\Companies\FindOneByIdHandler::class => Handler\Companies\FindOneByIdHandlerFactory::class,
                Handler\Companies\FindAllHandler::class => Handler\Companies\FindAllHandlerFactory::class,
                Handler\Companies\FindAllByPagingHandler::class => Handler\Companies\FindAllByPagingHandlerFactory::class,

                // Models
                //
                Model\CompanyModel::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $companies = new TableGateway('companies', $dbAdapter, null, new ResultSet(ResultSet::TYPE_ARRAY));
                    $columnFilters = $container->get(ColumnFilters::class);
                    return new Model\CompanyModel($companies, $columnFilters);
                },
            ]
        ];
    }
}
```

Böylece <kbd>/api/companies/create</kbd> rotası çağırıldığında uygulama bu rota adresine ait işleyiciyi çalıştırmış olacak.

### Rota Konfigürasyonu

Yukarıda anlatılanların dışında işleyicinizin çalışabilmesi için <kbd>config/routes.php</kbd> dosyasında rota konfigürasyonunun yapıldığından emin olun.

```php
$auth = [
    JwtAuthenticationMiddleware::class,
    Mezzio\Authorization\AuthorizationMiddleware::class,
];
// Companies
$app->route('/api/companies/create', [...$auth, [App\Handler\Companies\CreateHandler::class]], ['POST']);
$app->route('/api/companies/update/:companyId', [...$auth, [App\Handler\Companies\UpdateHandler::class]], ['PUT']);
$app->route('/api/companies/delete/:companyId', [...$auth, [App\Handler\Companies\DeleteHandler::class]], ['DELETE']);
$app->route('/api/companies/findAll', [JwtAuthenticationMiddleware::class, App\Handler\Companies\FindAllHandler::class], ['GET']);
$app->route('/api/companies/findAllByPaging', [...$auth, [App\Handler\Companies\FindAllByPagingHandler::class]], ['GET']);
$app->route('/api/companies/findOneById/:companyId', [...$auth, [App\Handler\Companies\FindOneByIdHandler::class]], ['GET']);
```
