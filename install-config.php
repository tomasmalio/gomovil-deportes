<?php 
	//
	$val = getopt("p:");
	print_r($val);
	// $opts = getopt('f:');
	echo $val[p];
	$file = file_get_contents('index.php');
	if (isset($val['p']) && $val['p'] != '') {
		// echo $typePlatform;
		echo $val['p'];
		$file = str_replace('{@TYPE_PRODUCTION}', $val['p'], $file);
		// print_r($file);
		file_put_contents($file);
	} else {
		$file = file_get_contents('index.php');
		$file = str_replace('{@TYPE_PRODUCTION}', 'development', $file);
		// print_r($file);
		file_put_contents($file);
	}