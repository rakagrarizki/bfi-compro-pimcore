<section class="widget-section" id="product-widget">
    <div class="custom-shape-divider-top-1658816883">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V7.23C0,65.52,268.63,112.77,600,112.77S1200,65.52,1200,7.23V0Z" class="shape-fill"></path>
        </svg>
    </div>
    <div class="container">
        <div class="sect-title text-center">
            <?php  if(!$this->input('sub-title')->isEmpty()) { ?>
                <p class="sub-title"><?= $this->input('sub-title'); ?></p>
            <?php } ?>
            <?php if(!$this->input('title')->isEmpty()) { ?>
                <h1 class="title"><?= $this->input('title');?></h1>
            <?php } ?>
            <?php  if(!$this->input('title-desc')->isEmpty()) { ?>
                <p class="sub-title"><?= $this->input('title-desc'); ?></p>
            <?php } ?>
        </div>
        <div class="card-list row">
            <?php while ($this->block("contentblock")->loop()) { ?>
                <?php $asset = $this->image("product-image");?>
                <div class="col-md-6">
                    <div class="card">
                        <p class="card-title"><?= $this->input("product-title") ?></p>
                        <p class="card-desc"><?= $this->input("product-desc") ?>
                            <?php if(!$this->link("terms")->isEmpty()) { ?>
                                <span><a href="<?= $this->link('terms')->getHref(); ?>#accordion-pembiayaan" class="<?= $this->link('terms')->getClass(); ?>" id="<?= $this->link('terms')->getParameters()?>"><?= $this->link('terms')->getText(); ?></a></span>
                            <?php } ?>
                        </p>
                        <div class="card-footer">
                            <div class="button-area">
                                <a href="<?= $this->link('product-url')->getHref(); ?>" class="cta cta-primary-text cta-see <?= $this->link('product-url')->getClass(); ?>" id="<?= $this->link('product-url')->getParameters()?>"><?= $this->link('product-url')->getText(); ?></a>
                            </div>
                            <div class="product-img">
                                <img src="<?= $asset->getImage()?>" alt="<?= $this->input("alt-img")?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php if($this->checkbox("show-btn")->isChecked()) { ?>
            <div class="button-area text-center margin-top-20">
                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary-text cta-see cta-big <?= $this->link('url')->getClass(); ?>" id="<?= $this->link('url')->getParameters()?>"><?= $this->link('url')->getText(); ?></a>
            </div>
        <?php } ?>
    </div>
</section>