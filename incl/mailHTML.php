<?php
/*
 * Создан: 13.08.2007 10:03:46
 * Автор: Александр Перов
 */


 function sendMail($to, $from, $subject, $message){
 	if ($mail_config ['mailer_type'] == 'smtp') {

		// Loop through messages

	    $mail = new Zend_Mail();
	    $mail->addTo($to);
	    $mail->setFrom($from);
	    $mail->setSubject($subject);
	    $mail->setBodyText($message);
	    $mail->send($transport);

 	else {
	 	$headers  = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=utf8\n";
	 	$headers .= "From: $from\n";
	    $headers .= "Reply-To: $from\n";
	 	return mail($to, $subject, $message, $headers);
 	}
 }

?>