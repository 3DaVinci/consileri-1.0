<?php

$INSTALL_DIR = dirname (__FILE__)."/../";

function getChangedFiles () {
    include dirname (__FILE__)."/get_changed_files.php";
    return $files_to_change;
}

function createDirs () {
    global $INSTALL_DIR;
    $dirs = array ('conf', 'exportdata', 'logs', 'templates_c', 'patches', 'importdata', 'dumper/backup');
    umask (0);
    foreach ($dirs as $dir) {
	    @mkdir ($INSTALL_DIR.$dir, 0777, true);
	    @chmod ($INSTALL_DIR.$dir, 0777);
    }

}

function updateFiles ($files) {
    global $INSTALL_DIR;
    foreach ($files as $path => $file) {
	    // создаем директорию
        $dir = dirname ($path);
        //echo $path."<br>\n"; continue;
        @mkdir ($INSTALL_DIR.$dir, 0777, true);
        $fp = fopen ($INSTALL_DIR.$path, 'w');
        $file_content = base64_decode ($file);
        fwrite ($fp, $file_content);
        fclose ($fp);
        chmod ($val, 0644);
    }
}

function updateConfig () {
    global $INSTALL_DIR;
    $config_file = $INSTALL_DIR."conf/config.php";
    include $config_file;
    $config_content = "<?php
/*
 * Created on 25.09.2007
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

 \$dbconfig = array ('host'     => '".$dbconfig['host']."',
                 'username' => '".$dbconfig['username']."',
                 'password' => '".$dbconfig['password']."',
                 'dbname'   => '".$dbconfig['dbname']."',
                 'profiler' => true );
 \$mail_config = array ('mail_from' => '".$mail_config['mail_from']."',
 						'admin_email' => '".$mail_config['admin_email']."',
 						'mailer_type' => '".$mail_config['mailer_type']."',
 						'mailer_smtp_host' => '".$mail_config['mailer_smtp_host']."',
 						'mailer_smtp_port' => '".$mail_config['mailer_smtp_port']."');
 //\$conf['siteurl'] = '';
 \$conf['siteurl'] = trim ('http://'.\$_SERVER['HTTP_HOST']. dirname (str_replace (\$_SERVER ['DOCUMENT_ROOT'], '', \$_SERVER ['SCRIPT_NAME'])), '/');
 \$conf['dir'] = dirname(str_replace (\$_SERVER ['DOCUMENT_ROOT'], '', \$_SERVER ['SCRIPT_NAME']));
 \$conf['license'] = '".$conf['license']."';

?>";
    rename ($config_file, $config_file.".old");
    $fp = fopen ($config_file, "w");
    fputs ($fp, $config_content);
    fclose ($fp);
}

?>

Patch <?php echo date ("d.m.Y"); ?>
<br>
<?php if (! isset ($_GET ['go'])) { ?>
<button onclick = "window.location='<?=$_SERVER ['REQUEST_URI']. "?go";?>'">Go!</button>
<?php } 
else { 
    createDirs ();
    $files = getChangedFiles ();
    updateFiles ($files);
    updateConfig ();
    echo "Done.";
} ?>



