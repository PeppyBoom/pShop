<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.08.2016
 * Time: 17:20
 */

namespace application\controllers;


use application\models\Cart;
use lib\SmallCart;

/**
 * Class CartController
 * @package application\controllers
 */
class CartController extends BaseController
{
    public function index()
    {
        $model = new Cart();

        //если пользователь изменил данные в корзине
        if ($_REQUEST['refresh']) {
            $listItemId = $_REQUEST;

            //пробегаю по массиву , нахожу пометки на удаление и на изменение количества
            foreach ($listItemId as $itemId => $newCount) {
                $id = "";
                $count = 0;
                if ("item_" == substr($itemId, 0, 5)) {
                    $id = substr($itemId, 5);
                    $count = $newCount;
                } elseif ("del_" == substr($itemId, 0, 4)) {
                    $id = substr($itemId, 4);
                }

                if ($id) {
                    $arrProductId[$id] = (int)$count;
                }
            }

            // передаю в модель данные для обновления корзины
            $model->refreshCart($arrProductId);
            // пересчитываю маленькую корзину
            SmallCart::getInstance()->setCartData();
            header("Location: /cart");
            die();
        }

        // если пользователь очистил корзину
        if ($_REQUEST['clear']) {
            $model->clearCart();
            SmallCart::getInstance()->setCartData();
            header("Location: /cart");
            die();
        }

        //список позиций к заказу
        $bigCart = $model->printCart();
        $this->bigCart = $bigCart;
        $this->emptyCart = $model->isEmptyCart();
    }
}