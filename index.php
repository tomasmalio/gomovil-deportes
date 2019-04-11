<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	require_once __DIR__.'/extensions/Widgets.php';
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	$GLOBALS['extensions_url'] = '/extensions';

	/****************************************
	 * META TAGS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/metaTags/MetaTags.php';
	$widgetMetaTags = (new MetaTags())->renderView();
	$displayMetaTags = true;

	/****************************************
	 * FEATURED NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsFeatured/NewsFeatured.php';
	$widgetNewsFeatured = (new NewsFeatured())->renderView();
	$displayNewsFeatured = true;

	/****************************************
	 * LIST NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsList/NewsList.php';
	$widgetNewsList 	= (new NewsList())->renderView();
	$displayNewsList = true;

	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$widgetMatchesNext 	= (new MatchesNext())->renderView();
	$displayMatchesNext = true;

	/****************************************
	 * LIST VIDEOS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/videosList/VideosList.php';
	$widgetVideosList 	= (new VideosList())->renderView();
	$displayVideosList = true;

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');

	echo $template->render([
		'widgetMetaTags'			=> [
											'content' 				=> $widgetMetaTags,
											'display'				=> $displayMetaTags,
		],
		'widgetNewsFeatured' 		=> [
											'content'			 	=> $widgetNewsFeatured,
											'display'				=> $displayNewsFeatured,
		],
		'widgetNewsList'			=> [
											'content'		 		=> $widgetNewsList,
											'display'				=> $displayNewsList,
		],
		'widgetMatchesNext'			=> [
											'content'		 		=> $widgetMatchesNext,
											'display'				=> $displayMatchesNext,
		],
		'widgetVideosList'			=> [
											'content'		 		=> $widgetVideosList,
											'display'				=> $displayVideosList,
		],
	]);