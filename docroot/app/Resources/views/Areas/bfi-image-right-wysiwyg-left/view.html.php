

<?php $asset = $this->image("image");?>
<div class="about-us-page">
    <div class="container">
        <div class="row activities-section">
            <div class="col-md-6">
                <?= $this->wysiwyg("text"); ?>
            </div>
            <div class="col-md-6">
                <div class="side-image" style="background-image: url('<?= $asset->getImage()?>')"></div>
            </div>
        </div>
    </div>
</div>

<?php if(!$this->link("link")->isEmpty()) : ?>
<!-- <div></div> -->
<?= $this->link("link")->getHref();?>
<?= $this->link("link")->getText();?>
<?php endif?>