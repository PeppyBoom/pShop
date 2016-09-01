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
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function connection()
    {
        try {
            self::$connection = new PDO(
                "mysql:host = " . HOST .
                ";dbName = " . DB_NAME .
                ";charset = " . CHARSET
                , DB_USER
                , DB_PASSWORD
//                , [PDO::ATTR_PERSISTENT => true]
            );
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Не удалось подключиться к базе!";
            file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
        }

        return self::$connection;
    }

    public static function getInstance()
    {
        return null == self::$instance ? new static() : self::$instance;
    }

    /**
     * @param $query
     * @return \PDOStatement
     */
    public function query($query)
    {
        if (($numArgs = func_num_args()) > 1) {
            $args = func_get_args();
            $query = vsprintf($query, $args);
        }

        if (preg_match('`^(INSERT|UPDATE|DELETE|REPLACE)`i', $query, $null)) {
            try {
                $result = self::connection()->exec($query);
                return $result;
            } catch (PDOException $e) {
                echo "Не удалось выполнить запрос!";
                file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
            }
        } elseif(preg_match('`^(SELECT)`i', $query, $null)) {
            try {
                $result = self::connection()->query($query);
                return $result;
            } catch (PDOException $e) {
                echo "Не удалось выполнить запрос!";
                file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
            }
        } else {
            echo "В этом методе такой запрос не возможен!";
        }
    }

    /**
     * @param $query
     * @param $arr
     * @param string $divide
     * @return bool|\PDOStatement
     */
    public function buildQuery($query, $arr, $divide = ',')
    {
        if (is_array($arr)) {
            $partQuery = '';

            foreach ($arr as $index => $value) {
                $partQuery .= sprintf(" %s = '%s'" . $divide, $index, $value);
            }

            $partQuery = trim($partQuery, $divide);
            $query .= $partQuery;
            return $this->query($query);
        }

        return false;
    }

    public function insertId()
    {
        return self::$connection->lastInsertId();
    }
}