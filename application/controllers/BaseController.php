<?php


namespace application\controllers;

/**
 * Class BaseController
 * @package application\controllers
 * базовый класс для всех контроллеров
 */
class BaseController
{
    private $member;

    /**
     * @param $name
     * @param $value
     */
    function __set($name, $value)
    {
        $this->member[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        return $this->member;
    }
}