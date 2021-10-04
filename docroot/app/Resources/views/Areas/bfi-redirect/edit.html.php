<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 04/10/21
 * Time: 16:50
 */
?>
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Image</div>
            <div class="col-sm-8"><?= $this->image('sub-image');?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Subtitle</div>
            <div class="col-sm-8"><?= $this->input("subtitle"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Redirect to</div>
            <div class="col-sm-8"><?= $this->input("link"); ?></div>
        </div>
    </div>
</div>
