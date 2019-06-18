<?php
	/**
	 * Model NewsTrendio
	 */
	class ModelNewsTrendio {
		
		private $url = 'http://news.plugty.com/api/';
		
		private $key = '123';
		
		public $country_id;
		
		public $country_code;

		private $article = null;
		
		public $trending = false;

		public $category;
		
		public $type = 'feedcards';

		public $return_news = '1';

		public $return_trends = '0';

		public $limit = '10';

		//http://news.plugty.com/api/singlenews?key=123&news_id=1522650
		
		public function model ($params = []) {
			self::setCountryCode($params['country_code']);
			self::setArticle($params['article']);
			self::setTrending($params['trending']);
			self::setCategory($params['category']);
			self::setType($params['type'], $params['trending']);
			self::setTrends($params['trends']);
			self::setNews($params['news']);
			self::setLimit($params['limit']);
			$array = json_decode(self::getNews(), true);
			$type = ['news' => $this->return_news, 'trends' => $this->return_trends];
			$array = array_merge($array, $type);
			return $array;
		}

		public function setCountryCode ($country_code) {
			if (!empty($country_code)) {
				$this->country_code = $country_code;
			}
		}

		public function setArticle ($article) {
			if (!empty($article)) {
				$this->article = $article;
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

		private function setType ($type, $trending) {
			if (isset($this->article)) {
				$this->type = 'singlenews';
			} else if (empty($type)) {
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

		private function setTrends ($trends) {
			if (isset($trends)) {
				$this->return_trends = '1';
			}
		}

		private function setNews ($news) {
			if (isset($news) && $news == false) {
				$this->return_news = '0';
			}
		}

		private function setLimit ($limit) {
			if (!empty($limit)) {
				$this->limit = $limit;
			}
		}

		public function getNews () {
			return $this->processNews();
		}

		private function processNews() {
			$json = $this->url . $this->type .'?key=' . $this->key;
			if (isset($this->article)) {
				$json .= '&news_id=' . $this->article;
				return file_get_contents($json);
			} else {
				$json .= '&country_id=' . $this->country_code . '&return_news='.$this->return_news.'&return_trends='.$this->return_trends.'&limit='.$this->limit;
				if (($this->type == 'feedcards' && $this->trending && isset($this->category)) || ($this->type == 'feedcards' && !$this->trending)) {
					$json .= '&category_id='. $this->category;
				}
			}
			return file_get_contents($json);
		}
	}
?>