<?php $asset = $this->image("image");?>
<div id="credit" class="lazy-slide" style="background-image:url('/System/white.gif')" data-src="<?= $asset->getImage()?>">
    <div class="container">
        <div class="credit-body">
            <h2 class="text-center">
                <?= $this->input('title');?>
                <?php $asset = $this->image("image");?>
                <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link('url')->getHref(); ?>" 
					class="cta cta-primary cta-big <?= $this->link('url')->getClass();?>">
					<?= $this->input('button');?>
				</a>
            </h2>
        </div>
    </div>
</div>
