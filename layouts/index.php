<?php

//выводится шапка сайта
include_once "header.php";

//выводится вьюха контроллера
include $router->getView();

//выводится футер сайта
include_once "footer.php";