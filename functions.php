<?php

function rus_date() {
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

function ymdw ($param1 = null, $param2 = null) {
// ——————————————————————————————————————
// Эта функция работает только в связке с функцией "rus_date" http://webi.ru/webi_files/rus_date.html
// ——————————————————————————————————————
// y — Год
// m — Месяц
// d — День
// w — Название дня недели
// ——————————————————————————————————————
// ymdw () — Вывод: 2019-08-30 (Текущая дата)
// ymdw ("") — Вывод: 2019-08-30 (Текущая дата)
// ymdw ("2019-08-30") — Вывод: 30 Августа (Пятница), 2019 г. (Заданная дата)
// ymdw ( ymdw () ) — Вывод: 30 Августа (Пятница), 2019 г. (Текущая дата)
// ymdw ("tmsp") — Вывод: 1567155817 // Метка времени Unix текущей даты и времени (тикает) (Текущий)
// ymdw ("Y") — Вывод: 2019 (Текущий)
// ymdw ("m") — Вывод: Номер месяца (от 1 до 12) (Текущий)
// ymdw ("mn") — Вывод: Название месяца (Текущий)
// ymdw ("d") — Вывод: Дата месяца (от 1 до 31) (Текущий)
// ymdw ("dn") — Вывод: Название дня недели (Понедельник) (Текущий)
// ymdw ("2019-08-30", "tmsp") — Вывод: 1567155817 // Метка времени Unix текущей даты
// ymdw ("2019-08-30", "Y") — Вывод: Год (число)
// ymdw ("2019-08-30", "m") — Вывод: Номер месяца (от 1 до 12)
// ymdw ("2019-08-30", "mn") —  Вывод: Название месяца (Января)
// ymdw ("2019-08-30", "d") — Вывод: Дата месяца (от 1 до 31)
// ymdw ("2019-08-30", "dn") — Вывод: Название дня недели (Понедельник)
// ymdw ("1559682000", "") — Вывод: 5 Июня (Среда) 2019 г.
// ymdw ("1559682000", "Y") — Вывод: 2019
// ymdw ("1559682000", "m") — Вывод: Номер месяца (от 1 до 12)
// ymdw ("1559682000", "mn") — Вывод: Название месяца
// ymdw ("1559682000", "d") — Вывод: Дата месяца (от 1 до 31)
// ymdw ("1559682000", "dn") — Вывод: Название дня недели (Понедельник)
// ——————————————————————————————————————
    date_default_timezone_set("Europe/Moscow");
    $args = func_get_args (); // Массив аргументов функции
    $year = substr ($param1, 0, 4); // Год
    $month = substr ($param1, 5, -3); // Номер месяца
    $month_name = rus_date ("F", mktime(0, 0, 0, (int)$month, 10)); // Название месяца
    $day = substr ($param1, 8); // Число месяца
    $get_week_day = rus_date ( "l", strtotime($param1) ); // День недели
    $timestamp = strtotime($param1); // Метка времени Unix
// ——————————————————————————————————————
// Текущая дата (2019-08-30)
    if ( count ($args) == 0 ) {
        return date ("Y-m-d");
    } elseif ( $param1 == "" ) {
        return date ("Y-m-d");
    } elseif ( $param1 != "" ) {
        // 5 Июня (Воскресенье), 1977 г.
        if ( preg_match ("#([0-9]{4,4})-([0-9]{2,2})-([0-9]{2,2})#", $param1) ) {
            if ( $param2 != "" ) {
                if ( $param2 == "tmsp" ) {
                    return strtotime ( date ($param1) );
                } elseif ( $param2 == "Y" ) {
                    return substr ($param1, 0, 4);
                } elseif ( $param2 == "m" ) {
                    return substr ($param1, 5, -3);
                } elseif ( $param2 == "d" ) {
                    return substr ($param1, 8);
                } elseif ( $param2 == "mn" ) {
                    return rus_date ("F", mktime(0, 0, 0, (int) substr ($param1, 5, -3), 10));
                } elseif ( $param2 == "dn" ) {
                    return rus_date ( "l", strtotime($param1) );
                }
            } else {
                return (int)$day . " " . $month_name . " (" . $get_week_day . "), " . $year . " г.";
            }
        } elseif ( preg_match ("#^[0-9]{5,20}$#", $param1) ) {
            if ( $param2 != "" ) {
                // Год (число)
                if ( $param2 == "Y" ) {
                    return date("Y", $param1);
                }
                // Номер месяца (от 1 до 12)
                elseif ( $param2 == "m" ) {
                    return (int) date("m", $param1);
                }
                // Дата месяца (от 1 до 31)
                elseif ( $param2 == "d" ) {
                    return (int) date("d", $param1);
                }
                // Название месяца
                elseif ( $param2 == "mn" ) {
                    return rus_date ("F", mktime(0, 0, 0, (int) date("m", $param1), 10));
                }
                // Название дня недели (Понедельник)
                elseif ( $param2 == "dn" ) {
                    return rus_date ("l", mktime(0, 0, 0, (int) date("d", $param1), 10));
                }
            }
            // Вывод: 30 Августа (Пятница), 2019 г.
            else {
                return (int) date("d", $param1) . " " . rus_date ( "F", $param1 ) . " (" . rus_date ( "l", $param1 ) . ") " . date("Y", $param1) . " г.";
            }
        } else {
            // Метка времени Unix текущей даты и времени
            if ( $param1 == "tmsp" ) {
                return time();
                // return strtotime("now");
            }
            // Текущий Год
            elseif ( $param1 == "Y" ) {
                return date ("Y");
            }
            // Текущий Месяц
            elseif ( $param1 == "m" ) {
                return (int) date ("m");
            }
            // Название месяца
            elseif ( $param1 == "mn" ) {
                return rus_date ("F", time() );
            }
            // Текущий День
            elseif ( $param1 == "d" ) {
                return (int) date ("d");
            }
            // Название дня недели (Понедельник)
            elseif ( $param1 == "dn" ) {
                return rus_date ( "l", time() );
            }
        }
    }
}