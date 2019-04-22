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
			'styles' => [
				'@card-text-social-links-color' => '@color-second',
			],
			'script' => [
				'name'		=> 'masonry.social-posts',
				'content' 	=> "$('.grid-social').masonry({
									itemSelector: '.grid-item-social',
									gutter: 0
								});"
			]
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					
				]
			);
		}
	}
?>