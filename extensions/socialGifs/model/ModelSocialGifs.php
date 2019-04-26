
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
		public $search = 'futbol';
		// Limit of gifs
		public $limit = 10;
		// Language
		public $lang = 'es';
		
		public function model () {
			$content = $this->url. 'api_key=' .$this->key. '&q=' . $this->search . '&limit='. $this->limit .'&offset=0&rating=G&lang='.$this->lang;
			$json = file_get_contents($content);
			return json_decode($json);
		}
	}
?>