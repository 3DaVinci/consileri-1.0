<?php
/*
 * Создан: 13.08.2007 10:03:46
 * Автор: Александр Перов
 */
 
 
 function sendMail($to, $from, $subject, $message){
 	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/plain; charset=utf8\n";
 	$headers .= "From: $from\n";
    $headers .= "Reply-To: $from\n"; 	
 	return mail($to, $subject, $message, $headers);
 }
 
?>
