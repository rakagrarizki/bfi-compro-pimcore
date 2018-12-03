<section id="bfi-cabang">
    <div class="container">
        <h2 class="title-wrapper text-center">
            <?= $this->input('title');?>
        </h2>
        <p class="text-center paragraf-title"><?= $this->textarea('text');?></p>

        <div class="row content-bfi">
            <div class="col-md-4 thumbnail">
                <img src="assets/images/logo-bfi.png">
                <div class="thumbnail-caption">
                    <h3>BFI Cengkareng</h3>
                    <p>
                        Sedayu Square Blok C-2 <br>
                        Jl. Outer Ring Road <br>
                        Cengkareng <br>
                        Jakarta Barat
                    </p>
                    <a href="#" class="cta-location">lihat lokasi</a>
                </div>
            </div>
        </div>

        <div class="button-area text-center">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big cta-see">SELENGKAPNYA</a>
        </div>

    </div>
</section>