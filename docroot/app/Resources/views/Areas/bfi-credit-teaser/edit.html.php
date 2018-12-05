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
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Text</div>
            <div class="col-sm-8"><?= $this->textarea("text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link rumah</div>
            <div class="col-sm-8"><?= $this->link("url-rumah"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link ruko</div>
            <div class="col-sm-8"><?= $this->link("url-ruko"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link mobil</div>
            <div class="col-sm-8"><?= $this->link("url-mobil"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link motor</div>
            <div class="col-sm-8"><?= $this->link("url-motor"); ?></div>
        </div>
    </div>
</div>


