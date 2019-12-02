# Readme

GoMovil Deportes 

## [Install](#install)
When we want to install the platform from the begining we must follow the instructions to get in ready very quicky.
1) Open your terminal of your server and go to the directory in which your Apache works
2) You must clone this respository:
```bash
git clone https://github.com/tomasmalio/gomovil-deportes.git folder_name
```
3) Your server must have PHP so let's install. Here it's an example with the version that works:
```bash
yum install php71-cli.x86_64
```
4) Once you have completed the few steps before you must ***install***:
```bash
sh install
```

## [Starting](#start)
We've installed the software so it's time to create our clients in the system.

1) To **create** a new client we must go to the **table client**:
- name: name of the project (it's internal)
- url: your project contain domains so you must put it here. You can put more than one separated by comma (,)
- title: the title of the project. It's use for al the site.
- country_id: reference to table country
- zone_id: reference to table zone
- language_id: reference to table language
- logo: name of the logo image
- status: status of oyur client active (1) or desable (0 | null)

_Example:_
```sql
INSERT INTO `client:(`name`, `url`, `title`, `country_id`, `zone_id`, `language_id`, `logo`, `status`) 
VALUES ('Sports Dev', 'sports-dev.gomovil.co', 'Sports Dev', '11', '19', '39', 'logo-gosports.png', '1');
```

2) We've created our client so the next step is to add **customizations params** in your new client. The possibility that you've is to change colors, font family, size, buttons, to change global variables and add your CSS content.

- client_id: client number, reference to _table client_
- color_first:
- color_first_hover:
- color_first_active:
- color_second: color in hexadecimal (ex: #000000)
- color_second_hover: color in hexadecimal (ex: #000000)
- color_second_active: color in hexadecimal (ex: #000000)
- color_third: color in hexadecimal (ex: #000000)
- color_third_hover: color in hexadecimal (ex: #000000)
- color_third_active: color in hexadecimal (ex: #000000)
- color_quarter: color in hexadecimal (ex: #000000)
- color_quarter_hover: color in hexadecimal (ex: #000000)
- color_quarter_active: color in hexadecimal (ex: #000000)
- color_fifth: color in hexadecimal (ex: #000000)
- color_fifth_hover: color in hexadecimal (ex: #000000)
- color_fifth_active: color in hexadecimal (ex: #000000)
- color_sixth: color in hexadecimal (ex: #000000)
- color_sixth_hover: color in hexadecimal (ex: #000000)
- color_sixth_active: color in hexadecimal (ex: #000000)
- color_seventh: color in hexadecimal (ex: #000000)
- color_seventh_hover: color in hexadecimal (ex: #000000)
- color_seventh_active: color in hexadecimal (ex: #000000)
- color_eighth: color in hexadecimal (ex: #000000)
- color_eighth_hover: color in hexadecimal (ex: #000000)
- color_eighth_active: color in hexadecimal (ex: #000000)
- color_nineth: color in hexadecimal (ex: #000000)
- color_nineth_hover: color in hexadecimal (ex: #000000)
- color_nineth_active: color in hexadecimal (ex: #000000)
- color_tenth: color in hexadecimal (ex: #000000)
- color_tenth_hover: color in hexadecimal (ex: #000000)
- color_tenth_active: color in hexadecimal (ex: #000000)
- color_facebook (default: #4267b2): color in hexadecimal (ex: #000000)
- color_twitter (default: #1DA1F2): color in hexadecimal (ex: #000000)
- color_spotify (default: #1ED760): color in hexadecimal (ex: #000000)
- color_googleplus (default #dd4b39): color in hexadecimal (ex: #000000)
- color_youtube (default: #ff0000): color in hexadecimal (ex: #000000)
- color_instagram (default: #c13584): color in hexadecimal (ex: #000000)
- h1_font_family: font family for your first title
- h1_font_weight (default: normal): font weight for your first title
- h1_font_size: font size for your first title in pt or px
- h1_font_size_responsive: font size for your first title in responsive mode in pt or px
- h2_font_family: font family for your second title
- h2_font_weight (default: normal): font weight for your second title
- h2_font_size: font size for your second title in pt or px
- h2_font_size_responsive:  font size for your second title in responsive mode in pt or px
- h3_font_family: font family for your third title
- h3_font_weight (default: normal): font weight for your third title
- h3_font_size: font size for your third title in pt or px
- h3_font_size_responsive: font size for your third title in responsive mode in pt or px
- p_font_family: font family for your text
- p_font_weight (default: normal): font weight for your text
- p_font_size: font size for your texts in pt or px
- p_font_size_responsive: font size for your texts in responsive mode in pt or px
- button_font_family: font family for your buttons
- button_font_weight (default: normal): font weight for your buttons
- button_font_size: font size for your buttons in pt or px
- button_font_size_responsive: font size for your buttons in responsive mode in pt or px
- variables (JSON): set your css variables if you want to change. Example: 'body-background': '#f7f7f7'.
- less_content (LESS or CSS): add your styles.
- modify_status: when you change the customization remember to change the modify status to 1. When the system process it'll change to 0.
- modify_date: when you change the customization remember to change the modify date so you've a record of this.
- status (default: 0): remember to put in 1 if you're using.

3) When you've created your client you can start creating sections for the site. To understand this you must see the **table section**, that contains all the kind of sections that can be use. _Example: Home, Football, News._

Attributes when you create a new section for a client:
- client_id: client number id, reference to _table client_
- section_id: section number id, reference to _table section_
- layout_id: layout number id, reference to _table layout_
- content_id: content number id, reference to _table content_. This item appears when something contains default info and translations.
- parent_id (default: null): if this section contains a parent before that is inherit
- view_name (default: null): the view name
- menu_display (default: null): if the sections appears in the menu and the order of each.
- title: section title name for the hole section and meta tags.
- description: section description for meta tags.
- image: section image for meta tags.
- keywords: section keywords for meta tags.
- security_id (default: null): if the section needs login or security level.
- age_control (default: null): when a section needs a age control you must put a 1 here.
- time_cache (default: 86400): the time in seconds for cache the section.
- datetime: the datetime of last update.
- status (default: 0): if the sections is available must be in 1.

_Example:_
```sql
INSERT INTO `section_client:(`client_id`, `section_id`, `layout_id`, `content_id`, `parent_id`, `menu_display`, `title`, `description`, `image`, `keywords`, `security`, `time_cache`, `datetime`, `status`) 
VALUES ('1', '1', '1', NULL, NULL, NULL, 'Principal', `Descripción de la página principal`, `palabra clave, palabra clave dos`, NULL, '86400', '2019-11-29 17:00:00', '1');
```

4) If you finished creating your sections you can add widgets to them associating with **section_extension**.
When you created your **section client** you're available to add widgets to that sections. But where're the widgets extensions? You can find them in the **table extension**.

When you've a new widget to add in the platform you must incorporate in the **extensions/** folder and then in your table add:
- name: widget name
- datetime: of upload the widgets
- directory: the directory folder in extensions/
- status: if it's available 1 or 0 disable.

Okay we're ready to start adding widgets to your section client in the **section extension** table:
- section_client_id: section client number, reference to your section_client table
- extension_id: extension number, reference to your extension table
- position: the position in the layout. Check first where is going to be
- position_mobile: the position in the layout. Check first where is going to be
- options (JSON): options for your widget
- content (JSON): content that your widget receive
- external_content: associate for table content
- styles:
- scripts:
- styles_files (auto generated): when the styles is compile you're going to see the directory of your assets
- scripts_files (auto generated): whe the script is compile you're going to see the directory of your assets
- view_name (default: null): if you've a different view name add it here but in default mode live it null
- model_name (default: null): if you've a different model name add it here. 
- modify_date: when you change something in the widget extesion remember to change the date of modify
- modify_status: if you change something remember to put a 1 here so the system understand to compile the widget again.
- status (default: 0): if the status is in 1 (available) or 0 (disable).

## [Development](#development)

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