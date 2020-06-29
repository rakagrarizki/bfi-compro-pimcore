<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Image</div>
            <div class="col-sm-8"><?= $this->image("image-pop"); ?></div>
            <div class="col-sm-4">Alt Image</div>
            <div class="col-sm-8"><?= $this->input("altimage")?></div>

        </div>
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title")?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Text</div>
            <div class="col-sm-8"><?= $this->input("description"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Button Path Link</div>
            <div class="col-sm-8"><?= $this->link("linkbutton"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Always Showing if reload</div>
            <div class="col-sm-8"><?= $this->checkbox("Checkbox"); ?></div>
        </div>
    </div>
</div>
