<?php
	/**
	 * Social Gifs
	 */
	class SocialGifs extends Widgets {
		// Gifs
		public $content;

		// Assets files
		public $files = [
			'style'	=> ['social-gif.less'],
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
					'content' 		=> $this->content,
				],
				$this->viewName
			);
		}
	}
?>