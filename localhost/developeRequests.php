<?php
include 'bd.php';


$problem_description = $_POST['problem'];
$name = $_POST['name'];
$email = $_POST['email'];
$additional_info = $_POST['additional-info'];
$attachment = $_POST['attachment'];
$consent = isset($_POST['consent']) ? 1 : 0; // преобразование значения чекбокса в булево значение

// SQL запрос для вставки данных в таблицу
$sql = "INSERT INTO requests (problem_description, name, email, additional_info, attachment, consent) VALUES ('$problem_description', '$name', '$email', '$additional_info', '$attachment', '$consent')";

if ($conn->query($sql) === TRUE) {
    echo "Заявка успешно отправлена";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$target_dir = "uploads/"; // Папка, куда будут загружены файлы
$target_file = $target_dir . basename($_FILES["attachment"]["name"]); // Полный путь к загружаемому файлу

// Проверка, является ли файл допустимым
if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
    echo "Файл ". basename( $_FILES["attachment"]["name"]). " успешно загружен.";
} else {
    echo "Произошла ошибка при загрузке файла.";
}

?>