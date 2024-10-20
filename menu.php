<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню</title>
    <link rel="stylesheet" href="style/menu.css">
</head>
<body>
    <div class="container">
        <h1>Меню</h1>

        <div class="menu-section">
            <h2>Выпечка и десерты</h2>

            <div class="menu-item">
    <div class="item-info">
        <h3>Торты</h3>
        <img src="images/tort.jpg" alt="Торты" class="item-image">
        <p>Нежный торт ручной работы.</p>
    </div>
    <div class="item-details">
        <div class="item-price">950 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Торт">
            <input type="hidden" name="product_price" value="950">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Пирожное</h3>
        <img src="images/pirojnie.jpg" alt="Пирожные" class="item-image">
        <p>Изысканныое пирожное, идеальное для праздников и будней.</p>
    </div>
    <div class="item-details">
        <div class="item-price">90 р.</div>
            <form action="add_to_cart.php" method="post" class="add-to-cart-form">
            <input type="hidden" name="product_name" value="Пирожное">
            <input type="hidden" name="product_price" value="90">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
            </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Круассан</h3>
        <img src="images/kruassany.jpg" alt="Круассаны" class="item-image">
        <p>Хрустящий круассан.</p>
    </div>
    <div class="item-details">
        <div class="item-price">75 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Круассан">
            <input type="hidden" name="product_price" value="75">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Багет</h3>
        <img src="images/baget.jpg" alt="Багеты" class="item-image">
        <p>Французский багет с хрустящей корочкой.</p>
    </div>
    <div class="item-details">
        <div class="item-price">70 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Багет">
            <input type="hidden" name="product_price" value="70">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Штрудель</h3>
        <img src="images/shrtudeli.jpg" alt="Штрудели" class="item-image">
        <p>Ароматный штрудель с яблоками и корицей.</p>
    </div>
    <div class="item-details">
        <div class="item-price">240 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Штрудель">
            <input type="hidden" name="product_price" value="240">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Чизкейк</h3>
        <img src="images/cheez.jpg" alt="Чизкейки" class="item-image">
        <p>Нежный чизкейк.</p>
    </div>
    <div class="item-details">
        <div class="item-price">240 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Чизкейк">
            <input type="hidden" name="product_price" value="240">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Тирамису</h3>
        <img src="images/tir.jpg" alt="Тирамису" class="item-image">
        <p>Классический итальянский десерт с ароматом кофе.</p>
    </div>
    <div class="item-details">
        <div class="item-price">260 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Тирамису">
            <input type="hidden" name="product_price" value="260">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>

<div class="menu-item">
    <div class="item-info">
        <h3>Маффин</h3>
        <img src="images/maff.png" alt="Маффины" class="item-image">
        <p>Пышный маффин с разнообразными вкусами.</p>
    </div>
    <div class="item-details">
        <div class="item-price">110 р.</div>
        <form action="add_to_cart.php" method="post">
            <input type="hidden" name="product_name" value="Маффин">
            <input type="hidden" name="product_price" value="110">
            <button type="submit" class="add-to-cart">Добавить в корзину</button>
        </form>
    </div>
</div>
</body>
</html>