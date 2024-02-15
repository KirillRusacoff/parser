<?php

$dataTabless = $_GET['title'];

//Excel Ali

$csvFile = './parsers/tables/ali-table.csv';

       if (file_exists($csvFile)) {
           $file = fopen($csvFile, 'r');
       
           $minPrice = PHP_INT_MAX;
           $minPriceDetails = null;
       
           while (($data = fgetcsv($file, 1000, ',')) !== false) {
               if ($data[1] == $dataTabless) {
                   if (isset($data[4]) && is_numeric($data[4])) {
                       if ($data[5] < $minPrice) {
                           $minPrice = $data[5];
                           $minPriceDetails = array(
                               'название' => $data[1],
                               'производитель' => $data[0],
                               'количество' => $data[2],
                               'цена' => $data[4],
                               'цена-2' => $data[6],
                               'цена-3' => $data[8],
                               'цена-4' => $data[10],
                               'цена-5' => $data[12],
                           );
                       }
                   }
               }
           }
       
           fclose($file);
       
           // Выводим результат
    if ($minPriceDetails !== null) {
        $priceTable1 = number_format($minPriceDetails['цена'], 2);
        $titleTable = $minPriceDetails['название'];
        $produserTable = $minPriceDetails['производитель'];
        $sumTable = $minPriceDetails['количество'];
        $priceTable2 = number_format($minPriceDetails['цена-2'], 2);
        $priceTable3 = number_format($minPriceDetails['цена-3'], 2);
        $priceTable4 = number_format($minPriceDetails['цена-4'], 2);
        $priceTable5 = number_format($minPriceDetails['цена-5'], 2);
    } else {
        echo "0";
    }
       }
       
       // Теперь можно использовать $priceTable1, $titleTable, $produserTable, $sumTable за пределами условия
       // Например, выведите их значения
    //    echo "Цена: $priceTable1, Название: $titleTable, Производитель: $produserTable, Количество: $sumTable";

//Excel Cathy

$csvFile1 = './parsers/tables/Cathy-Zhong.csv';

if (file_exists($csvFile1)) {
    $file1 = fopen($csvFile1, 'r');

    $minPrice1 = PHP_INT_MAX;
    $minPriceDetails1 = null;

    while (($data1 = fgetcsv($file1, 1000, ',')) !== false) {
        if ($data1[0] == $dataTabless) {
            if (isset($data1[5]) && is_numeric($data1[5])) {
                if ($data1[5] < $minPrice1) {
                    $minPrice1 = $data1[5];
                    $minPriceDetails1 = array(
                        'название' => $data1[0],
                        'производитель' => $data1[1],
                        'количество' => $data1[2],
                        'цена' => $data1[5]
                    );
                }
            }
        }
    }

    fclose($file1);

    // Выводим результат
    if ($minPriceDetails1 !== null) {
        // Выносим значения во внешние переменные
        $price = $minPriceDetails1['цена'];
        $title = $minPriceDetails1['название'];
        $producer = $minPriceDetails1['производитель'];
        $quantity = $minPriceDetails1['количество'];

        // echo "Минимальная цена: $price у товара '$title'. Производитель: $producer. Количество на складе: $quantity.";
    } else {
        $price = 0;
    }
} else {
    // echo "Файл не найден.";
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="./main.css">
    <script src="./libs/jquery-3.7.1.min.js" defer></script>
    <script src="./fetch.js" defer></script>
    <script src="./main.js" defer></script>
</head>
<body>
    <div class="register-block" id="register">
        <div  class="register-block__wrapper">
            <form action="register/log-in.php" method="post" class="auto-form">
                <h2>Авторизация:</h2>
                <button class="cross" type="button">&#10006;</button>
                <input type="email" name="login" placeholder="Введите логин">
                <input type="password" name="password" placeholder="Введите пароль:">
                <input type="submit" value="Войти" class="button">
                <p>У Вас нет аккаунта? <button type="button" id="on-register">Зарегистрируйтесь</button>.</p>
            </form>
            <form action="register/sing-up.php" method="post" class="register-form">
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
                    <a href="tel:+74992880426" class="header__contact">+7(499)288-04-26</a>
                    <a href="mailto:order@modulesource.ru" class="header__contact">order@modulesource.ru</a>
                </div>
                <div class="header__buttons">
                    <button type="button" class="header__button" id="open-form">Войти</button>
                    <div class="open-connect-form"><span>Добро пожаловать!</span><br><a href="index.php" style="color:red;">&lt; Выйти</a></div>
                    <a href="cart.php" class="header__button" id="1">&larr; В корзину</a>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="main__wrapper">
            <h2 class="main__search-title">Введите искомый парт-номер</h2>
                <form class="main__search" metod='get' id="search">
                    <input type="text" name="title" placeholder="Введите название детали">
                    <input type="submit" value="Поиск" class="main__search-button">
                </form>
                <div class="table" id="table">
                    <div class="table__row">
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Номер</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Количество</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Срок поставки</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Производитель</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Цена</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Количество к заказу</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">Итоговая цена</div>
                        <div style="font-weight:600; background-color:#a3fc98" class="table__block">В корзину</div>
                    </div>
                    <div class="table__row">
                        <div class="table__block"> <?php include './parsers/parser-01.php'; echo $product['title'];  ?> </div>
                        <div class="table__block"> <?php include './parsers/parser-01.php'; echo $product['in_stock'];  ?> </div>
                        <div class="table__block"> 1-2 недели </div>
                        <div class="table__block"> <?php include './parsers/parser-01.php'; echo $product['producer']; ?> </div>
                        <div class="table__block table__block-price"> <?php include './parsers/parser-01.php'; echo $min_price * 1.05 ; ?> </div>
                        <div class="table__block"> <input type="number" placeholder="кол-во"> </div>
                        <div class="table__block"> <span>0</span> </div>
                        <div class="table__block"> <button type="button">В корзину</button> </div>
                    </div>
                    <div class="table__row">
                        <div class="table__block"> <?php echo $titileString;?> </div>
                        <div class="table__block"> <?php echo $quantityInStock;?> </div>
                        <div class="table__block"> 1-2 недели </div>
                        <div class="table__block"> <?php  echo $manufacturer; ?> </div>
                        <div class="table__block table__block-price"> <?php echo $thisMinPrice="0"; ?> </div>
                        <div class="table__block"> <input type="number" placeholder="кол-во"> </div>
                        <div class="table__block"> <span>0</span> </div>
                        <div class="table__block"> <button type="button">В корзину</button> </div>
                    </div>
                    <div class="table__row">
                        <div class="table__block"> <?php echo $titleTable; ?> </div>
                        <div class="table__block"> <?php echo $sumTable;  ?> </div>
                        <div class="table__block"> 2-4 недели </div>
                        <div class="table__block"> <?php echo $produserTable;  ?> </div>
                        <div class="table__block table__block-price table__block-price--multi" style="text-align:left;">
                        <?php echo "от 1шт: " . ($priceTable1 * 1.03 * 0.01)/80*100 . "<br>";
                              echo "от 10шт: " . ($priceTable2 * 1.03 * 0.01)/80*100 . "<br>";
                              echo "от 100шт: " . ($priceTable3 * 1.03 * 0.01)/80*100 . "<br>";
                              echo "от 1т.шт: " . ($priceTable4 * 1.03 * 0.01)/80*100 . "<br>";
                              echo "от 10т.шт: " . ($priceTable5 * 1.03 * 0.01)/80*100; ?>
                        </div>
                        <div class="table__block"> <input type="number" placeholder="кол-во"> </div>
                        <div class="table__block"> <span>0</span> </div>
                        <div class="table__block"> <button type="button">В корзину</button> </div>
                    </div>
                    <div class="table__row">
                        <div class="table__block"> <?php echo $title; ?> </div>
                        <div class="table__block"> <?php echo $quantity; ?> </div>
                        <div class="table__block"> 4-5 недель </div>
                        <div class="table__block"> <?php echo $producer; ?> </div>
                        <div class="table__block table__block-price"> <?php echo ($price * 1.03 * 0.01)/80*100; ?> </div>
                        <div class="table__block"> <input type="number" placeholder="кол-во"> </div>
                        <div class="table__block"> <span>0</span> </div>
                        <div class="table__block"> <button type="button">В корзину</button> </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="container">
            <p>&copy; Созданный сайт 2024год</p>
        </div>
    </footer>
</body>
</html>