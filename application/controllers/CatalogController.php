<?php


namespace application\controllers;

use application\models\Cart;
use application\models\Catalog;
use lib\SmallCart;

/**
 * Class CatalogController
 * @package application\controllers
 * контроллер каталога
 */
class CatalogController extends BaseController
{
    /**
     * вывод и заказ товара в каталоге
     */
    public function index()
    {
        if ($id = $_REQUEST['in-cart-product-id']) {
            $cart = new Cart();
            $cart->addToCart($id);
            SmallCart::getInstance()->setCartData();
            header("Location: /catalog");
            exit();
        }

        $model = new Catalog();
        $catalogItems = $model->getList();
        $this->catalogItems = $catalogItems;
    }
}