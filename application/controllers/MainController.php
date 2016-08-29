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
        $statement = ApplicationDataBase::getInstance()->query(
//            "alter table tshop.user add date TIMESTAMP",
            "select * from tshop.user",
            "insert into tshop.user (login, pass, role) VALUES ('', '', 2)");

        if (is_object($statement)) {
            while ($row = $statement->fetchObject()) {
                echo $row->login . "<br/>\n";
            }
        }
    }
}