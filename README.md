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
As this is the only command in the file, you can execute it by pressing ⇧⌘B (Run Build Task). The sample Less file should not have any compile problems, so by running the task all that happens is a corresponding styles.css file is created.


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


## Development

### Widgets
In the moment you want to add an extension to the platform you must follow the next instructions.

1) First you must include your folder inside the directory in which all the extensions are: ***./extensions/***
2) Validate if your folder is in the correct place:
```bash
$ ls extensions/
```
Remember that inside your Widget folder you must have the following files and folders:

```bash
├── _widgetName
├── _drafts
|   ├── _views
|   ├── ── viewWidgetName.php
|   └── WidgetName.php
```

3) Add the following code inside the Controller (*index.php*) 

```php
	/****************************************
	 * WIDGET NAME
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/nameOfWidget/WidgetName.php';
	$widgetWidgetName 	= (new WidgetName())->renderView();
	$displayWidgetName = true;
```
Remember to change the following words:
* ***nameOfWidget***: is the name of the folder that you include in */extensions/*
* ***WidgetName***: name of the first file inside the folder and of course the class name
* ***widgetWidgetName***: is a variable name that always begins with widget and the ***WidgetName*** which will store the code
* ***displayWidgetName***: is a variable name that always begins with display and the ***WidgetName*** which contains if you want to display or not

4) Next inside your principal file (*extensions/nameOfWidget/***WidgetName***.php*) you must include the variables that want to use to include inside the HTML file. 
Example:
```php
    class WidgetName extends Widgets {
        public $title;
        public $description;
        public $image;
    }
```
Then to render the view of the HTML document, yo must add in the renderView() the variables that you name before:
```php
    class WidgetName extends Widgets {
        public $title;
        public $description;
        public $image;
       
       public function renderView () {
           return Widgets::renderPhpFile(lcfirst(get_class($this)) .'/views/view' . get_class($this) . '.php', array(
                    'title' => $this->title,
                    'description' => $this->description,
                    'image' => $this->image,
                )
            );
        }
    }
```
