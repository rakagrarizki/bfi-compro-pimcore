<div>
    <div id="ajukan-sekarang" class="point-step">
        <div class="sect-title text-center">
            <h2><?= $this->input('title');?></h2>
            <p><?= $this->input('text'); ?></p>
        </div>
        <div class="sect-step">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("sub-image");?>
                <div class="sect-step__item">
                    <img src="<?= $asset->getImage()?>" alt="">
                    <div class="text-wrap">
                        <p><?= $this->input('sub-title');?></p>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="btn-ajukan">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange"><?= $this->link('url')->getText(); ?></a>
        </div>

    </div>
</div>