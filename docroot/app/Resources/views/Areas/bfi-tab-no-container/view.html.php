
<?php
// while ($this->block("tab")->loop()) {
//     echo $this->input("text");
//     while ($this->block("accordion")->loop()) {
//         echo $this->input("text1");
//         echo $this->wysiwyg("value");
//     }
// }
$tab = $this->getParam("tab");

?>

<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/tabbing.js');
?>

<div class="tabs-accor">
    <div class="container-fluids">
        <article class="sect-title text-center">
            <h1 style="text-align:justify">&nbsp;</h1>
            <h2 class=""><?= $this->input('title');?></h2>
        </article>
        <div id="<?= $this->select("group")->getData();?>" class="tabs-outer container">
            <ul class="nav nav-tabs" role="tablist" id="outer-choice">
                <li style="display: none" role="presentation" onclick="prev()" class="arrow" onclick="scrollPosition('<?= $id;?>')" id="prevButton">
                    <a class="arrow-outer"><i class="icon-left-arrow"></i></a>
                </li>
                <?php while ($this->block("tab")->loop()) { ?>
                    <?php
                    $pattern = '/\W/';
                    $result = preg_replace($pattern," ", $this->input("text"));
                    $removeSpace = preg_replace('/\s+/',"-",$result);
                    $last = str_replace(" ","-",strtolower($removeSpace));
                    $id = $this->block("tab")->getCurrent();
                    $active = "";
                    if($tab == ""){
                        if($id == 0){
                            $active = "active";
                        }
                    }
                    if($tab == $last){
                        $active = "active";
                    }
                    ?>
                        <?php $tabWidth = 100/$this->block("tab")->getCount();?>
                        <?php $tabWidth = str_replace(",",".",$tabWidth)?>
                        <li role="presentation" class="<?= $active ?><?= $container ?>" id="div<?= $id;?>" style="width:<?= $tabWidth; ?>%">
                            <a href="#<?= $id;?>" id="href<?= $id;?>"  data-prev="<?= $id == 0 ? '' : $id - 1 ?>" data-next="<?=$id == ($this->block("tab")->getCount() -1) ? "" : $id + 1;?>" aria-controls="<?= $id?>" role="tab" data-toggle="tab" onclick="setPreviewId(<?= $id == 0 ? '' : $id - 1 ?>,<?=$id == ($this->block('tab')->getCount() -1) ? '' : $id + 1;?>)"><?= $this->input("text");?></a>
                        </li>

                <?php }?>
                <li role="presentation" class="arrow" onclick="next()" id="nextButton">
                    <a class="arrow-outer"><i class="icon-right-arrow"></i></a>
                </li>

            </ul>


        </div>
        <div class="tab-content">
            <?php while ($this->block("tab")->loop()) { ?>
                <?php
                $pattern = '/\W/';
                $result = preg_replace($pattern," ", $this->input("text"));
                $removeSpace = preg_replace('/\s+/',"-",$result);
                $last = str_replace(" ","-",strtolower($removeSpace));

                $id = $this->block("tab")->getCurrent();
                $active = "";
                $container = "";
                ?>
                <?php if($tab == "") {
                    if($id == 0){
                        $active = "active";
                    }if($id == 1){
                        $container = "container";
                    }
                    if($id == 2){
                        $container = "container";
                    }
                }
                if($tab == $last){
                    $active = "active";
                }
                ?>
                <div role="tabpanel" class="tab-pane <?= $active?> <?= $container?>" id="<?=$id?>">
                    <?= $this->snippet("teaserSnipet");?>
                </div>
            <?php }?>

        </div>
    </div>
</div>
