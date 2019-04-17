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
		public function renderViewHtml ($array) {
			return $this->renderPhpFile(lcfirst(get_class($this)) .'/views/view' . get_class($this) . '.php', $array);
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
						foreach ($files as $file) {
							if (self::validateFile($file) && file_exists($src . '/'. $file)) {
								// Compile the less but first verify if the css exist
								$less->checkedCompile($src . '/'. $file, $dest .'/'. basename($file, '.less') . '.css');

								if (!isset($this->options['minify']) || $this->options['minify']) {
									$filename = $dest .'/'. basename($file, '.less') . '.min.css';
									// Minify
									$minify = (new Minify\CSS($dest .'/'. basename($file, '.less') . '.css'))->minify($filename);
								} else {
									$filename = $dest .'/'. basename($file, '.less') . '.css';
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
						
						foreach ($files as $file) {
							$src .= '/'.$file;
							$dest .= '/'.$file;
							shell_exec("cp -r $src $dest");

							array_push($arrayReturn, $dest);

							$src = str_replace('/'.$file, '', $src);
							$dest = str_replace('/'.$file, '', $dest);
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
	}
?>