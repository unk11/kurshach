<?php
session_start();
$host = 'localhost';
$db = 'sladosti';
$user = 'root';
$password = '';


$conn = new mysqli($host, $user, $password, $db);
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    die("Корзина пуста. Невозможно оформить заказ.");
}

if (!isset($_SESSION['user_id'])) {
    die("Пользователь не авторизован.");
}

$user_id = $_SESSION['user_id'];
$fio = $_POST['client_id'] ?? '';
$delivery_date = $_POST['delivery_date'] ?? '';
$delivery_time = $_POST['delivery_time'] ?? '';
$address = $_POST['address'] ?? '';
$payment_method = $_POST['payment_method'] ?? '';
$total_cost = $_POST['total_cost'] ?? 0;

$items_ordered = array_map(function($item) {
    return $item['name'];
}, $_SESSION['cart']);
$items_ordered_str = implode(', ', $items_ordered);

$total_quantity = array_reduce($_SESSION['cart'], function($sum, $item) {
    return $sum + (int)$item['quantity'];
}, 0);

if (empty($fio) || empty($delivery_date) || empty($delivery_time) || empty($address) || empty($items_ordered_str)) {
    die("Все поля должны быть заполнены.");
}

$sql = "INSERT INTO Orders (OrderDate, OrderTime, ItemsOrdered, TotalCost, FIO, Quantity, Address, client_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param(
        "sssdsisi",
        $delivery_date,
        $delivery_time,
        $items_ordered_str,
        $total_cost,
        $fio,
        $total_quantity,
        $address,
        $user_id
    );

    if ($stmt->execute()) {
        echo "Заказ успешно оформлен!";
        
        unset($_SESSION['cart']);
        header("Location: main.php");
        exit();
    } else {
        echo "Ошибка при оформлении заказа: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Ошибка подготовки запроса: " . $conn->error;
}

$conn->close();
?>
