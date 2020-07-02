<div class="container">
<?php if (!$this->input("title")->isEmpty()) { ?>
    <div class="page-title"><?= $this->input("title")?>
        <?= $this->input("subtitle");?>
    </div>
<?php } ?>
    <ul class="list-title">
        <?php while($this->block("contentblock")->loop()) { ?>
        <li>
            <a href="<?= $this->link("url")->isEmpty() ? "#" : $this->link("url")->getHref();?>">
                <div class="right-content">
                    <p> <?= $this->date("date", [
                            "format" => "%d %B %Y"
                        ]); ?></p>
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


