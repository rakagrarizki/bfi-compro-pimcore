<div>
    <div class="slider-author">
        <div class="slider-author__wrapper">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("image");?>
                <?php $assetAuthor = $this->image("image-author");?>
                <div class="item-slide item-slide-produk" style="background-image: url('<?= $asset->getImage()?>')">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-md-4 col-sm-4">
                                <div class="img-wrap">
                                    <img class="img-produk" src="<?= $assetAuthor->getImage()?>" alt="">
                                </div>
                            </div>
                            <div class="col-lg-10 col-md-8 col-sm-8 text-wrapper-produk">
                                <div class="text-wrapper">
                                    <p><?= $this->textarea('text');?></p>
                                    <div class="author">
                                        <h4><strong><?= $this->input('name-author');?></strong></h4>
                                        <h4><?= $this->input('position-author');?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>