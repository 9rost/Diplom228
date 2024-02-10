<?php
include 'bd.php'; // Подключаем файл с подключением к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] === 'edit') {
        $edit_section_id = $_POST['edit_section_id'];
        $edit_section_content = $_POST['edit_section_content'];
        
        // Подготовленный запрос на обновление данных раздела
        $sql = "UPDATE help SET section_content = ? WHERE section_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }
        
        // Привязываем параметры
        $stmt->bind_param("si", $edit_section_content, $edit_section_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Информация о разделе успешно отредактирована";
        } else {
            echo "Ошибка при редактировании информации о разделе: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    } elseif ($_POST['action'] === 'delete') {
        $delete_section_id = $_POST['delete_section_id'];
        
        // Подготовленный запрос на удаление раздела
        $sql = "DELETE FROM help WHERE section_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }
        
        // Привязываем параметры
        $stmt->bind_param("i", $delete_section_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Раздел успешно удален";
        } else {
            echo "Ошибка при удалении раздела: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    }
}

// Закрываем соединение с базой данных
$conn->close();
?>
