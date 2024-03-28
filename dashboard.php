<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'utilisateur a les autorisations nécessaires
if ($_SESSION['type'] !== 'administrateur') {
    header("Location: unauthorized.php");
    exit();
}


include 'config.php'; 

$query = "SELECT * FROM produit";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Liste des produits</h2>
        <a href="ajouter.php" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
        <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Référence</th>
                <th>libellé</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Description</th>
                <th>Type</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?php echo $row['RefPdt']; ?></td>
                    <td><?php echo $row['libPdt']; ?></td>
                    <td><?php echo $row['Prix']; ?></td>
                    <td><?php echo $row['Qte']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><img src="<?php echo $row['image']; ?>" alt="Produit" class="img-thumbnail" style="max-width: 100px;"></td>
                    <td>
                        <a href="details.php?RefPdt=<?php echo $row['RefPdt']; ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i> <!-- Icone pour afficher -->
                        </a>
                        <a href="edit.php?RefPdt=<?php echo $row['RefPdt']; ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> <!-- Icone pour modifier -->
                        </a>
                        <a href="delete.php?RefPdt=<?php echo $row['RefPdt']; ?>" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> <!-- Icone pour supprimer -->
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>

        </table>
        <a href="logout.php" class="btn btn-primary">Déconnexion</a>
    </div>
</body>
</html>
