<?php

require_once 'core/initPublic.php';
require_once './head.php';
if (Session::exists('cron')) {
    echo Session::flash('cron');
}

$date = date('d/m/Y');
$cache_time_out = 10800;
$file_currency_cache = './currency.xml'; // Файл кэша
$count = Database::getInstance()->selectAll('currency')->count(); // считаем сколько строк


if (!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {

    $currency = new Currency();
    $currency->get_currency($date, $cache_time_out,$file_currency_cache);

    $file_currency = simplexml_load_file('./currency.xml');
    foreach ($file_currency as $el) {
        $value = str_replace(',', '.', $el->Value);

        if($count>0){
        $currency->update(array(
            'nominal' => strval($el->Nominal),
            'value' => strval($value)
        ), "'" . strval($el->CharCode) . "'", 'code');

        }
        else{
            $currency->create(array(
                'code' => strval($el->CharCode),
                'nominal' => strval($el->Nominal),
                'name_ru' => strval($el->Name),
                'value' => strval($el->Value)
            ));
        }
    }
}
else{

   echo "<div class='alert alert-danger'>Пока рано обновлять данные</div>";
}



require_once './foot.php';
?>