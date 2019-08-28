<?php
	/**
	 * Matches Featured
	 */
	class MatchesFeatured extends Widgets {
		// Matches featured
		public $content;
		// Label of the match featured
		public $label = 'Partido destacado';
		// Title vote
		public $titleVote = '¿Qué equipo va a ganar?';

		// Assets files
		public $files = [
			'style'	=> ['matches-featured.less'],
			'js'	=> [],
		];

		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> false, 
					'pagination'	=> false,
					'navigation'	=> false,
				],
				'mobile' 	=> [
					'display' 		=> true, 
					'pagination'	=> false,
					'navigation'	=> true,
				]
			],
			'items' => [
				'desktop' 	=> 2,
				'mobile' 	=> 2,
			]
		];

		public $renameVerify = [
			'wrong' 	=> ['local', 'local_img', 'gol_local', 'penal_local', 'visitante', 'visitante_img', 'gol_visitante', 'estado', 'hora_inicio'],
			'verify'	=> ['team_local', 'team_image_local', 'gol_local', 'penal_local', 'team_visit', 'team_image_visit', 'gol_visit', 'penal_visit', 'status', 'datetime'],
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
					'content' 		=> $this->content,
					'label'			=> $this->label,
					'titleVote'		=> $this->titleVote,
					'items'			=> parent::items(),
					'slider'		=> parent::slider(),
					'pagination'	=> parent::sliderPagination(),
					'navigation'	=> parent::sliderNavigation(),
				],
				$this->viewName
			);
		}
	}
?>