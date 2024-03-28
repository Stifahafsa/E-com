<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include 'config.php'; 

if (isset($_GET['RefPdt'])) {
    $RefPdt = $_GET['RefPdt'];

    $query = "DELETE FROM produit WHERE RefPdt = :RefPdt";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':RefPdt', $RefPdt);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
} else {
    header("Location: dashboard.php");
    exit();
}
?>
