

<?php $asset = $this->image("image");?>

<!-- Template -->

<!-- Desktop View -->

<div class="container wysiwyg-list-right hidden-xs">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12">
            <img src="<?= $asset->getImage()?>">
        </div>
        <div class="col-lg-8 col-md-8 col-12">
            <?= $this->wysiwyg("text"); ?>
        </div>
    </div>
</div>

<!-- Mobile view -->

<div class="container wysiwyg-list-right hidden-md">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12">
            <?= $this->wysiwyg("text"); ?>
        </div>
        <div class="col-lg-4 col-md-4 col-12">
            <img src="<?= $asset->getImage()?>">
        </div>
    </div>
</div>

<!-- Template -->
