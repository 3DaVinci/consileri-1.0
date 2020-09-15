<?php

// Задаем текущий язык проекта
putenv("LANG=de_DE.utf8");

// Задаем текущую локаль (кодировку)
setlocale (LC_ALL,"de_DE.UTF-8");

global $locale_conf, $conf;

$locale_conf ['bank_properties_left'] = 6;
$locale_conf ['bank_properties_right'] = 4;


function lang_echo_day ($day, $month, $year = '') {
    return $day . ". " . ucfirst ($month);
}

function lang_echo_week ($day1, $month1, $day2, $month2) {
    return lang_echo_day ($day1, $month1) . " - " . lang_echo_day ($day2, $month2);
}

function lang_echo_month ($month, $year) {
     return $month . " " . $year;
}

$locale_conf ['alphabet'] = array (
'A' => array ('view' => 'A(Ä)', 'symbols' => array ('A', 'Ä')),
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
'O' => array ('view' => 'O(Ö)', 'symbols' => array ('O', 'Ö')),
'P' => array ('view' => 'P', 'symbols' => array ('P')),
'Q' => array ('view' => 'Q', 'symbols' => array ('Q')),
'R' => array ('view' => 'R', 'symbols' => array ('R')),
'S' => array ('view' => 'S', 'symbols' => array ('S')),
'T' => array ('view' => 'T', 'symbols' => array ('T')),
'U' => array ('view' => 'U(Ü)', 'symbols' => array ('U', 'Ü')),
'V' => array ('view' => 'V', 'symbols' => array ('V')),
'W' => array ('view' => 'W', 'symbols' => array ('W')),
'X' => array ('view' => 'X', 'symbols' => array ('X')),
'Y' => array ('view' => 'Y', 'symbols' => array ('Y')),
'Z' => array ('view' => 'Z', 'symbols' => array ('Z'))
);

$locale_conf ['alphabet_national'] = array ();

$locale_conf ['activate_url'] = '<a href = "http://www.konsileri-crm.de/de/support/reg.html">www.konsileri-crm.de/de/support/reg.html</a>';

$locale_conf ['xls_template_url'] = $conf['siteurl'] . '/importdata/de-template.xls';
