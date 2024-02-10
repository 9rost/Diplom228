<?php
include 'bd.php';
header("Location: admin.php");

    $section_content = $_POST['section_content'];

    // SQL запрос для вставки данных в таблицу privatepolicy
    $sql = "INSERT INTO privatepolicy (section_content) VALUES ('$section_content')";

    // Выполнение SQL запроса
    if (mysqli_query($conn, $sql)) {
        echo "Новая запись успешно добавлена.";
    } else {
        echo "Ошибка: " . mysqli_error($conn);
    }

?>
