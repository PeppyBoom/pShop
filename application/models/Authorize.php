<?php


namespace application\models;

use lib\ApplicationDataBase;

/**
 * Class Authorize
 * @package application\models
 * модель авторизации
 */
class Authorize
{
    /**
     * @param $login
     * @param $password
     * @return array
     * проверка данных авторизации
     */
    public function validateAuth($login, $password) {
        $query = ApplicationDataBase::getInstance()->query("select * from pShop.user where login = '$login' and pass = '$password'");

        if ($query->fetchObject()) {
            $_SESSION['Auth'] = true;
            $_SESSION['User'] = $login;
        } else {
            $_SESSION['Auth'] = false;
        }

        if (!$_SESSION["Auth"]) {
            $message="<em><span style='color:red'>Данные введены не верно!</span></em>";
            $formHidden = false;
        } else {
            $message="<em><span style='color:green'>Вы верно ввели данные!</span></em>";
            $formHidden = true;
        }

        $result = [
            "formHidden"=>$formHidden,
            "message"=>$message,
            "login"=>$login,
            "password"=>$password,
        ];

        return $result;
    }
}