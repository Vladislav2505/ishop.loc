<footer>
    <section class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <h4><?=___('tpl_information') ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="#"><?=___('tpl_home') ?></a></li>
                        <li><a href="#"><?=___('tpl_about_store') ?></a></li>
                        <li><a href="#"><?=___('tpl_payment_and_delivery') ?></a></li>
                        <li><a href="#"><?=___('tpl_list_contacts') ?></a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?=___('tpl_opening_hours') ?></h4>
                    <ul class="list-unstyled">
                        <li><?=___('tpl_address') ?></li>
                        <li><?=___('tpl_list_opening_hours') ?></li>
                        <li><?=___('tpl_nonstop') ?></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?=___('tpl_contacts') ?></h4>
                    <ul class="list-unstyled">
                        <li><a href="tel:5551234567">555 123-45-67</a></li>
                        <li><a href="tel:5551234567">555 123-45-68</a></li>
                        <li><a href="tel:5551234567">555 123-45-69</a></li>
                    </ul>
                </div>

                <div class="col-md-3 col-6">
                    <h4><?=___('tpl_online') ?></h4>
                    <div class="footer-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</footer>

<div class="modal fade" id="cart-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Корзина</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-cart-content">

            </div>
        </div>
    </div>
</div>

<button id="top">
    <i class="fas fa-angle-double-up"></i>
</button>

<?php $this->getDbLogs() ?>

<script>
    const PATH = '<?= PATH ?>'
</script>
<script src="<?= PATH ?>/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="<?= PATH ?>/assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?= PATH ?>/assets/js/main.js"></script>

</body>
</html>


