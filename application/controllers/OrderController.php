<?php

namespace application\controllers;


use application\models\Order;
use lib\SmallCart;

class OrderController extends BaseController
{
    public function index()
    {
        // показываю форму ввода данных
        $this->displayForm = true;

        // если пришли данные с формы
        if (isset($_REQUEST["to_order"])) {
            //создаю модель заказа
            $model = new Order();
            //проверяю на корректность ввода
            $error = $model->isValidate($_REQUEST);

            if ($error) {
                $this->error = $error;
            } else {
                //добавляю заказ в БД
                $orderId = $model->addOrder();
                // пересчитываю маленькую корзину
                SmallCart::getInstance()->setCartData();
                header('Location: /order?thanks=' . $orderId);
                die();
            }
        }

        if ($_REQUEST["thanks"]) {
            $this->message = "Ваша заявка <strong>№ " . $_REQUEST["thanks"] . "</strong> принята";
            $this->displayForm = false;
        }
    }
}