<?php 
	//
	$opts = getopt('t:');
	print_r($opts);
	$file = file_get_contents('index.php');
	if (isset($opts['t']) && $opts['t'] != '') {
		// echo $typePlatform;
		$file = str_replace('{@TYPE_PRODUCTION}', $opts['t'], $file);
		// print_r($file);
		file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', 'development', $file);
		// print_r($file);
		file_put_contents($file);
	}