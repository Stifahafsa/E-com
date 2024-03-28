<?php
$servername = 'localhost';
$username = 'root';
$password = 'dev101@2023';
$data = 'WS_Concours';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$data", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->exec('SET NAMES utf8');
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
    exit;
}
?>
