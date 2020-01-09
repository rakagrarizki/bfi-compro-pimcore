<div class="slider-author">
    <div class="slider-author__wrapper">
        <?php while ($this->block("contentblock")->loop()) { ?>
            <?php $asset = $this->image("image");?>
            <?php $assetAuthor = $this->image("image-author");?>
            <div class="item-slide item-slide-produk" style="background-image: url('<?= $asset->getImage()?>')">
                <div class="container centered-content">
                    <div class="testimony-wrap">
                        <p class="testimony"><?= $this->textarea('text');?></p>
                        <span class="quote"><i class="fa fa-quote-left"></i></span>
                    </div>
                    <div class="author-wrap">
                        <div class="img-wrap">
                            <img class="img-produk" src="<?= $assetAuthor->getImage()?>" alt="">
                        </div>
                        <div class="text-wrapper">
                            <div class="author">
                                <p class="name"><?= $this->input('name-author');?></p>
                                <p class="position"><?= $this->input('position-author');?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>