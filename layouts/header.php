<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/less/style.less" type="text/css" />
    <link rel="stylesheet" href="/less/normalize.less" type="text/css" />
</head>
<body>
<div id="outer_wrapper">
    <div id="inner_wrapper">
        <div id="header">
            <div class="smalcart">
                <strong>Товаров в корзине:</strong>	<?php echo $smallCart['cartCount']?> шт.
                <br/>
                <strong>На сумму:</strong>	<?php echo $smallCart['cartPrice']?> руб.
                <br/>
                <a href='/cart'>Оформить заказ</a>
            </div>
            <div class="menu">
                <?php echo $menu?>
            </div>

        </div>
        <div id="content">
            <hr/>
            <div class="left">
                &nbsp;
            </div>

