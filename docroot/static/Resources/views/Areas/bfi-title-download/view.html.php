<div class="row">
    <div class="container">
        <div class="title-download">
            <div class="title">
                <h3><?= $this->input("title"); ?></h3>
            </div>
            <div class="download-btn">
                <div class="down-box">
                    <a href="<?= $this->link("link")->getHref(); ?>" class="cta cta-down" download>
                        <span><?= $this->t("Unduh Dokumen") ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>