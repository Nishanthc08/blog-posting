<?php

include 'config.php';
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = pg_query($conn, $sql);

    if(pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: home.php");
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "No ser found with that username!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signin</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <h2>Signin</h2>
    <form action="signin.php" method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Signin">
    </form>
    <a href="signup.php">Signup</a>
</body>
</html>