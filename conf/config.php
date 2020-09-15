<?php

 $dbconfig = array ('host'     => 'localhost',
                 'username' => 'alelekov_cons_d',
                 'password' => 'pQiCrhHz',
                 'dbname'   => 'alelekov_cons_d',
                 'profiler' => true );
 $mail_config = array ('mail_from' => 'mail@login.dacons.ru',
 						'admin_email' => 'mail@login.dacons.ru',
 						'mailer_type' => 'mail',
 						'mailer_smtp_host' => 'localhost',
 						'mailer_smtp_port' => '25');
 $conf['siteurl'] = trim ('http://'.$_SERVER['HTTP_HOST']. dirname (str_replace ($_SERVER ['DOCUMENT_ROOT'], '', $_SERVER ['SCRIPT_NAME'])), '/');
 $conf['dir'] = dirname(str_replace ($_SERVER ['DOCUMENT_ROOT'], '', $_SERVER ['SCRIPT_NAME']));
 $conf['license'] = 'QZZZ-0Z71-ZZUA-24H9';
 
 $conf ['lang'] = 'de';

if (function_exists('_')){
	include dirname (__FILE__).'/../conf/locale/' . $conf ['lang'].'.php';

	// Указываем имя домена
	$domain = 'consileri';

	// Задаем каталог домена, где содержатся переводы
	bindtextdomain ($domain, dirname (__FILE__)."/../locale");

	// Выбираем домен для работы

	textdomain ($domain);

	// Если необходимо, принудительно указываем кодировку
	// (эта строка не обязательна, она нужна,
	// если вы хотите выводить текст в отличной
	// от текущей локали кодировке).
	bind_textdomain_codeset($domain, 'UTF-8');
} else {
	function _($str){
		return $str;
	}
}
 
 global $is_saas;
 $is_saas = false;
?>
