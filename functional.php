<?php
use lib\Menu;

$menu = getMenu();
//$mallCart = getSmallCart();

//подключаю меню
function getMenu() {
    return Menu::getInstance()->getMenu();
}

//подключаю маленькую корзину
//function getSmallCart() {
//    return Lib_SmallCart::getInstance()->getCartData();
//}