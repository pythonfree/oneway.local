<?php

class PageM
{
    /**
     * Функция вывода списка товаров
     * @return array $goods массив товаров
     * @var string $direction направление сортировки
     * @var int $limit количество выводимых на страницу товаров
     * @var string или bool $filter фильтр для товаров
     * @var любой тип $value значение для $filter
     * @var string $sort условие сортировки
     */
    public function catalog(string $sort, string $direction, int $limit, $filter, $value)
    {
        if ($sort && $direction && $limit && $filter && $value) {
            $query = "SELECT g.id, g.model, g.material, g.img, g.price, g.description, 
                g.order_count, ca.category, b.brand, s.season, co.color
                FROM goods AS g
                JOIN brand AS b ON g.brand = b.id_brand
                JOIN season AS s ON g.season = s.id_season
                JOIN color AS co ON g.color = co.id_color
                JOIN category AS ca ON g.category = ca.id_category
                WHERE $filter = '$value'
                ORDER BY $sort $direction LIMIT $limit";
        } else {
            $query = "SELECT g.id, g.model, g.material, g.img, g.price, g.description, 
                g.order_count, ca.category, b.brand, s.season, co.color
                FROM goods AS g
                JOIN brand AS b ON g.brand = b.id_brand
                JOIN season AS s ON g.season = s.id_season
                JOIN color AS co ON g.color = co.id_color
                JOIN category AS ca ON g.category = ca.id_category";
        }
        $goods = PdoM::Instance()->Select($query);
        return $goods;
    }

    /**
     * Функция вывода описания товара
     * @return array $val массив с описание товара
     */
    public function good()
    {
        $id = $_GET['id'];
        $query = "SELECT g.id, g.model, g.material, g.img, g.price, g.description, 
            ca.category, b.brand, s.season, co.color
            FROM goods AS g
            JOIN brand AS b ON g.brand = b.id_brand
            JOIN season AS s ON g.season = s.id_season
            JOIN color AS co ON g.color = co.id_color
            JOIN category AS ca ON g.category = ca.id_category 
            WHERE id='$id'";

        $res = PdoM::Instance()->Select($query);
        foreach ($res as $key => $val) {
            return $val;
        }
    }

    public function getPhoto()
    {
        $query = 'SELECT p.photo, l.id_photo, COUNT(l.id_photo) AS liked
                    FROM photos AS p
                    JOIN likes AS l ON p.id = l.id_photo
                    GROUP BY l.id_photo';
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

    /**
     * Функция для получения фильтров из url
     * @return array массив фильтров
     */
    public function filter()
    {
        if (isset($_GET['brand'])) {
            $filter = 'b.brand';
            $value = $_GET['brand'];
        } else {
            $filter = true;
            $value = true;
        }
        return array($filter, $value);
    }

    /**
     * Функция добавляет email пользователя в БД
     */
    public function subscribe()
    {
        $query = "SELECT * FROM subscribe WHERE email = '" . $_POST['email'] . "'";
        $res = PdoM::Instance()->Select($query);
        if (!$res) {
            $res = PdoM::Instance()->Insert('subscribe', ['email' => $_POST['email']]);
        }
    }

    /**
     * Функция получает список отзывов
     * @return array $feedbacks
     * @var string $status статус отзыва или false
     */
    public function feedbacks($status)
    {
        if ($status) {
            $query = "SELECT * FROM feedbacks WHERE status = '$status' ORDER BY id DESC";
        } else {
            $query = "SELECT * FROM feedbacks ORDER BY id DESC";
        }
        $res = PdoM::Instance()->Select($query);
        $feedbacks = [];
        foreach ($res as $key => $feedbackVal) {
            $userId = $feedbackVal['id_user'];
            $user = PdoM::Instance()->Select("SELECT * FROM users WHERE id = $userId");
            foreach ($user as $key => $userVal) {
                $userName = $userVal['name'];
            }
            $feedbackVal['user_name'] = $userName;
            $feedbacks[] = $feedbackVal;
        }
        return $feedbacks;
    }

}