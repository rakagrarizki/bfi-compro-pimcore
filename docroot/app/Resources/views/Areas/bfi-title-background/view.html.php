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
                <?php if(!$this->link("link")->isEmpty()) :?>
                <div class="button">
                    <a href="#" data-key="<?= $this->link("link")->getHref();?>"><?= $this->link("link")->getText();?></a>
                </div>
                <?php endif;?>
            </div>
        </div>
        <div class="herobanner__noslider visible-xs"
             style="background-image: url('<?= $assetMobile->getImage() ?>')">
            <div class="sect-title middle-position">
                <h2><?= $this->input('title'); ?></h2>
                <p><?= $this->input('text'); ?></p>
                <?php if(!$this->link("link")->isEmpty()) :?>
                <div class="button">
                    <a href="#" data-key="<?= $this->link("link")->getHref();?>"><?= $this->link("link")->getText();?></a>
                </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>