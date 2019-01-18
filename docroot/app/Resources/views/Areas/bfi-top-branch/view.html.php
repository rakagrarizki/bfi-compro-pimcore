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
                <div class="col-md-4 thumbnail thumbnail--branch">
                    <img src="/static/images/icon/branch1.png">
                    <div class="thumbnail-caption">
                        <h3><?= $branch->getName(); ?></h3>
                        <p><?= $branch->getAddress(); ?></p>
                        <a href="/<?= $this->getLocale() ?>/branch-office?latitude=<?= $branch->getMap() ? $branch->getMap()->getLongitude() : '' ?>&latitude=<?= $branch->getMap() ? $branch->getMap()->getLatitude() : '' ?>" class="cta-location"><?= $this->translate("seeLocation") ?></a>
                    </div>
                </div>
                <?php
                $i++;
            }
            ?>

        </div>

        <div class="jamoperasional">
            <?php echo $this->wysiwyg('value', ["customConfig" => "custom/ckeditor_config.js"]) ?>
        </div>

        <div class="button-area text-center">
            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-primary cta-big cta-see"><?= $this->translate("more") ?></a>
        </div>

    </div>
</section>