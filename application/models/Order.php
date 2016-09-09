<?php

namespace application\models;


use lib\ApplicationDataBase;

/**
 * Class Order
 * @package application\models
 * модель заказов
 */
class Order
{
    private $fio;
    private $email;
    private $phone;
    private $address;

    /**
     * @param $arrayData
     * @return bool|string
     * проверка входных данных
     */
    public function isValidate($arrayData)
    {
        if (!preg_match("/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $arrayData['email'])) {
            $error = "<span style=\"color: red;\">E-mail не существует!</span>";
        } elseif (!trim($arrayData['address'])) {
            $error = "<span style=\"color: red;\">Введите адрес!</span>";
        }

        if (!empty($error)) return $error;
        else {
            $this->fio = trim($arrayData['fio']);
            $this->email = trim($arrayData['email']);
            $this->phone = trim($arrayData['phone']);
            $this->address = trim($arrayData['address']);
            return false;
        }
    }

    /**
     * @return mixed
     * добавляет заказ в базу
     */
    public function addOrder()
    {
        $date = mktime();

        $itemPosition = new Product();

        foreach ($_SESSION['cart'] as $productId => $count) {
            $price = $itemPosition->getProductPrice($productId);
            $productPositions[$productId] = [
                "price" => $price,
                "count" => $count,
            ];
        }

        $orderContent = addslashes(serialize($productPositions));
        // создаю новую корзину чтобы узнать сумму заказа
        $cart = new Cart();
        $sum = $cart->getTotalSum();

        $array = [
            "name" => $this->fio,
            "email" => $this->email,
            "phone" => $this->phone,
            "adres" => $this->address,
            "date" => $date,
            "summ" => $sum,
            "order_content" => $orderContent
        ];

        ApplicationDataBase::getInstance()->buildQuery("INSERT INTO " . DB_NAME . ".order SET", $array);
        //заказ с номером равным id добавляю в базу
        $id = ApplicationDataBase::getInstance()->insertId();

        // если заказ успешно записан, то очищаю корзину
        if ($id) $cart->clearCart();

        //номер заказа
        return $id;
    }
}