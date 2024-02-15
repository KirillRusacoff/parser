<?php

require_once './db-connect.php';

$number = $_POST['inn'];
$title = $_POST['title'];
$my_address = $_POST['real_address'];
$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$in_password = $_POST['password'];

$message = "Ваши данные для входа на сайт:\nЛогин: " . $email . "\n" . "Пароль: " . $in_password;

$in_password = md5($in_password);

mysqli_query($connect, "INSERT INTO `users` (`id`, `number`, `title`, `my_address`, `full_name`, `phone`, `email`, `in_password`) VALUES (NULL, '$number', '$title', '$my_address', '$full_name', '$phone', '$email', '$in_password')");

mail($email, 'Данные для входа на сайт', $message);

header('Location: ./../index.php');