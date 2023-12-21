<?php
$host = 'sql311.infinityfree.com';
$dbname = 'if0_35654577_ezvote';
$username = 'if0_35654577';
$password = 'co4869ol';
try {
 $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 die("Database connection failed: " . $e->getMessage());
}
?>