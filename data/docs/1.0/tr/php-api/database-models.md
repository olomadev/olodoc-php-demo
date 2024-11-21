
## Veritabanı Modelleri

<b>Yazma</b>, <b>okuma</b>, <b>güncelleme</b> ve <b>silme</b> operasyonları için işleyici sınıflarından tetiklenen Model sınıfları kullanılır. Bir model sınıfı birden fazla fonksiyon içerebilir. Bir modelin çalışabilmesi önce aşağıdaki gibi <kbd>App/ConfigProvider.php</kbd> dosyasına tanımlanması gerekir.

```php
public function getDependencies() : array
{
    return [
        'factories' => [
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
```

### Verilerin Kaydedilmesi

Eğer http başlığından aşağıdaki gibi <b>dizi</b> türünde bir veri geliyorsa; 

<tab>
<title>Swagger|Json|Php</title>
<content>

<kbd>src/App/Schema/Employees/EmployeeSave.php</kbd>

```php
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

<b>employeeChildren</b> dizisinden elde edilen veri takip eden örnekte oluduğu gibi kayıt edilir.

### Create (Veri Oluşturma)

Aşağıdaki örnekte dizi türündeki <b>employeeChildren</b> verisi <b>create</b> metodu içerisinde <b>foreach</b> ifadesi ile kayıt ediliyor.

<kbd>src/App/Model/EmployeeModel.php</kbd>

```php
public function create(array $data)
{
    $employeeId = $data['id'];
    try {
        $this->conn->beginTransaction();
        $data['employees']['employeeId'] = $employeeId;
        $data['employees']['createdAt'] = date('Y-m-d H:i:s');
        $this->employees->insert($data['employees']);

        // children
        if (! empty($data['employeeChildren'])) {
            foreach ($data['employeeChildren'] as $val) {
                $val['employeeId'] = $employeeId;
                $this->employeeChildren->insert($val);
            }
        }
        $this->conn->commit();
    } catch (Exception $e) {
        $this->conn->rollback();
        throw $e;
    }
}
```

### Update (Veri Güncelleme)

Takip eden örnekte dizi türündeki <b>employeeChildren</b> verisi <b>update</b> metodu içerisinde <b>foreach</b> ifadesi ile kayıt ediliyor.

<kbd>src/App/Model/EmployeeModel.php</kbd>

```php
public function update(array $data)
{
    $employeeId = $data['id'];
    try {
        $this->conn->beginTransaction();
        $this->employees->update($data['employees'], ['employeeId' => $employeeId]);

        // delete children
        // 
        $this->employeeChildren->delete(['employeeId' => $employeeId]);
        if (! empty($data['employeeChildren'])) {
            foreach ($data['employeeChildren'] as $val) {
                $val['employeeId'] = $employeeId;
                $this->employeeChildren->insert($val);
            }
        }
        $this->conn->commit();
    } catch (Exception $e) {
        $this->conn->rollback();
        throw $e;
    }
}
```

## Sütun Filtreleri

<kbd>Olobase\Mezzio\ColumnFiltersInterface</kbd>, sütun filtresi sınıfı önyüzden api a gönderilen url adresini çözümleyerek veritabanında çalıştırılmak üzere SQL sorguları oluşturur.

![Column Filters](/images/advanced-filters.png)

Yukarıdaki resimde görülen filtreleme <b>tarayıcınızda</b> ve <b>arka uç API</b>'nizde aşağıdaki gibi görünecektir:

<tab>
<title>Frontend|Backend Api</title>
<content>

```sh
http://127.0.0.1:3000/employees?page=1&perPage=10&filter={"jobTitleId":[{"id":"137b00c8-0e36-ce3a-25f2-ce4b7b1cf97c","name":"Web+Designer"},{"id":"28fd1a31-becf-2329-6bcf-0c80bcc64e2d","name":"Computer+Programmer"}],"companyId":[{"id":"ebf6b935-5bd8-46c1-877b-9c758073f278","name":"Demo+Company","companyShortName":"Demo"}]}
```

<tcol>

```string
http://demo.local/api/employees/findAllByPaging?jobTitleId[][id]=137b00c8-0e36-ce3a-25f2-ce4b7b1cf97c&jobTitleId[][name]=Web Designer&jobTitleId[][id]=28fd1a31-becf-2329-6bcf-0c80bcc64e2d&jobTitleId[][name]=Computer Programmer&companyId[][id]=ebf6b935-5bd8-46c1-877b-9c758073f278&companyId[][name]=Demo Company&companyId[][companyShortName]=Demo&_perPage=10&_page=1
```
<tcol>

</content>
</tab>

Arka uca gönderilen değerler aşağıdaki gibi elde edilir.

```php
$get = $request->getQueryParams();
var_dump($get);
/*
array (
  'jobTitleId' => 
  array (
    0 => array ('id' => '137b00c8-0e36-ce3a-25f2-ce4b7b1cf97c'),
    1 => array ('name' => 'Web Designer'),
    2 => array ('id' => '28fd1a31-becf-2329-6bcf-0c80bcc64e2d',),
    3 => array ('name' => 'Computer Programmer',),
  ),
  'companyId' => 
  array (
    0 => array ('id' => 'ebf6b935-5bd8-46c1-877b-9c758073f278'),
    1 => array ('name' => 'Demo Company'),
    2 => array ('companyShortName' => 'Demo'),
  ),
  '_perPage' => '10',
  '_page' => '1',
)
*/
```

Sütun filtreleme sınıfına mevcut sütunlarınızı tanımlamak için <kbd>columnFilters->setColumns()</kbd> metodu kullanılır.

```php
$this->columnFilters->setColumns([
    'companyId',
    'employeeNumber',
    'name',
    'surname',
    'companyId',
    'jobTitleId',
    'gradeId'
]);
```

Eğer sütun adı yerine bir başka tablo adı kullanılmak isteniyorsa <kbd>columnFilters->setAlias()</kbd> metodu kullanılır.

```php
$this->columnFilters->setAlias('companyId', 'c.companyId');
```

Tanımladığınız sütunlar içerisinde bir <b>like</b> aramasının gerçekleşmesini istiyorsanız <kbd>columnFilters->setLikeColumns()</kbd> metodunu kullanmalısınız.

```php
$this->columnFilters->setLikeColumns(
    [
        'employeeNumber',
        'name',
        'surname',
    ]
);
```

Tanımladığınız sütunlar içerisinde bir <b>where</b> aramasının gerçekleşmesini istiyorsanız <kbd>columnFilters->setWhereColumns()</kbd> metodunu kullanmalısınız.

```php
$this->columnFilters->setWhereColumns(
    [
        'companyId',
        'jobTitleId',
        'gradeId',
        'departmentId',
    ]
);
```

Takip eden örnekte EmployeeModel sınıfı <b>findAllByPaging()</b> metodu ile bir sütun filtreleme örneği gösteriliyor;

<kbd>src/App/Model/EmployeeModel.php</kbd>

```php
<?php
declare(strict_types=1);

namespace App\Model;

use Olobase\Mezzio\ColumnFiltersInterface;

class EmployeeModel
{
    public function __construct(
        TableGatewayInterface $employees,
        TableGatewayInterface $employeeChildren,
        TableGatewayInterface $employeeFiles,
        TableGatewayInterface $files,
        ColumnFiltersInterface $columnFilters
    ) {
        $this->adapter = $employees->getAdapter();
        $this->employees = $employees;
        $this->employeeChildren = $employeeChildren;
        $this->employeeFiles = $employeeFiles;
        $this->files = $files;
        $this->conn = $this->adapter->getDriver()->getConnection();
        $this->columnFilters = $columnFilters;
    }
    /*
      ...
      .
    */
    public function findAllByPaging(array $get)
    {
        $select = $this->findAll();
        $this->columnFilters->clear();
        $this->columnFilters->setAlias('companyId', 'c.companyId');
        $this->columnFilters->setAlias('jobTitleId', 'j.jobTitleId');
        $this->columnFilters->setAlias('gradeId', 'g.gradeId');
        $this->columnFilters->setColumns([
            'companyId',
            'employeeNumber',
            'name',
            'surname',
            'companyId',
            'jobTitleId',
            'gradeId'
        ]);
        $this->columnFilters->setLikeColumns(
            [
                'employeeNumber',
                'name',
                'surname',
            ]
        );
        $this->columnFilters->setWhereColumns(
            [
                'companyId',
                'jobTitleId',
                'gradeId',
                'departmentId',
            ]
        );
        $this->columnFilters->setData($get);
        $this->columnFilters->setSelect($select);

        if ($this->columnFilters->searchDataIsNotEmpty()) {
            $nest = $select->where->nest();
            foreach ($this->columnFilters->getSearchData() as $col => $words) {
                $nest = $nest->or->nest();
                foreach ($words as $str) {
                    $nest->or->like(new Expression($col), '%'.$str.'%');
                }
                $nest = $nest->unnest();
            }
            $nest->unnest();
        }
        if ($this->columnFilters->likeDataIsNotEmpty()) {
            foreach ($this->columnFilters->getLikeData() as $column => $value) {
                if (is_array($value)) {
                    $nest = $select->where->nest();
                    foreach ($value as $val) {
                        $nest->or->like(new Expression($column), '%'.$val.'%');
                    }
                    $nest->unnest();
                } else {
                    $select->where->like(new Expression($column), '%'.$value.'%');
                }
            }   
        }
        if ($this->columnFilters->whereDataIsNotEmpty()) {
            foreach ($this->columnFilters->getWhereData() as $column => $value) {
                if (is_array($value)) {
                    $nest = $select->where->nest();
                    foreach ($value as $val) {
                        $nest->or->equalTo(new Expression($column), $val);
                    }
                    $nest->unnest();
                } else {
                    $select->where->equalTo(new Expression($column), $value);
                }
            }
        }
        if ($this->columnFilters->orderDataIsNotEmpty()) {
            $select->order($this->columnFilters->getOrderData());
        }
        // echo $select->getSqlString($this->adapter->getPlatform());
        // die;
        $paginatorAdapter = new DbSelect(
            $select,
            $this->adapter
        );
        $paginator = new Paginator($paginatorAdapter);
        return $paginator;
    }
    /*
      ...
      .
    */
}
```

## CRUD operasyonları için SQL Oluşturmak

Eğer <b>insert</b>,<b>update</b>,</b>delete</n> operasyonlarından bir sql çıktısı elde etmeyi amaçlıyorsanız aşağıdaki örnekten faydalanabilirsiniz.

```php [line-numbers] data-line="22"
$sql = new Sql($this->adapter);
$insert = $sql->insert();
$insert->into("example");
$insert->columns(
    [
        'companyId',
        'workplaceId',
        'yearId',
        'monthId',
        'creationDate',
    ]
);
$insert->values(
    [
        $companyId,
        $workplaceId,
        $yearId,
        $monthId,
        date('Y-m-d H:i:s')
    ]
);
$string = $sql->buildSqlString($insert);
echo $string.PHP_EOL; // sql output of insert operation

$statement = $sql->prepareStatementForSqlObject($insert);
$statement->execute();
```

## Sql Hata Ayıklama

Takip eden örnekte olduğu gibi herhangi bir model sınıfında ve <b>$select</b> nesnesinin varolduğu bir metot içerisinde iken <kbd>$select->getSqlString()</kbd> metodu yardımı ile sql kodunu string türünde elde edebilirsiniz.

```php
$sql    = new Sql($this->adapter);
$select = $sql->select();
$select->columns([
    'permId',
    'route',
    'method',
    'action',
]);
$select->join(
    ['rp' => 'rolePermissions'],
    'permissions.permId = rp.permId', [], $select::JOIN_INNER);
$select->join(
    ['r' => 'roles'],
    'r.roleId = rp.roleId', ['roleKey','roleLevel'], $select::JOIN_LEFT);

echo $select->getSqlString($adapter->getPlatform());
die;
/*
SELECT `permissions`.`permId` AS `permId`, `permissions`.`route` AS `route`, `permissions`.`method` AS `method`,
`r`.`roleKey` AS `roleKey`, `r`.`roleLevel` AS `roleLevel` FROM `permissions` INNER JOIN `rolePermissions` AS `rp` ON
`permissions`.`permId` = `rp`.`permId` LEFT JOIN `roles` AS `r` ON `r`.`roleId` = `rp`.`roleId`
*/
```

## ColumnFilters Metotları

#### $columnFilters->clear()

ColumnFilters sınıfına ait değişkenlerin değerini sıfırlar.

#### $columnFilters->setSelect(SqlInterface $select)

Eğer iki tarih arasında bir filtreleme gerçekleştiriliyorsa $select nesnesi columnFilters sınıfına gönderilmelidir. Aksi durumda filtreleme gerçekleşmez.

```php [line-numbers] data-line="2"
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('creationDate');
```

#### $columnFilters->setColumns(array $columns)

Hangi sütunların sorgulanması gerektiğini belirler.

```php
$this->columnFilters->setColumns(
    [
        'customerId',
        'customerShortName',
    ]
);
```

#### $columnFilters->unsetColumns(array $columns)

Sorgulanması gereken sütunları siler.

#### $columnFilters->getColumns(): array

Sorgulanan sütun isimlerine geri döner.

#### $columnFilters->setAlias(string $name, string $alias)

```php
$this->columnFilters->setAlias('purchaserName', $this->concatFunction);
```

You can also use <kbd>Laminas\Db\Sql\Expression</kbd> object as value.

```php
$this->columnFilters->setAlias('orderItems', new Expression($this->orderItemFunction, [LANG_ID]));
```

#### $columnFilters->setLikeColumns(array $columns)

Tanımladığınız sütunlar içerisinde bir <b>like</b> aramasının gerçekleşmesini sağlar.

```php
$this->columnFilters->setLikeColumns(
    [
        'employeeNumber',
        'name',
        'surname',
    ]
);
```

#### $columnFilters->setWhereColumns(array $columns)

Tanımladığınız sütunlar içerisinde bir <b>where</b> aramasının gerçekleşmesini sağlar.

```php
$this->columnFilters->setWhereColumns(
    [
        'companyId',
        'jobTitleId',
        'gradeId',
        'departmentId',
    ]
);
```

#### $columnFilters->setGroupedColumns(string $name, array $columns, callable $returnFunc = null)

Bu fonksiyona genelde birden fazla boolean türünde olan ve dağınık görünen filtreleri bir çoklu seçim girdisine dönüştürdüğüzde ihtiyacınız olacak.

![Grouped Column Filters](/images/grouped-where-columns.png)

Yukarıdaki örneği göz önüne alırsak; <b>ssl</b>, <b>verified</b> ve <b>resourceAccess</b> adlı 3 adet sütuna sahip olduğunuzu ve bu sütunları tablonuzda var olmayan bir isim altında gruplamak istediğimizi varsayalım.

```php
$this->columnFilters->setGroupedColumns(
    'resources', // group name 
    [
        'ssl',  // column names that you want to group
        'verified',
        'resourceAccess',
    ]
);
```

Sql çıktı:

```sql
SELECT
  `d`.`domainId` AS `id`,
  `d`.`name` AS `name`,
  `d`.`url` AS `url`,
  `d`.`ssl` AS `ssl`,
  `d`.`verified` AS `verified`,
  `d`.`resourceAccess` AS `resourceAccess`,
FROM
  `domains` AS `d`
WHERE `ssl` = '1'
  AND `verified` = '1'
  AND `resourceAccess` = '1'
```

Eğer 3. parametreden bir <kbd>closure</kbd> fonksiyonu göndermeyi seçseydik bu durumda sonuç aşağıdaki gibi olacaktı.

```php
$this->columnFilters->setGroupedColumns(
    'resources', // group name 
    [
        'ssl',  // column names that you want to group
        'verified',
        'resourceAccess',
    ],
    function ($val) {
        return (string)$val;
    }
);
```

Sql çıktı:

```sql
SELECT
  `d`.`domainId` AS `id`,
  `d`.`name` AS `name`,
  `d`.`url` AS `url`,
  `d`.`ssl` AS `ssl`,
  `d`.`verified` AS `verified`,
  `d`.`resourceAccess` AS `resourceAccess`,
FROM
  `domains` AS `d`
WHERE `ssl` = 'ssl'
  AND `verified` = 'verified'
  AND `resourceAccess` = 'resourceAccess'
```

#### $columnFilters->getRawData(): array

Sütun filtresi tarafından işlenmemiş sütun verilerine geri döner.

#### $columnFilters->setData(array $data)

Dizi formatında gelen http verisini sütun filtresi sınıfına gönderir.

```php
$this->columnFilters->setData($get);
```

#### $columnFilters->getData() : array

Dizi formatında gelen http verisine geri döner.

#### $columnFilters->setDateFilter(string $dateColumn, $endDate = null, $fixedDate = null)

Tarih filtrelerini girilen değerlere göre otomatik oluşturur.

### Tek Bir Sütuna Göre Filtreleme

Aşağıdaki örnek gözönüne alındığında, eğer <b>endDate</b> değeri <b>boş</b> gönderilirse,

```php
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('creationDate');
```

bu kodu aşağıdaki gibi bir sql sorgusu üretir.

```php
/*
$nest = $this->select->where->nest();
    $nest->and->between($dateColumn, $data[$columnStart], $data[$columnEnd]);
$nest->unnest();
*/
```

### İki Sütun Arasında Sorgu

Eğer sadece belirli iki veritabanı sütunu arasında sorgu gerekiyorsa, 2. parametre sorgunun iki tarih arasında gerçekleşmesini sağlar ve,

```php
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('startDate', 'endDate');
```

yukarıdaki kod aşağıdaki gibi bir sql sorgusu üretir.

```php
/*
$nest = $this->select->where->nest();
    $nest->and->lessThanOrEqualTo($columnStart, $data[$endKey])
         ->and->greaterThanOrEqualTo($columnEnd, $data[$startKey]);
$nest->unnest();
*/
```

### İki Sütun Arasında Gönderilen Sabit Bir Tarihe Göre Sorgu

Eğer <b>fixedDate</b> değeri girilirse,

```php
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('startDate', 'endDate', 'startDate');
```

bu kod aşağıdaki gibi bir sql sorgusu üretir.

```php
/*
$nest = $this->select->where->nest();
    $nest->and->lessThanOrEqualTo($columnStart, $data[$fixedDate])
         ->and->greaterThanOrEqualTo($columnEnd, $data[$fixedDate]);
$nest->unnest();
*/
```

#### $columnFilters->getLikeData(): array

Eğer sütunlara göre bir arama isteği gönderilmiş ise sorgulanan sütun isimleri ve değerlerine geri döner.

![Get Like Data](/images/get-like-data.png)

```php
print_r($this->columnFilters->getLikeData());
die;
/*
Array
(
    [`firstname`] => demo
)
*/
```

#### $columnFilters->getWhereData(): array

Eğer sütunlara göre bir arama isteği gönderilmiş ise sorgulanan sütun isimleri ve değerlerine geri döner.

![Get Where Data](/images/get-column-data.png)

```php
print_r($this->columnFilters->getWhereData());
die;
/*
Array
(
    [c.companyId] => Array
        (
            [0] => ebf6b935-5bd8-46c1-877b-9c758073f278
        )

    [j.jobTitleId] => Array
        (
            [0] => 137b00c8-0e36-ce3a-25f2-ce4b7b1cf97c
        )

    [g.gradeId] => Array
        (
            [0] => 8e9204c4-0133-4a51-82ca-4265b1656b1d
            [1] => 07ef35ed-5f96-4776-a57a-998d5f09a891
        )
)
*/
```

#### $columnFilters->getOrderData() : array

Sıralanmış sütun isimleri ve değerlerine geri döner.

![Get Where Data](/images/get-order-data.png)

```php
print_r($this->columnFilters->getOrderData());
die;
/*
Array
(
    [0] => j.jobTitleId ASC
    [1] => name ASC
)
*/
```

#### $columnFilters->getSearchData()

Eğer <kbd>evrensel arama</kbd> girdisinden arama değerleri gönderildi ise text araması yapılan sütun isimleri ve değerlerine geri döner.

![Get Search Data](/images/get-search-data.png)

```php
print_r($this->columnFilters->getSearchData());
die;
/*
Array
(
    [c.companyId] => Array
        (
            [0] => Brown
        )

    [`employeeNumber`] => Array
        (
            [0] => Brown
        )

    [`name`] => Array
        (
            [0] => Brown
        )

    [`surname`] => Array
        (
            [0] => Brown
        )

    [j.jobTitleId] => Array
        (
            [0] => Brown
        )

    [g.gradeId] => Array
        (
            [0] => Brown
        )
)
*/
```
#### $columnFilters->searchDataIsNotEmpty()

Eğer evrensel arama verisi boş değilse true aksi durumda false değerine geri döner.

#### $columnFilters->searchDataEmpty()

Eğer evrensel arama verisi boş ise true aksi durumda false değerine geri döner.

#### $columnFilters->likeDataIsNotEmpty()

Eğer like arama verisi boş değilse true aksi durumda false değerine geri döner.

#### $columnFilters->likeDataIsEmpty()

Eğer like arama verisi boş ise true aksi durumda false değerine geri döner.

#### $columnFilters->whereDataIsNotEmpty()

Eğer where arama verisi boş değilse true aksi durumda false değerine geri döner.

#### $columnFilters->whereDataIsEmpty()

Eğer where arama verisi boş ise true aksi durumda false değerine geri döner.

#### $columnFilters->orderDataIsNotEmpty()

Eğer sıralama verileri boş değilse true aksi durumda false değerine geri döner.

#### $columnFilters->orderDataIsEmpty()

Eğer sıralama verileri boş ise true aksi durumda false değerine geri döner.