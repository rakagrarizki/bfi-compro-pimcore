<div class="download-box">
    <div class="container">

        <div class="down-box">
            <h3><?= $this->link('url')->getText(); ?></h3>
            <a href="<?= $this->link('url')->getHref(); ?>" target="<?= $this->link('url')->getTarget(); ?>" class="cta cta-down" download>
                <span><?= $this->t("download") ?></span>
            </a>
        </div>
    </div>
</div>