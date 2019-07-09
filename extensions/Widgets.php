<?php
	/**
	 * Widget class
	 *
	 * @author			Tomas Malio <tomasmalio@gmail.com>
	 * @version 		1.2
	 * 
	 */
	use MatthiasMullie\Minify;

	class Widgets {

		public $viewName;
		// Client name
		private $clientName;
		// Extension Id
		private $extensionId;
		// Source folder
		private $source;
		// Destination folder
		private $destination;
		// Destination temp
		private $temporal;

		public function __construct($params = []) {
			$this->clientName 	= $params['clientName'];
			$this->extensionId 	= $params['id'];
			$this->source 		= 'extensions/'.lcfirst(get_class($this)) . '/assets';
			$this->destination 	= 'assets/'. $this->clientName . '/' . strtolower(get_class($this));
			$this->temporal 	= 'tmp/'. strtolower(get_class($this));

			unset($params['clientName']);
			unset($params['id']);

			//print_r($params);
			if (isset($params) && count($params) > 0) {
				foreach ($params['data'] as $key => $value) {
					if (property_exists(get_class($this), $key)) {
						/**
						 * If the extensions receive words that are going to
						 * be use for titles, buttons, etc we obtain and then
						 * separated from the main content
						 */
						if ($key == 'content') {
							// if (isset($value['words'])) {
							// 	if (!isset($value['words']['title'])) {
							// 		$value['words']['title'] = $value['section'][COUNTRY_CODE];
							// 	}
							// } else {
							// 	$value['words']['title'] = $value['section'][COUNTRY_CODE];
							// }
							// $includeContent['words'] = $value['words'];
							// if (isset($value['title'])) {
							// 	$includeContent['title'] = $value['title'];
							// }
							$this->content = $value;
							if (isset($value['words'])) {
								unset($this->content['words']);
								foreach ($value['words'] as $k => $v) {
									$this->content[$k] = $v;
								}
							}
						}
						if ($key != 'content' && $key != 'options') {
							$this->$key = $value;
						}
						/**
						 * Extension options
						 */
						if ($key == 'options') {
							if (isset($value)) {
								$this->options = array_replace_recursive($this->options, $value);
								/**
								 * Creating scripts include in default at
								 * extension.
								 */
								if (isset($this->options['scripts']) && $this->options['scripts']) {
									$script['scripts'] = $this->options['scripts'];
								}
								/**
								 * Creating scripts for slider
								 */
								if (($this->options['slider']['desktop']['display'] && !IS_MOBILE) || ($this->options['slider']['mobile']['display'] && IS_MOBILE)) {
									
									// Setting variables for the swiper
									$mousewheel = 'true';
									$spacebetween = '30';
									$loop = 'true';

									if ($this->options['slider']['options']['loop'] === 'false') {
										$loop = 'false';
									}
									if ($this->options['slider']['options']['spacebetween'] != '30') {
										$spaceBetween = $this->options['slider']['options']['spacebetween'];
									}
									if ($this->options['slider']['options']['mousewheel'] === false) {
										$mousewheel = 'false';
									}
									
									// Slider script generator
									$script['scripts'][1] = [
										'name'		=> 'swiper.' . strtolower(get_class($this)) . $this->extensionId,
										'content' 	=> "var swiper" . get_class($this) . $this->extensionId . " = new Swiper('.". strtolower(get_class($this)) ."-content', {
											slidesPerView: 'auto',
											loop: ".$loop.",
											spaceBetween: ".$spacebetween.",
											mousewheel: ".$mousewheel.",
											navigation: {
												nextEl: '.swiper-button-next',
												prevEl: '.swiper-button-prev',
											},
											pagination: {
												el: '.swiper-pagination',
												clickable: true,
											},
										});"
									];
								}
								// If there're scripts we include in our options variable
								(is_array($script)) ? $this->options = array_merge($this->options, $script): '';
							}
						}
					}
				}
			}
			if (isset($params['viewName']) && $params['viewName']) {
				$this->viewName = $params['viewName'];
			}
			/**
			 * Getting the content info
			 * 
			 * Returns array info of the model 
			 **/ 
			$modelUrl = 'extensions/'.lcfirst(get_class($this)).'/model';
			if (is_dir($modelUrl)) {
				try {
					if (isset($params['modelView']) && $params['modelView']) {
						if (file_exists($modelUrl .'/Model' . $params['modelView'] . '.php')) {
							require_once $modelUrl .'/Model' . $params['modelView'] . '.php';
							$name = 'Model'.$params['modelView'];
						} else {
							throw new Exception('No model find for '.$modelUrl .'/Model' . $params['modelView'] . '.php');
						}
					} else {
						if (file_exists($modelUrl .'/Model' . get_class($this) . '.php')) {
							require_once $modelUrl .'/Model' . get_class($this) . '.php';
							$name = 'Model'.get_class($this);
						} else {
							throw new Exception('No model find for '.$modelUrl .'/Model' . get_class($this) . '.php');
						}
					}
					if (isset($name)) {
						$model = new $name();
						$content = $model->model($params['data']['content']);	
					}
				} catch (Exception $e) {
					$e->getMessage();
				}
				//}
				// Changing naming content before created
				// if (isset($this->renameVerify)) {
				// 	$content = self::multiRenameKey($content, $this->renameVerify['wrong'], $this->renameVerify['verify']);
				// }
				
			} else {
				$content = null;
			}
			/**
			 * Creating the content var for using in the front html. 
			 * If the extension has words (title, buttons, etc) we merge with
			 * the content array.
			 */
			//print_r($content);
			$this->content['content'] = $content;
			// if (!is_array($this->content)) {
			// 	$this->content = [];
			// }
			// if (is_array($includeContent['words'])) {
			// 	$this->content = array_merge($this->content, $includeContent['words']);
			// }
			// if (is_array($includeContent['title']) && (!isset($includeContent['words']['title']))) {
			// 	$this->content['title'] = $includeContent['title'];
			// }
			// print_r($this->content);
		}
		
		/**
		 * Slider
		 * Create a slider for desktop or mobile in which we detect the
		 * device in which the user is.
		 * 
		 * @return		object 			Returns true or false if validate the conditions for desktop or mobile
		 */
		public function slider () {
			if ((!IS_MOBILE && isset($this->options['slider']['desktop']['display']) && $this->options['slider']['desktop']['display']) || (IS_MOBILE && isset($this->options['slider']['mobile']['display']) && $this->options['slider']['mobile']['display'])) {
				return true;
			}
			return false;
		}

		/**
		 * Pagination
		 * Identify if the slider must have pagination in the slider for desktop 
		 * or mobile in which we detect the device in which the user is.
		 * 
		 * @return		object 			Returns true or false if validate the conditions for desktop or mobile
		 */
		public function sliderPagination () {
			if ((!IS_MOBILE && isset($this->options['slider']['desktop']['pagination']) && $this->options['slider']['desktop']['pagination']) || (IS_MOBILE && isset($this->options['slider']['mobile']['pagination']) && $this->options['slider']['mobile']['pagination'])) {
				return true;
			}
			return false;
		}

		/**
		 * Navigation (arrows)
		 * Identify if the slider must arrows navigations in the slider for desktop 
		 * or mobile in which we detect the device in which the user is.
		 * 
		 * @return		object 			Returns true or false if validate the conditions for desktop or mobile
		 */
		public function sliderNavigation () {
			if ((!IS_MOBILE && isset($this->options['slider']['desktop']['navigation']) && $this->options['slider']['desktop']['navigation']) || (IS_MOBILE && isset($this->options['slider']['mobile']['navigation']) && $this->options['slider']['mobile']['navigation'])) {
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
			if (IS_MOBILE && isset($this->options['items']['mobile'])) {
				return $this->options['items']['mobile'];
			} elseif (!IS_MOBILE && isset($this->options['items']['desktop'])) {
				return $this->options['items']['desktop'];
			}
		}

		/**
		 * Render View HTML
		 * 
		 * @param 		array 			$array
		 * @return		object 			Returns the object from the renderPhpFile
		 */
		public function renderViewHtml($array, $viewName) {
			(!$viewName) ? $viewName = get_class($this) : $viewName;
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
			if (!empty($this->options['styles'])) {
				return str_replace('"'.strtolower(get_class($this)).'"', strtolower(get_class($this)) . $this->extensionId, ob_get_clean());
			} else {
				return ob_get_clean();
			}
		}

		/**
		 * Assets
		 * 
		 * @return		array			Returns an array with the assets files for Styles and JavaScript
		 */
		public function assets ($date) {
			try {
				self::xcopy($this->source.'/images', $this->destination.'/images', 0755);
				self::xcopy($this->source.'/fonts', $this->destination.'/fonts', 0755);

				return [
					'css' => self::compileAssets('CSS', $this->files['style'], $date, $this->options), 
					'js' => self::compileAssets('JS', $this->files['js'], $date, $this->options)
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
		private function compileAssets ($type, $files, $date, $options = null) {
			$less = new lessc;
			try {
				if ($type == 'CSS') {
					if (!empty($files)) {
						$dest 		= $this->destination . '/css';
		
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
								if (self::validateFile($file) && file_exists($this->source . '/'. self::getExtension($file) . '/' .$file)) {
									//$src .= '/' . self::getExtension($file);
									$original = $this->source . '/'. self::getExtension($file) . '/' . $file;
									$filename = $dest .'/'. basename($file, '.'. self::getExtension($file));
									
									// File in a LESS format
									if (strpos($file, 'less')) {
										// Backup the original file to create the new one
										$backupFile = $this->temporal . '/'. self::getExtension($file) . '/' . basename($file, '.less').'.bk.less';	
										// Create a copy of the original file to keep it save
										self::createDirectory($this->temporal . '/'. self::getExtension($file), '0755');
										self::xcopy($original, $backupFile, 0755);
										// shell_exec("chmod -R 0755 $this->temporal");
										// shell_exec("cp -r $original $backupFile");
										// Import global less files
										if (!isset($options['importGlobalLess']) || $options['importGlobalLess']) {
											self::addImportsLess($backupFile);
										}
										
										/**
										 * If there's styles define we concat to the 
										 * filename the id extension to identify
										 */
										if (!empty($options['styles'])) {
											$filename .= $this->extensionId;
										}

										// Minify the file if is not set or if it's true
										if (!isset($options['minify']) || $options['minify']) {
											$filename .= '.min.css';
											$less->setFormatter("compressed");
										} else {
											$filename .= '.css';
										}

										/**
										 * If there's styles define we modify the original file 
										 * with the new content. If the variable is not change
										 * the original value continues
										 */
										if (!empty($options['styles'])) {
											//$backupFile = $this->temporal . '/'. self::getExtension($file) . '/' . basename($file, '.less').'.bk.less';
											
											// Create a copy of the original file to keep it save
											//self::createDirectory($this->temporal . '/'. self::getExtension($file), '0755');
											//self::xcopy($original, $backupFile, 0755);
											//shell_exec("cp -r $original $backupFile");

											// Replacement of the class name
											$newFile = file_get_contents($backupFile);
											$newFile = str_replace([strtolower(get_class($this)).' ', strtolower(get_class($this)).'{'], [strtolower(get_class($this)) . $this->extensionId . ' ', strtolower(get_class($this)) . $this->extensionId . '{'], $newFile);
											file_put_contents($backupFile, $newFile);

											// Modify the variables
											self::modifyVars($options['styles'], $backupFile);
											
											// Compile the file
											$less->checkedCompile($backupFile, $filename);

											// Remove the backup file
											unlink($backupFile);
										} else {
											// Compile the less but first verify if the css exist
											$less->checkedCompile($backupFile, $filename);
										}
										//shell_exec("rm -rf $this->temporal");
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
									$filename .= '?v='.date('YmdHis', $date);
									array_push($arrayReturn, $filename);
								}
							}
						}	
						return $arrayReturn;
					}
				} elseif ($type == 'JS') {
					$arrayReturn = [];
					
					if (!empty($files)) {
						$src 		= $this->source . '/js';
						$dest 		= $this->destination. '/js';
						
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
										$filename = $dest .'/'. basename($file, '.js') . $this->extensionId . '.min.js';
										
										(new Minify\JS($original))->minify($filename);
									} else {
										$filename = $dest .'/'. basename($file, '.js') . $this->extensionId . '.js';
									}
									$filename .= '?v='.date('YmdHis', $date);
									array_push($arrayReturn, $filename);
								}
							}
						}
					} 
					/**
					 * Create JavaScript file with the code that we received
					 */
					if (count($options['scripts']) > 0) {
						$src 		= $this->source . '/js';
						$dest 		= $this->destination . '/js';
						
						// Create the directory if not exist
						self::createDirectory($dest);
						
						foreach ($options['scripts'] as $script) {
							$original = self::createScriptJs($script['content'], $script['name']);
							// Minify the file if is not set or if it's true
							if (!isset($options['minify']) || $options['minify']) {
								$filename = str_replace('.js', '.min.js', $original);
								(new Minify\JS($original))->minify($filename);
							} else {
								$filename = $original;
							}
							$filename .= '?v='.date('YmdHis', $date);
							array_push($arrayReturn, $filename);
						}
						
					}
					return $arrayReturn;
				}	
			} catch (exception $e) {
				echo "Error compile Assets message: " . $e->getMessage();
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
				$file .= "@import '../../../less/common.less';\n\n";
				$file .= "@import '../../../less/config.".$this->clientName.".less';\n";
				$file .= file_get_contents($filename);
				file_put_contents($filename, $file);
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
		private function createScriptJs ($script, $name = '') {
			if (isset($name) && $name) {
				$filename 	= str_replace('.js', '', $name) . $this->extensionId . '.js';
			} else {
				$filename 	= 'script.' . strtolower(get_class($this)) . $this->extensionId . '.js';
			}
			$dest 	= $this->destination . '/js';
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

		/**
		 * Multi Rename Key
		 * Modify the key names of arrays with new ones
		 * 
		 * @param		array		$array		Array with the content
		 * @param		array		$old_key	Array with the old key to change
		 * @param		array		$new_key	Array with the new keys
		 * @return		array		Return array with the key replace
		 */
		public function multiRenameKey (&$array, $wrong, $verify) {
			if (is_array($wrong) && is_array($verify)) {
				foreach($array as $key => &$value) {
					$keyNew = array_search($key, $wrong);
					if ($key !== 0 && is_numeric($keyNew)) {
						if ($value <> '') {
							$array[$verify[$keyNew]] = $value;
						} else {
							$array[$verify[$keyNew]] = '';
						}
						unset($array[$key]);
					}
					if(is_array($value)) { 
						self::multiRenameKey($value, $wrong, $verify); 
					} 
				}
			}
			return $array;
		}

		/**
		 * Normalize String
		 * 
		 * @* @param String str String to be transform
		 */
		public function normalizeString($str) {

			$unwanted_array = array(
				'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A',
				'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a',
				'Ê' => 'E', 'Ë' => 'E', 'È' => 'E', 'É' => 'E', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 
				'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
				'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
				'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ù' => 'U', 'ù' => 'u', 'ú' => 'u', 'û' => 'u',
				'Ñ' => 'N', 
				'Š' => 'S', 'š' => 's', 
				'Ž' => 'Z', 'ž' => 'z', 
				'Ç' => 'C', 'ç' => 'c', 
				'Ý' => 'Y', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y',
				'Þ' => 'B', 
				'ß' => 'Ss', 				
				' ' => '-', '.' => '-', '"' => '-', '`' => '-', '´' => '-', ',' => '-', '„' => '-', '`' => '-', 
				'´' => '-', '“' => '-', '”' => '-', '´' => '-', '/' => '-', '|' => '-', '«' => 'ab', '»' => '-bb', 
				'#' => '', '°' => '', '>' => '-', '<' => '-', '=' => '-', '{' => '-', '}' => '-', '[' => '-', ']' => '-', 
				'(' => '-', ')' => '-', '=' => '-', '+' => '-', '%' => '-', '*' => '-', '@' => '-',
			);
	
			$str = strtr($str, $unwanted_array);

			$str = str_replace(array("ä", "Ä"), "a", $str); // Additional Swedish filter
			$str = str_replace(array("å", "Å"), "a", $str); // Additional Swedish filter
			$str = str_replace(array("ö", "Ö"), "o", $str); // Additional Swedish filter
	
			$str = preg_replace("/[^a-z0-9\s\-]/i", "", $str); // Remove special characters
			$str = preg_replace("/\s\s+/", " ", $str); // Replace multiple spaces with one space
			$str = trim($str); // Remove trailing spaces
			$str = preg_replace("/\s/", "-", $str); // Replace all spaces with hyphens
			$str = preg_replace("/\-\-+/", "-", $str); // Replace multiple hyphens with one hyphen
			$str = preg_replace("/^\-|\-$/", "", $str); // Remove leading and trailing hyphens
	
			return utf8_encode(strtolower($str));
		}
	}
?>