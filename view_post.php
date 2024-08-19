<?php
require_once 'classes/Database.php';
require_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($post->read($id)) {
        // Post found
    } else {
        echo "Post not found.";
        exit;
    }
} else {
    echo "No post ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($post->title); ?></h1>
    <p><strong>Author:</strong> <?php echo htmlspecialchars($post->author); ?></p>
    <p><strong>Created on:</strong> <?php echo htmlspecialchars($post->created_at); ?></p>
    <div class="content">
        <p><?php echo nl2br(htmlspecialchars($post->content)); ?></p>
    </div>
    <a href="list_post.php" class="btn">Back to Posts</a>
</div>

</body>
</html>
