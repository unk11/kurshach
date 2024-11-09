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

    $query = "DELETE FROM $table WHERE " . 
             ($table === 'Menu' ? 'ItemID' : 
             ($table === 'Orders' ? 'OrdersID' : 
             ($table === 'Supplies' ? 'SupplyID' : 'id'))) . " = ?";

    $stmt = $conn->prepare($query);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->error) {
            die("Ошибка выполнения запроса: " . htmlspecialchars($stmt->error));
        }

        $stmt->close();
    } else {
        die("Ошибка подготовки запроса: " . htmlspecialchars($conn->error));
    }

    $conn->close();
    header("Location: admin.php");
    exit();
} else {
    $table = $_GET['table'] ?? '';
    $id = $_GET['id'] ?? '';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удаление записи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Подтверждение удаления записи</h1>
        <form method="POST" action="">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($table, ENT_QUOTES, 'UTF-8'); ?>">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>">
            <p>Вы уверены, что хотите удалить запись с ID: <?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>?</p>
            <button type="submit" class="btn btn-danger">Удалить</button>
            <a href="admin.php" class="btn btn-secondary">Отмена</a>
        </form>
    </div>
</body>
</html>
