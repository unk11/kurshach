<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="style/main.css">
    
</head>
<body>
    <header>
        <div class="logo">
            <img class="logotip" src="images/crousan.png" alt="Логотип" >
        </div>
        <button class="hamburger">&#9776;</button>
        <div class="nav-container">
            <ul class="nav-menu">
                <li><a href="./menu.php">Меню</a></li>
                <li><a href="#text">О нас</a></li>
                <li><a href="./korzina.php">Корзина</a></li>
            </ul>
        </div>
        <div class="buttons">
            <?php if (isset($_SESSION['user'])): ?>
                <form action="logout.php" method="post" style="display:inline;">
                    <button class="sing" type="submit">Выйти</button>
                </form>
            <?php else: ?>
                <a href="./login.php">
                    <button class="sing">Войти</button>
                </a>
                <a href="./register.php">
                    <button class="sing">Зарегистрироваться</button>
                </a>
            <?php endif; ?>
        </div>
    </header>

    <script>
        const hamburger = document.querySelector('.hamburger');
        const navMenu = document.querySelector('.nav-menu');

        hamburger.addEventListener('click', () => {
            navMenu.classList.toggle('show-menu');
        });
    </script>    

<main>
    <img class="img" src="images/asdasd.png" alt="">
    <h1 class="prod">Наша продукция</h1>
    <div class="wrapper">
        <div class="products">
            <a href="menu.php" class="card">
                <img class="card_img" src="images/tort.jpg" >
                <div class="card-text">Торты <br> ОТ 950 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/pirojnie.jpg" alt="">
                <div class="card-text">ПИРОЖНЫЕ <br> ОТ 90 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/kruassany.jpg" alt="" >
                <div class="card-text">КРУАССАНЫ <br> ОТ 75 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/baget.jpg" alt="">
                <div class="card-text">БАГЕТЫ <br> ОТ 70 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/shrtudeli.jpg" alt="">
                <div class="card-text">ШТРУДЕЛИ <br> ОТ 240 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/cheez.jpg" alt="">
                <div class="card-text">ЧИЗКЕЙКИ <br> ОТ 240 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/tir.jpg" alt="">
                <div class="card-text">ТИРАМИСУ <br> ОТ 260 р.</div>
            </a>
            <a href="menu.php" class="card">
                <img class="card_img" src="images/maff.png" alt="">
                <div class="card-text">МАФФИНЫ <br> ОТ 110 р.</div>
            </a>
        </div>
    </div>  
</main>
    <div class="content">
        <h1>Добро пожаловать в кондитерскую «Сахарок»!</h1>
        <p>Давайте расскажем немного о нашей кондитерской и том, что мы предлагаем. Кондитерская «Сахарок» работает с 2018 года, и за это время мы накопили солидный опыт в создании тортов для жителей Перми.</p>
        
        <p>В дополнение к тортам у нас представлен широкий ассортимент свежей выпечки и десертов: <strong>капкейки, чизкейки, эклеры, пирожные «Картошка», воздушные зефиры, маффины</strong> и ароматные пряники!</p>

        <p><em>Мы используем только натуральные и свежие ингредиенты</em>, тщательно подбирая составы, чтобы наши изделия радовали и взрослых, и детей. Каждая деталь имеет значение: от воздушного бисквита до нежного крема и насыщенного шоколада.</p>

        <h2>Индивидуальный подход к каждому заказу</h2>
        <p>Наши специалисты с удовольствием помогут вам определиться с дизайном и начинкой торта, а также подберут оптимальный вес, чтобы ваше событие стало по-настоящему незабываемым.</p>

        <h2>Цены и заказ</h2>
        <p>На нашем сайте вы легко найдете торт на любой вкус и кошелек – <strong>цены стартуют от 950 рублей!</strong></p>
        <p>Чтобы сделать заказ, выберите понравившийся торт в каталоге и заполните форму на сайте или свяжитесь с нами по телефону, указанному в меню на главной странице.</p>

        <p class="highlight">Мы с нетерпением ждем возможности стать частью вашего праздника!</p>
    </div>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h3 id="text">О нас</h3>
                <p>Кондитерская «Сахарок» с 2018 года радует жителей Перми вкусными тортами и десертами. Мы используем только натуральные ингредиенты и создаем сладости для любых событий!</p>
            </div>
    
            <div class="footer-section contact">
                <h3>Контакты</h3>
                <p>Пермь, ул. Сладкая, 10</p>
                <p>Телефон: <a href="+79991234567">+7 (999) 123-45-67</a></p>
                <p>Время работы: Пн–Вс, с 9:00 до 21:00</p>
            </div>
    
            <div class="footer-section social">
                <h3>Мы в соцсетях</h3>
                <a href="#" class="social-link">Instagram</a> | 
                <a href="#" class="social-link">ВКонтакте</a> | 
                <a href="#" class="social-link">Telegram</a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2024 Сахарок. Все права защищены.</p>
        </div>
    </footer>
    
</body>
</html>