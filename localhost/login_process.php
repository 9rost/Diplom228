<?php
// Начинаем сессию
session_start();

include 'bd.php'; // Подключаем файл с подключением к базе данных

// Проверка, была ли отправлена форма методом POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Проверка email и пароля (реализация зависит от вашей логики аутентификации)
    // Например, вы можете проверить их в базе данных или другом хранилище
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Ошибка выполнения запроса: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_type = $row['user_type'];

        // Устанавливаем сессию для запоминания аутентификации
        $_SESSION['authenticated'] = true;
        $_SESSION['user_type'] = $user_type;

        // Проверяем тип пользователя и перенаправляем на соответствующую страницу
        if ($user_type == 'admin') {
            header("Location: admin.php");
            exit(); // Важно остановить дальнейшее выполнение кода после перенаправления
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        echo "Неверный адрес электронной почты или пароль.";
    }
} else {
    // Если форма не была отправлена методом POST, перенаправляем пользователя на страницу входа
    header("Location: login.php");
    exit();
}
?>
