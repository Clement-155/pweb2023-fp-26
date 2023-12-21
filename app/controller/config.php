<?php
require_once 'sessionauth.php';
if ($_SESSION["user_id"]<=0){
    header("Location: ../views/profile/login.php");
}
?>

<?php
$host = 'localhost';
$dbname = 'ezvote';
$username = 'root';
$password = '';
try {
 $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
 die("Database connection failed: " . $e->getMessage());
}
?>