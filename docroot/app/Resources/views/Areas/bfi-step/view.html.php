<div class="steps">
    <div class="container">
        <div class="sect-title text-center">
            <h2><?= $this->input('title');?></p>
            <p><?= $this->input('text'); ?></p>
        </div>
        <div class="steps-list">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("sub-image");?>
                <div class="steps-item">
                    <picture>
                        <img src="<?= $asset->getImage()?>" alt="">
                    </picture>
                    <div class="text-wrap">
                        <p><?= $this->input('sub-title');?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>