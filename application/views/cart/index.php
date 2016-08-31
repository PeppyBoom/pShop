<h2>Корзина</h2>

<?php if($emptyCart):?>

    <form action="/cart" method="post">
        <?php echo $bigCart;?>
        <input type="submit" name="refresh" value="Пересчитать"  style="margin-left:10px; margin-top:10px;" />
    </form>

    <form action="/order" method="post" style="margin-left:600px;">
        <input type="submit" name="order" value="Оформить заказ" style=" height:30px; padding: 0px 20px;" />
    </form>

<?php else:?>
    Ваша корзина пуста!
<?php endif;?>