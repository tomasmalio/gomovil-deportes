<?php 
	//
	$opts = getopt('type:');
	$file = file_get_contents('index.php');
	if (isset($opts['type']) && $opts['type'] != '') {
		// echo $typePlatform;
		$file = str_replace('{@TYPE_PRODUCTION}', $opts['type'], $file);
		// print_r($file);
		file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', 'development', $file);
		// print_r($file);
		file_put_contents($file);
	}