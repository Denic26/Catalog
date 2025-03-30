<?php
include('../includes/db.php');

// Получаем параметры фильтрации из GET-запроса
$category = isset($_GET['category']) ? $_GET['category'] : '';
$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : '';
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : '';

// Формируем SQL-запрос с фильтрами
$sql = "SELECT * FROM products WHERE 1=1";

if ($category) {
    $sql .= " AND category = '$category'";
}

if ($min_price) {
    $sql .= " AND price >= $min_price";
}

if ($max_price) {
    $sql .= " AND price <= $max_price";
}

$result = $conn->query($sql);

$search = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT * FROM products WHERE name LIKE '%$search%'";

if ($category) {
    $sql .= " AND category = '$category'";
}

if ($min_price) {
    $sql .= " AND price >= $min_price";
}

if ($max_price) {
    $sql .= " AND price <= $max_price";
}

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Каталог товаров</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <div class="container">
        <?php include('../includes/header.php'); ?>

        <h1>Каталог товаров</h1>

        <!-- Форма фильтрации -->
        <div>
            <form method="GET" action="index.php">
                <label for="category">Категория:</label>
                <select name="category" id="category">
                    <option value="">Все</option>
                    <option value="electronics" <?php if ($category == 'electronics') echo 'selected'; ?>>Электроника
                    </option>
                    <option value="clothing" <?php if ($category == 'clothing') echo 'selected'; ?>>Одежда</option>
                    <option value="books" <?php if ($category == 'books') echo 'selected'; ?>>Книги</option>
                </select>

                <label for="min_price">Мин. цена:</label>
                <input type="number" name="min_price" id="min_price" value="<?php echo $min_price; ?>">

                <label for="max_price">Макс. цена:</label>
                <input type="number" name="max_price" id="max_price" value="<?php echo $max_price; ?>">

                <input type="text" name="search" placeholder="Поиск по товарам"
                    value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button type="submit">Искать</button>
            </form>
        </div>
        <div class="product-list">
            <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product">
                <img src="../assets/images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['description']; ?></p>
                <p>Цена: <?php echo $row['price']; ?> руб.</p>
                <a href="view.php?id=<?php echo $row['id']; ?>">Подробнее</a>
            </div>
            <?php endwhile; ?>
        </div>
        <br>
        <?php include('../includes/footer.php'); ?>
    </div>

</body>

</html>