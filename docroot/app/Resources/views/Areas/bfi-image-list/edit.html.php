<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Subtitle</div>
            <div class="col-sm-8"><?= $this->input("subtitle"); ?></div>
        </div>
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Name</div>
                <div class="col-sm-8"><?= $this->input("name"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Position</div>
                <div class="col-sm-8"><?= $this->input("position"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Image</div>
                <div class="col-sm-8"><?= $this->image('image');?></div>
            </div> 
            <div class="row">
                <div class="col-sm-4">Alt Image</div>
                <div class="col-sm-8"><?= $this->input("alt-img"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Biodata</div>
                <div class="col-sm-8"><?= $this->wysiwyg("biodata"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Job Experience</div>
                <div class="col-sm-8"><?= $this->wysiwyg("job-exp"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Education</div>
                <div class="col-sm-8"><?= $this->wysiwyg("education"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Popup Selector</div>
                <div class="col-sm-8"><?= $this->input('pop-selector');?></div>
            </div>
        <?php } ?>
    </div>
</div>