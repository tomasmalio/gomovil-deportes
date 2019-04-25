<?php
	/**
	 * NewsList
	 */
	class NewsList extends Widgets {
		public $news = [
			[
				'title' => 'Competidor sorpresa para CR7', 
				'description' => 'La llegada de Cristiano Ronaldo a la Juventus de Turín ha causado una auténtica revolución en la Serie A, que llevaba bastantes temporadas sin tener a un crack tan diferencial como él.', 
				'date' => '2019-04-23', 
				'image' => 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/Duvan-Zapata-Atalanta-Getty_1000x500.jpg',
				'url' => '#'
			],
			[
				'title' => 'Russo busca una vuelta de tuerca', 
				'description' => 'El presente de Alianza Lima tiene consternada a una parte importante del público: no atraviesa su mejor estado de forma ni en la Liga 1 ni en la Copa Libertadores de América. ¿Cómo revertir esta realidad?', 
				'date' => '2019-04-22', 
				'image' => 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/miguel-angel-russo-alianza-lima-getty_1000x500.jpg',
				'url' => '#'
			],
			[
				'title' => 'Champions: pronósticos de las semifinales', 
				'description' => 'La Liga de Campeones de la UEFA ha entrado en su etapa más divertida.', 
				'date' => '2019-04-21', 
				'image' => 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/Ajax-Amsterdam-Festejo-Gol-Juventus-Champions-Abril-2019_1000x500.jpg',
				'url' => '#'
			],
			[
				'title' => 'Juventus arde', 
				'description' => 'La Juventus de Turín aún se encuentra conmovida por la eliminación sufrida en la Liga de Campeones de la UEFA, a manos del Ajax de Ámsterdam', 
				'date' => '2019-04-21', 
				'image' => 'https://s3.us-east-2.amazonaws.com/bitel/deportes/nota/Juventus-Cristiano-Ronaldo-Ajax-Lamento-Derrota-Champions-AFP_1000x500.jpg',
				'url' => '#'
			],
		];

		// Assets files
		public $files = [
			'style'	=> ['news-list.less','swiper.css'],
			'js'	=> ['swiper.js'],
		];

		// Options
		public $options = [
			'slider' => [
				'desktop' 	=> true,
				'mobile' 	=> true,
			],
			'minify' => false,
			'script' => [
				'name'		=> 'swiper.news-list',
				'content' 	=> "var swiper = new Swiper('.swiper-container', {
					slidesPerView: 'auto',
					loop: true,
					spaceBetween: 30,
					mousewheel: true,
					pagination: {
					  clickable: false,
					},
				});"
			]
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					'newsList' 	=> $this->news,
					'slider'	=> parent::slider(),
					'items'		=> parent::items(),
				]
			);
		}
	}
?>