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
            <div class="col-sm-8"><?= $this->input("title");?></div>
        </div>
        <?php while ($this->block("tab")->loop()) { ?>
        <div class="row">
            <div class="col-sm-4">Tab Title</div>
            <div class="col-sm-8"><?= $this->input("text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
        <?php while ($this->block("accordion")->loop()) { ?>
                <div class="row">
                    <div class="col-sm-4">Accordion Title</div>
                    <div class="col-sm-8"><?= $this->input("text1"); ?></div>
                </div>
                <div class="row">
                    <div class="col-sm-4">wysiwyg</div>
                    <div class="col-sm-8"><?php echo $this->wysiwyg("value", [
                            "placeholder" => "value",
                        ]); ?></div>
                </div>

        <?php } ?>
            </div>
        </div>
            <?php } ?>

      
    </div>
</div>


