<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:15
 */
?>

<!-- <div class="container pengajuan">
    <div class="row">
        <div class="cek-pengajuan">
            <p class="title"><?= $this->input('title'); ?></p>
            <form action="#">
                <div class="row">
                    <div class="col-md-12">
                        <div class="_parentboxkirikanan">
                            <div class="_boxkiri">
                                <div class="input-group">
                                    <div class="plaintext-cekpengajuan"><?= $this->translate('collateralInfo')?></div>
                                </div>
                            </div>
                            <div class="_boxkanan row">
                                <div class="_boxkananchild1">
                                    <div class="input-group inputform">
                                        <select class="c-custom-select-home form-control" id="sel"
                                                data-placeholder="<?= $this->translate('collateralInfo2')?>" multiple="multiple">
                                            <?php
                                            while ($this->block("contentblock")->loop()) {
                                            //    $url = !$this->link('url')->isEmpty() ? $this->link('url')->getHref() : "";
                                                ?>
                                                <option value="<?= $this->input('value') ?>" id="block-<?=$this->block('contentblock')->getCurrent()?>"><?= $this->input('text'); ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="c-custom-select-home form-control" id="sel2"
                                            data-placeholder="<?= $this->translate('collateralInfo2')?>" multiple="multiple">
                                            <?php
                                            while ($this->block("contentblock")->loop()) {
                                                    $id = $this->block('contentblock')->getCurrent();
                                            while ($this->block("contentblock1")->loop()) {
                                                //$url = !$this->link('url')->isEmpty() ? $this->link('url')->getHref() : "";
                                                ?>
                                                <option value="<?= $url ?>" class="block-<?=$id?>"><?= $this->input('text1'); ?></option>
                                            <?php }} ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="_boxkananchild2 hidden-xs soloboxarrow-cekpengajuan">
                                    <button disabled class="btn-kotak no-mobile btn-submit btn-submit-how-form-credit"
                                            type="submit"></button>
                                </div>
                                <div class="_boxkananchildmobile2 visible-xs">
                                <button disabled class="btn-blok btn-submit btn-submit-how-form-credit"
                                            type="submit"><?= $this->translate('ajukan-sekarang'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- template -->
<section id="pengajuan">
    <div class="container">
        <div class="submission-wrapper">
            <h4>Simulasikan Pengajuan Kredit Anda</h4>
            <form action="" id="selection-form">
                <div class="selection-wrapper">
                <div class="selection-1">
                    <select id="category-1">
                        <option value="" selected style="display:none;"></option>
                        <option value="1">BPKB Motor</option>
                        <option value="2">BPKB Mobil</option>
                    </select>
                </div>
                <div class="selection-2">
                    <select id="category-2">
                        <option value="" selected style="display:none;"></option>
                        <option value="1">BPKB Motor2</option>
                        <option value="2">BPKB Mobil2</option>
                    </select>
                </div>
                </div>
                <button class="btn-next">Hitung &nbsp<i class="fa fa-angle-right"></i></button>
            </form>
        </div>
    </div>
</section>
<!-- template -->