<?php
	namespace Sports;

	class Assets {

		/**
		 * Generate Assets
		 * 
		 * @filename String
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