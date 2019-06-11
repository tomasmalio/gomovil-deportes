# Widgets
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
	   └─ model/
	   |   └── ModelWidgetName.php
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
				'desktop' => [
					'display' => true, 
					'pagination' => false,
					'navigation' => false,
				],
				'mobile' => [
					'display' => true, 
					'pagination' => true,
					'navigation' => true,
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

6) When we want to connect our extension with a API Service or Database, we must create our **model** file. The default name must start with **Model** and then the name of the **WidgetName**. ***Example: ModelWidgetName.php***.

Inside of the file you can have something like this:

```php
	class ModelWidgetName {
		
		public $url = '//domain.com/api-service.json';

		public function model ($params = []) {
			$json = file_get_contents($this->url);
			return json_decode($json, true);
		}
	}
```

When you finished creating your **model** file you must call it inside of your **WidgetName** document:

Example:
```php
	class WidgetName extends Widgets {
		// Content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['styles.filename.less'],
			'js'		=> ['script.in.javascript.js', 'script.in.javascript.second.js'],
		];

		// Options
		public $options = [];

		public function __construct() {
			if ($content = Widgets::model()) {
				$this->content = $content;
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml('YourViewName', 
				[
					'content'       => $this->content,
				]
			);
		}
	}
```
***Important: you can see that we receive from our Model file the info that's get from a API Service. If there's info we set to a variable call $this->content and then pass to the view file.***

7) Add the following code inside your Controller (*index.php*) 

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