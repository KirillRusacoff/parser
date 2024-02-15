<?php

require_once './db-connect.php';

$login = $_POST['login'];
$password = md5($_POST['password']);

$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$login' AND `in_password` = '$password'");

if(mysqli_num_rows($check_user) > 0){

    $user = mysqli_fetch_assoc($check_user);

    echo "Success!";

} else {
    echo "Такого пользователя не найдено!";
};