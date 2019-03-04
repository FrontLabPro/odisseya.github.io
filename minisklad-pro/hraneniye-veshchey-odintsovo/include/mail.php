<?php
if (isset($_POST['type'])) {
	/*Адрес отправки*/
	$emailTo = 'k.s@minisklad.pro';
	
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
}

?>
