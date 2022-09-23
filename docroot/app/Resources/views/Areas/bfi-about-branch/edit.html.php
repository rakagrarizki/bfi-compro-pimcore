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
            <div class="col-sm-4">Total</div>
            <div class="col-sm-8"><?= $this->input("total"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Total Description</div>
            <div class="col-sm-8"><?= $this->input("total-desc"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        Data:
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?= $this->wysiwyg("data-list"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>