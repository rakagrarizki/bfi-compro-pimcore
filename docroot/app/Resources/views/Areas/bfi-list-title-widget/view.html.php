<div class="container">
    <div class="page-title"><?= $this->input("title")?>
        <?= $this->input("subtitle");?>
    </div>
    <ul class="list-title">
        <?php while($this->block("contentblock")->loop()) { ?>
        <li>
            <a href="<?= $this->link("url")->isEmpty() ? "#" : $this->link("url")->getHref();?>">
                <div class="right-content">
                    <h6> <?= $this->date("date", [
                            "format" => "%d %B %Y"
                        ]); ?></h6>
                    <h3> <?= $this->input("detail-title");?></h3>
                </div>
                <div class="left-content">
                    <i class="fa fa-angle-right"></i>
                </div>
            </a>
        </li>
        <?php }?>

    </ul>

</div>


