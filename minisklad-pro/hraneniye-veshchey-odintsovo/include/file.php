<?php
if (isset ($_POST['type'])) {
    $to = "miniskladpro@gmail.com";
	if($_POST['type'] == "smeta"){
		$subject = "Заказ на предварительную смету и схему дренажа";
		$tel = $_POST['tel'];
		$name = $_POST['name'];
		$info = $_POST['info'];
		$message = '<html><head><title>'.$subject.'</title></head><body><p>Пользователь: '.$name.'</p><p>Номер телефна: '.$tel.'</p><p>Данные участка: '.$info.'</p><p>Страница: Дренаж участка</p></body></html>';
		$boundary = md5(date('r', time()));
		$filesize = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers = "From: Лендинг Drainage & Design <landing@d2.ru>\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
		$message="
	Content-Type: multipart/mixed; boundary=\"$boundary\"
	
	--$boundary
	Content-Type: text/html; charset=\"utf-8\"
	Content-Transfer-Encoding: 7bit
	
	$message";
		for($i=0;$i<count($_FILES['file']['name']);$i++) {
			if(is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i])));
				$filename = $_FILES['file']['name'][$i];
				$filetype = $_FILES['file']['type'][$i];
				$filesize += $_FILES['file']['size'][$i];
				$message.="
	
	--$boundary
	Content-Type: \"$filetype\"; name=\"$filename\"
	Content-Transfer-Encoding: base64
	Content-Disposition: attachment; filename=\"$filename\"
	
	$attachment";
			}
		}
		$message.="
	--$boundary--";
	
		if ($filesize < 10000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
			mail($to, $subject, $message, $headers);
		} else {
			echo 'Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.';
		}
	}else if($_POST['type'] == "quest"){
		$subject = "Bопрос пользователя";
		$tel = $_POST['tel'];
		$name = $_POST['name'];
		$quest = $_POST['quest'];
		$message = '<html><head><title>'.$subject.'</title></head><body><p>Пользователь: '.$name.'</p><p>Номер телефна: '.$tel.'</p><p>Bопрос: '.$quest.'</p><p>Страница: Дренаж участка</p></body></html>';
		$boundary = md5(date('r', time()));
		$filesize = '';
		$headers = "MIME-Version: 1.0\r\n";
		$headers = "From: Лендинг Drainage & Design <landing@d2.ru>\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
		$message="
	Content-Type: multipart/mixed; boundary=\"$boundary\"
	
	--$boundary
	Content-Type: text/html; charset=\"utf-8\"
	Content-Transfer-Encoding: 7bit
	
	$message";
		for($i=0;$i<count($_FILES['file']['name']);$i++) {
			if(is_uploaded_file($_FILES['file']['tmp_name'][$i])) {
				$attachment = chunk_split(base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i])));
				$filename = $_FILES['file']['name'][$i];
				$filetype = $_FILES['file']['type'][$i];
				$filesize += $_FILES['file']['size'][$i];
				$message.="
	
	--$boundary
	Content-Type: \"$filetype\"; name=\"$filename\"
	Content-Transfer-Encoding: base64
	Content-Disposition: attachment; filename=\"$filename\"
	
	$attachment";
			}
		}
		$message.="
	--$boundary--";
	
		if ($filesize < 10000000) { // проверка на общий размер всех файлов. Многие почтовые сервисы не принимают вложения больше 10 МБ
			mail($to, $subject, $message, $headers);
		} else {
			echo 'Извините, письмо не отправлено. Размер всех файлов превышает 10 МБ.';
		}
	}
}
?>
