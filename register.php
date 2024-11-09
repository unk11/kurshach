<?php
session_start();

$host = 'localhost';
$dbname = 'sladosti';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к БД: " . $e->getMessage());
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $sql = "INSERT INTO users2 (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username, 'password' => $password]);

        $_SESSION['user'] = $username;
        header("Location: main.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() === '23000') {
            $message = "Ошибка: такое имя пользователя уже существует.";
        } else {
            $message = "Ошибка при регистрации: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style/autoreg.css">
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <?php if ($message): ?>
            <div class="message error">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        
        <form action="register.php" method="post">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <br>  <br>
            <input type="password" name="password" placeholder="Пароль" required>
            <br>  <br>
            <button type="submit">Зарегистрироваться</button>
        </form>
        <p>Уже есть аккаунт? <a href="./login.php">Войти</a></p>
    </div>
</body>
</html>
