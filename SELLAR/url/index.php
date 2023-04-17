<?php
require_once 'db.php';

$pdo = connectDatabase();

function generateurlCode($taille = 6)
{
    $characteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characteresTaille = strlen($characteres);
    $urlCode = '';

    for ($i = 0; $i < $taille; $i++) {
        $urlCode .= $characteres[rand(0, $characteresTaille - 1)];
    }

    return $urlCode;
}

if (isset($_POST['url'])) {
    $url = $_POST['url'];
    $urlCode = generateurlCode();

    $query = $pdo->prepare("INSERT INTO urls (urlCode, url) VALUES (?, ?)");

    if ($query->execute([$urlCode, $url])) {
        $urlRacc = "http://{$_SERVER['HTTP_HOST']}/{$_SERVER['PHP_SELF']}?u=$urlCode";
        echo "URL raccourcie: " . htmlspecialchars($urlRacc);
    } 
} 

elseif (isset($_GET['u'])) {
    $urlCode = $_GET['u'];

    $query = $pdo->prepare("SELECT url FROM urls WHERE urlCode = ?");
    $query->execute([$urlCode]);

    $url = $query->fetchColumn();

    if ($url) {
        header("Location: $url");
        exit;
    } else {
        echo "URL incorrect";
    }
} else {
    ?><form method="post" action=""><input type="url" name="url" required><input type="submit" value="Raccourcir"></form>

    <?php
}
