<?php $asset = $this->image("image");?>
<section id="credit" style="background-image:url('<?= $asset->getImage()?>')">
    <div class="container">
        <div class="credit-body">
            <p class="text-center launcher-credit-text">
                <?= $this->input('title');?>
                <?php $asset = $this->image("image");?>
                <a id="<?= $this->link('url')->getParameters()?>" href="<?= $this->link('url')->getHref(); ?>" 
					class="cta cta-primary cta-big <?= $this->link('url')->getClass();?>">
					<?= $this->input('button');?>
				</a>
            </p>
        </div>
    </div>
</section>
