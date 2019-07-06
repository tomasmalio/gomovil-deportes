
<?php
	/**
	 * Model Social Gifs
	 */
	class ModelSocialGifs {
		// Url
		public $url = 'https://api.giphy.com/v1/gifs/search?';
		// Key
		public $key = '3TjC2jUDvbzMlYWqeS6LI2RcdIFQo7XE';
		// Keyword search
		public $search;
		// Limit of gifs
		public $limit = 10;
		// Language
		public $lang = 'es';
		
		public function model ($params = []) {
			$content = $this->url. 'api_key=' .$this->key. '&q=' . rawurlencode($params['search']) . '&limit='. $this->limit .'&offset=0&rating=G&lang='.$this->lang;
			return (json_decode(file_get_contents($content), true))['data'];
		}
	}
?>