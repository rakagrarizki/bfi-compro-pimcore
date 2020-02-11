<div>
    <div id="herobanner" class="herobanner">
        <?php while ($this->block("contentblock")->loop()) { ?>
            <?php $asset = $this->image("image");?>
            <?php $assetMobile = $this->image("imageMobile");?>
            <div>
                <div class="slide hidden-xs" style="background-image: url('<?= $asset->getImage()?>')">
                    <div class="slide-cont">
                        <div class="desc-slide">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <div class="desc-cont">
                                            <h3><?= $this->input('title');?></h3>
                                            <h1><?= $this->input('text'); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slide visible-xs" style="background-image: url('<?= $assetMobile->getImage()?>')">
                    <div class="slide-cont">
                        <div class="desc-slide">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="desc-cont">
                                            <h3><?= $this->input('title');?></h3>
                                            <h1><?= $this->input('text'); ?></h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="navigation">
        <div class="row">
            <div class="slick-nav">
                <div class="prev prev-1 btn-kotak arrowbanner"></div>

            </div>
            <div class="slick-nav">
                <div class="next next-1 btn-kotak arrowbanner"></div>
            </div>
        </div>
    </div>
</div>