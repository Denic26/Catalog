<?php
include('../includes/db.php');

// Получаем ID товара из GET-параметра
$product_id = $_GET['id'];

// Получаем товар из базы данных
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

    <?php include('../includes/header.php'); ?>

    <h1><?php echo $product['name']; ?></h1>
    <img src="../assets/images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p><?php echo $product['description']; ?></p>
    <p>Цена: <?php echo $product['price']; ?> руб.</p>

    <?php include('../includes/footer.php'); ?>

</body>

</html>