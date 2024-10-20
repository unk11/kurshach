<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <link rel="stylesheet" href="style/order.css">
</head>
<body>
    <div class="container">
        <h2>Оформление заказа</h2>

        <form action="submit_order.php" method="POST" class="order-form">

            <div class="form-group">
                <label for="client-id">ФИО:</label>
                <input type="text" id="client-id" name="client_id" required>
            </div>

            <div class="form-group">
                <label for="order-date">Дата заказа:</label>
                <input type="text" id="order-date" name="order_date" >
            </div>

            <div class="form-group">
                <label for="order-time">Время заказа:</label>
                <input type="text" id="order-time" name="order_time" >
            </div>

            <div class="form-group">
                <label for="quantity">Количество:</label>
                <input type="text"  name="quantity" >
            </div>

            <div class="form-group">
                <label for="total-sum">Итого:</label>
                <input type="text" id="total-sum" name="total_sum" >
            </div>

            <div class="buttons">
                <button type="submit" class="submit-order">Подтвердить заказ</button>
                <a href="card.html" class="back-to-cart">Вернуться в корзину</a>
            </div>
        </form>
    </div>
</head>
</html>