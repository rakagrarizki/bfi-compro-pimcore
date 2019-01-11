<div class="block-payment">
    <?php while ($this->block("contentblock")->loop()) { ?>
        <div class="payment-wrap">
            <h4><?= $this->input("method"); ?>:</h4>
            <div class="block-payment__item">
                <?php while ($this->block("contentblock-2")->loop()) { ?>
                    <?php $asset = $this->image("image");?>
                    <div class="row">
                        <div class="col-md-4 col-sm-6"><a href="<?= $this->link('url')->getHref(); ?>"><img src="<?= $asset->getImage()?>" alt=""></a></div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>