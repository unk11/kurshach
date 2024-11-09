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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $id = $_POST['id'];

    $itemName = $_POST['itemName'] ?? null; 
    $description = $_POST['description'] ?? null; 
    $price = $_POST['price'] ?? null; 
    $orderDate = $_POST['orderDate'] ?? null; 
    $orderTime = $_POST['orderTime'] ?? null; 
    $itemsOrdered = $_POST['itemsOrdered'] ?? null; 
    $totalCost = $_POST['totalCost'] ?? null; 
    $fio = $_POST['FIO'] ?? null; 
    $quantity = $_POST['quantity'] ?? null; 
    $supplyDate = $_POST['supplyDate'] ?? null; 
    $supplyQuantity = $_POST['supplyQuantity'] ?? null; 
    $supplier = $_POST['supplier'] ?? null; 
    $username = $_POST['username'] ?? null; 
    $password = $_POST['password'] ?? null; 


    switch ($table) {
        case 'Menu':
            $query = "UPDATE Menu SET ItemName=?, Description=?, Price=? WHERE ItemID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssdi", $itemName, $description, $price, $id);
            break;

        case 'Orders':
            $query = "UPDATE Orders SET OrderDate=?, OrderTime=?, ItemsOrdered=?, TotalCost=?, FIO=?, Quantity=? WHERE OrdersID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssdssi", $orderDate, $orderTime, $itemsOrdered, $totalCost, $fio, $quantity, $id);
            break;

        case 'Supplies':
            $query = "UPDATE Supplies SET SupplyDate=?, Quantity=?, Supplier=? WHERE SupplyID=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("issi", $supplyDate, $supplyQuantity, $supplier, $id);
            break;

        case 'Users2':
            $query = "UPDATE Users2 SET username=?, password=? WHERE id=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ssi", $username, $password, $id);
            break;

        default:
            die("Неизвестная таблица: $table");
    }

    if ($stmt->execute() === false) {
        die("Ошибка выполнения запроса: " . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $conn->close();
    header("Location: admin.php");
    exit();
} else {
    $table = $_GET['table'];
    $id = $_GET['id'];

    $query = "SELECT * FROM $table WHERE " . ($table === 'Menu' ? 'ItemID' : ($table === 'Orders' ? 'OrdersID' : ($table === 'Supplies' ? 'SupplyID' : 'id'))) . "=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение записи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Изменить запись</h1>

        <form method="POST" action="edit.php">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($table ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id ?? '', ENT_QUOTES, 'UTF-8'); ?>">

            <?php if ($table === 'Menu') : ?>
                <div class="form-group">
                    <label for="itemName">Название:</label>
                    <input type="text" class="form-control" id="itemName" name="itemName" value="<?php echo htmlspecialchars($item['ItemName'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Описание:</label>
                    <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($item['Description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['Price'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
            <?php endif; ?>

            <?php if ($table === 'Orders') : ?>
                <div class="form-group">
                    <label for="orderDate">Дата заказа:</label>
                    <input type="date" class="form-control" id="orderDate" name="orderDate" value="<?php echo htmlspecialchars($item['OrderDate'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="orderTime">Время заказа:</label>
                    <input type="time" class="form-control" id="orderTime" name="orderTime" value="<?php echo htmlspecialchars($item['OrderTime'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="itemsOrdered">Товары:</label>
                    <textarea class="form-control" id="itemsOrdered" name="itemsOrdered" required><?php echo htmlspecialchars($item['ItemsOrdered'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="totalCost">Итоговая сумма:</label>
                    <input type="number" class="form-control" id="totalCost" name="totalCost" value="<?php echo htmlspecialchars($item['TotalCost'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="FIO">ФИО:</label>
                    <input type="text" class="form-control" id="FIO" name="FIO" value="<?php echo htmlspecialchars($item['FIO'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="quantity">Количество:</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['Quantity'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
            <?php endif; ?>

            <?php if ($table === 'Supplies') : ?>
                <div class="form-group">
                    <label for="supplyDate">Дата поставки:</label>
                    <input type="date" class="form-control" id="supplyDate" name="supplyDate" value="<?php echo htmlspecialchars($item['SupplyDate'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="supplyQuantity">Количество:</label>
                    <input type="number" class="form-control" id="supplyQuantity" name="supplyQuantity" value="<?php echo htmlspecialchars($item['Quantity'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="supplier">Поставщик:</label>
                    <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo htmlspecialchars($item['Supplier'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
            <?php endif; ?>

            <?php if ($table === 'Users2') : ?>
                <div class="form-group">
                    <label for="username">Имя пользователя:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($item['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="text" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($item['password'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
            <a href="admin.php" class="btn btn-secondary">Назад</a>
        </form>
    </div>
</body>
</html>
