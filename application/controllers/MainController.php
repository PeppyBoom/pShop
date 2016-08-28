<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 28.08.2016
 * Time: 21:51
 */

namespace application\controllers;


use lib\ApplicationDataBase;

/**
 * Class MainController
 * @package application\controllers
 */
class MainController extends BaseController
{
    /**
     *
     */
    public function index()
    {
        $statement = ApplicationDataBase::getInstance()->query("select * from tshop.user");

        while ($row = $statement->fetchObject()) {
            echo $row->login . "<br/>\n";
        }
    }
}