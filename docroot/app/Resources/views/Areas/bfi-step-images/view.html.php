<div>
    <div id="ajukan-sekarang" class="point-step container">
        <div class="sect-title text-center">
            <h1 class="title"><?= $this->input('title');?>
            <?php if (!$this->input("additional-title")->isEmpty()) { ?>
                <span><?= $this->input('additional-title');?></span>
            <?php } ?>
            </h1>
            <p class="sub-title"><?= $this->input('text'); ?></p>
        </div>
        <div class="sect-step">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("sub-image");?>
                <div class="sect-step__item">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="<?= $asset->getImage()?>" alt="<?= $this->input("alt-img")?>">
                        </div>
                        <div class="col-md-8">
                            <div class="text-wrap">
                                <h3><?= $this->input('sub-title');?></h3>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if($this->checkbox("show-btn")->isChecked()) { ?>
            <div class="btn-ajukan margin-bottom-85 margin-top-70">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange <?= $this->link('url')->getClass(); ?>" id="<?= $this->link('url')->getParameters()?>"><?= $this->link('url')->getText(); ?></a>
        </div>
            <?php } ?>
        <?php if($this->checkbox("show-terms")->isChecked()) { ?>
            <div class="terms">*<?= $this->input("terms"); ?></div>
        <?php } ?>
    </div>
</div>
