<?php
session_start();

// Проверяем, если админ не авторизован, перенаправляем его на страницу входа
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("Location: login.php");
    exit();
}

include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];

    // Загружаем изображение
    move_uploaded_file($_FILES['image']['tmp_name'], "../assets/images/$image");

    // Вставляем товар в базу данных
    $sql = "INSERT INTO products (name, description, price, category, image) 
            VALUES ('$name', '$description', '$price', '$category', '$image')";
    if ($conn->query($sql) === TRUE) {
        echo "Товар добавлен успешно!";
    } else {
        echo "Ошибка: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Добавить товар</title>
</head>

<body>

    <h1>Добавить товар</h1>

    <form method="POST" enctype="multipart/form-data">
        <label for="name">Название товара:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Описание:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="price">Цена:</label>
        <input type="number" name="price" id="price" required>

        <label for="category">Категория:</label>
        <select name="category" id="category" required>
            <option value="electronics">Электроника</option>
            <option value="clothing">Одежда</option>
            <option value="books">Книги</option>
        </select>

        <label for="image">Изображение:</label>
        <input type="file" name="image" id="image" required>

        <button type="submit">Добавить товар</button>
    </form>

</body>

</html>