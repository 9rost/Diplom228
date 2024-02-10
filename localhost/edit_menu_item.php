<?php
include 'bd.php';
header("Location: admin.php");

// Получение данных из формы
$edit_id = $_POST['edit_id'];
$new_title = $_POST['new_title'];
$new_link = $_POST['new_link'];
$new_parent_id = $_POST['new_parent_id'];

// SQL запрос для редактирования элемента
$sql = "UPDATE menu_items SET title='$new_title', link='$new_link', parent_id='$new_parent_id' WHERE id='$edit_id'";

if ($conn->query($sql) === TRUE) {
    echo "Элемент успешно отредактирован";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
