<?php
	/**
	 * Model News API
	 * @source https://newsapi.org/
	 * 
	 * @author: tomas@plugty.com
	 * @password: `%9\rd8@CJW+V5x"
	 */
	class ModelNewsApi {
		// URL JSON
		private $json = 'http://newsapi.org/v2/';
		// API Key
		private $key = '508ccd1edfab4f81b802f57879d68273';
		// Endpoints
		private $endpoint = 'everything';
		// Search
		private $search = '';
		// Category
		private $category = '';
		// Date from
		private $from = '';
		// Date to
		private $to = '';
		// Language
		private $language = '';
		// Results
		private $results = 20;

		// Mapping name JSON
		private $mappingName = [
			'wrong' 	=> [
				
			],
			'verify'	=> [
				
			],
		];

		
		public function model ($params = []) {
			self::setEndPoint($params['endpoint']);
			self::setSearch($params['search']);
			echo "estoy aca";
			print_r(self::getNews());
			exit;
		}

		private function getNews () {
			$url = $this->json . $this->endpoint . '?q='.$this->search;
			if ($this->setEndPoint == 'top-headlines') {
				if (isset($this->category) && ($this->category == 'business' || $this->category == 'entertainment' || $this->category == 'general' || $this->category == 'health' || $this->category == 'science' || $this->category == 'sports' || $this->category == 'technology')) {
					$url .= '&category='.$this->category;
				}
				if (isset($this->country)) {
					$url .= '&country='.strtolower($this->country);
				}
			}
			$url .= '&apiKey=' . $this->key . '&results='.$this->results;
			//$url = $this->json . $this->endpoint . '?q=' . $this->search . '&apiKey=' . $this->key . '&results='.$this->results;
			echo $url;
			$json = @file_get_contents($url);
			if (strpos($http_response_header[0], "200")) {
				echo 'aca';
				return json_decode($json, true);
			} else { 
				return null;
			}
		}

		public function setEndPoint ($endpoint) {
			if (!empty($endpoint) && ($endpoint == 'everything' || $endpoint == 'top-headlines' || $endpoint == 'sources')) {
				$this->endpoint = $endpoint;
			}
		}
		public function setSearch ($search) {
			if (!empty($search)) {
				$this->search = $search;
			}
		}
	}
?>