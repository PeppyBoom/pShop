<h1>Оформление заказа</h1>
<a href="/cart"><<< Назад в корзину</a>
<br/>
<?php if (!empty($error)) {
    echo $error;
} ?><br/>
<?php

if ($displayForm) {
    ?>
    <form action="" method="post">
        <table class="table_order_form">
            <tr bgcolor="#F2F2F2">
                <td>Ф.И.О.</td>
                <td><input type="text" name="fio" value="<?php echo $_REQUEST['fio'] ?>"/></td>
            </tr>
            <tr bgcolor="lightgray">
                <td>E-mail<span style="color: red;">*</span></td>
                <td><input type="text" name="email" value="<?php echo $_REQUEST['email'] ?>"/></td>
            </tr>
            <tr bgcolor="#F2F2F2">
                <td>Телефон</td>
                <td><input type="text" name="phone" value="<?php echo $_REQUEST['phone'] ?>"/></td>
            </tr>
            <tr bgcolor="lightgray">
                <td>Адрес<span style="color: red;">*</span></td>
                <td><textarea name="address"><?php echo $_REQUEST['address'] ?></textarea></td>
            </tr>
        </table>
        <br/>
        <input type="submit" name="to_order" value="Оформить заказ">
    </form>
<?php } else {
    echo $message;
};
?>
