<?php

const KEY           = '031b3d680ec2674dd78849cc471c7de1';
const EVENT_CHAT    = 'chat_finished';
const EVENT_OFFLINE = 'offline_message';

if($_GET['key'] != KEY) {
    die('Key invalid');
}

// Webhook Data
$js_data = json_decode(trim(file_get_contents('php://input')), true);

if(empty($js_data)) {
    die('{"starus": "error", "message": "data_empty"}');
}

// Необходимые данные
$name    = isset($js_data['visitor']['name'])  ? $js_data['visitor']['name']  : null;
$phone   = isset($js_data['visitor']['phone']) ? $js_data['visitor']['phone'] : null;
$email   = isset($js_data['visitor']['email']) ? $js_data['visitor']['email'] : null;
$visit   = isset($js_data['user_token'])       ? $js_data['user_token']       : 'no_cookie';

//
$data = array(
    'key'     => 'MTg5MjQyOjExNDU0NDpiMzkzZWEwMzY5YWY2YjljODNmM2NmZjIxODZkNjYzMg==',
    'roistat' => $visit,
    'title'   => 'Заявка с "JivoSite"',
    'form'    => 'JivoSite',
    'name'    => $name,
    'phone'   => $phone,
    'email'   => $email,
    'fields'  => array(
        'STAGE_ID'          => 'NEW',           // Статус сделки
        'UF_CRM_1554369662' => 'JivoSite',      // Тип обращения
        'UF_CRM_1554369674' => 'JivoSite',      // Название формы
        'UF_CRM_1554369697' => '{landingPage}', // Страница с которой была оставлена заявка
        'UF_CRM_1554369710' => '{referrer}',    // Страница с которой был переход
        'UF_CRM_1554369726' => '{source}',      // Источник (Маркер)
    ),
);

//
switch($js_data['event_name']) {
    case EVENT_CHAT:
        // Необходимые данные
        $agent = isset($js_data['agents'][0]['id']) ? $js_data['agents'][0]['id'] : null;
        $manager = getManager($agent);

        foreach($js_data['chat']['messages'] as $message) {
            $name = $message['type'] == 'visitor' ? 'Пользователь' : 'Оператор';

            $messages .= $name . ': ' . $message['message'] . "\n";
        }

        $data['comment'] = $messages;
        $data['fields']['ASSIGNED_BY_ID'] = $manager;

        file_get_contents('https://cloud.roistat.com/api/proxy/1.0/leads/add?' . http_build_query($data));

        break;
    case EVENT_OFFLINE:
        // Необходимые данные
        $agent = null;
        $manager = getManager($agent);

        $data['comment'] = $js_data['message'];
        $data['fields']['ASSIGNED_BY_ID'] = $manager;

        file_get_contents('https://cloud.roistat.com/api/proxy/1.0/leads/add?' . http_build_query($data));

        break;
}

// ----------------------------------------------------------------------------

/**
 * Получить ID менеджера в CRM по email
 *
 * @param  int $agentId
 * @return int
 */
function getManager($agentId)
{
    $manager = 13;

    switch($agentId) {
        case 1376034:
            return 13;
            break;
    }

    return $manager;
}