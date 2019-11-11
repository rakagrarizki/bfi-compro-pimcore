<div class="container">
    <div class="page-title"><?= $this->input("title")?>
        <?= $this->input("subtitle");?>
    </div>
    <div class="row">
        <?php while($this->block("contentblock")->loop()) { ?>
            <a href = "<?= $this->link("url")->isEmpty() ? "#" : $this->link("url")->getHref();?>">
                <div class="button-type-17 col-md-12">
                    <?= $this->date("date", [
                        "format" => "%d %B %Y"
                    ]); ?>
                    <?= $this->input("detail-title");?>
                    <span class="arrow-right"><i class="icon-next"></i></span>
                </div>
            </a>
        <?php } ?>
    </div>
</div>
