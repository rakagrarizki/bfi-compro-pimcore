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
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Image</div>
                <div class="col-sm-8"><?= $this->image('img-content');?></div>
            </div> 
            <div class="row">
                <div class="col-sm-4">Alt Text Image</div>
                <div class="col-sm-8"><?= $this->input("alt-text"); ?></div>
            </div>
        <?php } ?>
    </div>
</div>