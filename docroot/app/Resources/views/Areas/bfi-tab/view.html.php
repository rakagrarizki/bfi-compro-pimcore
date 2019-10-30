
<?php
// while ($this->block("tab")->loop()) {
//     echo $this->input("text");
//     while ($this->block("accordion")->loop()) {
//         echo $this->input("text1");
//         echo $this->wysiwyg("value");
//     }
// }
?>
<div class="tabs-accor">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input('title');?></h2>
        </article>
        <div id="<?= $this->select("group")->getData();?>">
            <ul class="nav nav-tabs" role="tablist" id="tabsAccor">
                <?php while ($this->block("tab")->loop()) { ?>
                    <?php
                    $pattern = '/\W/';
                    $result = preg_replace($pattern," ", $this->input("text"));
                    $removeSpace = preg_replace('/\s+/',"-",$result);
                    $last = str_replace(" ","-",strtolower($removeSpace));


                    ?>

                <li role="presentation">
                    <a href="#<?= $last;?>" aria-controls="<?= $last;?>" role="tab" data-toggle="tab"><?= $this->input("text");?></a>
                </li>
                <?php }?>

            </ul>


        </div>
        <div class="tab-content">
            <?php while ($this->block("tab")->loop()) { ?>
                <?php
                $pattern = '/\W/';
                $result = preg_replace($pattern," ", $this->input("text"));
                $removeSpace = preg_replace('/\s+/',"-",$result);
                $last = str_replace(" ","-",strtolower($removeSpace));


                ?>

                <div role="tabpanel" class="tab-pane" id="<?= $last;?>">
                    <?= $this->snippet("teaserSnipet");?>
                </div>
            <?php }?>

        </div>
    </div>
</div>
