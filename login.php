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

    $stmt = $pdo->prepare("SELECT * FROM users2 WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $username, 'password' => $password]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['user'] = $username;
        $_SESSION['user_id'] = $user['id'];
        header("Location: main.php");
        exit();
    } else {
        $message = "Неверное имя пользователя или пароль.";
    }
}
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = 'admin';
    $password = 'password';

    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['loggedin'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Неверное имя пользователя или пароль.";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style/autoreg.css">
</head>
<body>
    <div class="container">
        <h2>Авторизация</h2>
        <?php if ($message): ?>
            <div class="message error">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Имя пользователя" required>
            <br>    <br>
            <input type="password" name="password" placeholder="Пароль" required>
            <br>  <br>
            <button type="submit">Войти</button>
        </form>
        <p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>
    </div>
</body>
</html>
