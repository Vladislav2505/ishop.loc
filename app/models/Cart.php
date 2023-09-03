<?php

namespace app\models;

use RedBeanPHP\R;

class Cart extends AppModel
{
    public function getProduct(int $id, int $langCode): array
    {
        return R::getRow("SELECT p.*, pd.* FROM `products` as p 
                                JOIN ishop.product_descriptions as pd on p.id = pd.product_id 
                                WHERE p.status=1 AND pd.language_id=? AND p.id=?", [$langCode, $id]);
    }

    public function addToCart(array $product, int $qty): bool
    {
        $qty = abs($qty);

        if ($product['is_download'] && isset($_SESSION['cart'][$product['id']])) {
            return false;
        }

        if (isset($_SESSION['cart'][$product['id']])) {
            $_SESSION['cart'][$product['id']]['qty'] += $qty;
        } else {
            if ($product['is_download']) {
                $qty = 1;
            }

            $_SESSION['cart'][$product['id']] = [
                'title' => $product['title'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'qty' => $qty,
                'img' => $product['img'],
                'is_download' => $product['is_download'],
            ];
        }

        $_SESSION['cart_qty'] = !empty($_SESSION['cart_qty']) ? $_SESSION['cart_qty'] + $qty : $qty;
        $_SESSION['cart_price'] = !empty($_SESSION['cart_price']) ?
            $_SESSION['cart_price'] + $qty * $product['price'] : $qty * $product['price'];

        return true;
    }
}