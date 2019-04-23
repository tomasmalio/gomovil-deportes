<?php
	/**
	 * Social Posts
	 */
	class SocialPosts extends Widgets {
		// Assets files
		public $files = [
			'style'	=> ['social-card.less'],
			'js'		=> [],
		];
		// Options
		public $options = [
			'minify' => false,
			'script' => [
				'name'		=> 'masonry.social-posts',
				'content' 	=> "$('.grid-social').masonry({
									itemSelector: '.grid-item-social',
									gutter: 0
								});
								$(function(){
									$(document).on('click', 'div[data-video=\"true\"]', function () {
										var w = $(this).find('.video-image').find('img').last()[0].width;
										var h = $(this).find('.video-image').find('img').last()[0].height;
										var v = $(this).attr('data-source');  
										var videoTag;
										if (v.includes('youtube')) {
											videoTag = '<iframe width=\"' + w + '\" height=\"' + h + '\" src=\"' + v + '\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>';
										} else {
											videoTag = '<video width=\"'+w+'\" height=\"'+h+'\" controls autoplay><source src=\"'+v+'\"</video>';
										}
										$(this).find('.card-video').prepend(videoTag);
										$(this).find('.video-image').remove();
									});
								});"
			]
		];

		public function renderView () {
			return Widgets::renderViewHtml([
					
				]
			);
		}
	}
?>