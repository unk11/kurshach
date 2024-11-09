<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sladosti";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Соединение не удалось: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню</title>
    <link rel="stylesheet" href="style/menu.css">
</head>
<body>
    <header class="perehod">
        <nav>
            <ul>
                <li><a href="main.php">На главную</a></li>
                <li><a href="korzina.php">Корзина</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Меню</h1>
        <div class="menu-section">
            <h2>Выпечка и десерты</h2>
                <?php
                $sql = "SELECT * FROM Menu";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($item = $result->fetch_assoc()) {
                        echo '<div class="menu-item">';
                        echo '<div class="item-info">';
                        echo '<h3>' . htmlspecialchars($item['ItemName']) . '</h3>';
                        echo '<img src="images/' . htmlspecialchars($item['Image']) . '" alt="' . htmlspecialchars($item['ItemName']) . '" class="item-image">';
                        echo '<p>' . htmlspecialchars($item['Description']) . '</p>';
                        echo '</div>';
                        echo '<div class="item-details">';
                        echo '<div class="item-price">' . htmlspecialchars($item['Price']) . ' р.</div>';
                        echo '<form action="add_to_cart.php" method="post">';
                        echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($item['ItemName']) . '">';
                        echo '<input type="hidden" name="product_price" value="' . htmlspecialchars($item['Price']) . '">';
                        echo '<button type="submit" class="add-to-cart">Добавить в корзину</button>';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo 'Нет товаров в меню.';
                }
            ?>
        </div>
    </div>
</body>
</html>
