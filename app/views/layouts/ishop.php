<?php
/** @var $this View */

use core\View;

?>

<?php $this->getPart('header') ?>

<?= $this->content ?>

<?php $this->getPart('footer'); ?>