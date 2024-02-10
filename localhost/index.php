<?php
include 'bd.php';
    ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Главная</title>
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
 
        <?php
        $sql_content = "SELECT section_name, section_content FROM index_content";
        $result_content = $conn->query($sql_content);
        while($row_content = $result_content->fetch_assoc()) {
            echo "<section id='" . strtolower(str_replace(" ", "-", $row_content['section_name'])) . "'>";
            echo "<h2>" . $row_content['section_name'] . "</h2><br>";
            echo "<p>" . $row_content['section_content'] . "</p>";
            echo "</section><br><br>";
        }

        ?>
<section class="inpService">
    <a href="register.php" class="btn">Заказать перевод</a>
</section><br><br><br>
<h2>Наши работы:</h2> <br>
        <?php
        $sql_portfolio = "SELECT * FROM index_portfolio";
        $result_portfolio = $conn->query($sql_portfolio);
        if ($result_portfolio->num_rows > 0) {
        while($row_portfolio = $result_portfolio->fetch_assoc()) {
            echo "<div class='portfolio-item'>";
            echo "<h3>" . $row_portfolio['project_name'] . "</h3>";
            echo "<a href='" . $row_portfolio['project_url'] . "'><img src='" . $row_portfolio['project_image'] . "' alt='" . $row_portfolio['project_name'] . "'></a>";
            echo "<p>" . $row_portfolio['project_description'] . "</p>";
            echo "</div>";
        }
        } else {
        echo "0 results";
        }
        ?><br>
        <h2>Предоставляемые услуги:</h2><br>
        <?php
        $sql_serv = "SELECT * FROM index_services";
        $result_serv = $conn->query($sql_serv);
        if ($result_serv->num_rows > 0) {
          echo "<div class='services-container'>";
          while($row_serv = $result_serv->fetch_assoc()) {
            echo "<div class='service'>";
            echo "<img src='" . $row_serv['image_url'] . "' alt='Service Image'>";
            echo "<div class='service-text'>";
            echo "<p>" . $row_serv['description'] . "</p>";
            echo "</div>";
            echo "</div>";
          }
          echo "</div>";
        } else {
          echo "0 results";
        }

        $sql_services = "SELECT * FROM index_services_prices";
        $result_services = $conn->query($sql_services);
        if ($result_services->num_rows > 0) {
        echo "<h2>Услуги</h2><br>
         <table class='services-table'>
        <thead>
        <tr>
        <th>Язык</th>
        <th>Тип перевода</th>
        <th>Стоимость перевода за стр</th>
        </tr>
        </thead>
        <tbody>";
        while($row_services = $result_services->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_services['language'] . "</td>";
        echo "<td>" . $row_services['translator_type'] . "</td>";
        echo "<td>" . number_format($row_services['price_per_page'], 2, ',', ' ') . "</td>";
        echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        } else {
        echo "0 results";
        }

        ?>
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