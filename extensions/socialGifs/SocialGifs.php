<?php
	/**
	 * Social Gifs
	 */
	class SocialGifs extends Widgets {
		
		public $gifs;

		// Assets files
		public $files = [
			'style'	=> ['social-gif.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
			'minify' => false,
		];

		public function __construct() {
			if ($content = Widgets::model()) {
				$this->gifs = $content;
			}
		}
		public function renderView () {
			return Widgets::renderViewHtml([
					'gifs' => $this->gifs,
				]
			);
		}
	}
?>