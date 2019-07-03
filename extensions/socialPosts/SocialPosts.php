<?php
	/**
	 * Social Posts
	 */
	class SocialPosts extends Widgets {
		// Social posts
		public $content;

		// Assets files
		public $files = [
			'style'	=> ['social-card.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
			'minify' => false,
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content'		=> $this->content,
				],
				$this->viewName
			);
		}
	}
?>