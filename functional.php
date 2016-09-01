<?php
use lib\Menu;
use lib\SmallCart;

$menu = getMenu();
$smallCart = getSmallCart();


/**
 * @return string
 * подключает меню
 */
function getMenu()
{
    return Menu::getInstance()->getMenu();
}

/**
 * @return array
 * подключает маленькую корзину
 */
function getSmallCart()
{
    return SmallCart::getInstance()->getCartData();
}