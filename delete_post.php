<?php
require_once 'classes/Database.php';
require_once 'classes/Post.php';

$database = new Database();
$db = $database->getConnection();

$post = new Post($db);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($post->delete($id)) {
        header('Location: list_post.php');
        exit();
    } else {
        echo "Unable to delete post.";
    }
} else {
    echo "No post ID provided.";
    exit();
}
?>
