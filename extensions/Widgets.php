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
		 * Get Assets
		 * Generate the assets files
		 * 
		 * @param 		array 			$assetsStyles
		 * @param 		array 			$assetsJs
		 * @return 		array			Returns an array with the assets files for Styles and JavaScript
		 */
		public function getAssets ($assetsStyles, $assetsJs) {
			try {
				self::xcopy('extensions/'.lcfirst(get_class($this)) . '/assets/images', 'assets/' . strtolower(get_class($this)) . '/images', 0755);
				return [
					'css' => self::compileAssets('CSS', $assetsStyles), 
					'js' => self::compileAssets('JS', $assetsJs)
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
		public function compileAssets ($type, $files, $options = null) {
			$less = new lessc;
			try {

				if ($type == 'CSS') {
					if (!empty($files)) {
						$src 		= 'extensions/'.lcfirst(get_class($this)) . '/assets/less';
						$dest 		= 'assets/' . strtolower(get_class($this)) . '/css';
		
						self::createDirectory($dest);
		
						$arrayReturn = [];
						/**
						 * For each LESS file we check & compile 
						 * to get the CSSS file. Then we copy to 
						 * asset directory and minify to compress 
						 * the size
						 */
						foreach ($files as $file) {
							if (self::validateFile($file) && file_exists($src . '/'. $file)) {
								
								$original = $dest .'/'. basename($file, '.less') . '.css';
								$filename = $dest .'/'. basename($file, '.less');

								// Minify the file if is not set or if it's true
								if (!isset($this->options['minify']) || $this->options['minify']) {
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
								if (!empty($this->options['styles'])) {
									$originalFile = $src . '/'. $file;
									$backupFile = $src . '/'. basename($file, '.less').'.bk.less';
									
									// Create a copy of the original file to keep it save
									shell_exec("cp -r $originalFile $backupFile");

									// Modify the variables
									self::modifyVars($this->options['styles'], $backupFile);
									
									// Compile the file
									$less->checkedCompile($backupFile, $filename);

									// Remove the backup file
									unlink($backupFile);
								} else {
									// Compile the less but first verify if the css exist
									$less->checkedCompile($src . '/'. $file, $filename);
								}
							
								array_push($arrayReturn, $filename);
							}
						}	
						return $arrayReturn;
					}
				} elseif ($type == 'JS') {
					if (!empty($files)) {
						$src 		= 'extensions/'.lcfirst(get_class($this)) . '/assets/js';
						$dest 		= 'assets/' . strtolower(get_class($this)) . '/js';
		
						self::createDirectory($dest);
		
						$arrayReturn = [];
						
						/**
						 * For each JS file we copy to asset directory
						 * and minify to compress the size
						 */
						foreach ($files as $file) {
							$src .= '/'.$file;
							$dest .= '/'.$file;
							shell_exec("cp -r $src $dest");

							$src = str_replace('/'.$file, '', $src);
							$dest = str_replace('/'.$file, '', $dest);

							// Minify the file if is not set or if it's true
							if (!isset($this->options['minify']) || $this->options['minify']) {
								$original = $dest .'/'. basename($file, '.js') . '.js';
								$filename = $dest .'/'. basename($file, '.js') . '.min.js';
								
								(new Minify\JS($original))->minify($filename);
								// Delete the original file
								try {
									unlink($original);
								} catch (exception $e) {
									echo "Error message: " . $e->getMessage();
								}
							} else {
								$filename = $dest .'/'. basename($file, '.js') . '.js';
							}
							array_push($arrayReturn, $filename);
						}
						/**
						 * Create JavaScript file with the code that
						 * you want.
						 */
						if (isset($this->options['script']) && !empty($this->options['script'])) {
							$original = self::createScriptJs($this->options['script']);
							// Minify the file if is not set or if it's true
							if (!isset($this->options['minify']) || $this->options['minify']) {
								$filename = str_replace('.js', 'min.js', $filename);
								basename($file, '.js')
								(new Minify\JS($original))->minify($filename);
							} else {
								$filename = $original;
							}
							array_push($arrayReturn, $filename);
						}
						return $arrayReturn;
					}
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
			if (strpos($file, 'less') || strpos($file, 'css') || strpos($file, 'js')) {
				return true;
			}
			return false;
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
		 * @return		string		String of how it starts
		 * @return		string		Return the directory concat with the filename
		 */
		public function createScriptJs ($script) {
			//$script 	= "$(document).ready(function(){alert('hai');});";
			$filename 	= 'script.' . strtolower(get_class($this)) . '.' . mt_rand() . '.js';
			$dest 		= 'assets/' . strtolower(get_class($this)) . '/js';
			file_put_contents($dest . '/' . $filename, $script);

			return ($dest . '/' . $filename);
		}
	}
?>