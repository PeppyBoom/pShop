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
    /**
     * @return string
     * роутер
     */
    private function getRoute()
    {
        if (empty($_GET['route'])) {
            $route = 'Main';
        } else {
            $route = $_GET['route'];
            $rt = explode("/", $route);
            $route = $rt[count($rt) - 1];

            if ($rt[count($rt) - 2] == "product") {
                $query = "select * from product where url LIKE '$route'";
                try {
                    $statement = ApplicationDataBase::getInstance()->query($query);

                    while ($row = $statement->fetchObject()) {
                        $_REQUEST['id'] = $row->id;
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

    /**
     * @return string
     * получает нужный контроллер
     */
    private function getController()
    {
        $route = $this->getRoute();
        $pathController = "\\application\\controllers\\";
        $controller = $pathController . $route . "Controller";

        return $controller;
    }

    /**
     * @return string
     * получает вьюху соответствующего контроллера
     */
    public function getView()
    {
        $route = $this->getRoute();
        $route = str_replace("Controller", "", $route);
        $pathView = "\\application\\views\\$route\\";
        $view = $pathView . "index.php";

        return $view;
    }

    /**
     * @return mixed
     * вызввает контроллер и возвращает его свойства
     */
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