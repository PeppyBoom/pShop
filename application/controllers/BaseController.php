<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.08.2016
 * Time: 22:14
 */

namespace application\controllers;

/**
 * Class BaseController
 * @package application\controllers
 * базовый класс для всех контроллеров
 */
class BaseController
{
    private $member;

    function __set($name, $value) {
        $this->member[$name] = $value;
    }

    function __get($name) {
        return $this->member;
    }
}