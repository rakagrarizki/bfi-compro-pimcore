<div>
    <div id="ajukan-sekarang" class="point-step">
        <div class="sect-title text-center">
            <p class="title"><?= $this->input('title');?></p>
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

        <div class="btn-ajukan margin-bottom-85 margin-top-70">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange"><?= $this->link('url')->getText(); ?></a>
        </div>

    </div>
</div>