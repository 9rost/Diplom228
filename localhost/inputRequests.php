<?php
include 'bd.php';
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Отправить запрос</title>
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
                    // Вывод ссылок
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
                    // Вывод ссылок
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
          // Вывод ссылок
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
 
    <div class="container">
    <h2>Отправить заявку</h2>

    <form action="developeRequests.php" method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="problem">Описание проблемы:</label>
            <textarea id="problem" name="problem" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="name">Ваше имя:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Электронная почта:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="additional-info">Дополнительная информация:</label>
            <textarea id="additional-info" name="additional-info" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="attachment">Прикрепленные файлы:</label>
            <input type="file" id="attachment" name="attachment" multiple>
        </div>
        <div class="form-group">
            <input type="checkbox" id="consent" name="consent" required>
            <label for="consent">Я согласен на обработку моих персональных данных в соответствии c <a href="#">политикой конфиденциальности</a> сайта.</label>
        </div>
        <button type="submit">Отправить</button>
    </form>
</div>



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
                    // Вывод ссылок
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