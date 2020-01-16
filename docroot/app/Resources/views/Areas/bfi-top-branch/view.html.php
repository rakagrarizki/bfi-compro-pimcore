<section id="bfi-cabang">
    <div class="container">
        <div class="title">
            <h2 class="title-wrapper text-center">
                <?= $this->input('title'); ?>
            </h2>
            <p class="text-center paragraf-title">
                <?= $this->textarea('text'); ?></p>
        </div>

        <!-- <div class="row content-bfi">
            </?php $i = 0;
            foreach ($this->branch as $branch) {
                if ($i > 3) {
                    break;
                }

                $name = $branch->getName();
                if ($this->getLocale() == 'en') {
                    if (strpos($branch->getName(), 'Cabang') !== false) {
                        $name = str_replace("Cabang", "Outlet", $branch->getName());
                    }
                }

            ?>
                <div class="col-md-4 thumbnail thumbnail--branch">
                    <img src="/static/images/icon/branch1.png">
                    <div class="thumbnail-caption">
                        <h3>
                            </?= $name; ?>
                        </h3>
                        <p>
                            </?= $branch->getAddress(); ?></p>
                        <a href="/</?= $this->getLocale() ?>/branch-office?longitude=</?= $branch->getMap() ? $branch->getMap()->getLongitude() : '' ?>&latitude=</?= $branch->getMap() ? $branch->getMap()->getLatitude() : '' ?>" class="cta-location"></?= $this->translate("seeLocation") ?></a>
                    </div>
                </div>
            </?php $i++;
            } ?>

        </div> -->

        <div class="button-area text-center">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big cta-see"><?= $this->translate("more") ?></a>
        </div>

        <div class="jamoperasional">
            <?php echo $this->wysiwyg('value', ["customConfig" => "custom/ckeditor_config.js"]) ?>
        </div>

    </div>
</section>

<!-- <section id="bfi-branch">
    <div class="container">
        <div class="title">
            <h1>BFI Hadir di Lebih Dari 400 Lokasi Pelayanan di Seluruh Indonesia</h1>
            <p>Cari cabang atau gerai terdekat Anda</p>
        </div>
        <div class="button">
            <a href="#"><span>SELENGKAPNYA</span><i class="fa fa-angle-right"></i></a>
        </div>
        <div class="operation-time">
            <p class="info">Jam Operasional :</p>
            <p class="date-time">Senin-Jumat 08.00-17.00 WIB,</p>
            <p class="date-time">Sabtu 08.00-15.30 WIB,</p>
        </div>
    </div>
</section> -->