<div class="container cont-cara">
    <div class="row">
        <div class="cara-kerja">
            <p class="title-cara-kerja"><?= $this->input('title');?></p>
            <p class="step-cara"><?= $this->input('sub-title');?></p>
            <ul class="list-step">
                <?php while ($this->block("contentblock")->loop()) { ?>
                    <li><span class="<?php echo $this->select("icon")->getData() ?>"></span><p><?= $this->input('text');?></p></li>
                <?php } ?>
            </ul>
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big cta-see">SELENGKAPNYA</a>
        </div>
    </div>
</div>