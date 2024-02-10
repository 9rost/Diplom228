<?php

include 'bd.php';
header("Location: admin.php");

// Получение данных из формы
$section_content = $_POST['section_content'];

// SQL запрос для добавления новой записи
$sql = "INSERT INTO privatecookie (section_content) VALUES ('$section_content')";

if ($conn->query($sql) === TRUE) {
    echo "Новая запись успешно добавлена";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
