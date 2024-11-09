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

$tables = [
    'Menu' => 'Меню',
    'Orders' => 'Заказы',
    'Supplies' => 'Поставки',
    'Users2' => 'Пользователи'
];

$tableFields = [
    'Menu' => [
        'ItemName' => 'Название товара',
        'Description' => 'Описание',
        'Price' => 'Цена',
    ],
    'Orders' => [
        'OrderDate' => 'Дата заказа',
        'OrderTime' => 'Время заказа',
        'ItemsOrdered' => 'Заказанные товары',
        'TotalCost' => 'Общая стоимость',
        'FIO' => 'ФИО',
        'Quantity' => 'Количество'
    ],
    'Supplies' => [
        'ItemID' => 'ID товара',
        'SupplyDate' => 'Дата поставки',
        'Quantity' => 'Количество',
        'Supplier' => 'Поставщик'
    ],
    'Users2' => [
        'username' => 'Имя пользователя',
        'password' => 'Пароль'
    ]
];


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table'])) {
    $table = $_POST['table'];

    if (isset($_POST['data']) && is_array($_POST['data'])) {
        $columns = implode(", ", array_keys($_POST['data']));
        $values = "'" . implode("', '", array_values($_POST['data'])) . "'";

        if ($table === 'Menu' && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "images/"; 
            $imageName = basename($_FILES['image']['name']);
            $targetFilePath = $targetDir . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                $columns .= ", Image"; 
                $values .= ", '$imageName'"; 

                $sql = "INSERT INTO $table ($columns) VALUES ($values)";

                if ($conn->query($sql) === TRUE) {
                    echo "Новая запись успешно добавлена";
                } else {
                    echo "Ошибка: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Ошибка при загрузке изображения.";
            }
        } else {
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";

            if ($conn->query($sql) === TRUE) {
                echo "Новая запись успешно добавлена";
            } else {
                echo "Ошибка: " . $sql . "<br>" . $conn->error;
            }
        }

        header("Location: admin.php");
        exit;
    } else {
        echo "Ошибка: Не были предоставлены данные для добавления.";
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление записи</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Добавить запись</h1>
        
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="table">Выберите таблицу:</label>
                <select class="form-control" id="table" name="table" required>
                    <option value="">-- Выберите таблицу --</option>
                    <?php foreach ($tables as $tableKey => $tableName) : ?>
                        <option value="<?php echo htmlspecialchars($tableKey); ?>">
                            <?php echo htmlspecialchars($tableName); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="data-fields" style="display: none;">

            </div>

            <div class="form-group" id="image-upload" style="display: none;">
                <label for="image">Выберите изображение:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Добавить запись</button>
            <a href="admin.php" class="btn btn-secondary">Назад</a>
        </form>
    </div>

    <script>
        document.getElementById('table').addEventListener('change', function() {
    const selectedTable = this.value;
    const dataFieldsDiv = document.getElementById('data-fields');
    dataFieldsDiv.innerHTML = ''; 
    const imageUploadDiv = document.getElementById('image-upload');

    if (selectedTable) {
        const fields = <?php echo json_encode($tableFields); ?>;
        const tableFields = fields[selectedTable];

        for (const column in tableFields) {
            const labelText = tableFields[column];

            const inputGroup = document.createElement('div');
            inputGroup.classList.add('form-group');
            
            const label = document.createElement('label');
            label.textContent = labelText;
            inputGroup.appendChild(label);

            const input = document.createElement('input');
            input.type = 'text';
            input.className = 'form-control';
            input.name = `data[${column}]`;
            input.required = true;
            inputGroup.appendChild(input);

            dataFieldsDiv.appendChild(inputGroup);
        }

        if (selectedTable === 'Menu') {
            imageUploadDiv.style.display = 'block';
        } else {
            imageUploadDiv.style.display = 'none';
        }

        dataFieldsDiv.style.display = 'block'; 
    } else {
        dataFieldsDiv.style.display = 'none'; 
        imageUploadDiv.style.display = 'none'; 
    }
    });
    </script>
</body>
</html>
