<?php 
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

include 'config.php';
$username = $_SESSION['username'];
$sql = "SELECT * FROM posts WHERE user_id = (SELECT id FROM users WHERE username='$username') ORDER BY created_at DESC";
$result = pg_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="assets/styles.css">
    <script src="assets/script.js" defer></script>
</head>
<body>
    
    <h2>Welcome, </php echo $_SESSION['username']; ?>!</h2>
    <a href="create_post.php">Create Post</a> | <a href="logout.php">Logout</a>
    <h3>Your Posts</h3>
    
    <?php
    while($row = pg_fetch_assoc($result)) {
        echo "<div>";
        echo "<h4>" . $row['title'] . "</h4>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<a href='edit_post.php?id=" . $row['id'] . "'>Edit</a> | ";
        echo "<a href='delete_post.php?id=" . $row['id'] . "'>Delete</a>";
        echo "</div>";
    }
    ?>

</body>
</html>