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
            <div class="col-sm-4">Image</div>
            <div class="col-sm-8"><?= $this->image("image"); ?></div>
        </div>
        <div class="row">
                <div class="col-sm-4">Alt Image</div>
                <div class="col-sm-8"><?= $this->input("alt-img"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Text</div>
            <div class="col-sm-8"><?= $this->wysiwyg("text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Link</div>
            <div class="col-sm-8"><?=$this->link("link");?></div>
        </div>
    </div>
</div>
