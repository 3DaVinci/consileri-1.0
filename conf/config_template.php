<?php

$conf['lang']='{lang}';

 $dbconfig = array ('host'     => '{db_host}',
                 'username' => '{db_user}',
                 'password' => '{db_password}',
                 'dbname'   => '{db_base}',
                 'profiler' => true );
 $mail_config = array ('mail_from' => '{dacons_mail_from}',
 						'admin_email' => '{dacons_admin_mail}',
 						'mailer_type' => '{mailer_type}',
 						'mailer_smtp_host' => '{mailer_smtp_host}',
 						'mailer_smtp_port' => '{mailer_smtp_port}');
 $conf['siteurl'] = trim ('http://'.$_SERVER['HTTP_HOST']. dirname (str_replace ($_SERVER ['DOCUMENT_ROOT'], '', $_SERVER ['SCRIPT_NAME'])), '/');
 $conf['dir'] = dirname(str_replace ($_SERVER ['DOCUMENT_ROOT'], '', $_SERVER ['SCRIPT_NAME']));
 $conf['license'] = '{license}';
 
 include dirname (__FILE__).'/../conf/locale/' . $conf ['lang'].'.php';

if (function_exists('_')){
	// Указываем имя домена
	$domain = 'consileri';

	// Задаем каталог домена, где содержатся переводы
	bindtextdomain ($domain, dirname (__FILE__).'/../locale');

	// Выбираем домен для работы
	textdomain ($domain);

	// Если необходимо, принудительно указываем кодировку
	// (эта строка не обязательна, она нужна,
	// если вы хотите выводить текст в отличной
	// от текущей локали кодировке).
	bind_textdomain_codeset($domain, 'UTF-8');
} 
else {
	function _($str){
		return $str;
	}
}
 
 global $is_saas;
 $is_saas = {is_saas};
?>
