<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Sub title</div>
            <div class="col-sm-8"><?= $this->input("sub-title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Link</div>
            <div class="col-sm-8"><?= $this->link("url"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Use Background</div>
            <div class="col-sm-8"><?= $this->checkbox("use-bg"); ?></div>
        </div>
    </div>
</div>