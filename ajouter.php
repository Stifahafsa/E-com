<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include 'config.php';

if (isset($_POST['submit'])) {
    $RefPdt = $_POST['RefPdt'];
    $libPdt = $_POST['libPdt'];
    $Prix = $_POST['Prix'];
    $Qte = $_POST['Qte'];
    $description = $_POST['description'];
    $type = $_POST['type'];

    // Gestion de l'upload de l'image
    $target_dir = "photos/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $image = $target_dir . uniqid() . '.' . $imageFileType;
    move_uploaded_file($_FILES["image"]["tmp_name"], $image);

    $query = "INSERT INTO produit (RefPdt, libPdt, Prix, Qte, description, image, type) VALUES (:RefPdt, :libPdt, :Prix, :Qte, :description, :image, :type)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':RefPdt', $RefPdt);
    $stmt->bindParam(':libPdt', $libPdt);
    $stmt->bindParam(':Prix', $Prix);
    $stmt->bindParam(':Qte', $Qte);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':type', $type);
    $stmt->execute();

    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un Produit</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="RefPdt">Référence du Produit :</label>
                <input type="text" class="form-control" id="RefPdt" name="RefPdt" required>
            </div>
            <div class="form-group">
                <label for="libPdt">Libellé du Produit :</label>
                <input type="text" class="form-control" id="libPdt" name="libPdt" required>
            </div>
            <div class="form-group">
                <label for="Prix">Prix :</label>
                <input type="number" class="form-control" id="Prix" name="Prix" required>
            </div>
            <div class="form-group">
                <label for="Qte">Quantité :</label>
                <input type="number" class="form-control" id="Qte" name="Qte" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="type">Type :</label>
                <input type="text" class="form-control" id="type" name="type" required>
            </div>
            <div class="form-group">
                <label for="image">Image :</label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Ajouter</button>
            <a href="dashboard.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
