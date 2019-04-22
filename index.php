<?php
	require_once __DIR__.'/bootstrap.php';

	/* Widget */
	$widget = new Widgets();
	
	/* Declare of extensions directory */
	$GLOBALS['extensions_url'] = '/extensions';

	use GoMovil\Assets;

	$assets = ['css' => [], 'js' => []];

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
	array_push($assets['css'], (new NewsFeatured())->assets()['css']);
	array_push($assets['js'], (new NewsFeatured())->assets()['js']);
	$displayNewsFeatured = true;

	/****************************************
	 * LIST NEWS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/newsList/NewsList.php';
	$widgetNewsList 	= (new NewsList())->renderView();
	array_push($assets['css'], (new NewsList())->assets()['css']);
	array_push($assets['js'], (new NewsList())->assets()['js']);
	$displayNewsList = true;

	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$widgetMatchesNext 	= (new MatchesNext())->renderView();
	array_push($assets['css'], (new MatchesNext())->assets()['css']);
	array_push($assets['js'], (new MatchesNext())->assets()['js']);
	$displayMatchesNext = true;

	/****************************************
	 * LIST VIDEOS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/videosList/VideosList.php';
	$widgetVideosList 	= (new VideosList())->renderView();
	array_push($assets['css'], (new VideosList())->assets()['css']);
	array_push($assets['js'], (new VideosList())->assets()['js']);
	$displayVideosList = true;

	/****************************************
	 * SOCIAL POSTS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/socialPosts/SocialPosts.php';
	$widgetSocialPosts 	= (new SocialPosts())->renderView();
	array_push($assets['css'], (new SocialPosts())->assets()['css']);
	array_push($assets['js'], (new SocialPosts())->assets()['js']);
	$displaySocialPosts = true;

	/****************************************
	 * SOCIAL GIFS
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/socialGifs/socialGifs.php';
	$widgetSocialGifs 	= (new SocialGifs())->renderView();
	array_push($assets['css'], (new SocialGifs())->assets()['css']);
	array_push($assets['js'], (new SocialGifs())->assets()['js']);
	$displaySocialGifs = true;

	/**
	 * Render view
	 */
	$template = $twig->load('generateIndex.html');

	echo $template->render([
		'assetsStyle'				=> (new Assets())->generateAssets($assets['css']),
		'assetsJs'					=> (new Assets())->generateAssets($assets['js']),
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
		'widgetSocialPosts'			=> [
											'content'		 		=> $widgetSocialPosts,
											'display'				=> $displaySocialPosts,
		],
		'widgetSocialGifs'			=> [
											'content'		 		=> $widgetSocialGifs,
											'display'				=> $displaySocialGifs,
],
	]);