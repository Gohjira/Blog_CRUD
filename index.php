<?php
include 'db.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Fetch posts with comment count
$sql = "SELECT posts.*, COUNT(comments.id) as comment_count 
        FROM posts 
        LEFT JOIN comments ON posts.id = comments.post_id 
        GROUP BY posts.id 
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Twitter-like font for the header */
        body {
            font-family: "Helvetica Neue", Arial, sans-serif;
        }

        /* Styling for the header containing the welcome and logout button */
        .header {
            display: flex;
            justify-content: flex-start; /* Align items to the left */
            align-items: center;
            padding: 10px;
            background-color: #f1f1f1;
        }

        .header p {
            margin: 0;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        /* Styling for the Logout Button */
        .header a {
            text-decoration: none;
            color: white;
            padding: 10px 20px;
            background-color: #1DA1F2; /* Twitter blue */
            border-radius: 5px;
            margin-left: 10px;
        }

        .header a:hover {
            background-color: #1991D2; /* Slightly darker blue on hover */
        }

        /* Logo styling */
        .header img {
            width: 100px; /* Logo size */
            margin-right: 10px; /* Spacing between logo and text */
        }

        /* Button styling for other buttons */
        .btn {
            background-color: #1DA1F2;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #1991D2;
        }

        .btn-delete {
            background-color: #FF3333;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: #D92C2C;
        }
    </style>
</head>
<body>

<!-- Welcome & Logout -->
<div class="header">
    <img src="logo.png" alt="Logo"> <!-- Display logo next to the button -->
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> 
        <a href="logout.php">Logout</a>
    </p>
</div>

<h2>Blog Posts</h2>

<a href="add.php" class="btn">Add New Post</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content Preview</th>
            <th>Date</th>
            <th>Comments</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars(substr($row['content'], 0, 50)); ?>...</td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td><?php echo $row['comment_count']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure?');">Delete</a>
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="btn">View</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No posts found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
