<?php 
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

include 'config.php';
$post_id = $_GET['id'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE posts SET title='$title', content='$content' WHERE id=$post_id";

    if(pg_query($conn, $sql)) {
        header("Location: home.php");
    } else {
        echo "Error: " . pg_last_error($con);
    }
} else {
    $sql = "SELECT * FROM posts WHERE id=$post_id";
    $result = pg_query($conn, $sql);
    $post = pg_fetch_assoc($result);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Post</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    
    <h2>Edit Post</h2>
    <form action="edit_post.php?id=<?php echo $post_id; ?>" method="post">
        Title: <input type="text" name="title" value="<?php echo $post['title']; ?>" required><br>
        ContentL <textarea name="content" required><?php echo $post['content']; ?></textarea>
        <input type="submit" value="Update">
    </form>
    <a href="home.php">Back to Home</a>
</body>
</html>