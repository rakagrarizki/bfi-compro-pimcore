<div class="download-box">
    <div class="container">
        <article class="sect-title text-center">
            <p class="title"><?= $this->input('title');?></p>
            <?= $this->wysiwyg('description');?>
        </article>
        <div class="down-box">
            <h3><?= $this->link('url')->getText(); ?></h3>
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                <span><?=  $this->t("download")?></span>
            </a>
        </div>
    </div>
</div>