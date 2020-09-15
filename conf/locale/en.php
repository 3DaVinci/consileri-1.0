<?php

// Задаем текущий язык проекта
putenv("LANG=en_US.utf8");

// Задаем текущую локаль (кодировку)
setlocale (LC_ALL,"en_US.UTF-8");

global $locale_conf;

$locale_conf ['bank_properties_left'] = 4;
$locale_conf ['bank_properties_right'] = 5;


function lang_echo_day ($day, $month, $year = '') {
    return date("jS \of ",mktime(0, 0, 0, 1, (int)$day, ($year?$year:date('Y')))).$month;
}

function lang_echo_week ($day1, $month1, $day2, $month2) {
    if ($month1==$month2)
        return  date("jS",mktime(0, 0, 0, 1, (int)$day1, date('Y')))."-".date("jS ",mktime(0, 0, 0, 1, (int)$day2, date('Y'))).$month1;
    else
        return  date("jS ",mktime(0, 0, 0, 1, (int)$day1, date('Y'))).$month1."-".date("jS ",mktime(0, 0, 0, 1, (int)$day2, date('Y'))).$month2;
}

function lang_echo_month ($month, $year) {
     return $month." ".$year;
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

$locale_conf ['alphabet_national'] = array ();
