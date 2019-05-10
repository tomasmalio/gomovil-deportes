# Readme

GoMovil Deportes 

## [Install](#install)
When we want to install the platform from the begining we must follow the instructions to get in ready very quicky.
1) Open your terminal of your server and go to the directory in which your Apache works
2) You must clone this respository:
```bash
git clone https://github.com/tomasmalio/gomovil-deportes.git
```
3) Your server must have PHP so let's install. Here it's an example with the version that works:
```bash
yum install php71-cli.x86_64
```
4) Once you have completed the few steps before you must install ***composer***:
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '48e3236262b34d30969dca3c37281b3b4bbe3221bda826ac6a9a62d6444cdb0dcd0615698a5cbe587c3f0fe57a54d8f5') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
If you need more information about it, follow the instructions from [here](https://getcomposer.org/download/) and continue the instructions of the [Basic Usage](https://getcomposer.org/doc/01-basic-usage.md). The most important thing is that the *composer.json* must be created.

5) When you finished the install of ***composer***, we must run the command that install all the require packages and scripts that are include in the repository:
```bash
php composer install
```
***Important:*** the composer.json contains a command in which change owner permissions to the user "apache". If you've other user for your web server be carefull because the *assets folder* must have owner permissions.

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
	└── widgetName/
	   └─ assets/
	   |   └─ css/
	   |   └─ js/
	   └─ views/
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
You can see that's it's a variable call ***$options*** which is an array that let you modify or include particulary things.

* **slider**: The extension may accept the possibility of including a slider. If desired, they can accept the possibility of having navigation through arrows and paging. To can define for desktop and mobile.
* ***minify (true | false)***: if you want to minify or not your files. The default condition is to minify CSS and JS files so if you want to cancel this you must add a false.
* ***styles (array)***: include the variables that you want to change inside the document LESS before compile.
* ***script***: include a JavaScript code that you don't want to create a file so the widget will make it for you. This element it's an array in which you can define the name of the script *(optional)* and the content that's require for creating the JS script.
* ***importGlobalLess (true | false)***: include global LESS to your LESS file extension (default: true).

Example:
```php
	class WidgetName extends Widgets {
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> true, 
					'pagination'	=> false,
					'navigation'	=> false,
				],
				'mobile' 	=> [
					'display' 		=> true, 
					'pagination'	=> true,
					'navigation'	=> true,
				]
			],
			'minify' => false,
			'styles' => [
				'color_1' => "white",
				'background_1' => "#000000",
				'h1-font-size' => "'Arial'",
			],
			'script' => [
				'name'	=> 'masonry.social-posts',
				'content' => "$('.grid-social').masonry({
								itemSelector: '.grid-item-social',
								gutter: 0
							});"
			],
			'importGlobalLess' => false,
		];
	}
```

4) If the widget have ***Styles files (LESS or CSS)*** or ***Scripts in JavaScript***, you can include them like this:
```php
	class WidgetName extends Widgets {
		// Assets files
		public $files = [
			'style'		=> ['styles.filename.less', 'style.filename.css'],
			'js'		=> ['script.in.javascript.js', 'script.in.javascript.second.js'],
		];
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [];
	}
```
* Variable ***$files*** it's an array that you are going to include styles and scripts at each position respectively. It's important that if you have more than one file you can include them because it's an array for each element (style and js). 
* Styles that you have in ***LESS*** format you must have it in the **assets/less/** folder and if you create ***CSS*** styles format you must have it in **assets/css/** folder.
* ***External files*** can be include in each position like this:

```php
	class WidgetName extends Widgets {
		// Assets files
		public $files = [
			'js'		=> ['https://code.jquery.com/jquery-3.4.0.min.js'],
		];
		public $title;
		public $description;
		public $image;
		// Options
		public $options = [];
	}
```
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
***Important:*** the default view file name is: ***viewClassName.php***, if you want to change you must send it to the **renderViewHtml()**. Remember that your view must be name like this: ***viewYourViewName.php***.

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

		public function renderView () {
			return Widgets::renderViewHtml('YourViewName', 
				[
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
	$assetWidgetName 	= (new WidgetName())->assets();
	array_push($assets['css'], $assetWidgetName['css']);
	array_push($assets['js'], $assetWidgetName['js']);
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

## Other issues
### Less Installation in Visual Studio Code

Use the steps recommend by Visual Studio [CSS, SCSS and Less](https://code.visualstudio.com/docs/languages/css#_transpiling-sass-and-less-into-css) to integrate with Less transpilers through a task runner. 
Important: you must have Node.js and the npm package manager already installed.

```bash
npm install -g node-sass less
```

#### Create the tasks.json
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
#### Run the Build Tasks
As this is the only command in the file, you can execute it by pressing ***⇧⌘B (Run Build Task)***. The sample Less file should not have any compile problems, so by running the task all that happens is a corresponding styles.css file is created.


### Problems to Compile Less
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