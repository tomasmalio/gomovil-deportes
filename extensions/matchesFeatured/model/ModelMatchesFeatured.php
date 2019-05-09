<?php
	/**
	 * Model Matches Featured
	 */
	class ModelMatchesFeatured {
		
		public $urlFootball = 'http://biteldev.gomovil.co/api/partidos-destacados.json';
		public $urlTennis= 'http://biteldev.gomovil.co/api/partidos-destacados.json';
		public $urlNba = 'http://biteldev.gomovil.co/api/partidos-destacados.json';

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
			return json_decode($json, true);
		}
	}
?>