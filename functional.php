<?php
$menu = getMenu();
$mallCart = getSmallCart();

//подключаю меню
function getMenu() {
    return Lib_Men::getInstance()->getMenu();
}

//подключаю маленькую корзину
function getSmallCart() {
    return Lib_SmallCart::getInstance()->getCartData();
}