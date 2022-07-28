<div class="container image-title">
    <?php $asset = $this->image("image");?>
    <?php if (!$this->input("title")->isEmpty()) { ?>
        <h3><?= $this->input('title');?></h3>
    <?php } ?>
    <img src="<?= $asset->getImage()?>" alt="<?= $this->input("alt-img")?>">
</div>
