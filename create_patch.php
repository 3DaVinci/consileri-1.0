<?php

$patch_tamplate = file_get_contents ("patches_data/patch_template.php");

include "patches_data/get_changed_files.php";

$changed_files = $str;

foreach ($files_to_change as $file => $content) {
    $changed_files .= sprintf ("\$files_to_change ['%s'] = '%s';\r\n", $file, $content);
}

$patch = str_replace (
    array ("include dirname (__FILE__).\"/get_changed_files.php\";", "<?php echo date (\"d.m.Y\"); ?>"),
    array ($changed_files, date ("d.m.Y")),
    $patch_tamplate
);


$fp = fopen ("patches/patch_".date ("Y-m-d").".php", 'w');

fwrite ($fp, $patch);

fclose ($fp);

echo "Patch is ready";

?>
