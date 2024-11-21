
## Database Models

Model classes triggered from handler classes are used for <b>write</b>, <b>read</b>, <b>update</b> and <b>delete</b> operations. A model class can contain more than one function. Before a model can work, it must be defined in the <kbd>App/ConfigProvider.php</kbd> file as follows.

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

### Saving Data

If data of <b>array</b> type comes from the http header as follows;

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

The data obtained from the <b>employeeChildren</b> array is recorded as in the following example.

### Create (Data Creation)

In the example below, the array type <b>employeeChildren</b> data is recorded with the <b>foreach</b> statement in the <b>create</b> method.

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

### Update (Data Update)

In the following example, the array type <b>employeeChildren</b> data is recorded with the <b>foreach</b> statement in the <b>update</b> method.

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

## Column Filters

<kbd>Olobase\Mezzio\ColumnFiltersInterface</kbd>, column filter class creates SQL queries to be run in the database by parsing the url address sent to the API from the frontend.

![Column Filters](/images/advanced-filters.png)

The filtering seen in the image above will appear in your <b>browser</b> and <b>backend API</b> as follows:

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

The values sent to the backend are obtained as follows.

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

The <kbd>columnFilters->setColumns()</kbd> method is used to define your existing columns for the column filtering class.

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

If you want to use another table name instead of the column name, the <kbd>columnFilters->setAlias()</kbd> method is used.

```php
$this->columnFilters->setAlias('companyId', 'c.companyId');
```

If you want a <b>like</b> search to occur within the columns you define, you should use the <kbd>columnFilters->setLikeColumns()</kbd> method.

```php
$this->columnFilters->setLikeColumns(
    [
        'employeeNumber',
        'name',
        'surname',
    ]
);
```

If you want a <b>where</b> search to occur within the columns you define, you should use the <kbd>columnFilters->setWhereColumns()</kbd> method.

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

The following example shows an example of column filtering with the <b>findAllByPaging()</b> method of the EmployeeModel class;

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

## Creating SQL for CRUD operations

If you aim to obtain SQL output from <b>insert</b>,<b>update</b>,</b>delete</n> operations, you can use the example below.

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

## Sql Debugging

As in the following example, you can obtain the SQL code in string type with the help of the <kbd>$select->getSqlString()</kbd> method in any model class and in a method where the <b>$select</b> object exists.

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

## ColumnFilters Methods

#### $columnFilters->clear()

Resets the values of variables belonging to the ColumnFilters class.

#### $columnFilters->setSelect(SqlInterface $select)

If filtering is performed between two dates, the $select object should be sent to the columnFilters class. Otherwise, filtering will not occur.

```php [line-numbers] data-line="2"
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('creationDate');
```

#### $columnFilters->setColumns(array $columns)

Determines which columns should be queried.

```php
$this->columnFilters->setColumns(
    [
        'customerId',
        'customerShortName',
    ]
);
```

#### $columnFilters->unsetColumns(array $columns)

Deletes the columns that need to be queried.

#### $columnFilters->getColumns(): array

Returns the queried column names.

#### $columnFilters->setAlias(string $name, string $alias)

```php
$this->columnFilters->setAlias('purchaserName', $this->concatFunction);
```

You can also use <kbd>Laminas\Db\Sql\Expression</kbd> object as value.

```php
$this->columnFilters->setAlias('orderItems', new Expression($this->orderItemFunction, [LANG_ID]));
```

#### $columnFilters->setLikeColumns($columns)

It allows a <b>like</b> search to be performed within the columns you define.

```php
$this->columnFilters->setLikeColumns(
    [
        'employeeNumber',
        'name',
        'surname',
    ]
);
```

#### $columnFilters->setWhereColumns($columns)

It allows a <b>where</b> search to be performed within the columns you define.

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

You will need this function when you convert filters, which usually have more than one boolean type and look messy, into a multi-selection input.

![Grouped Column Filters](/images/grouped-where-columns.png)

Considering the example above; Let's say you have 3 columns named <b>ssl</b>, <b>verified</b> and <b>resourceAccess</b> and we want to group these columns under a name that does not exist in your table.

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

Sql output:

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

If we had chosen to send a <kbd>closure</kbd> function from the 3rd parameter, the result would be as follows.

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

Sql output:

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

Returns column data that was not processed by the column filter.

#### $columnFilters->setData(array $data)

It sends the incoming http data in array format to the column filter class.

```php
$this->columnFilters->setData($get);
```

#### $columnFilters->getData() : array

It returns incoming http data in array format.

#### $columnFilters->setDateFilter(string $dateColumn, $endDate = null, $fixedDate = null)

It automatically creates date filters based on the entered values.

### Filter by a Single Column

Considering the example below, if the <b>endDate</b> value is sent <b>empty</b>,

```php
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('creationDate');
```

This code produces a SQL query as follows.

```php
/*
$nest = $this->select->where->nest();
    $nest->and->between($dateColumn, $data[$columnStart], $data[$columnEnd]);
$nest->unnest();
*/
```

### Query Between Two Columns

If you only need to query between two specific database columns, the 2nd parameter makes the query occur between two dates and,

```php
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('startDate', 'endDate');
```

The above code produces an SQL query as follows.

```php
/*
$nest = $this->select->where->nest();
    $nest->and->lessThanOrEqualTo($columnStart, $data[$endKey])
         ->and->greaterThanOrEqualTo($columnEnd, $data[$startKey]);
$nest->unnest();
*/
```

### Query Based on a Fixed Date Sent Between Two Columns

If <b>fixedDate</b> value is entered,

```php
$this->columnFilters->setSelect($this->select);
$this->columnFilters->setDateFilter('startDate', 'endDate', 'startDate');
```

This code produces an SQL query as follows.

```php
/*
$nest = $this->select->where->nest();
    $nest->and->lessThanOrEqualTo($columnStart, $data[$fixedDate])
         ->and->greaterThanOrEqualTo($columnEnd, $data[$fixedDate]);
$nest->unnest();
*/
```

#### $columnFilters->getLikeData(): array

If a search request is sent by columns, the queried column names and values are returned.

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

If a search request is sent by columns, the queried column names and values are returned.

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

Returns sorted column names and values.

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

If search values are sent from the <kbd>global search</kbd> entry, the text search returns the column names and values.

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

Returns true if the "global search" data is not empty, otherwise false.

#### $columnFilters->searchDataEmpty()

If the "global search" data is empty, it returns true, otherwise it returns false.

#### $columnFilters->likeDataIsNotEmpty()

If the "like" filter data is not empty, it returns true, otherwise it returns false.

#### $columnFilters->likeDataIsEmpty()

If the "like" filter data is empty, it returns true, otherwise it returns false.

#### $columnFilters->whereDataIsNotEmpty()

If the "where" filter data is not empty, it returns true, otherwise it returns false.

#### $columnFilters->whereDataIsEmpty()

If the "where" filter data is empty, it returns true, otherwise false.

#### $columnFilters->orderDataIsNotEmpty()

Returns true if the "sorting" data is not empty, otherwise false.

#### $columnFilters->orderDataIsEmpty()

If the "sorting" data is empty, it returns true, otherwise it returns false.