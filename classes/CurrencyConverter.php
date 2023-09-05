<?php

class CurrencyConverter
{

    private $amount1;
    private $amount2;
    private $from;
    private $to;
    private $typ;


    public function convert($from, $to, $amount1, $amount2, $typ)
    {
        if ($from == 'RUB') {
            $currency1_res = 1;
        } else {
            $currency1_query = Database::getInstance()->get('currency', array('code', '=', $from));
            $currency1 = $currency1_query->results();
            $currency1_nominal = $currency1[0]->nominal;
            $currency1_value = $currency1[0]->value;
            $currency1_res = $currency1_nominal / $currency1_value;
        }

        if ($to == 'RUB') {
            $currency2_res = 1;
        } else {
            $currency2_query = Database::getInstance()->get('currency', array('code', '=', $to));
            $currency2 = $currency2_query->results();
            $currency2_nominal = $currency2[0]->nominal;
            $currency2_value = $currency2[0]->value;
            $currency2_res = $currency2_nominal / $currency2_value;

        }

        if($typ==1){
            $result = round($amount1 / ($currency1_res) * ($currency2_res), 4);
        }elseif($typ==2) {
            $result = round($amount2 / ($currency2_res) * ($currency1_res), 4);
        }

        return $result;
    }


}