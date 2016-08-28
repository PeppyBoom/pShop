<?php

namespace lib;
use PDO;
use PDOException;

/**
 * Class ApplicationDataBase
 * @package lib
 */
class ApplicationDataBase
{
    private static $dataBase = [
        "HOST" => "localhost",
        "USER" => "root",
        "PASSWORD" => "",
        "NAME" => "tShop",
        "CHARSET" => "utf-8",
    ];

    private static $connection;

    private static $instance = null;

    /**
     * ApplicationDataBase constructor.
     */
    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

    public static function connection() {
        try {
            self::$connection = new PDO(
                "mysql:host = " . self::$dataBase["HOST"] .
                ";dbName = " . self::$dataBase["NAME"] .
                ";charset = " . self::$dataBase["CHARSET"],
                self::$dataBase["USER"],
                self::$dataBase["PASSWORD"],
                [PDO::ATTR_PERSISTENT => true]
            );
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Не удалось подключиться к базе!";
            file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
        }

        return self::$connection;
    }

    public static function getInstance() {
        return null == self::$instance ? new static() : self::$instance;
    }

    /**
     * @param $query
     * @return \PDOStatement
     */
    public function query($query) {
        try {
            $result = self::connection()->query($query);
            return $result;
        } catch (PDOException $e) {
            echo "Не удалось выполнить запрос!";
            file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
        }
    }
}