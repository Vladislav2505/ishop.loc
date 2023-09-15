<div class="dropdown d-inline-block">
    <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
        <img src="<?= PATH ?>/assets/img/lang/<?= \core\App::$app->getProperty('lang')['code'] ?>.png" alt="lang">
    </a>
    <ul class="dropdown-menu" id="languages">
        <?php foreach ($this->languages as $k => $v): ?>

            <?php if (\core\App::$app->getProperty('lang')['code'] == $k) continue; ?>

            <li>
                <button class="dropdown-item" data-langcode="<?= $k ?>">
                    <img src="<?= PATH ?>/assets/img/lang/<?= $k ?>.png" alt="lang">
                    <?= $v['title'] ?>
                </button>
            </li>

        <?php endforeach; ?>
    </ul>
</div>