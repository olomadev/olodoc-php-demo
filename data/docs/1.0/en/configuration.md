
# Configuration

Olodoc creates your documents by converting your existing markdown files. Before start to read configuration section make sure you have some <b>.md</b> files in your <kbd>/data/docs/$version/$locale</kbd> folder.

```sh
- myproject
  + bin
  + config
  - data
  	- docs
  		- 1.0
  			- en
  				index.md
  				installation.md
  			+ de
```

## Your First Directory Tree

Your directory tree configuration file <b>navigation.php</b> is located in <kbd>/config/docs/$version/</kbd> folder.

```sh
- myproject
  + bin
  - config
  	- docs
  		- 1.0
  			navigation.php
```

Open your <b>navigation.php</b> file and create your first simple navigation.

```php
/**
* Navigation index
*/
return [
    [
        'label' => 'Introduction',
        'url' => '/index.html',
    ],
    [
        'label' => 'Installation',
        'url' => '/installation.html',
    ],
]
```

Run generate command

```sh [command-line] data-user="root" data-host="local"
composer olodoc:generate
```

If everything went well your <b>.html</b> files will look at like below.

```sh
- myproject
  + bin
  + config
  - data
  	- docs
  		- 1.0
  			- en
  				index.md
  				index.html
  				installation.md
  				installation.html
  			+ de
```

## Creating Folders

Olodoc has unlimited subfolder support but you need to physically create the folders first and also define the folders in your navigation.php file.

To create a new folder:

1. Create a folder in your **data/docs/en/** folder. (In this example we created a folder named **markdown-guide**)
2. Open your navigation.php file and paste below the configuration.

```php [line-numbers] data-line="16,17"
/**
* Navigation index
*/
return [
    [
        'label' => 'Introduction',
        'url' => '/index.html',
    ],
    [
        'label' => 'Installation',
        'url' => '/installation.html',
    ],
    [
        'label' => 'Markdown Guide',
        'url' => '/markdown-guide/index.html',
        'folder' => '/markdown-guide',  // specify folder path
        'children' => [					// put your pages here into the children array
            [
                'label' => 'Markdown Guide',
                'url' => '/markdown-guide/index.html',  
            ],
        ]
    ],
]
```

Each folder configuration needs to has <b>folder</b> and <b>children</b> key.The <b>"folder"</b> key points your folder path and <b>"children"</b> key contains of your markdown pages.

## Creating Sub Folders

Each sub folder configuration needs to has <b>folder</b> and <b>children</b> key under the <b>parent</b> folder <b>children</b> key. Also, the path and url value of the subfolder must include the parent folder name as follows.

```php
'folder' => '/markdown-guide/basic-syntax',
'url' => '/markdown-guide/basic-syntax/index.html',
```

In this example we created a sub folder called <b>basic-syntax</b> under the <b>markdown-guide</b> parent folder.

```php [line-numbers] data-line="25,26"
<?php
/**
* Navigation index
*/
return [
    [
        'label' => 'Introduction',
        'url' => '/index.html',
    ],
    [
        'label' => 'Installation',
        'url' => '/installation.html',
    ],
    [
        'label' => 'Markdown Guide',
        'url' => '/markdown-guide/index.html',
        'folder' => '/markdown-guide',
        'children' => [
            [
                'label' => 'Markdown Guide',
                'url' => '/markdown-guide/index.html',
            ],
            [
                'label' => 'Basic Syntax',
                'folder' => '/markdown-guide/basic-syntax',
                'url' => '/markdown-guide/basic-syntax/index.html',
                'children' => [
                    [
                        'label' => 'Basic Syntax',
                        'url' => '/markdown-guide/basic-syntax/index.html'
                    ],
                ]
            ],
        ]
    ],
];
```

## Meta Tags and Titles

You can assign html meta tags to any configuration that includes a url key as shown in the following example.

```php [line-numbers] data-line="9"
<?php
/**
* Navigation index
*/
return [
    [
        'label' => 'Introduction',
        'url' => '/index.html',
        'meta' => [
            'title' => 'Introduction',
            'keywords' => 'intro, introduction, open source, document, generation, php',
            'description' => 'Olodoc is an open source documentation creation tool developed in PHP to create documentation from your foldered markdown files. It allows you to create and customize unique templates for your applications with the Bootstrap 5 CSS framework.',
        ]
    ],
];
```
