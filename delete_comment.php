<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Get post ID to redirect after deletion
    $get = $conn->prepare("SELECT post_id FROM comments WHERE id = ?");
    $get->bind_param("i", $id);
    $get->execute();
    $result = $get->get_result();
    $comment = $result->fetch_assoc();
    $post_id = $comment['post_id'];

    // Delete the comment
    $stmt = $conn->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: view.php?id=" . $post_id);
    exit;
} else {
    echo "Comment ID missing.";
}
?>
