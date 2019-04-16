<?php
	namespace Sports;

	class Assets {

		public function generateAssets ($asssetCss) {
			$array = array();
			foreach ($asssetCss as $css) {
				$var = '<link rel="stylesheet" type="text/css" href="/'.$css.'">';
				array_push($array, $var);
				
			}
			return $array;
		}
	}

?>