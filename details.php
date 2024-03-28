<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

include 'config.php'; 

if (isset($_GET['RefPdt'])) {
    $RefPdt = $_GET['RefPdt'];

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
    <title>Détails du Produit</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <h3><?php echo $row['libPdt']; ?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo $row['image']; ?>" class="img-fluid" alt="Produit" style="max-width: 300px;">
                        </div>
                <div class="col-md-6">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Référence produit:</th>
                            <td><?php echo $row['RefPdt']; ?></td>
                        </tr>
                        <tr>
                            <th>libellé produit:</th>
                            <td><?php echo $row['libPdt']; ?></td>
                        </tr>
                        <tr>
                            <th>Prix produit:</th>
                            <td><?php echo $row['Prix']; ?></td>
                        </tr>
                        <tr>
                            <th>Quantité produit:</th>
                            <td><?php echo $row['Qte']; ?></td>
                        </tr>
                        <tr>
                            <th>Description produit:</th>
                            <td><?php echo $row['description']; ?></td>
                        </tr>
                        <tr>
                            <th>Type produit:</th>
                            <td><?php echo $row['type']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="dashboard.php" class="btn btn-primary">Retour</a>
</body>
</html>
