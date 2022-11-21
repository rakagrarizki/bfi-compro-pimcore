<section class="widget-section cta-button-widget">
    <div <?= !$this->input("id-selector")->isEmpty() ? "id=" . $this->input("id-selector") : "" ?>>
        <div class="container">
            <div class="row">
                <div class="col-md-8 cta-desc">
                    <p class="cta-text"><?= $this->input("text-desc") ?></p>
                </div>
                <div class="col-md-4 cta-link">
                    <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange">
                            <?= $this->link('url')->getText(); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>