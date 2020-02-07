<div class="page-title"><?= $this->input("title"); ?></div>
<div class="container container-profesi">
    <div class="row">
        <?php while ($this->block("contentblock")->loop()) { ?>
            <div class="col-md-6 profesi-box">
                <div class="cards-type-13">
                    <div class="header-text"> <?= $this->input('subtitle'); ?></div>
                    <div class="header-title"><?= $this->input('title-profesi'); ?></div>
                    <?php if (!$this->input("address")->isEmpty()) { ?>
                        <div class="header-contain">
                            <i class="icon-maps-and-flags"></i><?= $this->input('address'); ?>
                        </div>
                    <?php } ?>
                    <?php if (!$this->input("phone")->isEmpty()) { ?>
                        <div class="header-contain">
                            <i class="icon-group-2584"></i><?= $this->input('phone'); ?><br>
                            <?= $this->input('fax'); ?>
                        </div>
                    <?php } ?>
                    <?php if (!$this->link("url")->isEmpty()) { ?>
                        <div class="header-contain">
                            <i class="icon-grid-world"></i><a href="<?= $this->link('url')->isEmpty() ? '#' : $this->link('url')->getHref(); ?>"><?= $this->link('url')->getHref(); ?></a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>