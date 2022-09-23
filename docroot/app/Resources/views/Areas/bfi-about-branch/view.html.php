<section class="widget-section" id="about-branch-widget">
    <div class="container">
        <div class="sect-title text-center">
            <?php if(!$this->input('title')->isEmpty()) { ?>
                <h2 class="title"><?= $this->input('title');?></h2>
            <?php } ?>
            <?php  if(!$this->input('sub-title')->isEmpty()) { ?>
                <p class="sub-title"><?= $this->input('sub-title'); ?></p>
            <?php } ?>
        </div>
        <div class="content-list">
            <div class="row">
                <div class="col-md-6 data-title">
                    <p class="text-center">
                        <span><?= $this->input('total') ?></span><br>
                        <?= $this->input('total-desc') ?>
                    </p>
                </div>
                <div class="col-md-6 data-list">
                    <?= $this->wysiwyg('data-list') ?>
                </div>
            </div>
        </div>
    </div>
</section>