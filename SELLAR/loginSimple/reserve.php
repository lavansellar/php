<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Réservé</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php

include 'menu.php';


if(isset($_SESSION['connected'])){
    if($_SESSION['connected']){
        echo "Vous êtes connecté.";
    }
    else{
        echo "Vous n'êtes pas autorisé à voir cette page.";
    }
}
else{
    echo "Vous n'êtes pas autorisé à voir cette page.";
}

?>
    
</body>
</html>
