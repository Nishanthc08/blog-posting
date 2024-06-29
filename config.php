<?php 

$host = "localhost";
$dbname = "blog_website";
$user = "postgres";
$password = "nishu";

// Create connection
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

// Check connection
if(!$conn) {
    die("Connection failed: " . pg_last_error());
}

?>