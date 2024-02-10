<?php

include 'bd.php';
header("Location: admin.php");

$title = $_POST['title'];
$link = $_POST['link'];
$parent_id = $_POST['parent_id'];

$sql = "INSERT INTO menu_items (parent_id, title, link) VALUES ('$parent_id', '$title', '$link')";
    // Выполнение SQL запроса
    if (mysqli_query($conn, $sql)) {
        echo "Новая запись успешно добавлена.";
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }



?>
