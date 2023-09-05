<?php

class Currency
{

    private $_db;
    private $date;
    private $cache_time_out;
    private $file_currency_cache;

    public function __construct($user = null)
    {
        $this->_db = Database::getInstance();
    }

    public function get_currency($date,$cache_time_out,$file_currency_cache)
    {


        if (!is_file($file_currency_cache) || filemtime($file_currency_cache) < (time() - $cache_time_out)) {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, 'https://www.cbr.ru/scripts/XML_daily.asp?date_req=' . $date);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);

            $out = curl_exec($ch);

            curl_close($ch);

            file_put_contents($file_currency_cache, $out);

        }
    }

    public function update($fields = array(), $id = null, $where = null)
    {

        if (!$this->_db->update('currency', $id, $fields, $where)) {
            return Session::flash('cron', 'Обновить не получилось');
        } else{
            $log = date('Y-m-d H:i:s') . ' обновление' .$id.' > '.$fields['value'];
            file_put_contents('./log.txt', $log . PHP_EOL, FILE_APPEND);
            return Session::flash('cron', 'Данные обновлены');
        }
    }

    public function create($fields = array()) {
        if (!$this->_db->insert('currency', $fields)) {
            return Session::flash('cron', 'Данные добавить не получилось');
        } else{
            return Session::flash('cron', 'Данные добавлены');
        }
    }


}
