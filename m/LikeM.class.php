<?php


class LikeM
{

    /**
     * Функция выводит массив товаров корзины
     * @return array $goods массив товаров корзины
     */
    public function cart()
    {
        $goods = [];
        if (isset($_SESSION['cart_goods'])) {
            $cartSession = $_SESSION['cart_goods']; //массив данных сессии корзины
            foreach ($cartSession as $key => $val) {
                $id = $val['id'];
                $quantity = $val['quantity'];
                $size = $val['size'];
                $sessionKey = $key;
                $query = "SELECT g.id, g.model, g.img, g.price, ca.category, b.brand, co.color
                    FROM goods AS g
                    JOIN brand AS b ON g.brand = b.id_brand
                    JOIN color AS co ON g.color = co.id_color
                    JOIN category AS ca ON g.category = ca.id_category 
                    WHERE id='$id'";
                $res = PdoM::Instance()->Select($query);
                foreach ($res as $key => $val) {
                    $val['quantity'] = $quantity;
                    $val['size'] = $size;
                    $val['key'] = $sessionKey;
                    $val['sum'] = $quantity * $val['price'];
                    $goods[] = $val;
                }
            }
        }
        return $goods;
    }

    /**
     * Функция подсчета количества товаров и суммы корзины
     * @return array
     */
    public function cartTotal($goods)
    {
        $cartCount = 0;
        $cartSum = 0;
        foreach ($goods as $key => $val) {
            $cartCount += $val['quantity'];
            $cartSum += $val['price'] * $val['quantity'];
        }
        return array($cartCount, $cartSum);
    }

    /**
     * Функция добавления товаров в корзину. Создает сессию корзины
     * Данные получает через ajax
     * @return array $cartSession возвращается в ajax
     */
    public function addOld()
    {
        $id = $_POST['id'];
        $size = $_POST['size'];
        $cartSession = [];

        if (isset($_SESSION['cart_goods'])) {
            $cartSession = $_SESSION['cart_goods'];
        }
        if (!empty($cartSession)) {
            $i = false;
            foreach ($cartSession as $key => $val) {
                if (($val['id'] === $id) && ($val['size'] === $size)) {
                    $cartSession[$key]['quantity'] = $cartSession[$key]['quantity'] + 1;
                    $i = true;
                }
            }
            if (!$i) {
                $cartSession[] = ['id' => $id, 'quantity' => 1, 'size' => $size];
            }
        } else {
            $cartSession[] = ['id' => $id, 'quantity' => 1, 'size' => $size];
        }

        $_SESSION['cart_goods'] = $cartSession;
        return $cartSession;
    }


    public function add($id, $ip)
    {
        $query = "SELECT l.ip FROM `likes` AS l WHERE l.ip='$ip' AND l.id_photo='$id'";
        $findIp = PdoM::Instance()->Select($query);

        if (!$findIp) {
            return PdoM::Instance()->Insert('likes', ['id_photo' => $id, 'ip' => $ip]);
        }

        $query = "DELETE FROM `likes` WHERE id_photo = '$id' AND ip = '$ip'";
        return PdoM::Instance()->Select($query);
    }
}