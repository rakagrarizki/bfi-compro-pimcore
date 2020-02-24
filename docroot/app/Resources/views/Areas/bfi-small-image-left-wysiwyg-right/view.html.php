

<?php $asset = $this->image("image");?>

<!-- Template -->

<!-- Desktop View -->

<div class="container wysiwyg-list-right hidden-xs">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12 desktop-img">
            <img src="<?= $asset->getImage()?>">
        </div>
        <div class="col-lg-8 col-md-8 col-12 desktop-details">
            <?= $this->wysiwyg("text"); ?>
        </div>
    </div>
</div>

<!-- Mobile view -->

<div class="container wysiwyg-list-right mobile-view hidden-md hidden-lg hidden-sm hidden-md">
    <div class="row">
    <div class="col-12 img-responsive img-mobile-view">
            <img src="<?= $asset->getImage()?>">
        </div>
    </div>
    <div class="row">
        <div class="col-12 details">
            <?= $this->wysiwyg("text"); ?>
        </div>
    </div>
</div>

<!-- Template -->
