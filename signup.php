<?php

include 'config.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = pg_query($conn, $sql);

    if($result) {
        echo "Registration successful";
        header("Location: signin.php");
    } else {
        echo "Error: " . pg_last_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    
    <h2>Signup</h2>
    <form action="signup.php" method="post">
        Username: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" value="Signup">
    </form>
    <a href="signin.php">Signin</a>
</body>
</html>