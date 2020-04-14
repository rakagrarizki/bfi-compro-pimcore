

<?php $asset = $this->image("image");?>

<!-- Template -->

<!-- Desktop View -->

<div class="container wysiwyg-list-right responsive-list-card hidden-xs">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-12 desktop-img">
            <a href="<?= $asset->getImage()?>" target="_blank"><img src="<?= $asset->getImage()?>"></a>
        </div>
        <div class="col-lg-8 col-md-8 col-12 desktop-details">
        <?php if (!$this->input("title")->isEmpty()) : ?>
            <h3 class="main-title"><?= $this->wysiwyg("title"); ?></h3>
        <?php endif; ?>
            <?= $this->wysiwyg("text"); ?>
        </div>
    </div>
</div>

<!-- Mobile view -->

<div class="container wysiwyg-list-right responsive-list-card mobile-view hidden-md hidden-lg hidden-sm hidden-md">
<?php if (!$this->input("title")->isEmpty()) : ?>
    <div class="row">
      <div class="col-12"><h3 class="main-title"><?= $this->wysiwyg("title"); ?></h3></div>
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col-12 img-responsive img-mobile-view">
            <a href="<?= $asset->getImage()?>" target="_blank"><img src="<?= $asset->getImage()?>"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 details">
            <?= $this->wysiwyg("text"); ?>
        </div>
    </div>
</div>

<!-- Template -->
