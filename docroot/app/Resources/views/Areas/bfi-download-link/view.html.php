<div class="download-box">
    <div class="container">

        <div class="down-box">
            <div class="row">
                <h3><?= $this->link('url')->getText(); ?></h3><br>
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down" download>
                    <span><?= $this->t("download") ?></span>
                </a>
            </div>
        </div>
    </div>
</div>