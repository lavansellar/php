<?php
require_once 'config.php';
$pdo = connectDatabase();

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $query->bindParam(':username', $username);
    $query->bindParam(':password', $password);

    if ($query->execute()) {
        header("Location: login.php");
    } else {
        $erreur = "Erreur d'inscription";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
<?php include_once("menu.php"); ?>

<h1>Inscription</h1>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit" name="register">S'inscrire</button>
    </form>
    <p>Déjà inscrit ? <a href="login.php">Se connecter</a></p>
    <?php if(isset($erreur)){
        echo $erreur;
    }
    ?>
</body>
</html>
