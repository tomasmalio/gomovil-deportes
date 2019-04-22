<?php
	namespace GoMovil;

	class Assets {

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
	}

?>