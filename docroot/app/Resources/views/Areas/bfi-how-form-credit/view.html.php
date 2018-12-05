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
            <p class="title"><?= $this->input('title');?></p>
            <form action="#">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group inputform">
                            <span class="input-group-addon" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control" placeholder="Berapa yang Anda Butuhkan ?" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="input-group inputform">
                            <select class="c-custom-select">
                                <option value="0" > Untuk Keperluan apa ?</option>
                                <?php while ($this->block("contentblock")->loop()) { ?>
                                    <option value="<?= $this->input('value'); ?>"><?= $this->input('text'); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn-kotak btn-submit" type="submit"></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
