<section class="widget-section" id="apply-step">
    <div class="container cont-cara">
        <div class="cara-kerja">
            <h2 class="title-cara-kerja"><?= $this->input('title'); ?></h2>
            <p class="step-cara"><?= $this->input('sub-title'); ?></p>
            <ul class="list-step">
                <?php while ($this->block("contentblock")->loop()) { ?>
                    <?php $asset = $this->image("image-step"); ?>
                    <li>
                        <div class="img-step">
                            <img src="<?= $asset->getImage() ?>" class="img-responsive" alt="<?= $this->input("alt-img")?>">
                        </div>
                        <p class="title-step"><?= $this->input('text'); ?></p>
                        <p class="desc-step"><?= $this->input('desc-step') ?></p>
                    </li>
                <?php } ?>
            </ul>
            <?php if (!$this->link("url")->isEmpty()) : ?>
                <div class="row">
                    <div class="button-area text-center no-padding">
                        <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange cta-see cta-big"><?= $this->link('url')->getText(); ?></a>
                    </div> 
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>