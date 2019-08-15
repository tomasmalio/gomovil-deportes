<?php 
	//
	echo 'aca '. $type_platform;
	$file = file_get_contents('index.php');
	if (isset($type_platform) && $type_platform != '') {
		echo $typePlatform;
		$file = str_replace('{@TYPE_PRODUCTION}', $type_platform, $file);
		// print_r($file);
		file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', 'development', $file);
		// print_r($file);
		file_put_contents($file);
	}