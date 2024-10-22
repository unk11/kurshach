<!DOCTYPE html>
<html lang="ru">
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
                <label for="delivery-date">Дата доставки:</label>
                <input type="date" id="delivery-date" name="delivery_date" required>
            </div>

            <div class="form-group">
                <label for="delivery-time">Время доставки:</label>
                <input type="time" id="delivery-time" name="delivery_time" required>
            </div>

            <div class="form-group">
                <label for="payment-method">Способ оплаты:</label>
                <select id="payment-method" name="payment_method" required>
                    <option value="cash">Наличными при получении</option>
                    <option value="card">Картой при получении</option>
                </select>
            </div>

            

            <div class="buttons">
                <button type="submit" class="submit-order">Подтвердить заказ</button>
                <a href="card.html" class="back-to-cart">Вернуться в корзину</a>
            </div>
        </form>
    </div>
</body>
</html>
