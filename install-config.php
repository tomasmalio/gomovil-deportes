<?php 
	//
	$val = getopt("p:");
	print_r($val);
	// $opts = getopt('f:');
	$file = file_get_contents('index.php');
	if (isset($val['p']) && $val['p'] != '') {
		// echo $typePlatform;
		// echo $val['p'];
		$fileNew = str_replace('{@TYPE_PRODUCTION}', $val['p'], $file);
		print_r($fileNew);
		// file_put_contents($fileNew);
	} else {
		$file = file_get_contents('index.php');
		$fileNew = str_replace('{@TYPE_PRODUCTION}', 'development', $file);
		// print_r($file);
		// file_put_contents($fileNew);
	}