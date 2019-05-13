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
            <div class="col-sm-8"><?= $this->input("text"); ?></div>
        </div>

        <div class="row">
            <div class="col-sm-4">Desktop Image</div>
            <div class="col-sm-8"><?= $this->image('image'); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Mobile Image</div>
            <div class="col-sm-8"><?= $this->image('mobileImage'); ?></div>
        </div>
    </div>
</div>


