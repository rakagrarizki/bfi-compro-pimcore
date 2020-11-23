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
                <div class="col-sm-8"><?= $this->input("text"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Link</div>
                <div class="col-sm-8"><?= $this->link("link"); ?></div>
            </div>

            <div class="row">
                <div class="col-sm-4">Image Desktop</div>
                <div class="col-sm-8"><?= $this->image('image');?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Image Mobile</div>
                <div class="col-sm-8"><?= $this->image('imageMobile');?></div>
            </div>
        <?php } ?>
    </div>
</div>


