<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', (SELECT id FROM users WHERE username='$username'))";

    if(pg_query($conn, $sql)) {
        header("Location: home.php");
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    
    <h2>Create Post</h2>
    <form action="create_post.php" method="post">
        Title: <input type="text" name="title" required><br>
        Content: <textarea name="content" required></textarea><br>
        <input type="submit" value="Create">
    </form>
    <a href="home.php">Back to Home</a>
</body>
</html>