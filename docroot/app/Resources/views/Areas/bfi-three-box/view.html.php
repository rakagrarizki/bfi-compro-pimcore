<div>
    <?php $asset = $this->image("image");?>
    <div id="three-box" class="three-box" style="background-image: url('<?= $asset->getImage()?>')">
        <div class="container">
            <div class="row">
                <?php while ($this->block("contentblock")->loop()) { ?>
                    <?php $asset = $this->image("image");?>
                    <div class="col-md-4 textalign-center">
                        <div class="three-box__item">
                            <h4><?= $this->input('title');?></h4>

                            <a href="<?= $this->link('url')->getHref(); ?>">
                                <?= $this->link('url')->getText(); ?>
                            </a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>