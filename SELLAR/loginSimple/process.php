<?php

session_start();

if(isset($_POST["submit"])){
    if($_POST["id"] == "root" && $_POST["password"] == "password"){
        $_SESSION["connected"] = true;
        header('Location: index.php');
    }
    else{
        echo "Identifiant ou mot de passe incorrect";
    }
}

?>