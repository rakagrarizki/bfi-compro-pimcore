<div>
    <div id="herobanner3" class="herobanner herobanner--static">
        <?php $asset = $this->image("image");?>
        <div class="herobanner__noslider" style="background-image: url('<?= $asset->getImage()?>')">
            <div class="sect-title middle-position">
                <h2><?= $this->input('title');?></h2>
                <p><?= $this->input('text'); ?></p>
            </div>
        </div>
    </div>
</div>