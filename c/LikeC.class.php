<?php


class LikeC extends BaseC
{

    public function add()
    {
        $this->like->add($_GET['id']);
    }

    /**
     * удаление товара из корзины
     */
    public function delete()
    {
        $this->cart->delete();
    }

    /**
     * очистка корзины
     */
    public function clear()
    {
        $this->cart->clear();

        header("location: index.php?class=cart&method=cart");
    }

    /**
     * оформление заказа
     */
    public function buy()
    {
        $this->cart->buy();
    }

}