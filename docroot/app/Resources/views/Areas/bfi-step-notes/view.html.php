<div class="container cont-cara">
    <div class="row">
        <div class="cara-kerja">
            <p class="title-cara-kerja"><?= $this->input('title'); ?></p>
            <p class="step-cara"><?= $this->input('sub-title'); ?></p>
            <ul class="list-step">
                <?php while ($this->block("contentblock")->loop()) { ?>
                    <?php $asset = $this->image("image-step"); ?>
                    <li>
                        <div class="img-step">
                            <img src="<?= $asset->getImage() ?>" class="img-responsive" alt="">
                        </div>
                        <p><?= $this->input('text'); ?></p>
                    </li>
                <?php } ?>
            </ul>
            <!-- <a href="/" class="cta cta-primary cta-big cta-see"><?= $this->translate("more") ?></a> -->
            <?php if (!$this->link("url")->isEmpty()) : ?>
                <div class="row">
                    <div class="button-area text-center no-padding">
                        <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange cta-see cta-big"><?= $this->link('url')->getText(); ?></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>