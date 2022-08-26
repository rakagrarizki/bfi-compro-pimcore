<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/simulasi-pbf.js');
?>
<div class="simulasi_pbf">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-push-6 desc-sect">
                <h2 class="desc-title"><?= $this->input("title"); ?></h2>
                <p class="desc-text"><?= $this->input("desc") ?></p>
                <div class="btn-ajukan" id="desk-btn">
                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange <?= $this->link('url')->getClass(); ?>" id="<?= $this->link('url')->getParameters()?>"><?= $this->link('url')->getText(); ?><i class="fa fa-angle-right"></i></a>
                </div>
            </div>
            <div class="col-md-6 col-md-pull-6 calc-sect">
                <h2 class="calc-title text-center"><?= $this->input("card-title"); ?></h2>
                <?php while($this->block("sub-titles")->loop()) { ?>
                    <div class="row">
                        <div class="col-xs-6">
                            <p><?= $this->input("sub-1"); ?></p>
                            <p class="price"><?= is_numeric($this->input("value-1")->getData()) ? "Rp ".number_format($this->input("value-1")->getData(),0,",",".") : $this->input("value-1"); ?></p>
                        </div>
                        <div class="col-xs-6">
                            <p><?= $this->input("sub-2"); ?></p>
                            <p class="price"><?= is_numeric($this->input("value-2")->getData()) ? "Rp ".number_format($this->input("value-2")->getData(),0,",",".") : $this->input("value-2"); ?></p>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-sm-12">
                        <p><?= $this->input("tenor-title"); ?></p>
                        <div class="tenor">
                            <div class="radio-group">
                                <?php while($this->block("tenors")->loop()) { ?>
                                    <input type="radio" class="tenor-item" id="<?= $this->input("tenor"); ?>" name="selector" value="<?= $this->input("angsuran") ?>">
                                    <label for="<?= $this->input("tenor"); ?>"><?= $this->input("tenor"); ?></label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="estimasi">
                            <p class="text-center"><?= $this->input("estimasi-text"); ?></p>
                            <p id="result-estimasi" class="text-center">Rp 0 <span>*</span></p>
                        </div>
                        <p class="desclaimer">
                            <?php if (!$this->input("desclaimer-text")->isEmpty()) { ?>
                                <span>*</span> <?= $this->input('desclaimer-text');?>
                            <?php } ?>
                        </p>
                        <div class="btn-ajukan" id="mobile-btn">
                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-orange <?= $this->link('url')->getClass(); ?>" id="<?= $this->link('url')->getParameters()?>"><?= $this->link('url')->getText(); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>