<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 29.08.2016
 * Time: 18:08
 */

namespace application\models;

use lib\ApplicationDataBase;

/**
 * Class Catalog
 * @package application\models
 * модель каталога
 */
class Catalog
{
    public function getList()
    {
        $query = "select * from tshop.product";
        $result = ApplicationDataBase::getInstance()->query($query);

        if (is_object($result)) {
            while ($row = $result->fetchObject()) {
                $catalogItems[] = [
                    "id" => $row->id,
                    "name" => $row->name,
                    "description" => $row->desc,
                    "price" => $row->price,
                    "url" => $row->url,
                ];
            }
        }

        return !empty($catalogItems) ? $catalogItems : false;
    }
}