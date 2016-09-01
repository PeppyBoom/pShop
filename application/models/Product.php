<?php


namespace application\models;


use lib\ApplicationDataBase;

/**
 * Class Product
 * @package application\models
 * модель товаров
 */
class Product
{
    /**
     * @param $id
     * @return array
     * возвращает товар по его Id
     */
    public function getProduct($id)
    {
        $query = "select * from tshop.product where id ='$id'";
        $statement = ApplicationDataBase::getInstance()->query($query);

        if ($row = $statement->fetchObject()) {
            $product = [
                "id" => $row->id,
                "name" => $row->name,
                "desc" => $row->desc,
                "price" => $row->price
            ];

            return $product;
        }

        return [];
    }

    /**
     * @param $id
     * @return bool
     * возвращает цену товара по его Id
     */
    public function getProductPrice($id)
    {
        $query = "select price from tshop.product where id = '$id'";
        $statement = ApplicationDataBase::getInstance()->query($query);

        if ($row = $statement->fetchObject()) {
            return $row->price;
        }

        return false;
    }
}