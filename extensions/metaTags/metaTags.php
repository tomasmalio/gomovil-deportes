<?php
	/**
	 * MetaTags
	 */
	class MetaTags extends Widgets {
		//public $title;
		public $general = [
			'title' 			=> '',
			'description' 		=> '',
			'keywords' 			=> '',
			'image'				=> '',
			'url'				=> '',
		];
		
		public $facebook = [
			'title' 			=> '',
			'description' 		=> '',
			'image'				=> '',
			'url'				=> '',
			'app_id'			=> '',
			'type'				=> '',
			'site'				=> '',
			'siteLink'			=> 'https://www.facebook.com/',
		];

		public $twitter = [
			'title' 			=> '',
			'description' 		=> '',
			'image'				=> '',
			'url'				=> '',
			'site'				=> '',
			'siteLink'			=> 'https://www.twitter.com/',
			'creator'			=> '',
			'card'				=> '',
		];

		public function renderView () {
			return Widgets::renderViewHtml(get_class($this), [
					'general' 	=> $this->general,
					'twitter' 	=> $this->twitter,
					'facebook' 	=> $this->facebook,
				]
			);
		}
	}
?>