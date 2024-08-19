<?php
require_once 'classes/Database.php';
require_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);
$stmt = $post->listAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>My Blog Posts</h1>
    <a href="create_post.php" class="btn">Create New Post</a>

    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
        <div class="content">
            <h5><?php echo htmlspecialchars($row['title']); ?></h5>
            <p class="post-meta">By: <?php echo htmlspecialchars($row['author']); ?> on <?php echo htmlspecialchars($row['created_at']); ?></p>
            <p><?php echo nl2br(htmlspecialchars(substr($row['content'], 0, 150))); ?>...</p>
            <div class="btn-group">
                <a href="view_post.php?id=<?php echo $row['id']; ?>" class="btn">View</a>
                <a href="edit_post.php?id=<?php echo $row['id']; ?>" class="btn">Edit</a>
                <a href="delete_post.php?id=<?php echo $row['id']; ?>" class="btn" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
            </div>
        </div>
    <?php endwhile; ?>
</div>

</body>
</html>
