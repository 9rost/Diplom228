<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "index"; 

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Ошибка соединения: " . mysqli_connect_error());
}
?>