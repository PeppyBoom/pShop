<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31.08.2016
 * Time: 15:04
 */

namespace application\models;


use lib\ApplicationDataBase;

class Product
{
    /**
     * @param $id
     * @return array
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