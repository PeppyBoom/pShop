<?php
//Error_reporting(E_ALL & ~E_NOTICE);
//print_r(PDO::getAvailableDrivers());

define("PATH_SITE", $_SERVER['DOCUMENT_ROOT']);
define("HOST", 'localhost');
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "tShop");


function __autoload($className) {
    $path = str_replace("_", "/", strtolower($className));

    if (file_exists($path)) {
        include_once $path . ".php";
    } else {
        header("HTTP/1.0 404 Not found");
        echo "К сожалению такой страницы не существует. [ " . PATH_SITE . "/" . $path . ".php ]";
        die();
    }

    try {
        $connection = new PDO("mysql:host = " . HOST . ";dbName = " . DB_NAME . ";charset = utf-8", DB_USER, DB_PASSWORD);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Не удалось подключиться к базе!";
        file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
    }
}