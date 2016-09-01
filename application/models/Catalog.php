<?php


namespace application\models;

use lib\ApplicationDataBase;

/**
 * Class Catalog
 * @package application\models
 * модель каталога
 */
class Catalog
{
    /**
     * @return array|bool
     * получает список всех товаров
     */
    public function getList()
    {
        $query = "select * from pShop.product";
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