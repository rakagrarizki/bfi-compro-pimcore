<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <?php while($this->block("tab-list")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Tab Title</div>
                <div class="col-sm-8"><?= $this->input("tab-title"); ?></div>
            </div> 
            <div class="row">
                <div class="col-sm-4">Tab Content</div>
                <div class="col-sm-8"><?= $this->wysiwyg("tab-content"); ?></div>
            </div>
        <?php } ?>
    </div>
</div>