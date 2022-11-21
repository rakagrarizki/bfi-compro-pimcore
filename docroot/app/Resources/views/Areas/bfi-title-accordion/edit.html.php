<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Text</div>
            <div class="col-sm-8"><?= $this->textarea("text"); ?></div>
        </div>
        <?php while($this->block('accord')->loop()){ ?>
            <div class="row">
                <div class="col-sm-4"><p>title-accord : </p></div>
                <div class="col-sm-8"><?php echo $this->input('title-accord') ?></div>
            </div>
            <div class="row">
                <div class="col-sm-12" style="text-align: center;"><p><b>Content accordian : </b></p></div>
                <div class="col-sm-12" style="padding: 36px;"><?php echo $this->areablock("Content-accord"); ?></div>
            </div>
        <?php } ?>
    </div>
</div>
