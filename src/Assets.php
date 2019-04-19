<?php
	namespace Sports;

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
				foreach ($asset as $file) {
					if (strpos($file, 'css')) {
						$var = '<link rel="stylesheet" href="/' . $file . '">';
					} elseif (strpos($file, 'js')) {
						$var = '<script src="' . $file . '"></script>';
					}
					array_push($array, $var);
				}
			}
			return $array;
		}
	}

?>