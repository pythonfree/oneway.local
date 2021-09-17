<?php

function getIp() {
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $arr = explode(',', $_SERVER[$key]);
            $ip = trim(end($arr));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
    return null;
}

function getAgeAppend($age)
{
    $nullGod = [0];
    $arrGod = [1,21,31,41,51,61,71,81,91];
    $arrGodA = [2,3,4,22,23,24,32,33,34,42,43,44,52,53,54,62,63,64,72,73,74,82,83,84,92,93,94];
    $arrLet = [5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,25,26,27,28,29,30,35,36,37,38,39,40,
        45,46,47,48,49,50,55,56,57,58,59,60,65,66,67,68,69,70,75,76,77,78,79,80,85,86,87,
        88,89,90,95,96,97,98,99,100];

    $arrFrom0ToHundred = [$nullGod, $arrGod, $arrGodA, $arrLet];
    foreach ($arrFrom0ToHundred as $arr) {
        if (in_array($age, $arr)) {
            if ($arr === $nullGod) {
                return $age . ' годиков';
            } elseif ($arr === $arrGod) {
                return $age . ' год';
            } elseif ($arr === $arrGodA) {
                return $age . ' года';
            }
        }
    }
    return $age . ' лет';
}

function dayAppend($d): string
{
    if (!$d) {
        return '0 дней';
    }
    if (1 == $d || 21 == $d || 31 == $d) {
        return $d . ' день';
    } elseif ($d >= 5 && $d <= 30) {
        return $d . ' дней';
    } else {
        return $d . ' дня';
    }
}

function monthAppend($m): string
{
    if (!$m) {
        return '0 месяцев';
    }
    switch ($m) {
        case 1:
            $m = $m . ' месяц';
            break;
        case 2:
        case 3:
        case 4:
            $m = $m . ' месяца';
            break;
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
        case 12:
            $m = $m . ' месяцев';
            break;
    }
    return $m;
}

function rus_date()
{
    $translate = array(
        "am" => "дп",
        "pm" => "пп",
        "AM" => "ДП",
        "PM" => "ПП",
        "Monday" => "Понедельник",
        "Mon" => "Пн",
        "Tuesday" => "Вторник",
        "Tue" => "Вт",
        "Wednesday" => "Среда",
        "Wed" => "Ср",
        "Thursday" => "Четверг",
        "Thu" => "Чт",
        "Friday" => "Пятница",
        "Fri" => "Пт",
        "Saturday" => "Суббота",
        "Sat" => "Сб",
        "Sunday" => "Воскресенье",
        "Sun" => "Вс",
        "January" => "Января",
        "Jan" => "Янв",
        "February" => "Февраля",
        "Feb" => "Фев",
        "March" => "Марта",
        "Mar" => "Мар",
        "April" => "Апреля",
        "Apr" => "Апр",
        "May" => "Мая",
        "June" => "Июня",
        "Jun" => "Июн",
        "July" => "Июля",
        "Jul" => "Июл",
        "August" => "Августа",
        "Aug" => "Авг",
        "September" => "Сентября",
        "Sep" => "Сен",
        "October" => "Октября",
        "Oct" => "Окт",
        "November" => "Ноября",
        "Nov" => "Ноя",
        "December" => "Декабря",
        "Dec" => "Дек",
        "st" => "ое",
        "nd" => "ое",
        "rd" => "е",
        "th" => "ое"
    );

    if (func_num_args() > 1) {
        $timestamp = func_get_arg(1);
        return strtr(date(func_get_arg(0), $timestamp), $translate);
    } else {
        return strtr(date(func_get_arg(0)), $translate);
    }
}
