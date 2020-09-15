<?php

//echo getScriptSize ('./dacons/www');

//die ('asdf');

createDump ('.');



function createDump ($file) {
	set_time_limit (0);
	$black_list = array ('./dacons-installed', './dump.php', './packer.php', './packer-fin.php', './installer.php', './install.php', './conf/config.php', './step_data.xml');
	$black_list_dirs = array ('conf', 'exportdata', 'logs', 'templates_c');
	if (is_dir ($file)) {
		if (in_array (basename ($file), $black_list_dirs)) return;
		$files = getDir ($file);
		if (count ($files) > 0) {
			foreach ($files as $_file) {
				//print $_file;
				createDump ($file.'/'.$_file);
			}
		}
	}
	elseif (! in_array ($file, $black_list)) /* if(file_exists ($file)) */{
        //if (strstr ($file, '.php') && !(strstr ($file, 'lang.php') ||  strstr ($file, 'freechat') || strstr ($file, 'fck') || strstr ($file, 'templates'))) {
          	
          	
          	//echo fread ($_fp, filesize ($file));
          	
			
			if (filesize ($file) > 0) {
				$file_arr = explode ('.', $file);
				$file_extension = end ($file_arr);
				//echo $file_extension."sadfasdfasdfa<br>";
				if (in_array ($file_extension, array ('tpl', 'php', 'sql', 'js'))) {
				    $_fp = fopen ($file, 'r');
				    $file_content = fread ($_fp, filesize ($file));
				    $file_content = str_ireplace (array ('utf8', 'utf8'), 'utf8', $file_content);
				    $file_content = iconv('utf8', 'utf8', $file_content);

				    print $file."<br>\n";
				    fclose ($_fp);
				    //unlink ($file);
				    
				    $_fp = fopen ($file, 'w');
				    fputs ($_fp, $file_content);
				    fclose ($_fp);
				}
				
			}
			
			
		//}
		//print $file. "   ".$size."\n";
	}
	return true;
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