<?php
	/**
	 * Model Next Matches
	 */
	class ModelSocialPostFootball {
		
		private $url 	= 'http://test.futmovil.com/apiTest.php?request=getMatchTimeline&matchId=';

		private $urlConnect = 'http://test.futmovil.com/apiTest.php?request=getMatchUniverso&universoId=';

		private $match_id;
		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				
			],
			'verify'	=> [
				
			],
		];
		
		public function model ($params = []) {
			self::setDate($params['match']);
			if (isset($this->match_id)) {
				$json = self::getContent();
				if ($json) {
					return $json;
				}
			}
			return null;
		}

		public function setDate ($match) {
			if (!empty($match)) {
				$this->match_id = $match;
			}
		}


		private function getConnection() {
			$json = @file_get_contents($this->urlConnect . $this->match_id);
			if (strpos($http_response_header[0], "200")) {
				return (json_decode($json, true))['data']['match_id'];
			}
			return null;
		}

		private function getContent() {
			$json = @file_get_contents($this->url . self::getConnection($this->match_id));
			if (strpos($http_response_header[0], "200")) {
				return json_decode($json, true);
			}
			return null;
		}
	}
?>