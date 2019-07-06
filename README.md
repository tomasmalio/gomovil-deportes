# Readme

GoMovil Deportes 

## [Install](#install)
When we want to install the platform from the begining we must follow the instructions to get in ready very quicky.
1) Open your terminal of your server and go to the directory in which your Apache works
2) You must clone this respository:
```bash
git clone https://github.com/tomasmalio/gomovil-deportes.git *folder_name*
```
3) Your server must have PHP so let's install. Here it's an example with the version that works:
```bash
yum install php71-cli.x86_64
```
4) Once you have completed the few steps before you must ***install***:
```bash
php install.php
```

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