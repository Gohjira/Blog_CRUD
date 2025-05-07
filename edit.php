<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error updating post: " . $conn->error;
    }
}

$sql = "SELECT * FROM posts WHERE id=$id";
$result = $conn->query($sql);
$post = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Edit Blog Post</h2>
<form method="post">
    <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br>
    <textarea name="content" rows="10" required><?php echo $post['content']; ?></textarea><br>
    <input type="submit" value="Update" class="btn">
</form>

</body>
</html>
