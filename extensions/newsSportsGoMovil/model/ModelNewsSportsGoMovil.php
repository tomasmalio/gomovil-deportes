<?php
	/**
	 * Model News Sports GoMovil
	 */
	class ModelNewsSportsGoMovil{
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
		// Modify naming of JSON
		public $renameVerify = [
			'wrong' 	=> ['nota_id', 'titulo', 'nota', 'fechaPublicacion', 'imagen', 'nota_html'],
			'verify'	=> ['id', 'title', 'summary', 'created_at', 'image',' text'],
		];

		public function model ($params = []) {
			self::setCountryCode($params['country_code']);
			self::setType($params['type']);
			self::setArticle($params['article']);
			//$array['content'] = json_decode(self::getNews(), true);
			//return $array;
			return json_decode(self::getNews(), true);
		}

		public function setCountryCode ($country_code) {
			if (!empty($country_code)) {
				$this->country_code = $country_code;
			}
		}

		public function setType ($type) {
			if (!empty($type)) {
				$this->type = $type;
			}
		}

		public function setArticle ($article) {
			if (!empty($article)) {
				$this->article = $article;
			}
		}

		private function getNews() {
			$json = $this->url[$this->type];
			switch ($this->type) {
				case 'list':
				case 'featured':
				default:					
					
					if (!empty($country_code)) {
						$json .= '&country_id=' . $this->country_id;
					}
					break;
				case 'view':
					$json .= $this->article . '.json';
					break;
			}
			return file_get_contents($json);
		}
	}
?>