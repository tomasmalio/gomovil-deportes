<?php
	/**
	 * MetaTags
	 */
	class MetaTags extends Widgets {
		//public $title;
		public $general = array(
			'title' 			=> '',
			'description' 		=> '',
			'keywords' 			=> '',
			'image'				=> '',
			'url'				=> '',
		);
		
		public $facebook = array(
			'title' 			=> '',
			'description' 		=> '',
			'image'				=> '',
			'url'				=> '',
			'app_id'			=> '',
			'type'				=> '',
			'site'				=> '',
			'siteLink'			=> 'https://www.facebook.com/',
		);

		public $twitter = array(
			'title' 			=> '',
			'description' 		=> '',
			'image'				=> '',
			'url'				=> '',
			'site'				=> '',
			'siteLink'			=> 'https://www.twitter.com/',
			'creator'			=> '',
			'card'				=> '',
		);

		public function renderView () {
			return Widgets::renderPhpFile(lcfirst(get_class($this)) .'/views/view' . get_class($this) . '.php', array(
					'general' 	=> $this->general,
					'twitter' 	=> $this->twitter,
					'facebook' 	=> $this->facebook,
				)
			);
		}
	}
?>