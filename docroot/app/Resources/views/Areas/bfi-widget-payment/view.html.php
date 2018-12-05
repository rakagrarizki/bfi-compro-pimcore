<div class="block-payment">
    <?php while ($this->block("contentblock")->loop()) { ?>
        <div class="payment-wrap">
            <h4><?= $this->input("method"); ?>:</h4>
            <div class="block-payment__item">
                <?php while ($this->block("contentblock-2")->loop()) { ?>
                    <?php $asset = $this->image("image");?>
                    <a href="<?= $this->link('url')->getHref(); ?>"><img src="<?= $asset->getImage()?>" alt=""></a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
</div>