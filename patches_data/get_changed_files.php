<?php

$dump = file_get_contents(dirname (__FILE__).'/installer.php.old');

$dump = substr ($dump, strpos ($dump, "\$path_array = array ();"));
$dump = substr ($dump, 0, strpos ($dump, "}"));

eval ($dump);
$old_files_array = array_combine ($path_array, $files_array);




$dump = file_get_contents(dirname (__FILE__).'/installer.php');

$dump = substr ($dump, strpos ($dump, "\$path_array = array ();"));
$dump = substr ($dump, 0, strpos ($dump, "}"));

eval ($dump);

$new_files_array = array_combine ($path_array, $files_array);

unset ($path_array, $files_array);


$files_to_change = array ();
$counter = 0;

foreach ($new_files_array as $key => $val) {
    if (! isset ($old_files_array [$key]) || $old_files_array [$key] != $new_files_array [$key]) {
        $files_to_change [$key] = $val;
        $counter += strlen($val);
    }
}

unset ($old_files_array, $new_files_array);

?>
