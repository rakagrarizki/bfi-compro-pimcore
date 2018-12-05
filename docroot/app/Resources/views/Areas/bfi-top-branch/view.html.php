<section id="bfi-cabang">
    <div class="container">
        <h2 class="title-wrapper text-center">
            <?= $this->input('title');?>
        </h2>
        <p class="text-center paragraf-title"><?= $this->textarea('text');?></p>

        <div class="row content-bfi">
            <?php
            $i = 0;
            foreach ($this->branch as $branch){
                if($i>3){
                    break;
                }

                ?>
                <div class="col-md-4 thumbnail">
                    <img src="/static/images/logo-bfi.png">
                    <div class="thumbnail-caption">
                        <h3><?= $branch->getName(); ?></h3>
                        <p><?= $branch->getAddress(); ?></p>
                        <a href="#" class="cta-location">lihat lokasi</a>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>

        </div>

        <div class="button-area text-center">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big cta-see">SELENGKAPNYA</a>
        </div>

    </div>
</section>