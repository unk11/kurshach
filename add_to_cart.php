<?php
session_start();

$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['name'] === $product_name) {
        $item['quantity'] += 1; 
        $found = true;
        break;
    }
}

if (!$found) {

    $_SESSION['cart'][] = [
        'name' => $product_name,
        'price' => $product_price,
        'quantity' => 1
    ];
}

header("Location: menu.php");
exit();
?>
