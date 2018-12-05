<div>
    <div class="slider-author">
        <div class="slider-author__wrapper">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("image");?>
                <?php $assetAuthor = $this->image("image-author");?>
                <div class="item-slide" style="background-image: url('<?= $asset->getImage()?>')">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="img-wrap">
                                    <img src="<?= $assetAuthor->getImage()?>" alt="">
                                </div>
                            </div>
                            <div class="col-md-10">
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