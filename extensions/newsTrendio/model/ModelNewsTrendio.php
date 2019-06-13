<?php
	/**
	 * Model NewsTrendio
	 */
	class ModelNewsTrendio {
		
		private $url = 'http://news.plugty.com/api/';
		
		private $key = '123';
		
		public $country_id;
		
		public $country_code;
		
		public $trending = false;

		public $category;
		
		public $type = 'feedcards';

		public $return_news = '1';

		public $return_trends = '0';

		public $limit = '10';
		
		// http://news.plugty.com/api/menu?key=123&country_id=15&show_news=1&show_trends=
		// http://news.plugty.com/api/featurednews?key=123&category_id=4&limit=10
		// http://news.plugty.com/api/feedcards?key=123&category_id=4&return_news=1&return_trends=&trending=&limit=10&Page=
		
		public function model ($params = []) {
			self::setCountryCode($params['country_code']);
			self::setTrending($params['trending']);
			self::setCategory($params['category']);
			self::setType($params['type'], $params['trending']);
			self::setLimit($params['limit']);
			return json_decode(self::getNews(), true);
		}

		public function setCountryCode ($country_code) {
			if (!empty($country_code)) {
				$this->country_code = $country_code;
			}
		}

		public function setTrending ($trending) {
			if (!empty($trending)) {
				$this->trending = $trending;
			}
		}

		public function setCategory ($category) {
			if (!empty($category)) {
				$json = file_get_contents($this->url .'menu?key=' . $this->key . '&country_id=' . $this->country_code . '&show_news=1&show_trends=0');
				$data = json_decode($json);

				foreach ($data->data->menu->categories as $cat) {
					if (strtolower(Widgets::normalizeString($category)) == strtolower(Widgets::normalizeString($cat->name))) {
						$this->category = $cat->id;
						break;
					}
				}
			}
		}

		public function setType ($type, $trending) {
			if (empty($type)) {
				if ($trending && isset($this->category)) {
					$this->type = 'feedcards';
				}else if ($trending && !isset($this->category)) {
					$this->type = 'featurednews';
				} else {
					$this->type = 'feedcards';
				}
			} else {
				$this->type = $type;
			}
		}

		public function setLimit ($limit) {
			if (!empty($limit)) {
				$this->limit = $limit;
			}
		}

		public function getNews () {
			return $this->processNews();
		}

		private function processNews() {
			$json = $this->url . $this->type .'?key=' . $this->key . '&country_id=' . $this->country_code . '&return_news='.$this->return_news.'&return_trends='.$this->return_trends.'&limit='.$this->limit;
			if (($this->type == 'feedcards' && $this->trending && isset($this->category)) || ($this->type == 'feedcards' && !$this->trending)) {
				$json .= '&category_id='. $this->category;
			}
			return file_get_contents($json);
		}
	}
?>