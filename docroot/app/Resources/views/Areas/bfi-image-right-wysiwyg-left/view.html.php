

<?php $asset = $this->image("image");?>
<div class="about-us-page">
    <div class="container">
        <div class="row activities-section">
            <div class="col-md-6">
                
                <?= $this->wysiwyg("text"); ?>
                <?php if(!$this->link("link")->isEmpty()) : ?>
                    <br><br>
                    <div class="row">
                        <div class="button-area text-center no-padding">
                            <a href="<?= $this->link("link")->getHref();?>" class="cta cta-orange cta-see cta-big"><?= $this->link("link")->getText();?></a>
                        </div>
                    </div>
                <?php endif?>
            </div>
            <div class="col-md-6">
                <div class="side-image" style="background-image: url('<?= $asset->getImage()?>')"></div>
            </div>
        </div>
    </div>
</div>