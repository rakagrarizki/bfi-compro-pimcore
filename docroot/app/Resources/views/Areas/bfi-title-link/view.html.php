<div>
    <?php $asset = $this->image("image");?>
    <div id="pengajuan2" class="pengajuan2" style="background-image: url('<?= $asset->getImage()?>')">
        <div class="container">
            <div class="row">
                <div class="item">
                    <div class="item__row">
                        <h3><?= $this->input('title');?></h3>
                    </div>
                    <div class="item__row">
                        <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange">
                            <?= $this->link('url')->getText(); ?>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>