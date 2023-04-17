<?php
session_start();
require_once 'config.php';
$pdo = connectDatabase();

if (!isset($_SESSION['id'])) {
    
}

if (isset($_POST['create_post'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['id'];

    $query = $pdo->prepare("INSERT INTO posts (user_id, message) VALUES (:user_id, :message)");
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':message', $message);

    if ($query->execute()) {
        echo "Le tweet a été envoyé.";
    } else {
        echo "Erreur pendant l'envoi du tweet.";
    }
}

if (isset($_GET['delete_post'])) {
    $post_id = $_GET['delete_post'];
    $query = $pdo->prepare("DELETE FROM posts WHERE id = :post_id");
    $query->bindParam(':post_id', $post_id);

    if ($query->execute()) {
        echo "Le tweet a été supprimé.";
    } else {
        echo "Erreur pendant la suppresion du tweet.";
    }
}

$query = $pdo->query("SELECT posts.id, posts.message, posts.created_at, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC LIMIT 10");

$posts = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mini Twitter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

    <?php include_once("menu.php"); ?>

    <?php if (isset($_SESSION['connected'])) {  ?>
    <h1>Bienvenue, <?= $_SESSION['username'] ?></h1>
    <form method="post" action="">
        <textarea name="message" placeholder="Votre message" required></textarea><br>
        <button type="submit" name="create_post">Créer un post</button>
    </form>

        <?php } ?>
    <h2>Les derniers tweets</h2>
    <?php foreach ($posts as $post): ?>
        <div>
            <p><?= htmlspecialchars($post['message']) ?></p>
            <p>Posté par <?= htmlspecialchars($post['username']) ?> le <?= $post['created_at'] ?></p>
            <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $post['username']): ?>



                <a href="index.php?delete_post=<?= $post['id'] ?>">Supprimer</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['connected'])) {  ?>
        <p><a href="logout.php">Se déconnecter</a></p>

        <?php } ?>
   
</body>
</html>
