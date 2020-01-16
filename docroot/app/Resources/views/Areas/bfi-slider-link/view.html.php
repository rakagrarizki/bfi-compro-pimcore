<div>
    <div id="herobanner2" class="herobanner herobanner--secondary">
        <?php while ($this->block("contentblock")->loop()) { ?>
            <?php $asset = $this->image("image"); ?>
            <?php $assetFounder = $this->image("image-founder"); ?>
            <div>
                <!-- desktop -->
                <div class="slide slidemodif hidden-xs" style="background-image: url('<?= $asset->getImage() ?>')">
                    <div class="slide-cont">
                        <div class="desc-slide2">
                            <div class="desc-cont container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="slider-content-wrapper">
                                            <p class="title"><?= $this->input('title'); ?></p>
                                            <a class="lihat-produk" href="<?= $this->link("url")->getHref(); ?>"><u><b><?= $this->link("url")->getText(); ?></b></u><!-- <i class="fa fa-angle-right"></i> --></a>
                                            <p class="quotes"><?= $this->textarea('text'); ?></p>
                                            <div class="bungkus-img-people"><img src="<?= $assetFounder->getImage() ?>" class="img-responsive img-people" alt=""></div>
                                            <div class="cont-name">
                                                <p class="name"><?= $this->input('founder'); ?></p>
                                                <p class="position"><?= $this->input('position'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="tagar hidden-xs"><?= $this->input('hashtag'); ?></div>
                        </div>
                    </div>
                </div>

                <!-- mobile -->
                <?php $assetMobile = $this->image('mobile-image'); ?>
                <div class="slide slidemodif visible-xs" style="background-image: url('<?= $assetMobile->getImage() ?>')">
                    <div class="slide-cont">
                        <div class="desc-slide2">
                            <div class="desc-cont container">
                                <div class="row">
                                    <div class="col-md-10 col-md-offset-1">
                                        <p class="title"><?= $this->input('title'); ?></p>
                                        <p class="quotes"><?= $this->textarea('text'); ?></p>
                                        <div class="bungkus-img-people"><img src="<?= $assetFounder->getImage() ?>" class="img-responsive img-people" alt=""></div>
                                        <div class="cont-name">
                                            <p class="name"><?= $this->input('founder'); ?></p>
                                            <p class="position"><?= $this->input('position'); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="tagar hidden-xs"><?= $this->input('hashtag'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="container navigation">
        <div class="row">
            <div class="slick-nav">
                <div class="prev prev-2 btn-kotak arrowbanner bawah"></div>

            </div>
            <div class="slick-nav">
                <div class="next next-2 btn-kotak arrowbanner bawah"></div>
            </div>
        </div>
    </div>
</div>