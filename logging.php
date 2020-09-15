<?php
/*
 * Создан: 13.08.2007 18:11:14
 * Автор: Александр Перов
 */
 $conf['logdir'] = "logs/";
 	$filename = $conf['logdir'].date("d_m_Y");
   	$loggingtext = "/-\n/ ".date("H:i:s")."\n/-\n"; 

	$loggingtext .= "/ IP: ";
	$loggingtext .= $_SERVER['REMOTE_ADDR']." ";
	if (isset($_SERVER['HTTP_VIA']))
	$loggingtext .= "HTTP_VIA:".$_SERVER['HTTP_VIA']." ";
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	$loggingtext .= "HTTP_X_FORWARDED_FOR:".$_SERVER['HTTP_X_FORWARDED_FOR']." ";

	$loggingtext .= "\n/-\n";
	foreach($_REQUEST as $k => $v) {
		
	if ($k=="password" || $k=="password2" || $k=="phpbb2mysql_data" ||
		$k=="phpbb2mysql_sid" || $k=="PHPSESSID" || $k=="oldpassword" ||
		$k=="sid")	{
    	
	} else { $loggingtext .=  "$k - $v\n"; }
	
	}

$loggingtext .= $_SERVER["REQUEST_URI"]."\n";	
 $loggingtext .= "\n";
 
 
 if (!file_exists($filename))
{
 $fp = fopen($filename.time(),"a"); 
 fputs($fp, $loggingtext); 
 fclose($fp);
} else
{
 // добавляем в архив
 
  $dir = $conf['logdir'];  
  if(!($res=opendir($dir))) exit(_("Нет такой директории..."));
    while(($file=readdir($res))==TRUE)
      if($file!="." && $file!=".." 
      		&& $file!='.htaccess' 
      		&& $file!='.htpass' 
			&& $file!='errorLog.txt' 
			&& $file!='archive'
			&& $file!=date("d_m_Y"))
      {				    
				    $data = implode("", file($conf['logdir'].$file));
    				$gzdata = gzencode($data, 3);
    				$fp = fopen($conf['logdir']."archive/".$file.".gz", "w");
    				fwrite($fp, $gzdata);
    				fclose($fp);
    				unlink($conf['logdir'].$file);										 
      }    
   closedir($res); 
}

?>
