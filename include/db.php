<?php
	use GoMovil\Db;
	$db = new Db();
	$db->setUsername('gomovil_db');
	$db->setPassword('g0m0v1lc0');
	$db->setDsn('mysql:dbname=gosports_dev;host=db.gomovil.co');
	// $db->setUsername('{@Username}');
	// $db->setPassword('{@Password}');
	// $db->setDsn('mysql:dbname={@Dbname};host={@Host}');
	$db->connect();
?>