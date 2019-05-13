<div>
    <div id="herobanner3" class="herobanner herobanner--static">
        <?php
        $asset = $this->image("image");
        $assetMobile = $this->image('mobileImage');
        ?>
        <div class="herobanner__noslider hidden-xs"
             style="background-image: url('<?= $asset->getImage() ?>')">
            <div class="sect-title middle-position">
                <h2><?= $this->input('title'); ?></h2>
                <p><?= $this->input('text'); ?></p>
            </div>
        </div>
        <div class="herobanner__noslider visible-xs"
             style="background-image: url('<?= $assetMobile->getImage() ?>')">
            <div class="sect-title middle-position">
                <h2><?= $this->input('title'); ?></h2>
                <p><?= $this->input('text'); ?></p>
            </div>
        </div>
    </div>
</div>