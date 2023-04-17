<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>

<?php

include 'menu.php'

?>

<form action="process.php" method="post">
    <label for="id">Identifiant</label>
    <input type="text" id="id" name="id">
    <label for="password">Mot de passe</label>
    <input type="password" id="password" name="password">
    <input type="submit" name="submit">
</form>

<p>Identifiant -> root / Mot de passe -> password</p>

    
</body>
</html>


