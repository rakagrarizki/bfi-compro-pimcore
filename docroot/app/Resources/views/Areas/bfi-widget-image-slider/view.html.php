<section id="img-slider-widget" class="widget-section">
    <div class="container">
        <div class="sect-title text-center">
            <?php if(!$this->input('title')->isEmpty()) { ?>
                <h1 class="title"><?= $this->input('title');?></h1>
            <?php } ?>
            <?php  if(!$this->input('sub-title')->isEmpty()) { ?>
                <p class="sub-title"><?= $this->input('sub-title'); ?></p>
            <?php } ?>
        </div>
        <div class="img-slider">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <div class="item-slider">
                    <img src="<?= $this->image('img-content')->getImage()?>" alt="<?= $this->input('alt-text')?>">
                </div>
            <?php } ?>
        </div>
    </div>
</section>