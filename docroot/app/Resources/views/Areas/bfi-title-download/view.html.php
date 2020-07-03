<div class="container">
    <div class="title-download">
        <div class="title">
            <p><?= $this->input("title"); ?></p>
        </div>
        <div class="download-btn">
            <div class="down-box">
                <a href="<?= $this->link("link")->getHref(); ?>" target="_blank" class="cta cta-down">
                    <span><?= $this->t("Unduh Dokumen") ?></span>
                </a>
            </div>
        </div>
    </div>
</div>