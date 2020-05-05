<div class="download-box">
    <div class="container">

        <div class="down-box">
            <h3><?= $this->link('url')->getText(); ?></h3>
            <a href="<?= $this->link('url')->getHref(); ?>" target="<?= $this->link('url')->getTarget(); ?>">
                <span class="cta cta-big cta-orange cta-see full"><?= $this->t("more") ?></span>
            </a>
        </div>
    </div>
</div>