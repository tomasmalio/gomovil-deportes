# Readme

GoMovil Deportes 

## Install Composer
Follow the instructions from [here](https://getcomposer.org/download/) and the continue the instructions of the [Basic Usage](https://getcomposer.org/doc/01-basic-usage.md). The most important thing is that the composer.json must be created.

## Install Twig
The first thing that you must do is install the [Twig](https://twig.readthedocs.io/en/latest/installation.html) with your composer.

```bash
php composer require twig/twig
```
Then you must update the extension add in your composer.lock to the composer.json
```bash
php composer install
```

## Less Installation in Visual Studio Code

Use the steps recommend by Visual Studio [CSS, SCSS and Less](https://code.visualstudio.com/docs/languages/css#_transpiling-sass-and-less-into-css) to integrate with Less transpilers through a task runner. 
Important: you must have Node.js and the npm package manager already installed.

```bash
npm install -g node-sass less
```

### Create the tasks.json
The next step is to set up the task configuration. To do this, run Terminal > Configure Tasks and click Create tasks.json file from templates. In the selection dialog that shows up, select Others.
This will create a sample tasks.json file in the workspace .vscode folder. 

```json
{
	"version": "2.0.0",
	"tasks": [
		{
			"label": "Less Compile",
			"type": "shell",
			"command": "lessc css/styles.less less/styles.css",
			"group": "build"
		}
	]
}
```
### Run the Build Tasks
As this is the only command in the file, you can execute it by pressing ***⇧⌘B (Run Build Task)***. The sample Less file should not have any compile problems, so by running the task all that happens is a corresponding styles.css file is created.


## Problems to Compile Less
If you received in the terminal a message like you see here, the problem is the permissios access.

```bash
Error: EACCES: permission denied, access '/usr/local/lib/node_modules'
error  { [Error: EACCES: permission denied, access '/usr/local/lib/node_modules']
error   stack:
error    'Error: EACCES: permission denied, access \'/usr/local/lib/node_modules\'',
error   errno: -13,
error   code: 'EACCES',
error   syscall: 'access',
error   path: '/usr/local/lib/node_modules' }
error The operation was rejected by your operating system.
error It is likely you do not have the permissions to access this file as the current user
error
error If you believe this might be a permissions issue, please double-check the
error permissions of the file and its containing directories, or try running
error the command again as root/Administrator (though this is not recommended).
```

To solve the problem you must change them. First check who owns the directory:
```bash
$ ls -la /usr/local/lib/node_modules
```
```bash
drwxr-xr-x   3 root    wheel  102 Jun 24 23:24 node_modules
```
If the response it's similar that the quote above it's denying access because the node_module folder is owned by root.
So this needs to be changed by changing root to your user but first run command below to check your current user. 
How do I get the name of the active user via the command line in OS X?

```bash
$ id -un
```

Then when you know the active user do the execute the following command:
```bash
$ sudo chown -R [owner]:wheel /usr/local/lib/node_modules
```

If you need more information we recommend to read it [here](https://stackoverflow.com/questions/48910876/error-eacces-permission-denied-access-usr-local-lib-node-modules-react).


## [Development](#development)

### Widgets
In the moment you want to add an extension to the platform you must follow the next instructions.

1) First you must include your folder inside the directory in which all the extensions are: ***./extensions/***
2) Validate if your folder is in the correct place:
```bash
$ ls extensions/
```
Remember that inside your extensions folder you must have the following files and folders:

```bash
└── extensions/
	├── widgetName/
	|   └─ assets/
	|   |   └─ css/
	|   |   └─ js/
	|   └─ views
	|   └── viewWidgetName.php
	└── WidgetName.php
```

3) Inside your principal file (*extensions/nameOfWidget/***WidgetName***.php*) you must include the variables that want to use to include inside the HTML file. 
Example:
```php
	class WidgetName extends Widgets {
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [];
	}
```
You can see that's it's a variable call $options which is an array that let you modify things of your styles and determinate if you want to minify or not your files. The default condition is to minify CSS and JS files so if you want to cancel this you must add a false.
Example:
Example:
```php
	class WidgetName extends Widgets {
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [
			'minify' => false,
		];
	}
```

4) If the widget have styles file or scripts in JavaScript, you can include them like this:
```php
	class WidgetName extends Widgets {
		// Assets files
		public $files = [
			'style'		=> ['styles.filename.less'],
			'js'		=> ['script.in.javascript.js', 'script.in.javascript.second.js'],
		];
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [];
	}
```
The variable ***$files*** let is an array that you are going to include the styles in style and the scripts at js position. It's important that if you have more than one file you can include them because it's an array for each element (style and js).

5) Then in the render view of the HTML document, you must add the variables that you name before (***renderView()***).
Example:
```php
	class WidgetName extends Widgets {
		// Assets files
		public $files = [
			'style'		=> ['styles.filename.less'],
			'js'		=> ['script.in.javascript.js', 'script.in.javascript.second.js'],
		];
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [];

		public function assets (){
			return parent::getAssets($this->files['style'], $this->files['js']);
		}
		public function renderView () {
			return Widgets::renderViewHtml([
					'title'         => $this->title,
					'description'   => $this->description,
					'image'         => $this->image,
				]
			);
		}
	}
```

6) Add the following code inside your Controller (*index.php*) 

```php
	/****************************************
	 * WIDGET NAME
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/nameOfWidget/WidgetName.php';
	$widgetWidgetName 	= (new WidgetName())->renderView();
	array_push($assets['css'], (new VideosList())->assets()['css']);
	array_push($assets['js'], (new VideosList())->assets()['js']);
	$displayWidgetName = true;
```
Remember to change the following words:
* ***nameOfWidget***: is the name of the folder that you include in */extensions/*
* ***WidgetName***: name of the first file inside the folder and of course the class name
* ***widgetWidgetName***: is a variable name that always begins with widget and the ***WidgetName*** which will store the code
* ***displayWidgetName*** *(true | false)*: is a variable name that always begins with display and the ***WidgetName*** which contains if you want to display or not
* ***array_push($assets['css'], (new VideosList())->assets()['css'])***: you must add this line if you have in the extension styles files. If you don't have styles you can delete.
* ***array_push($assets['js'], (new VideosList())->assets()['js'])***: you must add this line if you have in the extension scripts files. If you don't have styles you can delete.

#### LESS compiler with PHP
The extensions which have a style document in ***LESS*** format inside the assets folder are compile by ***lessphp*** [more information](http://leafo.net/lessphp/).

It's necessary to include the lessc.inc.php file to compile so you must include in your autoload. One way to make it happen is to add the next line in your composer.json:

```json
	"autoload": {
		"classmap": [
			"vendor/leafo/lessphp/lessc.inc.php"
		]
	},

```
When you save it remember to execute the refresh of the autoload:

```bash
php composer dumpautoload -o
```