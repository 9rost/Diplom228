<?php
include 'bd.php'; // Подключаем файл с подключением к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] === 'delete') {
    $delete_portfolio_id = $_POST['delete_portfolio_id'];
    
    // Подготовленный запрос на удаление проекта
    $sql = "DELETE FROM index_portfolio WHERE portfolio_id = ?";
    
    // Подготавливаем запрос
    $stmt = $conn->prepare($sql);
    
    // Привязываем параметры
    $stmt->bind_param("i", $delete_portfolio_id);
    
    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Проект успешно удален";
    } else {
        echo "Ошибка при удалении проекта: " . $stmt->error;
    }
    
    // Закрываем запрос
    $stmt->close();
}

// Закрываем соединение с базой данных
$conn->close();
?>
