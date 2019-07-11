<?php
	/**
	 * Social Post Football
	 */
	class SocialPostFootball extends Widgets {
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['social-post-football.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'content'			=> $this->content,
				],
				$this->viewName
			);
		}
	}
?>