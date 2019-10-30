<div>
    <?php $asset = $this->image("image");?>

    <h3><?= $this->input('title');?></h3>
    <img src="<?= $asset->getImage()?>">

</div>
