<?php

if (isset($_REQUEST['test']) && $_REQUEST['test'] == '1') {
    $paytureHost = 'https://sandbox3.payture.com';
    $paytureMerchantKey = 'VWMerchantMiniskladAdd';
} else {
    $paytureHost = 'https://secure.payture.com';
    $paytureMerchantKey = 'VWMiniSkladBRS3DSAdd';
}

$sendInfoMail = false;
$adminEmail = '';
$fromEmail = '';
$paymentUrl = 'http://minisklad-pro.ru/payture/';
$returnUrl = 'http://minisklad-pro.ru/payture/?orderid={orderid}&result={success}';
$returnUrlFail = 'http://minisklad-pro.ru/payture/?result=false';
$returnUrlError = 'http://minisklad-pro.ru/payture/?result=error';

$tax = 6; //НДС не облагается
$taxationSystem = 2; //Упрощенная доход минус расход, УСН

$minPrice = 0;
$maxPrice = 99999;

$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$patronymic = $_POST['patronymic'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$price = $_POST['price'];
$contract = $_POST['boxId'];
$checkTransport = $_POST['checkTransport'];

$priceKop = intval($price * 100);

if (!preg_match('/^[0-9\.\,]+$/', $price) || $price < $minPrice || $price > $maxPrice) {
    header('Location: ' . $paymentUrl);
    exit();
}

$checkPhone = preg_replace('/[^0-9]+/', '', $phone);

//http://payture.com/integration/api/#kassy-fz54_
$check = array(
    'Positions' => array(
        array(
            'Quantity' => 1,
            'Price' => $price,
            'Tax' => $tax,
            'Text' => 'Оплата бокса № ' . $contract
        )
    ),
    'CheckClose' => array(
        'TaxationSystem' => $taxationSystem
    ),
    'CustomerContact' => $checkTransport == 'phone' ? $checkPhone : $email,
    'Message' => 'Оплата бокса № ' . $contract,
    'AdditionalMessages' => array(
        array(
            'Key' => 'FirstName',
            'Value' => $firstName
        ),
        array(
            'Key' => 'Patronymic',
            'Value' => $patronymic
        ),
        array(
            'Key' => 'LastName',
            'Value' => $lastName
        ),
        array(
            'Key' => 'Phone',
            'Value' => $phone
        )
    )
);

//http://payture.com/integration/api/#inpay_init_
$initParams = array(
    'SessionType=Pay',
    'OrderId=' . $contract . '_' . time(),
    'Amount=' . $priceKop,
    'IP=' . $_SERVER['REMOTE_ADDR'],
    'Url=' . $returnUrl,
    'Cheque=' . base64_encode( json_encode($check) ),
    'Description=Оплата бокса № ' . $contract,
    'product=бокс № ' . $contract,
    'total=' . $price,
    'Email=' . $email,
    'FirstName=' . $firstName,
    'Patronymic=' . $patronymic,
    'LastName=' . $lastName,
    'Phone=' . $phone
);

$url = $paytureHost . '/apim/Init?Key=' . $paytureMerchantKey . '&Data=' . urlencode( implode(';', $initParams) );

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_TIMEOUT, 5);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$responseXml = curl_exec($curl);
curl_close($curl);

libxml_use_internal_errors(true);
$response = simplexml_load_string($responseXml);

if ($response === false) {
    header('Location: ' . $returnUrlError);
    exit();
}

if($response->attributes()->Success) {
    if ($sendInfoMail === true) {
        $mailBody = "Запущен процесс оплаты на сайте minisklad.pro";
        $mailBody .= "<br/>Бокс №: $contract";
        $mailBody .= "<br/>Фамилия: $lastName";
        $mailBody .= "<br/>Имя: $firstName";
        $mailBody .= "<br/>Email: $email";
        $mailBody .= "<br/>Телефон: $phone<br/>";
        $mailBody .= "<br/>Сумма: $price";

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
        $headers .= "From: $fromEmail\r\n";
        mail($adminEmail, 'Оплата на сайте minisklad.pro', $mailBody, $headers);
    }

    header('Location: ' . $paytureHost . '/apim/Pay?SessionId=' . $response->attributes()->SessionId );
} else {
    header('Location: ' . $returnUrlFail);
}
/*
string(116) "<Init Success="True" OrderId="123123_1502287020" Amount="230005" SessionId="33e038c3-c348-425b-9986-c0930f734eda" />"
SimpleXMLElement Object
(
    [@attributes] => Array
        (
            [Success] => True
            [OrderId] => 123123_1502287020
            [Amount] => 230005
            [SessionId] => 33e038c3-c348-425b-9986-c0930f734eda
        )

)

 */

?>