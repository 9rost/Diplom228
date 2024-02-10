<?php
include 'bd.php'; // Подключаем файл с подключением к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] === 'edit') {
        $edit_service_id = $_POST['edit_service'];
        $edit_description = $_POST['edit_description'];
        $edit_image_url = $_POST['edit_image_url'];
        
        // Подготовленный запрос на обновление данных услуги
        $sql = "UPDATE index_services SET description = ?, image_url = ? WHERE service_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        // Привязываем параметры
        $stmt->bind_param("ssi", $edit_description, $edit_image_url, $edit_service_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Информация о услуге успешно отредактирована";
        } else {
            echo "Ошибка при редактировании информации о услуге: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    } elseif ($_POST['action'] === 'delete') {
        $delete_service_id = $_POST['delete_service'];
        
        // Подготовленный запрос на удаление услуги
        $sql = "DELETE FROM index_services WHERE service_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        // Привязываем параметры
        $stmt->bind_param("i", $delete_service_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Услуга успешно удалена";
        } else {
            echo "Ошибка при удалении услуги: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    }
}

// Закрываем соединение с базой данных
$conn->close();
?>
