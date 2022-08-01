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
            <div class="col-sm-4">Sub Title</div>
            <div class="col-sm-8"><?= $this->input("sub-title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">link</div>
            <div class="col-sm-8"><?= $this->link("url"); ?></div>
        </div>
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Text</div>
                <div class="col-sm-8"><?= $this->input("text"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Description</div>
                <div class="col-sm-8"><?= $this->input("desc-step"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Image - Step</div>
                <div class="col-sm-8"><?= $this->image('image-step');?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Alt Image</div>
                <div class="col-sm-8"><?= $this->input("alt-img"); ?></div>
            </div>
        <?php } ?>
    </div>
</div>


