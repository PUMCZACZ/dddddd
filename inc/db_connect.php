<?php
include_once dirname(__FILE__).'/config.php';

try {
	$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';port='.DB_PORT, DB_USER, DB_PASS);
	$db->query("set names 'utf8'");
} catch(PDOException $e) {
	echo 'Połączenie nie mogło zostać utworzone.<br />';
}
?>
