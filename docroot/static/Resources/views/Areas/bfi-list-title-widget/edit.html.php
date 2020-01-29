<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">Title</div>
            <div class="col-sm-8"><?= $this->input("title");?></div>
        </div>
        <div class="row">
            <div class="col-sm-4">Subtitle</div>
            <div class="col-sm-8"><?= $this->input("subtitle");?></div>
        </div>
        <div class="row">
            <div class="col-sm-12">Details</div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <?php while($this->block("contentblock")->loop()) { ?>
                    <div class="row">
                        <div class="col-sm-4">Detail Title</div>
                        <div class="col-sm-8"><?= $this->input("detail-title"); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Detail Url</div>
                        <div class="col-sm-8"><?= $this->link("url"); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">Date</div>
                        <div class="col-sm-8"><?= $this->date("date", [
                                "format" => "d m Y",
                                'outputFormat' => "%d.%m.%Y"
                            ]); ?></div>
                    </div>

                <?php }?>

            </div>
        </div>

    </div>
</div>
