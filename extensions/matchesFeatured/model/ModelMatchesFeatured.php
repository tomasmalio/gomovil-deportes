<?php
	/**
	 * Model Matches Featured
	 */
	class ModelMatchesFeatured {
		
		private $urlFootball = 'http://biteldev.gomovil.co/api/partidos-destacados.json';
		private $urlTennis= 'http://biteldev.gomovil.co/api/partidos-destacados.json';
		private $urlNba = 'http://biteldev.gomovil.co/api/partidos-destacados.json';

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				'id',
				'torneo',
				'tipo',
				'local',
				'local_img',
				'gol_local',
				'penal_local',
				'visitante',
				'visitante_img',
				'gol_visitante',
				'penal_visitante',
				'dia',
				'hora',
				'hora_inicio',
				'hora_fin',
				'estado',
				'minuto',
			],
			'verify'	=> [
				'id',
				'tournament',
				'type',
				'team_local',
				'team_image_local',
				'gol_local',
				'local_penalty',
				'team_visit',
				'team_image_visit',
				'gol_visit',
				'visit_penalty',
				'day',
				'hour',
				'datetime_start',
				'datetime_end',
				'status',
				'minute',
			],
		];

		public function model ($params = []) {
			switch ($params['type']) {
				case 'football':
					$json = file_get_contents($this->urlFootball);
					break;
				case 'tenis':
					$json = file_get_contents($this->urlTennis);
					break;
				case 'nba':
					$json = file_get_contents($this->urlNba);
					break;
			}
			return Widgets::multiRenameKey(json_decode($json, true), $this->mappingName['wrong'], $this->mappingName['verify']);
		}
	}
?>