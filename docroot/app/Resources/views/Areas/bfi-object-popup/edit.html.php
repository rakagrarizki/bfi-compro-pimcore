<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title")?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Object</div>
            <div class="col-sm-8"><?= $this->href("myHref", [
                    "types" => ["object"],
                    "classes" => ["Manajemen"]
                ]); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Text</div>
            <div class="col-sm-8"><?= $this->wysiwyg("text"); ?></div>
        </div>
    </div>
</div>
