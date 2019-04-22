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
									$src .= '/' . self::getExtension($file);
									$original = $src . '/'. $file;

									$filename = $dest .'/'. basename($file, '.'.self::getExtension($file));

									// File in a LESS format
									if (strpos($file, 'less')) {
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
											$backupFile = $src . '/'. basename($file, '.less').'.bk.less';
											
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
											$less->checkedCompile($src . '/'. $file, $filename);
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
					elseif (isset($options['script']) && !empty($options['script']['content'])) {
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
		 * createScriptJs
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

	}
?>