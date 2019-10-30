<div>
   <div><?= $this->input("title");?></div>

                <?php while ($this->block("contentblock")->loop()) { ?>
                    <?= $this->input('title-profesi'); ?>
                    <?= $this->input('subtitle'); ?>
                    <?= $this->input('address'); ?>
                    <?= $this->input('phone'); ?>
                    <?= $this->input('url'); ?>
                    
                <?php } ?>
</div>
