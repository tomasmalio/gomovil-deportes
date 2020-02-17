<?php
	use GoMovil\Db;
	$db = new Db();
	$db->setUsername('{@Username}');
	$db->setPassword('{@Password}');
	$db->setDsn('mysql:dbname={@Dbname};host={@Host}');
	$db->connect();
?>