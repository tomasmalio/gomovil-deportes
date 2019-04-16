<?php
	/**
	 * Social Posts
	 */
	class SocialPosts extends Widgets {
		
		public $lessFileName = 'social-card';
		
		public $options = array();

		public function assets () {
			return Widgets::compileAssets($this->lessFileName);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					
				]
			);
		}
	}
?>