

<?php $asset = $this->image("image");?>

<!-- Template -->

<div class="container wysiwyg-list-right">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12">
            <img src="<?= $asset->getImage()?>">
        </div>
        <div class="col-lg-8 col-md-8 col-12">
            <?= $this->wysiwyg("text"); ?>
        </div>
    </div>
</div>

<!-- Template -->
