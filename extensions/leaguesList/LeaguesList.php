<?php
	/**
	 * Leagues List
	 */
	class LeaguesList extends Widgets {
		public $title = 'Ligas';
		//
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['leagues-list.less', 'swiper.css'],
			'js'		=> ['swiper.js'],
		];
		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> [
					'display' 		=> true,
				],
				'mobile' 	=> [
					'display' 		=> true,
				],
			],
			'minify' => false,
			'script' => [
				'name'		=> 'swiper.leagues-list',
				'content' 	=> "var swiperLeagueList = new Swiper('.leagues-list-content', {
					slidesPerView: 'auto',
					loop: true,
					spaceBetween: 0,
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

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return Widgets::renderViewHtml([
					'title'				=> $this->title,
					'content'			=> $this->content,
					'slider'			=> parent::slider(),
					'pagination'		=> parent::sliderPagination(),
					'navigation'		=> parent::sliderNavigation(),
				]
			);
		}
	}
?>