<?php
$host = 'localhost';
$user = 'root'; // замените на вашего пользователя
$password = ''; // замените на ваш пароль
$dbname = 'catalog';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>