<?php $asset = $this->image("image");?>
<section id="credit" style="background-image:url('')">
    <div class="container">
        <div class="credit-body">
            <h2 class="text-center">
                <?= $this->input('title');?>
                <?php $asset = $this->image("image");?>
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big"><?= $this->input('button');?></a>
            </h2>
        </div>
    </div>
</section>
