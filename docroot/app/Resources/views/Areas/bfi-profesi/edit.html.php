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
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input('title');?></div>
        </div>

        <hr>
    <?php while($this->block("contentblock")->loop()) { ?>
        <div class="row">
            <div class="col-sm-4">Title Profesi</div>
            <div class="col-sm-8"><?= $this->input("title-profesi"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Subtitle Profesi</div>
            <div class="col-sm-8"><?= $this->input("subtitle"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Address</div>
            <div class="col-sm-8"><?= $this->input("address"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Phone</div>
            <div class="col-sm-8"><?= $this->input("phone"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Fax</div>
            <div class="col-sm-8"><?= $this->input("fax"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link</div>
            <div class="col-sm-8"><?= $this->link("url"); ?></div>
        </div>
    <?php } ?>

    </div>

</div>





