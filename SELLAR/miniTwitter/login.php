<?php
session_start();
require_once 'config.php';
$pdo = connectDatabase();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $query->bindParam(':username', $username);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo $user['id'] . $user['username'];
        header("Location: index.php");
    } else {
        $erreur = "Le nom d'utilisateur ou le mot de passe est incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <?php include_once("menu.php"); ?>
    <h1>Connexion</h1>
    <form method="post" action="">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required><br>
        <input type="password" name="password" placeholder="Mot de passe" required><br>
        <button type="submit" name="login">Se connecter</button>
    </form>

    <?php if(isset($erreur)){
        echo $erreur;
    }
    ?>
   
</body>
</html>
