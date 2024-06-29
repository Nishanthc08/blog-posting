<?php
include 'config.php';

$sql = "SELECT posts.id, posts.title, posts.content, users.username, posts.created_at
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";
$result = pg_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog Website</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/script.js"></script>
</head>
<body>
    <h2>Welcome to the Blog Website</h2>
    <a href="signup.php">Signup</a> | <a href="signin.php">Signin</a>
    <h3>All Posts</h3>
    
    <?php 
    while($row = pg_fetch_assoc($result)) {
        echo "<div>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<p>by " . $row['username'] . " on " . $row['created_at'] . "</p>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
    }
    ?>

</body>
</html>