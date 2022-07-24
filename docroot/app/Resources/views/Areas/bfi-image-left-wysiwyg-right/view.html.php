<?php $asset = $this->image("image"); ?>
<div class="about-us-page" id="about-us-page">
    <div class="container">
        <div class="row activities-section">
            <div class="sect-title text-center">
                <h3><?= $this->input('title');?></h3>
            </div>
            <div class="col-md-6">
                <div class="side-image">
                    <img src="<?= $asset->getImage()?>" alt="<?= $this->input("alt-img")?>">
                </div>
            </div>
            <div class="col-md-6 text">
                <?php if (!$this->input("title")->isEmpty()) : ?>
                <h4 class="activities-content-title"><?= $this->input('title');?></h4>
                <?php endif; ?>
                <?= $this->wysiwyg("text"); ?>
                <?php if (!$this->link("link")->isEmpty()) : ?>
                    <br><br>
                    <div class="row">
                        <div class="button-area text-center no-padding" style="float: left;margin-left: 1rem;">
                            <a href="<?= $this->link("link")->getHref(); ?>" class="cta cta-orange cta-see cta-big"><?= $this->link("link")->getText(); ?></a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>