<?php
	/**
	 * Matches Next
	 */
	class MatchesNext extends Widgets {
		public $title = 'Próximos partidos';
		public $date;
		public $titleCalendar = 'Ver calendario';
		public $linkCalendar = '#';
		public $content;

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
					'title'				=> $this->title,
					'date'				=> $this->date,
					'content'			=> $this->content,
					'titleCalendar'		=> $this->titleCalendar,
					'linkCalendar'		=> $this->linkCalendar,
				]
			);
		}
	}
?>