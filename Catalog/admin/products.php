<?php
session_start();

// Проверяем, если админ не авторизован, перенаправляем его на страницу входа
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

// Получаем все товары
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $delete_sql = "DELETE FROM products WHERE id = $id";
    $conn->query($delete_sql);
    header("Location: products.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Управление товарами</title>
</head>

<body>

    <h1>Управление товарами</h1>

    <table>
        <tr>
            <th>Название</th>
            <th>Цена</th>
            <th>Категория</th>
            <th>Действия</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?> руб.</td>
            <td><?php echo $row['category']; ?></td>
            <td><a href="products.php?delete=<?php echo $row['id']; ?>">Удалить</a></td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>