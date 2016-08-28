<?php

use lib\Application;

require_once "./config.php";

//создаю объект, который ищет нужные контроллеры
$router = new Application();
$member = $router->run();

//если контроллер вернул какие-то переменные, то делаю их доступными для публичной части
if (isset($member)) {
    foreach ($member as $key => $value) {
        $$key = $value;
    }
}

//подключаю функционал сайта
//require_once "./functional.php";
//подключаю шаблоны сайта
//require_once "./layouts/index.php";