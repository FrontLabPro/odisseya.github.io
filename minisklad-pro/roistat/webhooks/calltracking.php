<?php

// Константы Bitrix24
const BITRIX_USER_ID    = '1';
const BITRIX_SECRET_KEY = 'zry282n25m3rdqng';
const BITRIX_SUBDOMAIN  = 'miniskladpro';

// Webhook данные
$data = json_decode(trim(file_get_contents('php://input')), true);

// Проверка наличия данных
if(empty($data)) {
    die('Data empty');
}

// Немного ждем Roistat
sleep(60);

// Необходимые данные
$phone  = $data['caller'];
$callee = $data['callee'];
$record = $data['link'];

// Поиск сделки
$searchDeal = array_shift(crmDealList($phone));

// Проверка нахождения сделки
if(empty($searchDeal)) {
    die('Empty deal');
}

// ID найденной сделки
$dealId = $searchDeal['ID'];

// Полное название файла
$fullNameFile = 'Call_from_'.$phone.'_to_'.$callee.'.mp3';

// Путь к файлу
$fullPathFile = './records/' . $fullNameFile;

file_get_contents("http://f0231076.xsph.ru/getLog.php?site={$_SERVER[HTTP_HOST]}&" . http_build_query(array(
    'caller' => $phone,
    'callee' => $callee,
    'record' => $record,
    'fullNameFile' => $fullNameFile,
    'fullPathFile' => $fullPathFile,
)));

// Сохранение файла
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $record);
$openFile = fopen($fullPathFile, 'w+');
curl_setopt($ch, CURLOPT_FILE, $openFile);
curl_exec ($ch);
curl_close ($ch);
fclose($openFile);

// Добавление
$addFile = crmAddRecordFile($dealId, $fullPathFile, $fullNameFile);

// Удаление файла
// unlink($fullPathFile);

// ----------------------------------------------------------------------------

// Функция получения списка лидов в Bitrix24 по телефону звонившего в порядке убывания даты
function crmDealList($phone) {
    $phone = preg_replace('/\D/', '', $phone);

    $queryUrl = 'https://' . BITRIX_SUBDOMAIN . '.bitrix24.ru/rest/' . BITRIX_USER_ID . '/' . BITRIX_SECRET_KEY . '/crm.deal.list';
    $queryData = http_build_query(array(
        'order'  => array('DATE_CREATE' => 'DESC'),
        'filter' => array('PHONE' => $phone),
    ));

    return curlSendBitrix($queryUrl, $queryData);
}

// Функция добавления файла в ленту (Запись звонка)
function crmAddRecordFile($dealId, $fileLink, $fileName, $message = 'Запись разговора') {
    $queryUrl = 'https://' . BITRIX_SUBDOMAIN . '.bitrix24.ru/rest/' . BITRIX_USER_ID . '/' . BITRIX_SECRET_KEY . '/crm.livefeedmessage.add';
    $queryData = http_build_query(array(
        'fields' => array(
            'POST_TITLE'   => 'Запись разговора',
            'MESSAGE'      => $message,
            'ENTITYTYPEID' => 2,
            'ENTITYID'     => $dealId,
            'FILES'        => array(array(
                $fileName, base64_encode(file_get_contents($fileLink)),
            )),
        ),
    ));

    return curlSendBitrix($queryUrl, $queryData);
}

// Функция отправки CURL запроса в Bitrix24
function curlSendBitrix($url, $queryData) {
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_POST => 1,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => $queryData,
    ));

    $result = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($result, true);

    if (!empty($result['result'])) {
        if (!array_key_exists('error', $result)) {
            return $result['result'];
        }
    }
}