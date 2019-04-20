<?php
	/**
	 * Social Posts
	 */
	class SocialPosts extends Widgets {
		// Assets files
		public $files = [
			'style'	=> ['social-card.less'],
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