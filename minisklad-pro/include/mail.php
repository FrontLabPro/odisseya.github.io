<?php
if (isset($_POST['type'])) {
	/*Адрес отправки*/
	$emailTo = 'mail@minisklad.pro';
	
	if($_POST['type'] == "call"){
		/*Тема письма*/
    	$subject = 'Заказ на звонок';
		/*Переменные из формы*/
		$tel = $_POST['tel'];
		$name = $_POST['name'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Пользователь: '.$name.'</p> 
				<p>Номер телефона: '.$tel.'</p>			
	      	</body>
	    </html>';
	}else if($_POST['type'] == "prop"){
		/*Тема письма*/
    	$subject = 'Письмо  руководителю';
		/*Переменные из формы*/
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		$text = $_POST['text'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Пользователь: '.$name.'</p>
				<p>Номер телефона: '.$tel.'</p>
				<p>'.$text.'</p>             
	      	</body>
	    </html>';
	}else if($_POST['type'] == "order"){
		/*Тема письма*/
    	$subject = 'Заказ на аренду контейнера';
		/*Переменные из формы*/
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Пользователь: '.$name.'</p>
				<p>Номер телефона: '.$tel.'</p>          
	      	</body>
	    </html>';
	}else if($_POST['type'] == "cons"){
		/*Тема письма*/
    	$subject = 'Заказ на консультацию';
		/*Переменные из формы*/
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Пользователь: '.$name.'</p>
				<p>Номер телефона: '.$tel.'</p>          
	      	</body>
	    </html>';
	}else if($_POST['type'] == "calc"){
		/*Тема письма*/
    	$subject = 'Заказ на аренду контейнера';
		/*Переменные из формы*/
		$tel = $_POST['tel'];
		$month = $_POST['month'];
		$cont_type = $_POST['cont_type'];
		$price = $_POST['price'];
		$price_desc = $_POST['price_desc'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Номер телефона: '.$tel.'</p>
				<p>Cрок хранения: '.$month.'</p>  
				<p>Тип контейнерф: '.$cont_type.'</p>    
				<p>Стоимость аренды: '.$price.' р</p>    
				<p>Стоимость аренды при единовременной оплате: '.$price_desc.' р</p>               
	      	</body>
	    </html>';
	}else if($_POST['type'] == "smaller"){
		/*Тема письма*/
    	$subject = 'Нашли цену дешевле';
		/*Переменные из формы*/
		$adr = $_POST['adr'];
		$tel = $_POST['tel'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Номер телефона: '.$tel.'</p>    
				<p>Aдрес: '.$adr.'</p>               
	      	</body>
	    </html>';
	}else if($_POST['type'] == "quest"){
		/*Тема письма*/
    	$subject = 'Вопрос пользователя';
		/*Переменные из формы*/
		$name = $_POST['name'];
		$tel = $_POST['tel'];
		$quest = $_POST['quest'];
		/*формирование сообщения*/
		$message = '<html>
			<head>
				<title>'.$subject.'</title>
			</head>
			<body>
				<p>Пользователь: '.$name.'</p>
				<p>Номер телефона: '.$tel.'</p>     
				<p>'.$quest.'</p>          
	      	</body>
	    </html>';
	}
	   
    /*Шапка письма*/
	$header = "Content-type: text/html; charset=\"utf-8\"\r\n";
	$header .= "From: Лендинг Minisklad.Pro <landing@minisklad.pro>\r\n";
	mail($emailTo, $subject, $message, $header);

	// Roistat Begin
	$rsTypeForm = null;
	$rsNameForm = null;
	$name       = null;
	$phone      = null;
	$comment    = null;

	//
	switch($_POST['type']) {
		case 'call':
            $rsTypeForm = 'Обратный звонок';
            $rsNameForm = 'Закажите обратный звонок';
            $name       = $_POST['name'];
            $phone      = $_POST['tel'];
			break;
        case 'order':
            $rsTypeForm = 'Арендовать в 1 клик';
            $rsNameForm = 'Аренда контейнера под склад';
            $name       = $_POST['name'];
            $phone      = $_POST['tel'];
            break;
        case 'cons':
            $rsTypeForm = 'Подобрать контейнер';
            $rsNameForm = 'Не знаете, какой контейнер подойдет для ваших нужд?';
            $name       = $_POST['name'];
            $phone      = $_POST['tel'];
            break;
        case 'calc':
            $rsTypeForm = 'Калькулятор';
            $rsNameForm = 'Рассчитайте стоимость хранения*';
            $name       = $_POST['name'];
            $phone      = $_POST['tel'];
            $comment    = <<<EOT
Номер телефона: {$_POST['tel']}
Cрок хранения: {$_POST['month']}
Тип контейнера: {$_POST['cont_type']}
Стоимость аренды: {$_POST['price']}
Стоимость аренды при единовременной оплате: {$_POST['price_desc']}
EOT;
            break;
        case 'smaller':
            $rsTypeForm = 'Нашли дешевле';
            $rsNameForm = 'Нашли дешевле?';
            $phone      = $_POST['tel'];
            $comment    = 'Aдрес:' . $_POST['adr'];
            break;
        case 'quest':
            $rsTypeForm = 'Подобрать контейнер';
            $rsNameForm = 'Не уверены, что вам подойдет склад­контейнер?';
            $name       = $_POST['name'];
            $phone      = $_POST['tel'];
            break;
	}

	//
    $roistatData = array(
        'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : 'no_cookie',
        'key'     => 'MTg5MjQyOjExNDU0NDpiMzkzZWEwMzY5YWY2YjljODNmM2NmZjIxODZkNjYzMg==',
        'title'   => 'Заявка с "'.$rsTypeForm.'"',
        'name'    => $name,
        'phone'   => $phone,
        'comment' => $comment,
        'fields'  => array(
        	'STAGE_ID'          => 'NEW',              // Статус сделки
			'UF_CRM_1554369662' => $rsTypeForm,     // Тип обращения
            'UF_CRM_1554369674' => $rsNameForm,     // Название формы
            'UF_CRM_1554369697' => '{landingPage}', // Страница с которой была оставлена заявка
            'UF_CRM_1554369710' => '{referrer}',    // Страница с которой был переход
            'UF_CRM_1554369726' => '{source}',      // Источник (Маркер)
        ),
    );

	if(!is_null($rsTypeForm)) {
        file_get_contents('https://cloud.roistat.com/api/proxy/1.0/leads/add?' . http_build_query($roistatData));
	}
	// Roistat End
}

?>
