
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
			$json = @file_get_contents($this->url. 'api_key=' .$this->key. '&q=' . rawurlencode($params['search']) . '&limit='. $this->limit .'&offset=0&rating=G&lang='.$this->lang);
			if (strpos($http_response_header[0], "200")) { 
				return (json_decode($json, true))['data'];
			} else { 
				return null;
			}
			
		}
	}
?>