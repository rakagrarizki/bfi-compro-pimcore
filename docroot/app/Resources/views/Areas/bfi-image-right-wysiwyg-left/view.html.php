

<?php $asset = $this->image("image");?>

<!-- Desktop View -->

<div class="about-us-page hidden-xs">
    <div class="container">
        <div class="row activities-section contact-hi">
            <div class="sect-title text-center">
                <h2><?= $this->input('title');?></h2>
            </div>
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

<!-- Mobile view -->

<div class="about-us-page hidden-md">
    <div class="container">
        <div class="row activities-section contact-hi">
            <div class="sect-title text-center">
                <h2><?= $this->input('title');?></h2>
            </div>
            <div class="col-md-6">
                <div class="side-image" style="background-image: url('<?= $asset->getImage()?>')"></div>
            </div>
        
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
            
        </div>
    </div>
</div>
