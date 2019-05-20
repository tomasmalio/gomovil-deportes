<?php
	/**
	 * Scores List
	 */
	class ScoresList extends Widgets {
		public $title = 'Goleadores';
		//
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['scores-list.less'],
			'js'		=> [],
		];
		// Options
		public $options = [];

		public function __construct($params = []) {
			parent::__construct($params);
			$this->content = Widgets::multiRenameKey($this->content, 
				[
					'nombre',
					'nombre_completo',
					'goles',
					'escudo',
					'puesto',
				], 
				[
					'player_name',
					'player_complete_name',
					'goals',
					'team_shield',
					'position',
				]
			);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'title'				=> $this->title,
					'content'			=> $this->content,
				]
			);
		}
	}
?>