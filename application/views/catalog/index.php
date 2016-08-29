<div class="right">
    <h1>Каталог</h1>
    <?php

    foreach ($catalogItems as $item) {
        if ($i % 2 == 0):?>
            <div class="product">
                <div class="product_name">
                    <?php echo $item["name"] ?> # <?php echo $item["id"] ?> - <?= $item["description"]?>
                </div>
                <div class="product_price">
                    <?php echo $item["price"] ?> руб.
                </div>
                <div class="product_buy">

                    <a href="/catalog?in-cart-product-id=<?php echo $item["id"] ?>">В корзину</a>

                </div>

            </div>
        <?php else: ?>
            <div class="product even">
                <div class="product_name">
                    <?php echo $item["name"] ?> # <?php echo $item["id"] ?> - <?= $item["description"]?>
                </div>
                <div class="product_price">
                    <?php echo $item["price"] ?> руб.
                </div>
                <div class="product_buy">

                    <a href="/catalog?in-cart-product-id=<?php echo $item["id"] ?>">В корзину</a>

                </div>

            </div>
        <?php endif; ?>

        <?php
        $i++;
    }
    ?>
</div>
