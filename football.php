<?php
	require_once __DIR__.'/bootstrap.php';


	/****************************************
	 * NEXT MATCHES
	 ****************************************/
	require_once __DIR__.'/'.$GLOBALS['extensions_url'].'/matchesNext/MatchesNext.php';
	$nextMatches	= new MatchesNext('MatchesNextNba', ['from' => ['date' => date('Y-m-d'), 'time' => '00:00:00']]);
	$widgetMatchesNext 	= $nextMatches->renderView();
	$assetMatchesNext = $nextMatches->assets();
	array_push($assets['css'], $assetMatchesNext['css']);
	array_push($assets['js'], $assetMatchesNext['js']);
	$displayMatchesNext = true;
	
	/**
	 * Render view
	 */
	$template = $twig->load('generateFootball.html');

	echo $template->render([
	]);