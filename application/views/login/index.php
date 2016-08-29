<?php

if(!$formHidden):?>
    <h1>Вход в личный кабинет</h1>
<?php endif;?>
<?php

if(!$formHidden):
    echo $message;
    ?>
    <form action="/login" method="POST">
        <div class="label">Логин: </div><div class="login"><input type="text" name="login" value="<?php echo $login?>" placeholder="admin"/></div>
        <div class="clear"></div>
        <div class="label">Пароль: </div><div class="pass"><input type="password" name="pass" value="<?php echo $password?>" placeholder="1"/></div>
        <div class="clear"></div>
        <div class="send"><input type="submit" value="Вход" /></div>
    </form>
<?php else:?>
    <h1>Личный кабинет пользователя <?php echo $_SESSION["User"]?></h1>
    <a href="/login?out=1">Выйти из кабинета!</a>
<?php endif;?>
