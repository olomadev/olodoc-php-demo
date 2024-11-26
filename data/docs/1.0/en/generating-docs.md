
# Generating Docs

Olodoc creates your documents by converting your existing markdown files to html files. To convert documents to html files, enter the project root directory,

```sh [command-line] data-user="root" data-host="local"
cd /var/www/myproject
```

and run generate command in your command line.

```sh [command-line] data-user="root" data-host="local"
composer olodoc:generate
```

If everything went well you will get this message.

![Cli Generate Command](/images/cli-generate-command.png)

After that the generation all documentation files will be created in your <kbd>/data/docs/$version/$locale</kbd> folder.

```sh
- myproject
  + bin
  + config
  - data
  	- docs
  		- 1.0
  			- en
  				index.html
  				index.md
  				installation.md
  				installation.html
  			+ de
  + public
  + src
  + templates
  + vendor
  .gitignore
  composer.json
  README.md
```

You can change your document generation folder from your olodoc <b>html_path</b> configuration.

<kbd>/config/autoload/local.php</kbd>

```php
<?php
declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    //
    // olodoc
    // 
    'olodoc' => [
    	/*....*/
        'html_path' => '/data/docs/', // save location for your ".html" document files
        /*....*/
    ],
]
```