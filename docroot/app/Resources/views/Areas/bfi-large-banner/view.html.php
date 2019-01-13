<div>
    <div id="herobanner" class="herobanner">
        <?php while ($this->block("contentblock")->loop()) { ?>
            <?php $asset = $this->image("image");?>
            <div class="slide" style="background-image: url('<?= $asset->getImage()?>')">
                <div class="slide-cont">
                    <div class="desc-slide">
                        <div class="desc-cont container">
                            <h3><?= $this->input('title');?></h3>
                            <h1><?= $this->input('text'); ?></h1>
                        </div>
                    </div>
                    
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="container navigation">
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