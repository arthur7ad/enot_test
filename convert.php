<?php
require_once 'core/initPublic.php';
if (Input::exists()) {

        $validate = new Validate();
        $validation = $validate->check($_POST, array(
            'amount1' => array(
                'required' => true,
                'min' => 1
            )
        ));

        if ($validation->passed()) {
            $convert = new CurrencyConverter();
            echo $convert->convert(Input::get('currency1'), Input::get('currency2'), Input::get('amount1'), Input::get('amount2'), Input::get('typ'));
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }

}

?>