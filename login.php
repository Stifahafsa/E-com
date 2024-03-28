<?php
session_start();

include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM utilisateur WHERE login='$login' AND password='$password'";
    $result = $conn->query($query);

    if ($result->rowCount() == 1) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['login'] = $login;
        $_SESSION['type'] = $row['type'];
        header("Location: dashboard.php"); // Rediriger vers la page dashboard si la connexion est réussie
    } else {
        echo "Login ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-center">Connexion</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="login">Login :</label>
                                <input type="text" class="form-control" id="login" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Se connecter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

