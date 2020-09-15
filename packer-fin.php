<?php

header ('Content-type: text/html;charset=utf-8');

$lang = @ $_GET ['lang'];

if ( empty ($lang) ) 
{
    print_form ();
}

function print_form ()
{
?>
<form>
    Какую версию собираем?
    <ul>
        <li><input type = 'radio' name = 'lang' value = 'russian' checked = "checked">Русский</li>
        <li><input type = 'radio' name = 'lang' value = 'deutsch'> Немецкий</li>
    </ul>
    <br>
    <input type = "checkbox" name = "single"> Однопользовательская версия<br>
    <input type = "submit" />
    
</form>
<?php
    die ();
}



include "packer.php";

switch ( $_GET ['lang'] ) 
{
    case 'deutsch' : $lang = 'de';
        break;
    case 'russian' : $lang = 'ru';
        break;
    default: $lang = 'ru';
}

$fp = fopen ('installer.php', 'wb');

$install = file_get_contents('install.php');

$dump = file_get_contents('dump.php');
$dump = str_replace (array ('<?php', '?>'), '', $dump);

$file_content = str_replace('include "dump.php";', & $dump, $install);
$file_content = str_replace(
                            '$config_content = file_get_contents (\'conf/config_template.php\');',
                            '$config_content = \'' .addslashes (file_get_contents ('conf/config_template.php')).'\';',
                            $file_content
                            );
$file_content = str_replace('<H2><A HREF="?step=0&lang=ru"><?php echo $installer_lang[\'installation_language_ru\']; ?></A></H2>', 
                            '<H2><A HREF="?step=0&lang='.$lang.'"><?php echo $installer_lang[\'installation_language_'.$lang.'\']; ?></A></H2>', 
                            $file_content);                            
$file_content = str_replace('{lang}', $lang, $file_content);

if ( ! empty ( $_GET ['single'] ) ) 
{
/*
    if ($lang = 'ru')
    {
       $demo_user_name = 'Демо-пользователь';
    }
    elseif ($lang = 'de')
    {
       $demo_user_name = 'Demo Nutzer';
    }
    $file_content = str_replace(
        'function add_single_user (){}',
        'function add_single_user (){
    mysql_query ("delete from dacons_users");
    mysql_query ("INSERT INTO `dacons_users` (`username`, `password`, `nickname`, `customer_id`, `email`, `subscribed`, `is_super_user`, `is_admin`, `readonly`, `location`, `location_exp`, `help`) VALUES
(\'demo\', \'e10adc3949ba59abbe56e057f20f883e\', \''.$demo_user_name.'\', 312, \'\', \'0\', 0, 0, 0, 0, \'0000-00-00 00:00:00\', \'a:16:{i:1;b:1;i:2;b:1;i:3;b:0;i:4;b:0;i:5;b:0;i:6;b:0;i:7;b:0;i:8;b:1;i:9;b:1;i:10;b:1;i:11;b:1;i:12;b:0;i:13;b:0;i:14;b:1;i:15;b:1;i:0;b:1;}\');");
}',
        $file_content
    );
                            
    $file_content = str_replace(
        '<TD ALIGN="CENTER" CLASS="line"><H2>admin</H2></TD>',
        '<TD ALIGN="CENTER" CLASS="line"><H2>demo</H2></TD>',
        $file_content
    );                            
*/                            
}


fputs ($fp, $file_content);

echo "ready ";
echo filesize ('installer.php');
echo "<br>\n";
