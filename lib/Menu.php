<?php


namespace lib;

/**
 * Class Menu
 * @package lib
 * Меню на сайте
 */
class Menu
{
    public $menuItem = [
        "Главная" => "/",
        "Каталог" => "/catalog",
        "Кабинет" => "/login",
    ];

    protected static $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        return null == self::$instance ? new static() : self::$instance;
    }

    /**
     * @return string
     * получает меню
     */
    public function getMenu()
    {
        $print = "<ul>";
        foreach ($this->menuItem as $name => $item) {
            if ($name == "Кабинет" && $_SESSION["User"] != "") {
                $print .= '<li><a href="/login">' . $_SESSION["User"] . '</a> [ <a href="/login?out=1"><span style="font-size:10px">выйти</span></a> ]</li>';
            } else {
                $print .= '<li><a href="' . $item . '">' . $name . '</a></li>';
            }
        }
        $print .= "</ul>";
        return $print;
    }
}