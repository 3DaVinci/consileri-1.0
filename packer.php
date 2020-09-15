<?php

$black_list = array (
    './conf/config.php',
    './conf/config_template.php',  
    './dacons-installed', 
    './dump.php', 
    './packer.php', 
    './packer-fin.php', 
    './installer.php', 
    './install.php', 
    './conf/config.php', 
    './step_data.xml', 
    './dumper/backup/dumper.cfg.php', 
    './create_patch.php', 
    './encoder.php',
    './pi.php',
    './ConstructorFields.sql',
    './conv.php',
    './getkey.php',
    './save_temp_files.php', 
    './revert_sql.php',
    './default_demo_dump_de.sql',
    './create_holland.php',
);
$black_list_dirs = array (
    './Utils',
    './exportdata', 
    './logs', 
    './templates_c', 
    './importdata', 
    './dumper/backup', 
    './patches_data',
    './packets',
    './conf/saas',
    './uploads',
    './patches'
);
$lang = @ $_GET [ 'lang' ];

if ( $lang != 'russian' )
{
    $black_list [] = './locale/ru/LC_MESSAGES/consileri.po';
    $black_list [] = './locale/ru/LC_MESSAGES/consileri.mo';
    $black_list [] = './dump.sql.ru';
    $black_list [] = './libs/jscalendar/lang/calendar-ru.js';
    $black_list [] = './conf/locale/ru.php';
    
}

if ( $lang != 'deutsch' )
{
    $black_list [] = './locale/de/LC_MESSAGES/consileri.po';
    $black_list [] = './locale/de/LC_MESSAGES/consileri.mo';
    $black_list [] = './dump.sql.de';
    $black_list [] = './images/deutsch.css';
    $black_list [] = './libs/jscalendar/lang/calendar-de.js';
    $black_list [] = './conf/locale/de.php';
}

if ( ! empty ( $_GET ['single'] ) )
{
    //$black_list [] = './application/controllers/ManagmentController.php';
    //$black_list [] = './application/controllers/BackupController.php';
    
    //$black_list_dirs [] = './application/views/scripts/backup';
    //$black_list_dirs [] = './application/views/scripts/managment';
    
    $black_list [] = './application/controllers/ProfileController.php';
    
    $black_list_dirs [] = './application/views/scripts/profile';
}
else 
{
    $black_list [] = './application/controllers/ProfileController.php';
    
    $black_list_dirs [] = './application/views/scripts/profile';
}


$black_list [] = './www.zip';


//echo getScriptSize ('./dacons/www');
include "encoder.php";

$fp = fopen ('dump.php', 'wb');

$string = "<?php\n\n\$path_array = array ();\n\$files_array = array ();\n\n";
fputs ($fp, $string);
print "<table>";
createDump ('.', $fp);
print "</table>";
$string = "?>";
fputs ($fp, $string);
fclose ($fp);







function createDump ($file, $fp) {
	set_time_limit (0);
    global $black_list, $black_list_dirs;
	if (is_dir ($file)) {
		if (in_array ($file, $black_list_dirs)) {
		    if ($file == "./importdata") {
		        createDump ($file.'/template.xls', $fp);
		        createDump ($file.'/de-template.xls', $fp);
		    }
                    return;
		}
		if (basename ($file) == ".svn") {
		    return;
		}
		$files = getDir ($file);
		if (count ($files) > 0) {
			foreach ($files as $_file) {
				//print $_file;
				createDump ($file.'/'.$_file, $fp);
			}
		}
	}
	elseif (! in_array ($file, $black_list)) /* if(file_exists ($file)) */{
        //if (strstr ($file, '.php') && !(strstr ($file, 'lang.php') ||  strstr ($file, 'freechat') || strstr ($file, 'fck') || strstr ($file, 'templates'))) {
			if (basename ($file) == "Thumbs.db") return;
          	print "<tr><td>".$file."</td><td align = 'right'>". filesize ($file) ."</td></tr>\n";
          	$_fp = fopen ($file, 'r');
          	//echo fread ($_fp, filesize ($file));
          	$string  = '$path_array  [] = "'.$file.'";'."\n";
			$string .= '$files_array [] = <<<START_FILE_CONTENT'."\n";
			if (filesize ($file) > 0) {
			    $file_content = fread ($_fp, filesize ($file));
			    if (substr ($file, -4) == ".php") {
			        $file_content = encoder ($file_content);
			    }
				$file_content = base64_encode ($file_content);
				$string .= $file_content;
			}
			$string .= "\nSTART_FILE_CONTENT;\n\n\n";
			fputs ($fp, $string);
		//}
		//print $file. "   ".$size."\n";
	}
	return true;
}

function getScriptSize ($file) {
	set_time_limit (0);
	$size = 0;
	if (is_dir ($file)) {
		$files = getDir ($file);
		$dir_size = 0;
		if (count ($files) > 0) {
			foreach ($files as $_file) {
				//print $_file;
				$dir_size += getScriptSize ($file.'/'.$_file);
			}
		}
		if ($dir_size > 0) {
			print "$file ". ($dir_size)."<br>\n";
		}
		$size += $dir_size;
	}
	else /* if(file_exists ($file)) */
	{
        //if (strstr ($file, '.php') && !(strstr ($file, 'lang.php') ||  strstr ($file, 'freechat') || strstr ($file, 'fck') || strstr ($file, 'templates'))) {
          	//print $file."<br>\n";
			$size += @filesize ($file);
		//}
		//print $file. "   ".$size."\n";
	}
	return $size;

}

function getDir ($path) {
	$dir = @opendir ($path);
	if (!@$dir) return false;
	$files = array ();
	while (($file = readdir($dir)) !== false) {
       	if ($file != '.' && $file != '..') {
       		$files [] = $file;
       	}
    }
    closedir($dir);
    return $files;
}





