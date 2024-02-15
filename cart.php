<?php

session_start();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    <link rel="stylesheet" href="./main.css">
    <script src="./main.js" defer></script>
</head>
<body>
    <div class="register-block" id="register">
        <div  class="register-block__wrapper">
            <form action="auto-form.php" method="post" class="auto-form">
                <h2>Авторизация:</h2>
                <button class="cross" type="button">&#10006;</button>
                <input type="email" name="login" placeholder="Введите логин">
                <input type="password" name="password" placeholder="Введите пароль:">
                <input type="submit" value="Войти" class="button">
                <p>У Вас нет аккаунта? <button type="button" id="on-register">Зарегистрируйтесь</button>.</p>
            </form>
            <form action="register-form.php" method="post" class="register-form">
                <h2>Регистрация:</h2>
                <button class="cross" type="button">&#10006;</button>
                <input type="number" name="inn" placeholder="Введите ИНН">
                <input type="text" name="title" placeholder="Название организации">
                <input type="text" name="real_address" placeholder="Юридический адрес">
                <input type="text" name="full_name" placeholder="ФИО">
                <input type="tel" name="phone" placeholder="Номер телефона">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Придумайте пароль">
                <input type="submit" value="Зарегистрироваться" class="button">
                <p>У Вас есть аккаунт? <button type="button" id="on-auto">Войдите</button>.</p>
            </form>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="header__wrapper">
                <img src="./img/logo.png" alt="Логотип" class="logo">
                <div class="header__contacts">
                    <a href="tel:+79995554433" class="header__contact">7(999)555-44-33</a>
                    <a href="mailto:info@mail.ru" class="header__contact">info@mailgroup.ru</a>
                </div>
                <div class="header__buttons">
                    <button type="button" class="header__button" id="open-form">Войти</button>
                    <div class="open-connect-form"><span>Добро пожаловать!</span><br><a href="index.html" style="color:red;">&lt; Выйти</a></div>
                    <a href="index.php" class="header__button">&larr; На главную</a>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        
    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; Созданный сайт 2024год</p>
        </div>
    </footer>
</body>
</html>

<?php

session_write_close();

?>