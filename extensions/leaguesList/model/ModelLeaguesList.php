<?php
	/**
	 * Model Leagues List
	 */
	class ModelLeaguesList {
		// Url 
		private $url = 'http://apiuf.gomovil.co/ligas/ligas.json';
		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'ligas',
				'copas',
				'selecciones',
				'nombre',
				'equipos',
				'escudo',
				'imagen'
			],
			'verify'	=> [
				'leagues',
				'cups',
				'selections',
				'name',
				'teams',
				'shield_team',
				'image'
			],
		];

		public function model ($params = []) {
			$json = json_decode(file_get_contents($this->url), true);
			$array['tournaments'] = Widgets::multiRenameKey($json, $this->mappingName['wrong'], $this->mappingName['verify']);
			print_r($array['tournaments']);
			echo "aca";
			print_r($params);
			return $params;
		}
	}
?>