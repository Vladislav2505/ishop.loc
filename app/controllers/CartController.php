<?php

namespace app\controllers;

use app\models\Cart;
use core\App;
use JetBrains\PhpStorm\NoReturn;

/** @property Cart $model */
class CartController extends AppController
{
    public function addAction(): void
    {
        $lang = App::$app->getProperty('lang');
        $id = get('id');
        $qty = get('qty');

        if (!$id) {
            return;
        }

        $product = $this->model->getProduct($id, $lang['id']);

        if ($product) {
            $this->model->addToCart($product, $qty);
        }

        if ($this->isAjax()) {
            $this->loadView('cart_modal');
        }

        redirect();
    }

    #[NoReturn] public function showAction(): void
    {
        $this->loadView('cart_modal');
    }
}