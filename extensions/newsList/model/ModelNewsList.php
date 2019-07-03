<?php
	/**
	 * Model News Lists
	 */
	class ModelNewsList {
		// Url
		public $url = [
						'list' => 'http://biteldev.gomovil.co/api/nota-del-dia.json',
						'view' => 'http://biteldev.gomovil.co/api/nota/',
						'featured' => 'http://biteldev.gomovil.co/api/noticia-destacada.json'
					];
		// Country code
		private $country_code;
		// Type
		private $type = 'list';
		// Article
		private $article;

		public function model ($params = []) {
			self::setCountryCode($params['country_code']);
			self::setType($params['type']);
			self::setArticle($params['article']);
			return json_decode(self::getNews(), true);
		}

		public function setCountryCode ($country_code) {
			if (!empty($country_code)) {
				$this->country_code = $country_code;
			}
		}

		private function getNews() {
			echo "ACA";
			exit;
			switch ($this->type) {
				case 'list':
				case 'featured':
				default:
					$json = $this->url . '&country_id=' . $this->country_id;
					break;
				case 'view':
					$json = $this->url . $this->article . '.json';
					break;
			}
			return file_get_contents($json);
		}

	}
?>