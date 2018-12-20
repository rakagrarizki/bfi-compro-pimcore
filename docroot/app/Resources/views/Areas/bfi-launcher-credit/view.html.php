<section id="credit">
    <div class="container">
        <div class="credit-body">
            <h2 class="text-center">
                <?= $this->input('title');?>
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big"><?= $this->input('button');?></a>
            </h2>
        </div>
    </div>
</section>
