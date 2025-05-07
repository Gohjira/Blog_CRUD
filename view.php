<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the post
    $stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $post_result = $stmt->get_result();
    $post = $post_result->fetch_assoc();

    if (!$post) {
        echo "Post not found.";
        exit;
    }

    // Handle comment submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comment'])) {
        $comment = trim($_POST['comment']);
        $user_id = $_SESSION['user_id'];
        $author = $_SESSION['username'];

        if (!empty($comment)) {
            $comment_stmt = $conn->prepare("INSERT INTO comments (post_id, author, comment) VALUES (?, ?, ?)");
            $comment_stmt->bind_param("iss", $id, $author, $comment);
            $comment_stmt->execute();
        }
    }

    // Fetch comments (oldest first)
    $comment_stmt = $conn->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at ASC");
    $comment_stmt->bind_param("i", $id);
    $comment_stmt->execute();
    $comments = $comment_stmt->get_result();
} else {
    echo "Post ID is missing.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<p>
    Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong> |
    <a href="logout.php">Logout</a> |
    <a href="index.php">Back to Blog</a>
</p>

<h2><?php echo htmlspecialchars($post['title']); ?></h2>
<p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
<p><small>Posted on: <?php echo $post['created_at']; ?></small></p>

<hr>
<h3>Comments</h3>

<?php if ($comments->num_rows > 0): ?>
    <?php while ($row = $comments->fetch_assoc()): ?>
        <div class="comment">
            <strong><?php echo htmlspecialchars($row['author']); ?>:</strong><br>
            <p><?php echo nl2br(htmlspecialchars($row['comment'])); ?></p>
            <small><?php echo $row['created_at']; ?></small>
        </div>
        <hr>
    <?php endwhile; ?>
<?php else: ?>
    <p>No comments yet.</p>
<?php endif; ?>

<h4>Add a Comment</h4>
<form method="POST">
    <textarea name="comment" placeholder="Write your comment..." required></textarea><br><br>
    <input type="submit" value="Post Comment">
</form>

</body>
</html>
