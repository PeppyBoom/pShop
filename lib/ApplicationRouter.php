<?php
namespace lib;


use PDOException;

/**
 * Class Lib_Application
 * @package lib
 * класс маршрутизатор, подбирает нужный контроллер для  обработки данных
 */
class ApplicationRouter
{
    private function getRoute()
    {
        if (empty($_GET['route'])) {
            $route = 'MainController';
        } else {
            $route = $_GET['route'];
            $rt = explode("/", $route);
            $route = $rt[count($rt) - 1];

            if ($rt[count($rt) - 2] == "product") {
                $query = "select * from product where url LIKE '$route'";
                try {
                    $result = $GLOBALS['connection']->query($query);

                    while ($row = $result->fetch()) {
                        $_REQUEST['id'] = $row['id'];
                        $route = "product";
                    }
                } catch (PDOException $e) {
                    echo "Не удалось выполнить запрос!";
                    file_put_contents("PDOErrors.txt", $e->getMessage(), FILE_APPEND);
                }
            }
        }

        return $route;
    }

    private function getController()
    {
        $route = $this->getRoute();
        $pathController = "\\application\\controllers\\";
        $controller = $pathController . $route;

        return $controller;
    }

    public function getView()
    {
        $route = $this->getRoute();
        $route = str_replace("Controller", "", $route);
        $pathView = "\\application\\views\\$route\\";
        $view = $pathView . $route . ".php";

        return $view;
    }

    public function run()
    {
        session_start();
        $controller = $this->getController();
        $nameController = $controller;
        $controller = new $nameController;
        $controller->index();
        $member = $controller->member;

        return $member;
    }
}