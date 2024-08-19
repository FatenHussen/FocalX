<?php
require_once 'classes/Database.php';
require_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['title'])) {
        $errors[] = 'Title is required.';
    }

    if (empty($_POST['content'])) {
        $errors[] = 'Content is required.';
    }

    if (empty($errors)) {
        $post->title = $_POST['title'];
        $post->content = $_POST['content'];
        $post->author = $_POST['author'];
        $post->created_at = date('Y-m-d H:i:s');
        $post->updated_at = date('Y-m-d H:i:s');

        if ($post->create()) {
            header('Location: list_post.php');
            exit();
        } else {
            $errors[] = 'Unable to create post.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
    <h1>Create a New Post</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="create_post.php" method="post">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($_POST['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea id="content" name="content" rows="5" required><?php echo htmlspecialchars($_POST['content'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($_POST['author'] ?? ''); ?>" required>
        </div>
        <button type="submit" class="btn">Create Post</button>
    </form>
    <a href="list_post.php" class="btn">Back to Posts</a>
</div>

</body>
</html>
