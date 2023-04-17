<?php

session_start();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <a href="inscription.php">Inscription</a>
    <a href="connexion.php">Connexion</a>


    <?php 
    if(isset($_SESSION['username'])) {
        echo "<a href='deconnexion.php'>Deconnexion</a>    <br>";
        echo "Bienvenue " . $_SESSION['username'];
    }

    ?>



</body>
</html>