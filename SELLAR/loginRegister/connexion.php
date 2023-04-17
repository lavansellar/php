

<?php
session_start();


$pdo = new PDO('mysql:host=localhost;dbname=bdd;charset=utf8', 'root', '');



if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];


    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

   
    if ($user && password_verify($password, $user['password'])) {
        
        $_SESSION['username'] = $username;
        echo "Connexion réussie.";
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
<form action="connexion.php" method="POST">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <br>
    <input type="submit" value="Se connecter">
</form>

</body>
</html>