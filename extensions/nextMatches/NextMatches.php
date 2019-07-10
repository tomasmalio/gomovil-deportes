<?php
	/**
	 * Next Matches
	 */
	class NextMatches extends Widgets {
		public $content = [
			'title' => 'Próximos partidos',
			'titleCalendar' => 'Ver calendario',
		];

		// Assets files
		public $files = [
			'style'		=> ['next-matches.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function __construct($params = []) {
			parent::__construct($params);			
			$this->date = date('Y-m-d');
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'date'				=> $this->date,
					'content'			=> $this->content,
				],
				$this->viewName
			);
		}
	}
?>