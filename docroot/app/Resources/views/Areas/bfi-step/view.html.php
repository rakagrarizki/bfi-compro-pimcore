<div class="steps">
    <div class="container">
        <article class="sect-title text-center">
            <p class="title"><?= $this->input('title');?></p>
            <p><?= $this->input('text'); ?></p>
        </article>
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