<?php
session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];  
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'] ?? '';
    $product_price = $_POST['product_price'] ?? 0;
    $quantity = $_POST['quantity'] ?? 1;

    $found = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['name'] === $product_name) {
            $item['quantity'] += $quantity;  
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => $quantity,
        ];
    }
    header("Location: korzina.php");
    exit();
}

if (isset($_GET['remove'])) {
    $product_name = $_GET['remove'];
    foreach ($_SESSION['cart'] as $key => $item) {
        if (is_array($item) && $item['name'] === $product_name) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    header("Location: korzina.php");
    exit();
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    if (is_array($item)) {
        $total += (int)($item['price'] ?? 0) * (int)($item['quantity'] ?? 0);
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="style/korzina.css">
</head>
<body>
    <div class="container">
        <h2>Ваша корзина</h2>

        <table class="cart-table">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th>Итого</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($_SESSION['cart'])): ?>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <?php if (is_array($item)): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['name'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= (int)($item['quantity'] ?? 0) ?></td>
                                <td><?= (int)($item['price'] ?? 0) ?> р.</td>
                                <td><?= (int)($item['price'] ?? 0) * (int)($item['quantity'] ?? 0) ?> р.</td>
                                <td>
                                    <a href="korzina.php?remove=<?= urlencode($item['name']) ?>">Удалить</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Корзина пуста</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="total">
            <p><strong>Общая сумма: <?= $total ?> р.</strong></p>
        </div>

        <div class="buttons">
            <a href="menu.php" class="continue">Продолжить покупки</a>
            <button class="checkout">Оформить заказ</button>
        </div>
    </div>
</body>
</html>
