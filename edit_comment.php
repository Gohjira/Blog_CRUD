<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the comment
    $stmt = $conn->prepare("SELECT * FROM comments WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $comment = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $author = $_POST['author'];
        $comment_text = $_POST['comment'];

        $update = $conn->prepare("UPDATE comments SET author = ?, comment = ? WHERE id = ?");
        $update->bind_param("ssi", $author, $comment_text, $id);
        $update->execute();

        header("Location: view.php?id=" . $comment['post_id']);
        exit;
    }
} else {
    echo "Comment ID missing.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Comment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Edit Comment</h2>
    <form method="POST">
        <input type="text" name="author" value="<?php echo htmlspecialchars($comment['author']); ?>" required><br><br>
        <textarea name="comment" required><?php echo htmlspecialchars($comment['comment']); ?></textarea><br><br>
        <input type="submit" value="Update Comment">
    </form>
</body>
</html>
