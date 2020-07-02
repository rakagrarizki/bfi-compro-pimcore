<div>
    <div id="ajukan-sekarang" class="point-step container">
        <div class="sect-title text-center">
            <h1 class="title"><?= $this->input('title');?></h1>
            <h2 class="sub-title"><?= $this->input('text'); ?></h2>
        </div>
        <div class="sect-step">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("sub-image");?>
                <div class="sect-step__item">
                    <a href="<?= $asset->getImage()?>" target="_blank"><img src="<?= $asset->getImage()?>" alt="<?= $this->input("alt-img")?>"></a>
                    <div class="text-wrap">
                        <h3><?= $this->input('sub-title');?></h3>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="btn-ajukan margin-bottom-85 margin-top-70">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange"><?= $this->link('url')->getText(); ?></a>
        </div>

    </div>
</div>
