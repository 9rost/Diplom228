<?php
include 'bd.php'; // Подключаем файл с подключением к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['edit_submit'])) {
        $price_id = $_POST['price_id'];
        $new_language = $_POST['new_language'];
        $new_translator_type = $_POST['new_translator_type'];
        $new_price_per_page = $_POST['new_price_per_page'];
        
        // Подготовленный запрос на обновление данных цены на услугу
        $sql = "UPDATE index_services_prices SET language = ?, translator_type = ?, price_per_page = ? WHERE price_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }
        
        // Привязываем параметры
        $stmt->bind_param("ssdi", $new_language, $new_translator_type, $new_price_per_page, $price_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Цена на услугу успешно отредактирована";
        } else {
            echo "Ошибка при редактировании цены на услугу: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    } elseif (isset($_POST['delete_submit'])) {
        $price_id = $_POST['price_id'];
        
        // Подготовленный запрос на удаление цены на услугу
        $sql = "DELETE FROM index_services_prices WHERE price_id = ?";
        
        // Подготавливаем запрос
        $stmt = $conn->prepare($sql);
        
        if ($stmt === false) {
            die("Ошибка подготовки запроса: " . $conn->error);
        }
        
        // Привязываем параметры
        $stmt->bind_param("i", $price_id);
        
        // Выполняем запрос
        if ($stmt->execute()) {
            echo "Цена на услугу успешно удалена";
        } else {
            echo "Ошибка при удалении цены на услугу: " . $stmt->error;
        }
        
        // Закрываем запрос
        $stmt->close();
    }
}

// Закрываем соединение с базой данных
$conn->close();
?>
