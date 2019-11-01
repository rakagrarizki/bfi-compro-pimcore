<div class="page-title"><?= $this->input("title"); ?></div>
<div class="container" style="padding-bottom: 30px;">
    <div class="row">
        <?php while ($this->block("contentblock")->loop()) { ?>
        <div class="col-md-6">
            <div class="cards-type-13">
                <div class="header-text"> <?= $this->input('subtitle'); ?></div>
                <div class="header-title"><?= $this->input('title-profesi'); ?></div>
                <div class="header-contain">
                    <i class="demo-icon icon-maps-and-flags"></i><?= $this->input('address'); ?>
                </div>
                <div class="header-contain">
                    <?= $this->input('phone'); ?>
                </div>
                <div class="header-contain">
                    <a href="<?= $this->link('url')->isEmpty() ? '#' :$this->link('url')->getHref(); ?>"><?= $this->link('url')->getHref(); ?></a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
 </div>
