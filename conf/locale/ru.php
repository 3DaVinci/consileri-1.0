<?php

// Задаем текущий язык проекта
putenv("LANG=ru_RU.utf8");

// Задаем текущую локаль (кодировку)
setlocale (LC_ALL,"ru_RU.UTF-8");

global $locale_conf, $conf;

$locale_conf ['bank_properties_left'] = 6;
$locale_conf ['bank_properties_right'] = 7;

function lang_echo_day ($day, $month, $year = '') {
    return $day . " " . $month;
}

function lang_echo_week ($day1, $month1, $day2, $month2) {
    return lang_echo_day ($day1, $month1) . " - " . lang_echo_day ($day2, $month2);
}

function lang_echo_month ($month, $year) {
     return $month . " " . $year;
}


$locale_conf ['alphabet'] = array (
'A' => array ('view' => 'A', 'symbols' => array ('A')),
'B' => array ('view' => 'B', 'symbols' => array ('B')),
'C' => array ('view' => 'C', 'symbols' => array ('C')),
'D' => array ('view' => 'D', 'symbols' => array ('D')),
'E' => array ('view' => 'E', 'symbols' => array ('E')),
'F' => array ('view' => 'F', 'symbols' => array ('F')),
'G' => array ('view' => 'G', 'symbols' => array ('G')),
'H' => array ('view' => 'H', 'symbols' => array ('H')),
'I' => array ('view' => 'I', 'symbols' => array ('I')),
'J' => array ('view' => 'J', 'symbols' => array ('J')),
'K' => array ('view' => 'K', 'symbols' => array ('K')),
'L' => array ('view' => 'L', 'symbols' => array ('L')),
'M' => array ('view' => 'M', 'symbols' => array ('M')),
'N' => array ('view' => 'N', 'symbols' => array ('N')),
'O' => array ('view' => 'O', 'symbols' => array ('O')),
'P' => array ('view' => 'P', 'symbols' => array ('P')),
'Q' => array ('view' => 'Q', 'symbols' => array ('Q')),
'R' => array ('view' => 'R', 'symbols' => array ('R')),
'S' => array ('view' => 'S', 'symbols' => array ('S')),
'T' => array ('view' => 'T', 'symbols' => array ('T')),
'U' => array ('view' => 'U', 'symbols' => array ('U')),
'V' => array ('view' => 'V', 'symbols' => array ('V')),
'W' => array ('view' => 'W', 'symbols' => array ('W')),
'X' => array ('view' => 'X', 'symbols' => array ('X')),
'Y' => array ('view' => 'Y', 'symbols' => array ('Y')),
'Z' => array ('view' => 'Z', 'symbols' => array ('Z'))
);


$locale_conf ['alphabet_national'] = array (
'A' => array ('view' => 'A', 'symbols' => array ('А')),
'Б' => array ('view' => 'Б', 'symbols' => array ('Б')),
'В' => array ('view' => 'В', 'symbols' => array ('В')),
'Г' => array ('view' => 'Г', 'symbols' => array ('Г')),
'Д' => array ('view' => 'Д', 'symbols' => array ('Д')),
'Е' => array ('view' => 'Е', 'symbols' => array ('Е', 'Ё')),
'Ж' => array ('view' => 'Ж', 'symbols' => array ('Ж')),
'З' => array ('view' => 'З', 'symbols' => array ('З')),
'И' => array ('view' => 'И', 'symbols' => array ('И', 'Й')),
'К' => array ('view' => 'К', 'symbols' => array ('К')),
'Л' => array ('view' => 'Л', 'symbols' => array ('Л')),
'М' => array ('view' => 'М', 'symbols' => array ('М')),
'Н' => array ('view' => 'Н', 'symbols' => array ('Н')),
'О' => array ('view' => 'О', 'symbols' => array ('О')),
'П' => array ('view' => 'П', 'symbols' => array ('П')),
'Р' => array ('view' => 'Р', 'symbols' => array ('Р')),
'С' => array ('view' => 'С', 'symbols' => array ('С')),
'Т' => array ('view' => 'Т', 'symbols' => array ('Т')),
'У' => array ('view' => 'У', 'symbols' => array ('У')),
'Ф' => array ('view' => 'Ф', 'symbols' => array ('Ф')),
'Х' => array ('view' => 'Х', 'symbols' => array ('Х')),
'Ц' => array ('view' => 'Ц', 'symbols' => array ('Ц')),
'Ч' => array ('view' => 'Ч', 'symbols' => array ('Ч')),
'Ш' => array ('view' => 'Ш', 'symbols' => array ('Ш')),
'Щ' => array ('view' => 'Щ', 'symbols' => array ('Щ')),
'Э' => array ('view' => 'Э', 'symbols' => array ('Э')),
'Ю' => array ('view' => 'Ю', 'symbols' => array ('Ю')),
'Я' => array ('view' => 'Я', 'symbols' => array ('Я'))
);


$locale_conf ['activate_url'] = '<a href = "http://www.consileri.ru/reg/" target = _blank>http://www.consileri.ru/reg/</a>';

$locale_conf ['xls_template_url'] = $conf['siteurl'] . '/importdata/template.xls';
