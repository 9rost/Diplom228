<?php
// Подключение к базе данных
include 'bd.php';

// Проверка, была ли отправлена форма регистрации
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получение данных из формы
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    $userType = $_POST['user-type'];

    // Проверка, чтобы пароль и подтверждение пароля совпадали
    if ($password !== $confirmPassword) {
        echo "Пароль и подтверждение пароля не совпадают.";
        exit;
    }

    // Хеширование пароля
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Подготовленный запрос на вставку данных в базу данных
    $sql = "INSERT INTO users (username, email, password, user_type) VALUES (?, ?, ?, ?)";

    // Подготавливаем запрос
    $stmt = $conn->prepare($sql);

    // Привязываем параметры
    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $userType);

    // Выполняем запрос
    if ($stmt->execute()) {
        echo "Регистрация прошла успешно. Добро пожаловать, $username!";
    } else {
        echo "Ошибка при регистрации: " . $stmt->error;
    }

    // Закрываем запрос и соединение с базой данных
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Timer</title>
</head>
<body>
    <h2>Вы будете перенаправлены на главную страницу через <span id="countdown">5</span> секунд.</h2>

    <script>
        // Функция для запуска таймера
        function startTimer(duration, redirectUrl) {
            let timer = duration;
            const countdownElement = document.getElementById('countdown');

            // Обновляем таймер каждую секунду
            const intervalId = setInterval(function () {
                countdownElement.textContent = timer;
                if (--timer < 0) {
                    clearInterval(intervalId);
                    window.location.href = redirectUrl; // Перенаправляем пользователя на главную страницу
                }
            }, 1000);
        }

        // Запускаем таймер при загрузке страницы
        window.onload = function () {
            const redirectUrl = 'index.php'; // Укажите адрес вашей главной страницы
            const duration = 5; // Продолжительность таймера в секундах
            startTimer(duration, redirectUrl);
        };
    </script>
</body>
</html>

