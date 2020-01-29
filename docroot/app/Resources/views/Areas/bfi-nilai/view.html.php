
<div class="cards-type-15">
    <?php while ($this->block("block")->loop()) { ?>
    <div class="content-wrapper">
        <div class="content-inner">
            <div class="primary-letter" ><?= $this->input("word"); ?></div>
            <div class="content-title"><?= $this->input("title"); ?></div>
            <div class="content-description"><?= $this->input("description"); ?></div>
        </div>
        <div class="content-inner">
            <?php while ($this->block("details")->loop()) { ?>
            <div class="content-detail">
                <div class="content-detail-title"><span>&#9632;</span> <?= $this->input("detail-title"); ?></div>
                <div class="content-detail-desc"><?= $this->input("detail-description"); ?></div>
            </div>
            <?php }?>

        </div>
    </div>
    <?php } ?>

</div>
