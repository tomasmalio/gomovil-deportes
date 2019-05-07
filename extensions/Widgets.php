<?php
	/**
	 * Widget class
	 *
	 * @author			Tomas Malio <tomasmalio@gmail.com>
	 * @version 		1.0
	 * 
	 */
	use MatthiasMullie\Minify;

	class Widgets {
		
		/**
		 * Slider
		 * Create a slider for desktop or mobile in which we detect the
		 * device in which the user is.
		 * 
		 * @return		object 			Returns true or false if validate the conditions for desktop or mobile
		 */
		public function slider () {
			if ((!$GLOBALS['isMobile'] && isset($this->options['slider']['desktop']) && $this->options['slider']['desktop']) || ($GLOBALS['isMobile'] && isset($this->options['slider']['mobile']) && $this->options['slider']['mobile'])) {
				return true;
			}
			return false;
		}

		/**
		 * Items
		 * 
		 * @return		int 			Returns the number of items to show
		 */
		public function items () {
			if ($GLOBALS['isMobile'] && isset($this->options['items']['mobile'])) {
				return $this->options['items']['mobile'];
			} elseif (!$GLOBALS['isMobile'] && isset($this->options['items']['desktop'])) {
				return $this->options['items']['desktop'];
			}
		}

		/**
		 * Model
		 * 
		 * @return		array 			Returns array info of the model
		 */
		public function model() {
			$modelUrl = 'extensions/'.lcfirst(get_class($this)).'/model';
			if (is_dir($modelUrl)) {
				require_once $modelUrl .'/Model' . get_class($this) . '.php';
				$name = 'Model'.get_class($this);
				$model = new $name();
				return $model->model();	
			}
			return null;
		}

		/**
		 * Render View HTML
		 * 
		 * @param 		array 			$array
		 * @return		object 			Returns the object from the renderPhpFile
		 */
		public function renderViewHtml($array, $viewName = false) {
			(!$viewName) ? $viewName = get_class($this) : '';
			return $this->renderPhpFile(lcfirst(get_class($this)) .'/views/view' . $viewName . '.php', $array);
		}

		/**
		 * Render PHP file
		 * 
		 * @param		string 			$filename
		 * @param 		array			$vars
		 * @return		object 			Returns the object file render
		 */
		public function renderPhpFile ($filename, $vars = null) {
			if (is_array($vars) && !empty($vars)) {
				extract($vars);
			}
			ob_start();
			include $filename;
			return ob_get_clean();
		}

		/**
		 * Assets
		 * 
		 * @return		array			Returns an array with the assets files for Styles and JavaScript
		 */
		public function assets () {
			try {
				self::xcopy('extensions/'.lcfirst(get_class($this)) . '/assets/images', 'assets/' . strtolower(get_class($this)) . '/images', 0755);
				self::xcopy('extensions/'.lcfirst(get_class($this)) . '/assets/fonts', 'assets/' . strtolower(get_class($this)) . '/fonts', 0755);
				return [
					'css' => self::compileAssets('CSS', $this->files['style'], $this->options), 
					'js' => self::compileAssets('JS', $this->files['js'], $this->options)
				];
			} catch (exception $e) {
				echo "Error message: " . $e->getMessage();
			}
		}

		/**
		 * Compile Assets
		 * 
		 * @param 		string 			$type
		 * @param 		array 			$files
		 * @param 		array			$options
		 * @return 		array			Returns an array with the assets files
		 */
		private function compileAssets ($type, $files, $options = null) {
			$less = new lessc;
			try {
				if ($type == 'CSS') {
					if (!empty($files)) {
						$src 		= 'extensions/'.lcfirst(get_class($this)) . '/assets';
						$dest 		= 'assets/' . strtolower(get_class($this)) . '/css';
		
						// Create the directory if not exists
						self::createDirectory($dest);
		
						$arrayReturn = [];
						/**
						 * For each LESS file we check & compile 
						 * to get the CSSS file. Then we copy to 
						 * asset directory and minify to compress 
						 * the size
						 */
						foreach ($files as $file) {
							// If it's an external file we include directly
							if (substr($file, 0, 4) === 'http' || substr($file, 0, 2) === '//') {
								array_push($arrayReturn, $file);
							} else {
								
								// Validate if an authorize file and exits
								if (self::validateFile($file) && file_exists($src . '/'. self::getExtension($file) . '/' .$file)) {
									//$src .= '/' . self::getExtension($file);
									$original = $src . '/'. self::getExtension($file) . '/' . $file;
									$filename = $dest .'/'. basename($file, '.'. self::getExtension($file));

									// File in a LESS format
									if (strpos($file, 'less')) {
										if (!isset($options['importGlobalLess']) || $options['importGlobalLess']) {
											$importFile = $src .  '/' . self::getExtension($file) . '/'. $file;
											self::addImportsLess($importFile);
										}

										// Minify the file if is not set or if it's true
										if (!isset($options['minify']) || $options['minify']) {
											$filename .= '.min.css';
											$less->setFormatter("compressed");
										} else {
											$filename .= '.css';
										}
										//echo "informacion". date ("F d Y H:i:s.", filemtime($filename));
										/**
										 * If there's styles define we modify the original file 
										 * with the new content. If the variable is not change
										 * the original value continues
										 */
										if (!empty($options['styles'])) {
											$backupFile = $src . '/'. self::getExtension($file) . '/' . basename($file, '.less').'.bk.less';
											
											// Create a copy of the original file to keep it save
											shell_exec("cp -r $original $backupFile");

											// Modify the variables
											self::modifyVars($options['styles'], $backupFile);
											
											// Compile the file
											$less->checkedCompile($backupFile, $filename);

											// Remove the backup file
											unlink($backupFile);
										} else {
											// Compile the less but first verify if the css exist
											$less->checkedCompile($src . '/'. self::getExtension($file) . '/' . $file, $filename);
										}
									}
									// File in a CSS format
									elseif (strpos($file, 'css')) {
										// Minify the file if is not set or if it's true
										if (!isset($options['minify']) || $options['minify']) {
											$filename .= '.min.css';
											(new Minify\CSS($original))->minify($filename);
										} else {
											$filename .= '.css';
											shell_exec("cp -r $original $filename");
										}
									}
									array_push($arrayReturn, $filename);
								}
							}
							
						}	
						return $arrayReturn;
					}
				} elseif ($type == 'JS') {
					$arrayReturn = [];

					if (!empty($files)) {
						$src 		= 'extensions/'.lcfirst(get_class($this)) . '/assets/js';
						$dest 		= 'assets/' . strtolower(get_class($this)) . '/js';
						
						// Create the directory if not exists
						self::createDirectory($dest);
						/**
						 * For each JS file we copy to asset directory
						 * and minify to compress the size
						 */
						foreach ($files as $file) {
							// If it's an external file we include directly
							if (substr($file, 0, 4) === 'http' || substr($file, 0, 2) === '//') {
								array_push($arrayReturn, $file);
								
							} else {
								// Validate if an authorize file and exits
								if (self::validateFile($file) && file_exists($src . '/' . $file)) {
									$src .= '/'.$file;
									$dest .= '/'.$file;

									// Copy the file to the assets directory
									shell_exec("cp -r $src $dest");

									// We change the name for the next file
									$src = str_replace('/'.$file, '', $src);
									$dest = str_replace('/'.$file, '', $dest);

									// Minify the file if is not set or if it's true
									if (!isset($options['minify']) || $options['minify']) {
										$original = $src .'/'. basename($file, '.js') . '.js';
										$filename = $dest .'/'. basename($file, '.js') . '.min.js';
										
										(new Minify\JS($original))->minify($filename);
									} else {
										$filename = $dest .'/'. basename($file, '.js') . '.js';
									}
									array_push($arrayReturn, $filename);
								}
							}
						}
					} 
					/**
					 * Create JavaScript file with the code that we received
					 */
					if (isset($options['script']) && !empty($options['script']['content'])) {
						$src 		= 'extensions/'.lcfirst(get_class($this)) . '/assets/js';
						$dest 		= 'assets/' . strtolower(get_class($this)) . '/js';
						
						// Create the directory if not exist
						self::createDirectory($dest);

						$original = self::createScriptJs($options['script']['content'], $options['script']['name']);
						// Minify the file if is not set or if it's true
						if (!isset($options['minify']) || $options['minify']) {
							$filename = str_replace('.js', '.min.js', $original);
							(new Minify\JS($original))->minify($filename);
						} else {
							$filename = $original;
						}
						array_push($arrayReturn, $filename);
					}
					return $arrayReturn;
				}
				
			} catch (exception $e) {
				echo "Error message: " . $e->getMessage();
			}
		}
		
		/**
		 * Validate File
		 * Validate the extension file so we can continue 
		 * with the process
		 * 
		 * @param		string 			$file		Filename
		 * @return		boolean			Returns true on success or false on failure
		 */
		private function validateFile ($file) {
			// Validate if the filename has less, css or js extension
			if ((self::getExtension($file) === 'less') || (self::getExtension($file) === 'css') || (self::getExtension($file) === 'js')) {
				return true;
			}
			return false;
		}

		/**
		 * Get Extension
		 * Get the extension name of the filename
		 * 
		 * @param		string 			$file		Filename
		 * @return		string			Returns the extension name or false
		 */
		private function getExtension ($file) {
			$extension = end(explode(".", $file));
			return $extension ? $extension : false;
		}

		/**
		 * Create Directory
		 * Make the directory if doesn't exists with permissions
		 * 
		 * @param		string 			$dir
		 * @param		int 			$persmission
		 */
		private function createDirectory ($dir, $permission = 0755) {
			// Check if the directory with the name already exists
			if (!is_dir($dir)) {
				// Create our directory if it does not exist
				mkdir($dir, $permission, true);
			}
		}

		/**
		 * Copy a file, or recursively copy a folder and its contents
		 * 
		 * @param		string		$source		Source path
		 * @param		string		$dest		Destination path
		 * @param		int 		$permissions New folder creation permissions
		 * @return		boolean		Returns true on success, false on failure
		 */
		private function xcopy ($source, $dest, $permissions = 0755) {
			if (file_exists($source)) {
				// Check for symlinks
				if (is_link($source)) {
					return symlink(readlink($source), $dest);
				}

				// Simple copy for a file
				if (is_file($source)) {
					return copy($source, $dest);
				}

				// Make destination directory
				self::createDirectory($dest, $permissions);

				// Loop through the folder
				$dir = dir($source);
				while (false !== $entry = $dir->read()) {
					// Skip pointers
					if ($entry == '.' || $entry == '..') {
						continue;
					}

					// Deep copy directories
					self::xcopy("$source/$entry", "$dest/$entry", $permissions);
				}

				// Clean up
				$dir->close();
				return true;
			}
			return false;
		}

		/**
		 * Add Imports LESS
		 * Include global imports in your LESS files 
		 * 
		 * @param		string		$filename	Source path
		 */
		private function addImportsLess ($filename) {
			if (strpos(file_get_contents($filename), "Global Imports") === false) {
				$file = "/* Global Imports */\n";
				$file .= "@import '../../../../less/config.less';\n";
				$file .= "@import '../../../../less/common.less';\n\n";
				$file .= file_get_contents($filename);
				file_put_contents($filename, $file);
				unset($file);
			}
		}

		/**
		 * Modify Variables from a LESS file
		 * 
		 * @param		array		$vars		Array with the new variables
		 * @param		string		$filename	Backup file to change the variables
		 */
		private function modifyVars($vars, $filename) {
			// Get the file content
			$file = file_get_contents($filename);
			// Go through the entire array variable styles
			foreach($vars as $name => $value){
				// Validate if the atribute contain a @
				$name = str_replace('@', '', $name);

				// Get the line which we're going to change
				$replace 	= self::getText($file, '@'.$name, ';').';';
				
				// Create the new line
				$change 	= (($name[0] === '@') ? '' : '@') . $name .': '. $value . ((substr($value,-1) === ';') ? '' : ';');
				
				// Replacement of the variables in the file
				$file = str_replace($replace, $change, $file);
				file_put_contents($filename, $file);
			}
		}

		/**
		 * Get Text
		 * 
		 * @param		string		$string		String which are going to get the content
		 * @param		string		$startStr	String of how it starts
		 * @param		string		$endStr		String of how it ends
		 * @return		string 		Return the content text
		 */
		private function getText ($string, $startStr, $endStr) {
			$startpos = strpos($string,$startStr);
			$endpos = strpos($string,$endStr,$startpos);
			$endpos = $endpos - $startpos;
			$string = substr($string,$startpos,$endpos);
			return $string;
		}

		/**
		 * Create Script Js
		 * 
		 * @param		string		$script		String with the code for create a JavaScript file
		 * @param		string		$name		String with the name output file name
		 * @return		string		Return the directory concat with the filename
		 */
		public function createScriptJs ($script, $name = '') {
			
			if (isset($name) && $name) {
				$filename 	= str_replace('.js', '', $name) . '.js';
			} else {
				$filename 	= 'script.' . strtolower(get_class($this)) . '.' . mt_rand() . '.js';
			}
			$dest 	= 'assets/' . strtolower(get_class($this)) . '/js';
			file_put_contents($dest . '/' . $filename, $script);

			return ($dest . '/' . $filename);
		}

		/**
		 * Make Links
		 * Create links throw a text that we receive
		 * 
		 * @param		string		$script		String with the social text
		 * @return		string		Return the social text with http in the links
		 */
		public function makeLinks($string) {
			
			if ($url = self::getLinks($string)) {
				// Loop through all matches
				foreach($url[0] as $newLinks){
					$string = str_replace($newLinks, '{URL}', $string);
					if (substr($newLinks, 0, 4) === "http"){
						$replace = '<a href="'.$newLinks.'" target="_blank">'.$newLinks.'</a>';
						return str_replace('{URL}', $replace, $string);
					}
				}
			}
		}

		/**
		 * Get links
		 * Get links from a string
		 * 
		 * @param		string		$script		String with the social text
		 * @return		array		Return an array of links
		 */
		public function getLinks ($string) {
			// The Regular Expression filter
			$reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";
			// Check if there is a url in the text
			if (preg_match_all($reg_exUrl, $string, $url)) {
				return $url;
			}
			return null;
		}

		/**
		 * Convert Social Links
		 * Create links throw a text that we receive that contains
		 * @username or #hashtags
		 * 
		 * @param		string		$script		String with the social text
		 * @return		string		Return the social text with http in the links of users and hasthags
		 */
		public function convertSocialLinks ($str, $network) {
			$regex = "/[@#](\w+)/";
		
			switch ($network) {
				case 'twitter':
					$hrefs = [
						'#' => 'https://www.twitter.com/hashtag/',
						'@' => 'https://www.twitter.com/'
					];
					break;
				case 'instagram':
					$hrefs = [
						'#' => 'https://www.instagram.com/explore/tags/',
						'@' => 'https://www.instagram.com/'
					];
					break;
			}
			$result = preg_replace_callback($regex, function($matches) use ($hrefs) {
				return sprintf('<a href="%s%s" target="_blank">%s</a>', $hrefs[$matches[0][0]], $matches[1], $matches[0]);
			}, $str);
			return($result);
		}

	}
?>