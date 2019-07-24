<?php
	/**
	 * VideosList
	 */
	class VideosFootballGoMovil extends Widgets {
		// Video content
		public $content;

		// Assets files
		public $files = [
			'style'		=> ['skin.bitel.jplayer.less', 'videos-football-gomovil.less'],
			'js'		=> ['jquery.jplayer.js', 'jplayer.playlist.js'],
		];

		// Options
		public $options = [
			'items' => [
				'desktop'	=> 4,
				'mobile'	=> 4,
			],
			'slider' => [
				'desktop' 	=> [
					'display' 		=> false,
				],
				'mobile' 	=> [
					'display' 		=> true,
				],
			],
			'controls' => [
				// Autoplay
				'autoPlay' 			=> false,
				// Display controls
				'displayControls' 	=> true,
				// Muted
				'muted' 			=> true,
				// Loop
				'loop'				=> false,
			],
			'scripts' => [
				0 => ['name' => '',
					  'content' => "$(function() {
						$(document).on('click', 'div[data-video=\"true\"]', function() {
							var w = $(this).find('.video-image').find('img').last()[0].width;
							var h = $(this).find('.video-image').find('img').last()[0].height;
							var v = $(this).attr('data-source');
							var videoTag;
							if (v.includes('youtube')) {
								videoTag = '<iframe width=\"' + w + '\" height=\"' + h + '\" src=\"' + v + '\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>';
							} else {
								videoTag = '<video width=\"' + w + '\" height=\"' + h + '\" controls autoplay><source src=\"' + v + '\"></video>';
							}
							$(this).find('.video-container').prepend(videoTag);
							$(this).find('.video-image').remove();
						});
					});"
				]
			]
		];

		public function __construct($params = []) {
			parent::__construct($params);
		}

		public function renderView () {
			return parent::renderViewHtml([
					'content'			=> $this->content,
					'options'			=> $this->options,
					'slider'			=> parent::slider(),
					'items'				=> parent::items(),
				],
				$this->viewName
			);
		}
	}
?>