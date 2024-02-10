<?php
include 'bd.php'; // Подключаем файл с подключением к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_section_id'])) {
        $edit_section_id = $_POST['edit_section_id'];
        $edit_section_content = $_POST['edit_section_content'];
        
        // Подготовленный запрос на обновление содержания раздела
        $sql = "UPDATE privatepolicy SET section_content = ? WHERE section_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }
        
        // Привязываем параметры
        $stmt->bind_param("si", $edit_section_content, $edit_section_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Содержание раздела успешно отредактировано";
        } else {
            echo "Ошибка при редактировании содержания раздела: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    } elseif (isset($_POST['section_id'])) {
        $delete_section_id = $_POST['section_id'];
        
        // Подготовленный запрос на удаление раздела
        $sql = "DELETE FROM privatepolicy WHERE section_id = ?";
        
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
