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
							if (!(substr($file, 0, 4) === 'http' || substr($file, 0, 2) === '//')) {
								$file = '/' . $file;
							}
							$var = '<link rel="stylesheet" href="' . $file . '">';
						} elseif (strpos($file, 'js')) {
							if (!(substr($file, 0, 4) === 'http' || substr($file, 0, 2) === '//')) {
								$file = '/' . $file;
							}
							$var = '<script src="/' . $file . '"></script>';
						}
						array_push($array, $var);
					}
				}
			}
			return $array;
			
		}
	}

?>