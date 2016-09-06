<?php

function classAutoLoad($className)
{
    $path = strtolower($className);

    if (file_exists($path . ".php")) {
        include_once $path . ".php";
    } else {
        header("HTTP/1.0 404 Not found");
        echo "К сожалению такой страницы не существует. [ " . PATH_SITE . "/" . $path . ".php ]";
        die();
    }
}

spl_autoload_register('classAutoLoad');