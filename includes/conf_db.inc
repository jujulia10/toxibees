<?php

$db = new PDO(

	'mysql:host=localhost;dbname=aqpxnrztoxibees',

	'root',

	'root',

	array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")

);

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

