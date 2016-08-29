<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.08.2016
 * Time: 18:03
 */

namespace application\controllers;

use application\models\Catalog;

/**
 * Class CatalogController
 * @package application\controllers
 * контроллер каталога
 */
class CatalogController extends BaseController
{
    public function index()
    {
        if ($id = $_REQUEST['in-cart-product-id']) {
            $cart = new Cart();
            $cart->addToCart($id);
            SmalCart::getInstance()->setCartData();
            header("Location: /catalog");
            exit();
        }

        $model = new Catalog();
        $catalogItems = $model->getList();
        $this->catalogItems = $catalogItems;
    }
}