<?php
	/**
	 * Model NewsTrendio
	 */
	class ModelNewsTrendio {
		// Url trendio
		private $url = 'http://news.plugty.com/api/';
		// key
		private $key = '123';
		// Country id
		private $country_id;
		// Country code
		private $country_code;
		// Article difinition
		private $article = null;
		// Trending news
		public $trending = false;
		// Category
		public $category;
		// Format type
		public $type = 'feedcards';
		// News content
		public $return_news = '1';
		// News trends
		public $return_trends = '0';
		// Limit
		public $limit = '10';
		
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

		private function setCountryCode ($country_code) {
			if (!empty($country_code)) {
				$this->country_code = $country_code;
			}
		}

		private function setArticle ($article) {
			if (!empty($article)) {
				$this->article = $article;
			}
		}

		private function setTrending ($trending) {
			if (!empty($trending)) {
				$this->trending = $trending;
			}
		}

		private function setCategory ($category) {
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

		private function getNews () {
			return $this->processNews();
		}

		private function processNews() {
			$json = $this->url . $this->type .'?key=' . $this->key;
			if (isset($this->article)) {
				$json .= '&news_id=' . $this->article . '&resetCache=1';
				return file_get_contents($json);
			} else {
				$json .= '&country_id=' . $this->country_code . '&return_news='.$this->return_news.'&return_trends='.$this->return_trends.'&limit='.$this->limit;
				if (($this->type == 'feedcards' && $this->trending && isset($this->category)) || ($this->type == 'feedcards' && !$this->trending)) {
					$json .= '&category_id='. $this->category;
				}
			}
			$json .= '&resetCache=1';
			return file_get_contents($json);
		}
	}
?>