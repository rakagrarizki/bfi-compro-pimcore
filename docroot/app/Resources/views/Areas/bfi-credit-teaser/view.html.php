<div class="container">
    <div class="row">
        <div class="cont-credit modif">
            <h2 class="title-wrapper"><?= $this->input("title"); ?></h2>
                <p class="paragraf-title"><?= $this->textarea('text');?></p>
                <div class="list-credit">
                    <div class="list-credit--icon">
                        <div class="credit--icon col-md-3">
                            <?php $assetMobil = $this->image("image-mobil");?>
                            <a href="<?= $this->link('url-mobil')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src="<?= $assetMobil->getImage()?>" alt="">
                                    <p><?= $this->input("title-mobil"); ?></p>
                                </div>
                            </a>
                        </div>
                        <div class="credit--icon col-md-3">
                            <?php $assetMotor = $this->image("image-motor");?>
                            <a href="<?= $this->link('url-motor')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src="<?= $assetMotor->getImage()?>" alt="">
                                    <p><?= $this->input("title-motor"); ?></p>
                                </div>

                            </a>
                        </div>
                        <div class="credit--icon col-md-3">
                            <?php $assetRumah = $this->image("image-rumah");?>
                            <a href="<?= $this->link('url-rumah')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src="<?= $assetRumah->getImage()?>" alt="">
                                    <p><?= $this->input("title-rumah"); ?></p>
                                </div>

                            </a>
                        </div>
                        <div class="credit--icon col-md-3">
                            <?php $assetRuko = $this->image("image-ruko");?>
                            <a href="<?= $this->link('url-ruko')->getHref(); ?>">
                                <div class="icon">
                                    <img class="imggetcredit" src="<?= $assetRuko->getImage()?>" alt="">
                                    <p><?= $this->input("title-ruko"); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>