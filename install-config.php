<?php 
	/**
	 * Creating the index for Production or Development
	 */
	$values = parse_str($argv[2]);
	print_r($argv);
	echo $argv[2];

	$val = explode('&', $values);
	

	$file = file_get_contents('include/db.php');

	$file = str_replace('{@Username}', $val[0], $file);
	$file = str_replace('{@Password}', $val[1], $file);
	$file = str_replace('{@Dbname}', $val[2], $file);
	$file = str_replace('{@Host}', $val[3], $file);

	file_put_contents('include/db.php', $file);

	// $val = getopt("p:");
	// print_r($val);
	// $file = file_get_contents('include/db.php');
	// if ($val['p'] === 'prod') {
	// 	$file = str_replace('{@TYPE_PRODUCTION}', $val['p'], $file);
	// } else {
	// 	$file = str_replace('{@TYPE_PRODUCTION}', 'dev', $file);
	// }
	// file_put_contents('include/db.php', $file);
?>