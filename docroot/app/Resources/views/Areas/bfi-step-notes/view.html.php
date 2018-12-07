<div class="container cont-cara hidden-xs">
    <div class="row">
        <div class="cara-kerja">
            <p class="title-cara-kerja"><?= $this->input('title');?></p>
            <p class="step-cara"><?= $this->input('sub-title');?></p>
            <ul class="list-step">
                <?php while ($this->block("contentblock")->loop()) { ?>
                    <?php $asset = $this->image("image");?>
                    <li>
                        <div class="img-step">
                            <img src="<?= $asset->getImage()?>" class="img-responsive" alt="">
                        </div>
                        <p><?= $this->input('text');?></p>
                    </li>
                <?php } ?>
            </ul>
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big cta-see">SELENGKAPNYA</a>
        </div>
    </div>
</div>