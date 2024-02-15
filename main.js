//forms

const registerBlock = document.querySelector('#register');
const buttonOpenRegisterBlock = document.querySelector('#open-form');
const registerForm = document.querySelector('.register-form');
const autoForm = document.querySelector('.auto-form');
const buttonOnRegister = document.querySelector('#on-register');
const buttonOnAuto = document.querySelector('#on-auto');
const buttonCross = document.querySelectorAll('.cross');

buttonOnRegister.addEventListener('click', function () {
    autoForm.classList.add('auto-form--hidden');
    registerForm.classList.add('register-form--active');
});

buttonOnAuto.addEventListener('click', function () {
    autoForm.classList.remove('auto-form--hidden');
    registerForm.classList.remove('register-form--active');
});

buttonCross.forEach(function(item){
    item.addEventListener('click', function () {
        registerBlock.classList.remove('register-block--active');
    });
});

buttonOpenRegisterBlock.addEventListener('click', function() {
    registerBlock.classList.add('register-block--active');
});

//Success log in

autoForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = $(this).serialize();

    jQuery.ajax({
        method: 'POST',
        url: './register/log-in.php',
        data: formData,
    }).done(function(msg){
        buttonOpenRegisterBlock.style = 'display:none';

        document.querySelector('.open-connect-form').style = 'display:block';


        registerBlock.classList.remove('register-block--active'); 
    })
});

//search

// const search = document.querySelector('#search');

// search.addEventListener('submit', function(event) {
//     event.preventDefault();

//     const formData = $(this).serialize();
//     const urls = ['./index.php', './parsers/parser-01.php', './parsers/parser-02.php'];

//     // Создаем массив промисов для каждого запроса
//     const requests = urls.map(url => {
//         return jQuery.ajax({
//             method: 'GET',
//             url: url,
//             data: formData,
//         });
//     });
// });

// const table = document.querySelector('.table');

// search.addEventListener('submit', function(){
//     table.style.opacity = "1";
// });

//button-cart

// document.addEventListener('DOMContentLoaded', function() {
//     const buttons = document.querySelectorAll('.button-cart');
 
//     buttons.forEach(button => {
//         button.addEventListener('click', function() {
//             const row = this.closest('tr');
//             if (row) {
//                 // Создаем объект для хранения данных ряда
//                 const rowData = {
//                     name: row.querySelector('td:nth-child(1)').textContent,
//                     quantity: row.querySelector('td:nth-child(2)').textContent,
//                     // Добавьте остальные данные по аналогии
//                 };
 
//                 // Передаем данные в блок main на странице cart.php с использованием параметров URL
//                 window.location.href = `cart.php?content=${encodeURIComponent(JSON.stringify(rowData))}`;
//             } else {
//                 console.error('Ряд не найден');
//             }
//         });
//     });
//  });

const buttonCart = document.querySelectorAll('.button-cart');

buttonCart.forEach(function(item){
    item.addEventListener('click', function(){
        item.style = "background-color:yellow;color:black;"
        item.innerText = "добавлено";
    })
});

//расчеты в колонке sum

// document.addEventListener('DOMContentLoaded', function() {
//     const priceElements = document.querySelectorAll('.price');
//     const numberInputElements = document.querySelectorAll('.number-table');
//     const sumElements = document.querySelectorAll('.sum');

//     for (let i = 0; i < priceElements.length; i++) {
//         numberInputElements[i].addEventListener('input', function() {
//             const priceValue = parseFloat(priceElements[i].textContent);
//             const numberValue = parseFloat(numberInputElements[i].value);
            
//             if (!isNaN(priceValue) && !isNaN(numberValue)) {
//                 const result = priceValue * numberValue;
//                 sumElements[i].textContent = result;
//             } else {
//                 console.error(`Ошибка в данных на позиции ${i}`);
//             }
//         });
//     }
// });

 // Функция для обновления значения в блоках span при изменении input
    function updateTotalPrice(inputIndex) {
        // Получаем значение из соответствующего input
        var quantity = inputElements[inputIndex].value;

        // Получаем цену из соответствующего блока price
        var priceElement = priceElements[inputIndex];
        var priceString = priceElement.innerText.replace(/[^\d.]/g, ''); // Убираем все символы, кроме цифр и точек
        var price = parseFloat(priceString);

        // Проверяем, есть ли у блока price дополнительный класс
        if (priceElement.classList.contains('table__block-price--multi')) {
            // Определяем категорию цены в зависимости от значения в input
            if (quantity >= 1 && quantity <= 9) {
                price = parseFloat('<?php echo $priceTable1; ?>');
            } else if (quantity >= 10 && quantity <= 99) {
                price = parseFloat('<?php echo $priceTable2; ?>');
            } else if (quantity >= 100 && quantity <= 999) {
                price = parseFloat('<?php echo $priceTable3; ?>');
            } else if (quantity >= 1000 && quantity <= 9999) {
                price = parseFloat('<?php echo $priceTable4; ?>');
            } else if (quantity >= 10000) {
                price = parseFloat('<?php echo $priceTable5; ?>');
            }
        }

        // Вычисляем итоговую цену
        var total = quantity * price;

        // Обновляем значение в соответствующем блоке span
        spanElements[inputIndex].innerText = total.toFixed(2); // Округляем до двух знаков после запятой
    }

    // Находим все блоки input, price и span
    var inputElements = document.querySelectorAll('.table__block input');
    var priceElements = document.querySelectorAll('.table__block-price');
    var spanElements = document.querySelectorAll('.table__block span');

    // Проходимся по каждому блоку input
    inputElements.forEach(function (inputElement, index) {
        // Добавляем обработчик события при изменении значения
        inputElement.addEventListener('input', function () {
            // Вызываем функцию обновления для соответствующего блока input
            updateTotalPrice(index);
        });
    });
  