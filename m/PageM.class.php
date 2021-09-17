<?php

class PageM
{

    public function getPhoto($ip)
    {
        $query = "SELECT p.photo, p.id, 
                    (SELECT COUNT(*) FROM likes AS l WHERE l.id_photo = p.id) AS liked, 
                    (SELECT l.ip FROM likes AS l WHERE l.ip = '$ip' AND l.id_photo = p.id) AS `checked` 
                    FROM photos AS p";

        return PdoM::Instance()->Select($query);
    }

    public function getBdayInfo($id)
    {
        $query = "SELECT s.b_day FROM stars AS s WHERE id='$id'";
        $res = PdoM::Instance()->Select($query);

        //форматируем дату рождения
        $bDay = $res[0]['b_day'];
        $rbDay = rus_date("d F Y", strtotime($bDay));

        //вычисляем возраст в годах
        $origin = new DateTime($bDay);
        $target = new DateTime(date('Y-m-d'));
        $interval = $origin->diff($target);
        $age = $interval->format('%y');
        $age = getAgeAppend($age);

        //вычисляем сколько осталось месяцев и дней до нового дня рождения
        $origin = new DateTime(date('Y-m-d'));
        $bDay = new DateTime($bDay);
        $formatNextYear = 'P' . ((int)$age + 1) . 'Y';
        $target = $bDay->add(new DateInterval($formatNextYear));
        $interval = $origin->diff($target);
        [$m, $d] = explode(',', $interval->format('%m,%d'));

        if (!$m && !$d) {
            $arrival = "Поздравляем с днем рождения!";
        } else {
            $m = monthAppend($m);
            $d = dayAppend($d);
            $arrival = "{$m} и {$d} до ДР";
        }

        return ['b_day' => $rbDay, 'age' => $age, 'arrival' => $arrival];
    }

    public function getStar()
    {
        $query = 'SELECT s.id, s.name, s.main_photo, s.location, s.person_descr, s.content, s.b_day, s.profession FROM stars AS s';
        $res = PdoM::Instance()->Select($query);
        foreach ($res as $key => $val) {
            return $val;
        }
    }
}