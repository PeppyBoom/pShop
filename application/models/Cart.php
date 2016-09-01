<?php


namespace application\models;

/**
 * Class Cart
 * @package application\models
 * модель корзины
 */
class Cart
{
    /**
     * добавляю товар в корзину
     * @param $id
     * @param int $count
     * @return bool
     */
    public function addToCart($id, $count = 1)
    {
        $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $count;

        return true;
    }


    /**
     * получаю список id продуктов из корзины
     * @return array
     */
    public function getListItemId()
    {
        if (is_array($_SESSION['cart'])) {
            $listId = array_keys($_SESSION['cart']);
            return $listId;
        }

        return [];
    }

    /**
     * возвращаю итоговую сумму корзины
     * @return int
     */
    public function getTotalSum()
    {
        $arrayProductId = $this->getListItemId();
        $itemPosition = new Product();

        //получаю информацию о каждом продукте
        foreach ($arrayProductId as $id) {
            $productPositions[] = $itemPosition->getProduct($id);
        }

        //счетаю сумму
        $totalSum = 0;
        foreach ($productPositions as $product) {
            $totalSum += $_SESSION['cart'][$product['id']] * $product['price'];
        }

        return $totalSum;
    }

    /**
     * чищу корзину
     */
    public function clearCart()
    {
        unset($_SESSION['cart']);
    }

    /**
     * обновляюсодержимое корзины
     * @param $arrayProductId
     */
    public function refreshCart($arrayProductId)
    {
        foreach ($arrayProductId as $itemId => $newCount) {
            if ($newCount <= 0) {
                unset($_SESSION['cart'][$itemId]);
            } else {
                $_SESSION['cart'][$itemId] = $newCount;
            }
        }
    }

    /**
     * проверяю корзину на пустоту
     * @return bool
     */
    public function isEmptyCart()
    {
        if ($_SESSION['cart']) return true;
        else return false;
    }

    /**
     * вывод содержимого корзины
     * @return string
     */
    public function printCart()
    {
        $arrayProductId = $this->getListItemId();
        $itemPosition = new Product();

        foreach ($arrayProductId as $id) {
            $productPositions[] = $itemPosition->getProduct($id);
        }

        $tableCart = "<table bgcolor='#E6DEEA' border='1' class='table_cart'><tr><th>№</th><th>Наименование</th><th>Стоимость</th><th>Количество</th><th>Сумма</th><th>Удалить</th></tr>";
        $i = 1;
        $totalSum = 0;

        if (!empty($productPositions)) {
            foreach ($productPositions as $product) {
                if ($i % 2 == 0) $bgColor = "#F2F2F2"; else $bgColor = "lightgray";
                $tableCart .= "<tr bgcolor=$bgColor>";
                $tableCart .= "<td>" . $i++ . "</td>";
                $tableCart .= "<td>" . $product['name'] . " # " . $product['id'] . "</td>";
                $tableCart .= "<td>" . $product['price'] . " руб. </td>";
                $tableCart .= "<td><input type='text' style='text-align:center' size=3 name='item_" . $product['id'] . "' value='" . $_SESSION['cart'][$product['id']] . "' /></td>";
                $tableCart .= "<td>" . $_SESSION['cart'][$product['id']] * $product['price'] . " руб. </td>";
                $tableCart .= "<td>" . "<INPUT TYPE='checkbox'  name='del_" . $product['id'] . "'>" . "</td>";
                $tableCart .= "</tr>";
                $totalSum += $_SESSION['cart'][$product['id']] * $product['price'];
            }
            $tableCart .= "<tr><td colspan='3'></td><td>К оплате: </td><td><strong> <span style='color: #7F0037'>" . $totalSum . " руб. </span></strong></td><td></td></tr></table>";

            return $tableCart;
        }

        return null;
    }
}