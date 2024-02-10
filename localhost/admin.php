<?php

include 'bd.php';
session_start();

if ($_SESSION['user_type'] !== 'admin') {
    echo "Пошли нафиг отсюда";
    exit();
}

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['section_name']) && isset($_POST['section_content']) && $_POST["submit"] == "Добавить контент") {
    $section_name = $_POST['section_name'];
    $section_content = $_POST['section_content'];
    
    header("Location: admin.php");
    $sql_insert_content = "INSERT INTO index_content (section_name, section_content) VALUES (?, ?)";
    $stmt_insert_content = $conn->prepare($sql_insert_content);
    $stmt_insert_content->bind_param("ss", $section_name, $section_content);
    
    if ($stmt_insert_content->execute()) {
        echo "Новый контент успешно добавлен.";
    } else {
        echo "Ошибка: " . $stmt_insert_content->error;
    }
    $stmt_insert_content->close();
}

else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['project_name']) && isset($_POST['project_description']) && isset($_POST['project_url']) && isset($_POST['project_image']) && $_POST["submit"] == "Добавить портфолио") {
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $project_url = $_POST['project_url'];
    $project_image = $_POST['project_image'];
    header("Location: admin.php");
    $sql_insert_project = "INSERT INTO index_portfolio (project_name, project_description, project_url, project_image) VALUES (?, ?, ?, ?)";
    $stmt_insert_project = $conn->prepare($sql_insert_project);
    $stmt_insert_project->bind_param("ssss", $project_name, $project_description, $project_url, $project_image);
    
    if ($stmt_insert_project->execute()) {
        echo "Новый проект успешно добавлен в портфолио.";
    } else {
        echo "Ошибка: " . $stmt_insert_project->error;
    }
    $stmt_insert_project->close();
}



else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['price_language']) && isset($_POST['price_translator_type']) && isset($_POST['price_per_page'])) {
    $price_language = $_POST['price_language'];
    $price_translator_type = $_POST['price_translator_type'];
    $price_per_page = $_POST['price_per_page'];
    header("Location: admin.php");
    $sql_insert_price = "INSERT INTO index_services_prices (language, translator_type, price_per_page) VALUES (?, ?, ?)";
    $stmt_insert_price = $conn->prepare($sql_insert_price);
    $stmt_insert_price->bind_param("sss", $price_language, $price_translator_type, $price_per_page);
    
    if ($stmt_insert_price->execute()) {
        echo "Новая цена успешно добавлена.";
    } else {
        echo "Ошибка: " . $stmt_insert_price->error;
    }
    $stmt_insert_price->close();
}

else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['description']) && isset($_POST['image_url'])) {
    $description = $_POST['description'];
    $image_url = $_POST['image_url'];
    header("Location: admin.php");
    $sql_insert_service = "INSERT INTO index_services (description, image_url) VALUES (?, ?)";
    $stmt_insert_service = $conn->prepare($sql_insert_service);
    $stmt_insert_service->bind_param("ss", $description, $image_url);
    
    if ($stmt_insert_service->execute()) {
        echo "Новая услуга успешно добавлена.";
    } else {
        echo "Ошибка: " . $stmt_insert_service->error;
    }
    $stmt_insert_service->close();
}


$sql_services = "SELECT * FROM index_services";
$result_services = $conn->query($sql_services);

$sql_prices = "SELECT * FROM index_services_prices";
$result_prices = $conn->query($sql_prices);

$sql_portfolio = "SELECT * FROM index_portfolio";
$result_portfolio = $conn->query($sql_portfolio);

$sql_content = "SELECT * FROM index_content";
$result_content = $conn->query($sql_content);


$options = ''; // Переменная для хранения опций списка

$sql = "SELECT portfolio_id, project_name FROM index_portfolio";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $options .= "<option value='" . $row["portfolio_id"] . "'>" . $row["project_name"] . "</option>";
    }
} else {
    $options = "0 результатов";
}


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Администратор</title>
    <link rel="stylesheet" href="assets/style.css">
    <script src="assets/script.js"></script>
</head>
<body>
<div class="header">
    
<div class="left">
    <div class="logotype">
        <a href="index.php"><img src="assets/img/log.png"></a>
    </div>
    <div class="navbar">
        <div class="avatar-container top-margin">
        <?php
                $parent_id_to_select = 1;
                $sql = "SELECT title, link FROM menu_items WHERE parent_id = $parent_id_to_select";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='" . $row["link"] . "'>" . $row["title"] . "</a>";
                    }
                } else {
                    echo "0 результатов";
                }
                ?>
            <div class="dropdown">
            <?php
                $parent_id_to_select = 2; 
                $sql = "SELECT title, link FROM menu_items WHERE parent_id = $parent_id_to_select";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='" . $row["link"] . "'>" . $row["title"] . "</a>";
                    }
                } else {
                    echo "0 результатов";
                }
                ?>
            </div>
        </div>
    </div>

</div><div class="right">
  
    <div class="navbar">
        <?php
        $parent_id_to_select = 3;
        $sql = "SELECT title, link FROM menu_items WHERE parent_id = $parent_id_to_select";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              echo "<a href='" . $row["link"] . "'>" . $row["title"] . "</a>";
          }
        } else {
          echo "0 результатов";
        }
      ?>
      </div>

    <div class="navbar_view iconMess"><a href="message.html"><img src="assets/img/iconMessange.png"></a></div>
    <div class="avatar-container">
        <div class="avatar">
            <img src="assets/img/avatar.jpg" alt="User Avatar">
        </div>
        <div class="dropdown">
            <div class="navbar_view">
                <?php
                $parent_id_to_select = 4;
                $sql = "SELECT title, link FROM menu_items WHERE parent_id = $parent_id_to_select";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='" . $row["link"] . "'>" . $row["title"] . "</a>";
                    }
                } else {
                    echo "0 результатов";
                }
                ?>
            </div>
            <div class="navbar1">
            <?php
                $parent_id_to_select = 5;
                $sql = "SELECT title, link FROM menu_items WHERE parent_id = $parent_id_to_select";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='" . $row["link"] . "'>" . $row["title"] . "</a>";
                    }
                } else {
                    echo "0 результатов";
                }
                ?>
            </div>
            
        </div>
    </div>
</div>
</div>
<hr>
    <div class="main">
    <h2>Добавление контента</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="section_name">Название секции:</label><br>
            <input type="text" id="section_name" name="section_name" required><br><br>
            <label for="section_content">Содержание секции:</label><br>
            <textarea id="section_content" name="section_content" rows="4" required></textarea><br><br>
            <input type="submit" name="submit" value="Добавить контент">
        </form><br>
        <h2>Редактирование информации</h2>
    <form action="processcontent.php" method="post">
        <input type="hidden" name="action" value="edit">
        <label for="edit_section_id">Выберите раздел для редактирования:</label><br>
        <select id="edit_section_id" name="edit_section_id" required>
            <?php
            $sql = "SELECT section_id, section_name FROM index_content";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["section_id"] . "'>" . $row["section_name"] . "</option>";
                }
            } else {
                echo "0 результатов";
            }
            ?>
        </select><br><br>
        <label for="edit_section_content">Новое содержимое раздела:</label><br>
        <textarea id="edit_section_content" name="edit_section_content" required></textarea><br><br>
        <input type="submit" value="Редактировать информацию">
    </form>

        <h2>Удаление информации</h2>
    <form action="processcontent.php" method="post">
        <input type="hidden" name="action" value="delete">
        <label for="delete_section_id">Выберите раздел для удаления:</label><br>
        <select id="delete_section_id" name="delete_section_id" required>
            <?php
            $sql = "SELECT section_id, section_name FROM index_content";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["section_id"] . "'>" . $row["section_name"] . "</option>";
                }
            } else {
                echo "0 результатов";
            }


            ?>
        </select><br><br>
        <input type="submit" value="Удалить информацию">
    </form>






        <h2>Добавление портфолио</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="project_name">Название проекта:</label><br>
            <input type="text" id="project_name" name="project_name" required><br><br>
            <label for="project_description">Описание проекта:</label><br>
            <textarea id="project_description" name="project_description" rows="4" required></textarea><br><br>
            <label for="project_url">Ссылка на проект:</label><br>
            <input type="text" id="project_url" name="project_url" required><br><br>
            <label for="project_image">URL изображения проекта:</label><br>
            <input type="text" id="project_image" name="project_image" required><br><br>
            <input type="submit" name="submit" value="Добавить портфолио">
        </form><br><br>

        <h2>Редактирование портфолио</h2>
        <form action="edit_portfolio.php" method="post">
    <label for="edit_project">Выберите проект для редактирования:</label><br>
    <select name="edit_portfolio_id" id="edit_project">
        <?php echo $options; ?>
    </select><br><br>
    <label for="edit_project_name">Название проекта:</label><br>
    <input type="text" id="edit_project_name" name="edit_project_name" required><br><br>
    <label for="edit_project_description">Описание проекта:</label><br>
    <textarea id="edit_project_description" name="edit_project_description" rows="4" cols="50" required></textarea><br><br>
    <label for="edit_project_url">URL проекта:</label><br>
    <input type="text" id="edit_project_url" name="edit_project_url" required><br><br>
    <label for="edit_project_image">URL изображения проекта:</label><br>
    <input type="text" id="edit_project_image" name="edit_project_image" required><br><br>
    <input type="hidden" name="action" value="edit">
    <input type="submit" value="Редактировать проект">
</form>

                    
        <br><br><h2>Удалить портфолио</h2>  
        <form action="delete_portfolio.php" method="post">
    <label for="delete_project">Выберите проект для удаления:</label><br>
    <select name="delete_portfolio_id" id="delete_project">
        <?php echo $options; ?>
    </select><br><br>
    <input type="hidden" name="action" value="delete">
    <input type="submit" value="Удалить проект">
</form>



        <br><br>


        
    <br><br>
    <h2>Добавление услуги</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="description">Описание услуги:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>
        <label for="image_url">URL изображения услуги:</label><br>
        <input type="text" id="image_url" name="image_url" required><br><br>
        <input type="submit" name="submit" value="Добавить услугу">
    </form>
</div>


<h2>Редактировать услугу</h2>
    <form action="processservices.php" method="post">
        <label for="edit_service">Выберите услугу для редактирования:</label><br>
        <select name="edit_service" id="edit_service">
            <?php
                $sql = "SELECT service_id, description FROM index_services";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['service_id'] . "'>" . $row['description'] . "</option>";
                    }
                } else {
                    echo "0 results";
                }
            ?>
        </select><br><br>
        <label for="edit_description">Описание услуги:</label><br>
        <textarea id="edit_description" name="edit_description" rows="4" cols="50" required></textarea><br><br>
        <label for="edit_image_url">URL изображения:</label><br>
        <input type="text" id="edit_image_url" name="edit_image_url" required><br><br>
        <input type="hidden" name="edit_service_id" id="edit_service_id">
        <input type="hidden" name="action" value="edit">
        <input type="submit" value="Редактировать услугу">
    </form>
<br><br> <h2>Удалить услугу</h2>
    <form action="processservices.php" method="post">
        <label for="delete_service">Выберите услугу для удаления:</label><br>
        <select name="delete_service" id="delete_service">
            <?php
                $sql = "SELECT service_id, description FROM index_services";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['service_id'] . "'>" . $row['description'] . "</option>";
                    }
                } else {
                    echo "0 results";
                }

            ?>
        </select><br><br>
        <input type="hidden" name="delete_service_id" id="delete_service_id">
        <input type="hidden" name="action" value="delete">
        <input type="submit" value="Удалить услугу">
    </form>

    <h2>Добавление цены для услуги</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="price_language">Язык:</label><br>
    <input type="text" id="price_language" name="price_language" required><br><br>
    <label for="price_translator_type">Тип переводчика:</label><br>
    <input type="text" id="price_translator_type" name="price_translator_type" required><br><br>
    <label for="price_per_page">Цена за страницу:</label><br>
    <input type="text" id="price_per_page" name="price_per_page" required><br><br>
    <input type="submit" name="submit" value="Добавить цену">
</form><br><br>

<h2>Редактирование цены на услуги</h2>
<form method="post" action="process_services_prices.php">
    <label for="price_id">Выберите для редактирования:</label><br>
    <select id="price_id" name="price_id">
        <?php
        $sql = "SELECT price_id, language, translator_type FROM index_services_prices";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["price_id"] . "'>" . $row["language"] . " - " . $row["translator_type"] . "</option>";
            }
        }
        ?>
    </select>
    <br><br>
    <label for="new_language">Новый язык:</label>
    <input type="text" id="new_language" name="new_language">
    <br><br>
    <label for="new_translator_type">Новый тип переводчика:</label>
    <input type="text" id="new_translator_type" name="new_translator_type">
    <br><br>
    <label for="new_price_per_page">Новая цена за страницу:</label>
    <input type="text" id="new_price_per_page" name="new_price_per_page">
    <br><br>
    <input type="submit" name="edit_submit" value="Редактировать">
</form><br><br>
<form method="post" action="process_services_prices.php">
    <label for="price_id">Выберите для удаления:</label><br>
    <select id="price_id" name="price_id">
        <?php
        
        $sql = "SELECT price_id, language, translator_type FROM index_services_prices";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["price_id"] . "'>" . $row["language"] . " - " . $row["translator_type"] . "</option>";
            }
        }
        ?>
    </select>
    <br><br>
    <input type="submit" name="delete_submit" value="Удалить">
</form>






        <br><br>
        <h2>Добавление меню</h2>
        <p> ПОМОЩЬ!!! 1 - Помощь, 2 - выпадающий список в помощи, 3 - навигационное меню,
            4 - видимое меню при адаптации, 5 - выпадающий список на аватарке, 6 - footer <br>

        <form action="add_menu_item.php" method="post">
        <label for="title">Заголовок:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="link">Ссылка:</label><br>
        <input type="text" id="link" name="link"><br>
        <label for="parent_id">ID родительского элемента (если есть):</label><br>
        <input type="text" id="parent_id" name="parent_id"><br>
        <input type="submit" value="Добавить">
        </form><br><br>


        <h2>Редактирование меню</h2> <br>
        <form action="edit_menu_item.php" method="post">
            <label for="edit_id">Выберите элемент для редактирования:</label><br>
            <select id="edit_id" name="edit_id">
                <?php
                $sql = "SELECT id, title FROM menu_items";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Нет доступных элементов для выбора</option>";
                }

                ?>
            </select><br>
            <label for="new_title">Новый заголовок:</label><br>
            <input type="text" id="new_title" name="new_title"><br>
            <label for="new_link">Новая ссылка:</label><br>
            <input type="text" id="new_link" name="new_link"><br>
            <label for="new_parent_id">Новый ID родительского элемента (если есть):</label><br>
            <input type="text" id="new_parent_id" name="new_parent_id"><br>
            <input type="submit" value="Редактировать">
        </form>
                <h2>Удаление меню</h2>
        <form action="delete_menu_item.php" method="post">
            <label for="delete_id">Выберите элемент для удаления:</label><br>
            <select id="delete_id" name="delete_id">
            <?php
                $sql = "SELECT id, title FROM menu_items";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["id"] . "'>" . $row["title"] . "</option>";
                    }
                } else {
                    echo "<option value=''>Нет доступных элементов для выбора</option>";
                }

                ?>
            </select><br>
            <input type="submit" value="Удалить">
        </form><br><br>
        <h2>Добавить новую запись на странице Политика Конфиденциальности</h2><br>
        <form action="add_private_policy.php" method="post">
        <label for="section_content">Содержание раздела:</label><br>
        <textarea id="section_content" name="section_content"></textarea><br>
        <input type="submit" value="Добавить">
        </form><br><br>

        <h2>Редактировать запись на странице Политика Конфиденциальности</h2>
        <form action="process_private_policy.php" method="post">
        <label for="edit_section_id">Выберите раздел для редактирования:</label><br>
        <select id="edit_section_id" name="edit_section_id">
            <?php
            $sql = "SELECT section_id, section_content FROM privatepolicy";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["section_id"] . "'>" . $row["section_content"] . "</option>";
                }
            } else {
                echo "<option value=''>Нет доступных элементов для выбора</option>";
            }
            ?>
        </select><br>
        <label for="edit_section_content">Новое содержание раздела:</label><br>
        <textarea id="edit_section_content" name="edit_section_content"></textarea><br>
        <input type="submit" value="Редактировать">
        </form><br><br>

        <h2>Удалить запись на странице Политика Конфиденциальности</h2>
        <form action="process_private_policy.php" method="post">
        <label for="section_id">Выберите раздел для удаления:</label><br>
        <select id="section_id" name="section_id">
        <?php
            $sql = "SELECT section_id, section_content FROM privatepolicy";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["section_id"] . "'>" . $row["section_content"] . "</option>";
                }
            } else {
                echo "<option value=''>Нет доступных элементов для выбора</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Удалить">
        </form><br><br>



        <h2>Добавить новую запись на странице Политика Cookie</h2><br>
        <form action="add_private_cookie.php" method="post">
        <label for="section_content">Содержание раздела:</label><br>
        <textarea id="section_content" name="section_content"></textarea><br>
        <input type="submit" value="Добавить">
        </form><br><br>

        <h2>Редактировать запись на странице Политика Cookie</h2>
        <form action="process_private_cookie.php" method="post">
        <label for="edit_section_id">Выберите раздел для редактирования:</label><br>
        <select id="edit_section_id" name="edit_section_id">
        <?php
            $sql = "SELECT section_id, section_content FROM privatecookie";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["section_id"] . "'>" . $row["section_content"] . "</option>";
                }
            } else {
                echo "<option value=''>Нет доступных элементов для выбора</option>";
            }
            ?>
        </select><br>
        <label for="edit_section_content">Новое содержание раздела:</label><br>
        <textarea id="edit_section_content" name="edit_section_content"></textarea><br>
        <input type="submit" value="Редактировать">
        </form><br><br>


        <h2>Удалить запись на странице Политика Cookie</h2>
        <form action="process_private_cookie.php" method="post">
        <label for="section_id">Выберите раздел для удаления:</label><br>
        <select id="section_id" name="section_id">
        <?php
            $sql = "SELECT section_id, section_content FROM privatecookie";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["section_id"] . "'>" . $row["section_content"] . "</option>";
                }
            } else {
                echo "<option value=''>Нет доступных элементов для выбора</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Удалить">
        </form><br><br>


        <h2>Добавление информации Правила</h2>
    <form action="processhelp.php" method="post">
        <input type="hidden" name="action" value="add">
        <label for="section_id">ID раздела:</label><br>
        <input type="text" id="section_id" name="section_id" required><br><br>
        <label for="section_content">Содержимое раздела:</label><br>
        <textarea id="section_content" name="section_content" required></textarea><br><br>
        <input type="submit" value="Добавить информацию">
    </form>

    <h2>Редактирование информации Правила</h2>
    <form action="processhelp.php" method="post">
        <input type="hidden" name="action" value="edit">
        <label for="edit_section_id">ID раздела для редактирования:</label><br>
        <input type="text" id="edit_section_id" name="edit_section_id" required><br><br>
        <label for="edit_section_content">Новое содержимое раздела:</label><br>
        <textarea id="edit_section_content" name="edit_section_content" required></textarea><br><br>
        <input type="submit" value="Редактировать информацию">
    </form>

    <h2>Удаление информации Правила</h2>
    <form action="processhelp.php" method="post">
        <input type="hidden" name="action" value="delete">
        <label for="delete_section_id">ID раздела для удаления:</label><br>
        <input type="text" id="delete_section_id" name="delete_section_id" required><br><br>
        <input type="submit" value="Удалить информацию">
    </form>
    </div>


    <footer>
    <hr>
    <div class="footer-content">
        <span>© 2024 LingoLink</span>
        
        <?php
                $parent_id_to_select = 6;
                $sql = "SELECT title, link FROM menu_items WHERE parent_id = $parent_id_to_select";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<a href='" . $row["link"] . "'>" . $row["title"] . "</a>";
                    }
                } else {
                    echo "0 результатов";
                }
                ?><br><br>
        <div class="social-links">
            <a href="#"><img src="assets/img/tg.png" alt="Telegram"></a>
            <a href="#"><img src="assets/img/vk.png" alt="VK"></a>
            <a href="#"><img src="assets/img/yt.png" alt="YouTube"></a>
            <a href="#"><img src="assets/img/fb.png" alt="Facebook"></a>
        </div><br>
    </div>
</footer>





</body>
</html>



<?php
$conn->close();
?>