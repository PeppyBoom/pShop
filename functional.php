<?php
$menu = getMenu();
$mallCart = getSmallCart();

//подключаю меню
function getMenu() {
    return Lib_Menu::getInstance()->getMenu();
}

//подключаю маленькую корзину
function getSmallCart() {
    return Lib_SmallCart::getInstance()->getCartData();
}