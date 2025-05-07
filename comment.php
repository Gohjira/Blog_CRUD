<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $author = $_POST['author'];
    $comment = $_POST['comment'];

    $stmt = $pdo->prepare("INSERT INTO comments (post_id, author, comment, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$post_id, $author, $comment]);

    header("Location: view.php?id=" . $post_id);
    exit;
}
?>
