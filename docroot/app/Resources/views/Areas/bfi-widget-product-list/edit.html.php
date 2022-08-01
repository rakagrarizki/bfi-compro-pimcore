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
            <div class="col-sm-4">Link</div>
            <div class="col-sm-8"><?= $this->link("url"); ?></div>
            <div class="row">
                    <div class="col-sm-4">
                        Show
                    </div>
                    <div class="col-sm-8">
                        <?=  $this->checkbox("show-btn") ?>
                    </div>
                </div>
        </div>
        <?php while($this->block("contentblock")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Title</div>
                <div class="col-sm-8"><?= $this->input("product-title"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Description</div>
                <div class="col-sm-8"><?= $this->input('product-desc');?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Terms</div>
                <div class="col-sm-8"><?= $this->link('terms');?></div>
            </div> 
            <div class="row">
                <div class="col-sm-4">Product Url</div>
                <div class="col-sm-8"><?= $this->link("product-url"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Image</div>
                <div class="col-sm-8"><?= $this->image('product-image');?></div>
            </div> 
            <div class="row">
                <div class="col-sm-4">Alt Image</div>
                <div class="col-sm-8"><?= $this->input("alt-img"); ?></div>
            </div>
        <?php } ?>
    </div>
</div>


