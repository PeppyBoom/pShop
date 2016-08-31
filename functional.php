<?php
use lib\Menu;
use lib\SmallCart;

$menu = getMenu();
$smallCart = getSmallCart();

//подключаю меню
function getMenu() {
    return Menu::getInstance()->getMenu();
}

//подключаю маленькую корзину
function getSmallCart() {
    return SmallCart::getInstance()->getCartData();
}