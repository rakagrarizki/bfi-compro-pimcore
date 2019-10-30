<?= $this->input("title"); ?>
<?php while ($this->block("contentblock")->loop()) { ?>
 <div class="cards-type-13">
    <div class="header-text"> <?= $this->input('subtitle'); ?></div>
    <div class="header-title"><?= $this->input('title-profesi'); ?></div>
    <div class="header-contain">
         <?= $this->input('address'); ?>
    </div>
    <div class="header-contain">
        <?= $this->input('phone'); ?>
    </div>
    <div class="header-contain">
        <a href="<?= $this->input('url') == "" ? '#' :$this->input('url'); ?>"><?= $this->input('url'); ?></a>
    </div>
</div>
 <?php } ?>
