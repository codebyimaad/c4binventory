<?php
$dsn = "mysql:host=".DATABASE_HOST."; dbname=".DATABASE_NAME."";
$user = DATABASE_USER;
$pass = DATABASE_PASS;

try {
	$pdo = new PDO($dsn,$user,$pass);
	$pdo->exec("set names utf8");
} catch (PDOException $e) {
	// Change this to log the error instead of echoing it
	error_log('Connection error: ' . $e->getMessage());
	$pdo = null; // Set $pdo to null to indicate connection failure
}
// Remove the closing PHP tag to prevent accidental whitespace

