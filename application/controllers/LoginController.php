<?php


namespace application\controllers;
use application\models\Authorize;

/**
 * Class LoginController
 * @package application\controllers
 * контроллер обрабатывает данные авторизации
 */
class LoginController extends BaseController
{
    /**
     * авторизация
     */
    public function index()
    {
        //если пришли логин и пароль, создаю модель проверки авторизации и передаю их в нее
        if ($_REQUEST['login'] && $_REQUEST['pass']) {
            $model = new Authorize();
            $resultValidation = $model->validateAuth($_REQUEST['login'], $_REQUEST['pass']);

            //полученный результат проверки записываю в переменные для вывода в публичной части сайта
            $this->formHidden=$resultValidation['formHidden'];
            $this->userName=$resultValidation['login'];
            $this->message=$resultValidation['message'];
            $this->login=$resultValidation['login'];
            $this->password=$resultValidation['password'];
        } elseif ($_SESSION['Auth']) {
            $this->formHidden = true;
        }

        if ($_REQUEST['out'] == true) {
            $_SESSION["Auth"] = false;
            $_SESSION["User"] = "";
            $this->formHidden = false;
        }
    }
}