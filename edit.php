<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include 'config.php'; 

if (isset($_GET['RefPdt'])) {
    $RefPdt = $_GET['RefPdt'];

    if (isset($_POST['submit'])) {
        $libPdt = $_POST['libPdt'];
        $Prix = $_POST['Prix'];
        $Qte = $_POST['Qte'];
        $description = $_POST['description'];
        $type = $_POST['type'];

        $query = "UPDATE produit SET libPdt = :libPdt, Prix = :Prix, Qte = :Qte, description = :description, type = :type WHERE RefPdt = :RefPdt";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':libPdt', $libPdt);
        $stmt->bindParam(':Prix', $Prix);
        $stmt->bindParam(':Qte', $Qte);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':RefPdt', $RefPdt);
        $stmt->execute();

        header("Location: dashboard.php");
        exit();
    }

    $query = "SELECT * FROM produit WHERE RefPdt = :RefPdt";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':RefPdt', $RefPdt);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modifier le Produit</h2>
        <form method="POST">
            <div class="form-group">
                <label for="libPdt">Libellé du Produit :</label>
                <input type="text" class="form-control" id="libPdt" name="libPdt" value="<?php echo $row['libPdt']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Prix">Prix :</label>
                <input type="number" class="form-control" id="Prix" name="Prix" value="<?php echo $row['Prix']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Qte">Quantité :</label>
                <input type="number" class="form-control" id="Qte" name="Qte" value="<?php echo $row['Qte']; ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="type">Type :</label>
                <input type="text" class="form-control" id="type" name="type" value="<?php echo $row['type']; ?>" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Enregistrer</button>
            <a href="dashboard.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>
