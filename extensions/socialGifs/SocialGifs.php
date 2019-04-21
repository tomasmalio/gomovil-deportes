<?php
	/**
	 * Social Gifs
	 */
	class SocialGifs extends Widgets {
		// Assets files
		public $files = [
			'style'	=> ['social-gif.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
			'minify' => false,
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					
				]
			);
		}
	}
?>