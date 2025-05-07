<?php
include 'db.php';
session_start(); // Ensure the session is started

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

// Handle post submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();

    // Redirect to index page after posting
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Welcome & Logout links -->
<div class="header">
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> | <a href="logout.php">Logout</a></p>
    <a href="index.php" class="btn">Back to Blog</a>
</div>

<h2>Create a New Post</h2>

<form method="POST">
    <label for="title">Title:</label><br>
    <input type="text" name="title" required><br><br>
    <label for="content">Content:</label><br>
    <textarea name="content" required></textarea><br><br>
    <input type="submit" value="Post">
</form>

</body>
</html>
