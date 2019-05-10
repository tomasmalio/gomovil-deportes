<?php
	/**
	 * Matches Featured
	 */
	class MatchesFeatured extends Widgets {
		// Matches featured
		public $matches;
		// Label of the match featured
		public $label = 'Partido destacado';
		// Title vote
		public $titleVote = '¿Qué equipo va a ganar?';

		// Assets files
		public $files = [
			'style'	=> ['matches-featured.less','swiper.css'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> true,
				'mobile' 	=> true,
			],
			'items' => [
				'desktop' 	=> 2,
				'mobile' 	=> 2,
			],
			'script' => [
				'name'		=> 'swiper.matches-featured',
				'content' 	=> "var swiperMatchesFeatured = new Swiper('.matches-featured', {
					slidesPerView: 'auto',
					loop: true,
					spaceBetween: 30,
					mousewheel: true,
					navigation: {
						nextEl: '.swiper-button-next',
						prevEl: '.swiper-button-prev',
					},
					pagination: {
						el: '.swiper-pagination',
						clickable: true,
					},
				});"
			]
		];

		public function __construct() {
			if ($content = Widgets::model('', ['type' => 'football'])) {

				$this->matches = Widgets::multiRenameKey($content, 
					[
						'local',
						'local_img',
						'gol_local',
						'penal_local',
						'visitante',
						'visitante_img',
						'gol_visitante',
						'estado',
						'hora_inicio',
					], 
					[
						'team_local',
						'team_image_local',
						'gol_local',
						'penal_local',
						'team_visit',
						'team_image_visit',
						'gol_visit',
						'penal_visit',
						'status',
						'datetime',
					]
				);
			}
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'matches' 	=> $this->matches,
					'label'		=> $this->label,
					'titleVote'	=> $this->titleVote,
					'slider'	=> parent::slider(),
					'items'		=> parent::items(),
				]
			);
		}
	}
?>