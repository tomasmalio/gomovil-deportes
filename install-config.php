<?php 
	/**
	 * Customize your DB Connection
	 */
	$val = explode('&', $argv[2]);
	
	$file = file_get_contents('include/db.php');

	$file = str_replace('{@Username}', $val[0], $file);
	$file = str_replace('{@Password}', $val[1], $file);
	$file = str_replace('{@Dbname}', $val[2], $file);
	$file = str_replace('{@Host}', $val[3], $file);

	file_put_contents('include/db.php', $file);

?>