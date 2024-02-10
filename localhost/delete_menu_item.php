<?php
include 'bd.php';
header("Location: admin.php");

// Получение ID элемента для удаления
$delete_id = $_POST['delete_id'];

// SQL запрос для удаления элемента
$sql = "DELETE FROM menu_items WHERE id='$delete_id'";

if ($conn->query($sql) === TRUE) {
    echo "Элемент успешно удален";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}


?>
