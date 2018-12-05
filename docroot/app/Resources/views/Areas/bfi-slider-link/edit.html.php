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
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Title</div>
                <div class="col-sm-8"><?= $this->input("title"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Text</div>
                <div class="col-sm-8"><?= $this->textarea("text"); ?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">link</div>
                <div class="col-sm-8"><?= $this->link("url"); ?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">hashtag</div>
                <div class="col-sm-8"><?= $this->input("hashtag"); ?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Founder</div>
                <div class="col-sm-8"><?= $this->input("founder"); ?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Position</div>
                <div class="col-sm-8"><?= $this->input("position"); ?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Image - Founder</div>
                <div class="col-sm-8"><?= $this->image('image-founder');?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Image</div>
                <div class="col-sm-8"><?= $this->image('image');?></div>
            </div>
        <?php } ?>
    </div>
</div>


