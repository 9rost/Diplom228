<?php
include 'bd.php';
header("Location: admin.php");

// Обработка запроса на удаление
if ($_POST['action'] === 'delete') {
    $delete_section_id = $_POST['delete_section_id'];
    
    $sql = "DELETE FROM index_content WHERE section_id = $delete_section_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Информация успешно удалена";
    } else {
        echo "Ошибка при удалении информации: " . $conn->error;
    }
}

// Обработка запроса на редактирование
if ($_POST['action'] === 'edit') {
    $edit_section_id = $_POST['edit_section_id'];
    $edit_section_content = $_POST['edit_section_content'];
    
    $sql = "UPDATE index_content SET section_content = '$edit_section_content' WHERE section_id = $edit_section_id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Информация успешно отредактирована";
    } else {
        echo "Ошибка при редактировании информации: " . $conn->error;
    }
}


?>
