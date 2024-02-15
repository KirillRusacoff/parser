<?php

//Соединение с БД

$connect = mysqli_connect('localhost', 'root', '', 'module');

if(!$connect){
    die('Error connect to DataBase!');
} else {
    return;
};