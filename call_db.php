<?php 

try {
	$db = new PDO('mysql:host=sql25;dbname=iol91791;charset=utf8', 'iol91791', 'kBohd55y5K3b', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} 	
catch (Exception $e) {
	die("Erreur : " . $e->getMessage());
}
$content = "";
session_start();
?>