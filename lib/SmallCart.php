<?php


namespace lib;

/**
 * Class SmallCart
 * @package lib
 * маленькая корзина
 */
class SmallCart
{
    protected static $instance = null;

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function getInstance()
    {
        return null == self::$instance ? new static() : self::$instance;
    }

    /**
     * сохраняю значение в куках
     */
    public function setCartData()
    {
        $cartContent = serialize($_SESSION['cart']);
        setcookie("cart", $cartContent, time() + 3600 * 24 * 365);
    }

    /**
     * @return bool
     */
    protected function getCookieCart()
    {
        if (isset($_COOKIE)) {
            $_SESSION['cart'] = unserialize(stripcslashes($_COOKIE['cart']));

            return true;
        }

        return false;
    }

    /**
     * Получаю данные из БД - вычисляю общую стоимость содержимого, а также количество
     * @return array
     */
    public function getCartData()
    {
        $result = [
            'cartCount' => 0,
            'cartPrice' => 0,
        ];

        if ($this->getCookieCart() && $_SESSION['cart']) {
            foreach ($_SESSION['cart'] as $id => $count) {
                $query = "select p.price from tshop.product p where id = '{$id}'";
                $statement = ApplicationDataBase::getInstance()->query($query);

                if ($row = $statement->fetchObject()) {
                    $result['cartPrice'] += $row->price * $count;
                    $result['cartCount'] += $count;
                }
            }
        }

        return $result;
    }
}