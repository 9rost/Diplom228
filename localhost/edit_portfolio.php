<?php
include 'bd.php'; // Подключаем файл с подключением к базе данных

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['action'] === 'edit') {
    $edit_portfolio_id = $_POST['edit_portfolio_id'];
    $edit_project_name = $_POST['edit_project_name'];
    $edit_project_description = $_POST['edit_project_description'];
    $edit_project_url = $_POST['edit_project_url'];
    $edit_project_image = $_POST['edit_project_image'];
    
    // Подготовленный запрос на обновление данных проекта
    $sql = "UPDATE index_portfolio SET project_name = ?, project_description = ?, project_url = ?, project_image = ? WHERE portfolio_id = ?";
    
    // Подготавливаем запрос
    $stmt = $conn->prepare($sql);
    
    // Привязываем параметры
    $stmt->bind_param("ssssi", $edit_project_name, $edit_project_description, $edit_project_url, $edit_project_image, $edit_portfolio_id);
    
    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Информация о проекте успешно отредактирована";
    } else {
        echo "Ошибка при редактировании информации о проекте: " . $stmt->error;
    }
    
    // Закрываем запрос
    $stmt->close();
}

// Закрываем соединение с базой данных
$conn->close();
?>
