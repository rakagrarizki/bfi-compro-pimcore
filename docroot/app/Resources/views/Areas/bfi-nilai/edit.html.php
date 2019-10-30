<div class="row">
    <div class="col-sm-12">


        <?php while ($this->block("block")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Big Word</div>
                <div class="col-sm-8"><?= $this->input("word"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Title</div>
                <div class="col-sm-8"><?= $this->input("title"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Description</div>
                <div class="col-sm-8"><?= $this->input("description"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-12">Details</div>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?php while ($this->block("details")->loop()) { ?>
                    <div class="row">
                        <div class="col-sm-4">Detail Title</div>
                        <div class="col-sm-8"><?= $this->input("detail-title"); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Detail Description</div>
                        <div class="col-sm-8"><?= $this->input("detail-description"); ?></div>
                    </div>
                    <?php } ?>
                </div>

            </div>

        <?php } ?>



    </div>
</div>
