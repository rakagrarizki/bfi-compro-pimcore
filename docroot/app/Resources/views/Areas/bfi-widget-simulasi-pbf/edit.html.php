<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Description</div>
            <div class="col-sm-8"><?= $this->input("desc"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Card Title</div>
            <div class="col-sm-8"><?= $this->input("card-title"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Link</div>
            <div class="col-sm-8"><?= $this->link("url"); ?></div>
        </div>
        <?php while($this->block("sub-titles")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Sub-title 1</div>
                <div class="col-sm-8"><?= $this->input("sub-1"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Value for Sub 1</div>
                <div class="col-sm-8"><?= $this->input("value-1"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Sub-title 2</div>
                <div class="col-sm-8"><?= $this->input("sub-2"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Value for Sub 2</div>
                <div class="col-sm-8"><?= $this->input("value-2"); ?></div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-sm-4">Tenor Title</div>
            <div class="col-sm-8"><?= $this->input("tenor-title"); ?></div>
        </div>
        <?php while($this->block("tenors")->loop()) { ?>
            <div class="row">
                <div class="col-sm-4">Tenor</div>
                <div class="col-sm-8"><?= $this->input("tenor"); ?></div>
            </div>
            <div class="row">
                <div class="col-sm-4">Angsuran</div>
                <div class="col-sm-8"><?= $this->input("angsuran"); ?></div>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-sm-4">Estimasi Text</div>
            <div class="col-sm-8"><?= $this->input("estimasi-text"); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Desclaimer Text</div>
            <div class="col-sm-8"><?= $this->input("desclaimer-text"); ?></div>
        </div>
    </div>
</div>