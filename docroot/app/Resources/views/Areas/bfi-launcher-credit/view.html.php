<section class="widget-section" id="credit">
    <div class="container">
        <div class="row">
            <div class="col-md-8 content-text">
                <p class="title"><?= $this->input('text');?></p>
            </div>
            <div class="col-md-4 content-btn">
                <a href="<?= $this->link('button1')->getHref(); ?>" class="cta cta-orange cta-big" id="<?= $this->link('button1')->getParameters()?>"><?= $this->link('button1')->getText() ?></a>
                <a href="<?= $this->link('button2')->getHref(); ?>" class="cta cta-orange cta-big" id="<?= $this->link('button2')->getParameters()?>"><?= $this->link('button2')->getText() ?></a>
            </div>
        </div>
    </div>
</section>
