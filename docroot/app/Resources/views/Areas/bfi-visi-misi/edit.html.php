<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:04
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Visi</div>
            <div class="col-sm-8"><?= $this->input("visi"); ?></div>
        </div>
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Misi</div>
                <div class="col-sm-8"><?= $this->input("input-misi"); ?></div>
            </div>

        <?php } ?>
    </div>
</div>


