<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:15
 */
?>

<div class="container pengajuan">
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
                                        <select class="c-custom-select-home" id="sel-how-form-credit" data-placeholder="<?= $this->translate('collateralInfo2')?>">
                                            <?php
                                            while ($this->block("contentblock")->loop()) {
                                                $url = !$this->link('url')->isEmpty() ? $this->link('url')->getHref() : "";
                                                ?>
                                                <option value="<?= $url ?>"><?= $this->input('text'); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="_boxkananchild2 hidden-xs soloboxarrow-cekpengajuan">
                                    <button disabled class="btn-kotak no-mobile btn-submit btn-submit-how-form-credit"
                                            type="submit"></button>
                                </div>
                                <div class="_boxkananchildmobile2 visible-xs">
                                <button disabled class="btn-blok btn-submit btn-submit-how-form-credit"
                                            type="submit">AJUKAN SEKARANG</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
