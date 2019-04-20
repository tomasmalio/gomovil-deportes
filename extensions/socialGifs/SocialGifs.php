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

		public function assets (){
			return parent::getAssets($this->files['style'], $this->files['js']);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					
				]
			);
		}
	}
?>