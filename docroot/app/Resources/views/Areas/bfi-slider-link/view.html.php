<div>
    <div id="herobanner2" class="herobanner herobanner--secondary">
        <?php while ($this->block("contentblock")->loop()) { ?>
            <?php $asset = $this->image("image");?>
            <?php $assetFounder = $this->image("image-founder");?>
            <div class="slide slidemodif" style="background-image: url('<?= $asset->getImage()?>')">
                <div class="slide-cont">
                    <div class="desc-slide2">
                        <div class="desc-cont container">
                            <div class="row">
                                <div class="col-md-10 col-md-offset-1">
                                    <p class="title"><?= $this->input('title');?></p>
                                    <a href="<?= $this->link('url')->getHref(); ?>">LIHAT PRODUK</a>
                                    <p class="quotes"><?= $this->textarea('text');?></p>
                                    <div class="bungkus-img-people"><img src="<?= $assetFounder->getImage()?>" class="img-responsive img-people" alt=""></div>
                                    <div class="cont-name">
                                        <p class="name"><?= $this->input('founder');?></p>
                                        <p class="position"><?= $this->input('position');?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="tagar hidden-xs"><?= $this->input('hashtag');?></div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="container navigation">
        <div class="row">
            <div class="slick-nav">
                <div class="prev prev-2 btn-kotak arrowbanner"></div>

            </div>
            <div class="slick-nav">
                <div class="next next-2 btn-kotak arrowbanner"></div>
            </div>
        </div>
    </div>
</div>