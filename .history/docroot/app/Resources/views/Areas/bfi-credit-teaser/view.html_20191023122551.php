<div class="container">
    <div class="row">
        <div class="cont-credit">
            <h2 class="title-wrapper"><?= $this->input("title"); ?></h2>
            <p class="paragraf-title"><?= $this->textarea('text');?></p>
            <br />

            <div class="list-credit">
              <h3><?= $this->input("credit-jaminan-title"); ?></h3>
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
                </div>
            </div>

            <div class="list-credit">
              <h3><?= $this->input("credit-lainnya-title"); ?></h3>
                <div class="list-credit--icon">
                    <?php if(!$this->input("title-education")->isEmpty()) { ?>
                      <div class="credit--icon col-md-3">
                          <?php $assetMobil = $this->image("image-education");?>
                          <a href="<?= $this->link('url-education')->getHref(); ?>">
                              <div class="icon">
                                  <img class="imggetcredit" src="<?= $assetMobil->getImage()?>" alt="">
                                  <p><?= $this->input("title-education"); ?></p>
                              </div>
                          </a>
                      </div>
                    <?php } ?>
                    <div class="credit--icon col-md-3">
                        <?php $assetMotor = $this->image("image-travel");?>
                        <a href="<?= $this->link('url-travel')->getHref(); ?>">
                            <div class="icon">
                                <img class="imggetcredit" src="<?= $assetMotor->getImage()?>" alt="">
                                <p><?= $this->input("title-travel"); ?></p>
                            </div>

                        </a>
                    </div>
                    <div class="credit--icon col-md-3">
                        <?php $assetRumah = $this->image("image-mesin");?>
                        <a href="<?= $this->link('url-mesin')->getHref(); ?>">
                            <div class="icon">
                                <img class="imggetcredit" src="<?= $assetRumah->getImage()?>" alt="">
                                <p><?= $this->input("title-mesin"); ?></p>
                            </div>

                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>