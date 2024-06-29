<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: signin.php");
    exit();
}

include 'config.php';
$post_id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id=$post_id";

if(pg_query($conn, $sql)) {
    header("Location: home.php");
} else {
    echo "Error: " . pg_last_error($conn);
}
?>

