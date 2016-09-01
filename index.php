<?php

use lib\ApplicationRouter;

require_once "./params.php";

require_once "./classLoader.php";

//создаю объект, который ищет нужные контроллеры
$router = new ApplicationRouter();
$member = $router->run();

//если контроллер вернул какие-то переменные, то делаю их доступными для публичной части
if (isset($member)) {
    foreach ($member as $key => $value) {
        $$key = $value;
    }
}

//подключаю меню и маленькую корзину
require_once "./functional.php";
//подключаю шаблоны сайта
require_once "./layouts/index.php";