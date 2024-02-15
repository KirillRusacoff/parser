<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parser 2</title>
</head>
<body>
    <?php
        $searchTitle = 'STM32F302R8T6';

        error_reporting(E_ALL & ~E_DEPRECATED);

        require __DIR__ . './phpQuery-onefile.php';
        
        $ch = curl_init('https://elbase.ru/search?wrd=' . $searchTitle);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $html = curl_exec($ch);
        curl_close($ch);
        
        $pq = phpQuery::newDocument($html);
        
        $elem_prices = $pq->find('.table-preseach .card-text');
        
        $max_availability = 0;
        $max_availability_link = '';
        
        foreach ($elem_prices as $elem_price) {
            $text = pq($elem_price)->text();
        
            // Фильтруем только текст, содержащий "Наличие:"
            if (strpos($text, 'Наличие:') !== false) {
                preg_match('/Наличие: (\d+)/', $text, $matches);
        
                if (isset($matches[1]) && $matches[1] !== 'под заказ') {
                    $availability = (int)$matches[1];
        
                    // Если текущее наличие больше максимального, обновляем значения
                    if ($availability > $max_availability) {
                        $max_availability = $availability;
        
                        // Получаем ссылку (href) из родительской карточки
                        $max_availability_link = pq($elem_price)->parents('.card')->attr('href');
                    }
                }
            }
        }
        
        // echo "Наибольшее наличие - $max_availability\n";
        // echo "Ссылка на карточку - $max_availability_link\n";

        phpQuery::unloadDocuments();

        $chI = curl_init('https://elbase.ru' . $max_availability_link);
            curl_setopt($chI, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chI, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($chI, CURLOPT_HEADER, false);
            $htmlI = curl_exec($chI);
            curl_close($chI);

            // var_dump($htmlI);
        
            $pq = phpQuery::newDocument($htmlI);

            $elem_title = $pq->find('h1');

            $titileString = $elem_title->text();
        
            $elem_pricesI = $pq->find('.table tbody tr td.text-end');

            $allPrices = [];

            foreach ($elem_pricesI as $elem_priceI) {
                $price = pq($elem_priceI)->text();

                // Удаляем "999999999"
                $price = str_replace('999999999', '', $price);

                // Заменяем "по запросу" на "999999"
                $price = str_replace('по запросу', '999999', $price);

                // Заменяем запятые в числах на точки
                $price = str_replace(',', '.', $price);

                // Форматируем число с не более чем двумя знаками после запятой
                $price = number_format((float)$price, 2, '.', '');

                // Добавляем значение в массив
                $allPrices[] = $price;

                // echo $price . "\n";
            }

            // Находим минимальное значение в массиве
            $thisMinPrice = min($allPrices);

            echo "Наименьшее значение: $thisMinPrice\n"; // минимальная цена

            $elem_centerI = $pq->find('.table tbody tr td.text-center');
            $centerText = pq($elem_centerI)->text();
            
            // Заменить "по запросу" на "0"
            $centerText = preg_replace('/по запросу/', '0', $centerText);
            
            // Заменить "В наличии" на "30-60"
            $centerText = preg_replace('/В наличии/', '30-60', $centerText);
            
            // Удалить "999999999", "В корзине", "Купить", "Заявка"
            $centerText = preg_replace('/999999999|В корзине|Купить|Заявка/', '', $centerText);
            
            echo $centerText;

            $quantityInStock = "В работе";
            echo $quantityInStock;

            $manufacturer = "В работе";
            echo $manufacturer;

            echo  $titileString;


        
        phpQuery::unloadDocuments();
        ?>
</body>
</html>