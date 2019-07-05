<?php
	/**
	 * Model Leagues List
	 */
	class ModelLeaguesList {

		private $url = 'http://apiuf.gomovil.co/ligas/ligas.json';

		public $renameVerify = [
			'wrong' 	=> ['ligas', 'copas', 'selecciones', 'nombre'],
			'verify'	=> ['leagues', 'cups', 'selections', 'name'],
		];

		public function model ($params = []) {
			$json = json_decode(file_get_contents($this->url), true);
			//print_r($json);
			$array['content']['tournaments'] = findandReplace($json);
			print_r($array['content']['tournaments']);
			exit;
			return $params;
		}

		// public function goThroughArray ($array) {
		// 	foreach ($array as $key => $value) {
		// 		$keyNew = array_search($key, $this->renameVerify['wrong']);
		// 		if (isset($keyNew)) {
		// 			$array[$this->renameVerify['verify'][$keyNew]] = $value;
		// 		}
		// 	}
		// }

		public function findandReplace(&$array) {
			foreach($array as $key => &$value) { 
				if(is_array($value)) { 
					findandReplace($value); 
				} else {
					$keyNew = array_search($key, $this->renameVerify['wrong']);
					if ($key) {
						$array[$this->renameVerify['verify'][$keyNew]] = $value;
						//break;
					}
				} 
			}
			return $array;
		}
	}
?>