

<?php $asset = $this->image("image");?>

<!-- Desktop View -->

<div class="about-us-page hidden-xs">
    <div class="container">
        <div class="row activities-section contact-hi">
            <!-- <div class="sect-title text-center"></div> -->
            <div class="col-md-6 text">
            <?php if (!$this->input("title")->isEmpty()) : ?>
                <h2><?= $this->input('title');?></h2>
            <?php endif; ?>
                <?= $this->wysiwyg("text"); ?>
                <?php if(!$this->link("link")->isEmpty()) : ?>
                    <br><br>
                    <div class="row">
                        <div class="button-area no-padding button-left">
                            <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link("link")->getHref();?>" class="cta cta-orange cta-see cta-big"><?= $this->link("link")->getText();?></a>
                        </div>
                    </div>
                <?php endif?>
            </div>
            <div class="col-md-6">
                <div class="side-image" >
                <a href="<?= $asset->getImage()?>" target="_blank"> 
                <img src="<?= $asset->getImage()?>" alt="<?= $this->input("alt-img")?>"></a></div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile view -->

<div class="about-us-page hidden-lg hidden-sm hidden-md">
    <div class="container">
        <div class="row activities-section contact-hi">
        <?php if (!$this->input("title")->isEmpty()) : ?>
            <div class="sect-title text-center">
                <h2><?= $this->input('title');?></h2>
            </div>
        <?php endif; ?>
            <div class="col-md-6">
            <div class="side-image" >
                <a href="<?= $asset->getImage()?>" target="_blank"> 
                <img src="<?= $asset->getImage()?>"></a></div>
            </div>
        
            <div class="col-md-6 text">
                
                <?= $this->wysiwyg("text"); ?>
                <?php if(!$this->link("link")->isEmpty()) : ?>
                    <br><br>
                    <div class="row">
                        <div class="button-area text-center no-padding">
                            <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link("link")->getHref();?>" class="cta cta-orange cta-see cta-big"><?= $this->link("link")->getText();?></a>
                        </div>
                    </div>
                <?php endif?>
            </div>
            
        </div>
    </div>
</div>
