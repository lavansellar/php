<?php
header('Content-Type: application/json');

require_once 'config.php';
$pdo = connectDatabase();

function createPost($pdo, $input)
{
    $message = $input['message'] ?? '';
    $user_id = $input['user_id'] ?? '';

    if (!empty($message) && !empty($user_id)) {
        $query = $pdo->prepare("INSERT INTO posts (user_id, message) VALUES (:user_id, :message)");
        $query->bindParam(':user_id', $user_id);
        $query->bindParam(':message', $message);

        if ($query->execute()) {
            return ['etat' => 'valide', 'message' => 'Post créé avec succès.'];
        } else {
            return ['etat' => 'erreur', 'message' => 'Erreur lors de la création du post.'];
        }
    } else {
        return ['etat' => 'erreur', 'message' => 'Paramètres invalides.'];
    }
}

function deletePost($pdo, $post_id)
{
    $query = $pdo->prepare("DELETE FROM posts WHERE id = :post_id");
    $query->bindParam(':post_id', $post_id);

    if ($query->execute()) {
        return ['etat' => 'valide', 'message' => 'Post supprimé avec succès.'];
    } else {
        return ['etat' => 'erreur', 'message' => 'Erreur lors de la suppression du post.'];
    }
}

function listPosts($pdo)
{
    $query = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC LIMIT 10");
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
    return ['etat' => 'valide', 'posts' => $posts];
}

function getPostById($pdo, $post_id)
{
    $query = $pdo->prepare("SELECT * FROM posts WHERE id = :post_id");
    $query->bindParam(':post_id', $post_id);
    $query->execute();

    $post = $query->fetch(PDO::FETCH_ASSOC);

    if ($post) {
        return ['etat' => 'valide', 'post' => $post];
    } else {
        return ['etat' => 'erreur', 'message' => 'Post introuvable.'];
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '';

if ($method === 'POST') {
    if ($path === '/posts') {
        $input = json_decode(file_get_contents('php://input'), true);
        $response = createPost($pdo, $input);
        echo json_encode($response);
    }
} else if ($method === 'DELETE') {
    if (preg_match('#^/posts/(\d+)$#', $path, $matches)) {
        $post_id = $matches[1];
        $response = deletePost($pdo, $post_id);
        echo json_encode($response);
    }
} else if ($method === 'GET') {
    if ($path === '/posts') {
        $response = listPosts($pdo);
        echo json_encode($response);
    } else if (preg_match('#^/posts/(\d+)$#', $path, $matches)) {
        $post_id = $matches[1];
        $response = getPostById($pdo, $post_id);
        echo json_encode($response);
    }
}
    