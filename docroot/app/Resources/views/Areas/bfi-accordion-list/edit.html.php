<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Description Text</div>
            <div class="col-sm-8"><?= $this->textarea("text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Footer Text</div>
            <div class="col-sm-8"><?= $this->input("footer-text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Footer Link</div>
            <div class="col-sm-8"><?= $this->link("footer-link"); ?></div>
        </div>
        <?php while($this->block('content-list')->loop()){ ?>
            <div class="row">
                <div class="col-sm-4"><p>Content Title: </p></div>
                <div class="col-sm-8"><?php echo $this->input('content-title') ?></div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="text-align: center;"><p><b>Content : </b></p></div>
                <div class="col-sm-12"><?php echo $this->wysiwyg("content"); ?></div>
            </div>
        <?php } ?>
    </div>
</div>