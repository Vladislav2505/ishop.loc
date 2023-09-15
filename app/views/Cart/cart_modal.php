<div class="modal-body">
    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="table-responsive cart-table">
            <table class="table text-start">
                <thead>
                <tr>
                    <th scope="col"><?=___('tpl_cart_photo')?></th>
                    <th scope="col"><?=___('tpl_cart_product')?></th>
                    <th scope="col"><?=___('tpl_cart_qty')?></th>
                    <th scope="col"><?=___('tpl_cart_price')?></th>
                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($_SESSION['cart'] as $k => $item): ?>
                    <tr>
                        <td>
                            <a href="product/<?= $item['slug'] ?>"><img
                                        src="<?= PATH . $item['img'] ?>"
                                        alt=""></a>
                        </td>
                        <td><a href="product/<?= $item['slug'] ?>"><?= $item['title'] ?></a></td>
                        <td><?= $item['qty'] ?></td>
                        <td><?= $item['price'] ?></td>
                        <td><a href="cart/delete?id=<?= $k ?>"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="4" class="text-end"><?= ___('tpl_cart_total_qty')?></td>
                    <td class="cart-qty"><?=$_SESSION['cart_qty']?></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-end"><?= ___('tpl_cart_sum')?></td>
                    <td class="cart-price"><?=$_SESSION['cart_price']?></td>
                </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <h4><?=___('tpl_cart_empty')?></h4>
    <?php endif; ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-success ripple" data-bs-dismiss="modal">
        <?=___('tpl_cart_btn_continue')?>
    </button>
    <?php if (!empty($_SESSION['cart'])): ?>
        <button type="button" class="btn btn-primary"><?=___('tpl_cart_btn_order')?></button>
        <button type="button" class="btn btn-danger"><?=___('tpl_cart_btn_clear')?></button>
    <?php endif; ?>
</div>