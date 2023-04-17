<?php
function connectDatabase() {
    $host = 'localhost';
    $dbname = 'twitter';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("erreur lors de la connexion à la base de données " . $e->getMessage());
    }
}
