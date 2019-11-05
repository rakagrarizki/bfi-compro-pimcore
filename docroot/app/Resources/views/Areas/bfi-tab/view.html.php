
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

                        <li role="presentation" class="<?= $active ?>">
                            <a href="#" id="<?= $last;?>" aria-controls="<?= $id;?>" role="tab" data-toggle="tab"><?= $this->input("text");?></a>
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

                $id = $this->block("tab")->getCurrent();
                $active = "";
                ?>
                <?php if($tab == "") {
                    if($id == 0){
                        $active = "active";
                    }
                }
                if($tab == $last){
                    $active = "active";
                }
                ?>
                <div role="tabpanel" class="tab-pane <?= $active?>" id="<?=$id?>">
                    <?= $this->snippet("teaserSnipet");?>
                </div>
            <?php }?>

        </div>
    </div>
</div>
