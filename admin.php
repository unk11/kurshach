<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

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
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Админ-Панель</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать в админ-панель!</h1>
        <a href="logout.php" class="btn btn-danger" style="float: right;">Выход</a>

        <form method="post" class="text-center">
    <div class="form-group">
        <div class="input-group">
            <select name="table" id="table_select" class="form-control">
                <option value="Menu">Меню</option>
                <option value="Orders">Заказы</option>
                <option value="Supplies">Поставки</option>
                <option value="Users2">Пользователи</option>
            </select>

        </div>
    </div>
    <input type="submit" value="Показать таблицу" class="btn btn-primary">
    <a href="add.php" class="btn btn-primary">Добавить запись</a>
</form>


        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table'])) {
            $table = $_POST['table'];
            
            $query = "SELECT * FROM $table";
            $result = $conn->query($query);

            if ($result && $result->num_rows > 0) {
                echo '<div class="mt-4">';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-body">';

                    if ($table === 'Menu') {
                        echo '<h4>Название: ' . htmlspecialchars($row['ItemName']) . '</h4>';
                        echo '<p><strong>Описание:</strong> ' . htmlspecialchars($row['Description']) . '</p>';
                        echo '<p><strong>Цена:</strong> ' . htmlspecialchars($row['Price']) . ' руб.</p>';

                        echo '<a href="edit.php?id=' . htmlspecialchars($row['ItemID']) . '&table=' . $table . '" class="btn btn-warning">Изменить</a> ';
                        echo '<a href="delete.php?id=' . htmlspecialchars($row['ItemID']) . '&table=' . $table . '" class="btn btn-danger">Удалить</a>';
                    } elseif ($table === 'Orders') {
                        echo '<h4>Номер заказа: ' . htmlspecialchars($row['OrdersID']) . '</h4>';
                        echo '<p><strong>ФИО:</strong> ' . htmlspecialchars($row['FIO']) . '</p>';
                        echo '<p><strong>Дата заказа:</strong> ' . htmlspecialchars($row['OrderDate']) . '</p>';
                        echo '<p><strong>Время заказа:</strong> ' . htmlspecialchars($row['OrderTime']) . '</p>';
                        echo '<p><strong>Количество товаров:</strong> ' . htmlspecialchars($row['Quantity']) . '</p>';
                        echo '<p><strong>Итоговая сумма:</strong> ' . htmlspecialchars($row['TotalCost']) . ' руб.</p>';
                        

                        echo '<a href="edit.php?id=' . htmlspecialchars($row['OrdersID']) . '&table=' . $table . '" class="btn btn-warning">Изменить</a> ';
                        echo '<a href="delete.php?id=' . htmlspecialchars($row['OrdersID']) . '&table=' . $table . '" class="btn btn-danger">Удалить</a>';
                    } elseif ($table === 'Supplies') {
                        echo '<h4>Номер поставки: ' . htmlspecialchars($row['SupplyID']) . '</h4>';
                        echo '<p><strong>ID товара:</strong> ' . htmlspecialchars($row['ItemID']) . '</p>';
                        echo '<p><strong>Дата поставки:</strong> ' . htmlspecialchars($row['SupplyDate']) . '</p>';
                        echo '<p><strong>Количество:</strong> ' . htmlspecialchars($row['Quantity']) . '</p>';
                        echo '<p><strong>Поставщик:</strong> ' . htmlspecialchars($row['Supplier']) . '</p>';

                        echo '<a href="edit.php?id=' . htmlspecialchars($row['SupplyID']) . '&table=' . $table . '" class="btn btn-warning">Изменить</a> ';
                        echo '<a href="delete.php?id=' . htmlspecialchars($row['SupplyID']) . '&table=' . $table . '" class="btn btn-danger">Удалить</a>';
                    } elseif ($table === 'Users2') {
                        echo '<h4>Имя пользователя: ' . htmlspecialchars($row['username']) . '</h4>';
                        echo '<p><strong>ID:</strong> ' . htmlspecialchars($row['id']) . '</p>';
                        echo '<p><strong>Пароль:</strong> ' . htmlspecialchars($row['password']) . '</p>';

                        echo '<a href="edit.php?id=' . htmlspecialchars($row['id']) . '&table=' . $table . '" class="btn btn-warning">Изменить</a> ';
                        echo '<a href="delete.php?id=' . htmlspecialchars($row['id']) . '&table=' . $table . '" class="btn btn-danger">Удалить</a>';
                    }

                    echo '</div>'; 
                    echo '</div>'; 
                }
                echo '</div>';
            } else {
                echo "<div class='alert alert-info mt-4'>Нет данных в таблице.</div>";
            }
            $conn->close();
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
