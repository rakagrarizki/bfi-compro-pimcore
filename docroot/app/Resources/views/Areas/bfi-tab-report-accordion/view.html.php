
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
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input('title');?></h2>
        </article>
        <div id="<?= $this->select("group")->getData();?>" class="tabs-outer">
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
                        // dump($last);
                        // dump($id);
                        // exit;
                    }
                    ?>

                        <li role="presentation" class="<?= $active ?>" id="div<?= $id;?>" style="width:<?= 100 / $this->block("tab")->getCount()?>%">
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
                    <div class="row">
                        <div class="container">
                            <article class="sect-title text-center">
                                <h2 class="margin-top-10"><?= $this->input("title")?></h2>
                            </article>
                            <div class="accordion">
                                <div class="accordion__wrap produk">
                                    <!-- <div class="container"> -->
                                    <div class="row">
                                        <div class="panel-group" id="<?= "tab".$id?>">
                                            <?php
                                            $key = 0;
                                            $no = 0;
                                            $no = $id +1;
                                            if($this->document->getProperty("category".$no)) {


                                                $category = $this->document->getProperty("category" . $no)->getId();
                                                $reports = new \Pimcore\Model\DataObject\Report\Listing();
                                                $reports->addConditionParam("Category__id = ?", $category, "AND");
                                                $years = [];
                                                foreach ($reports as $year) {
                                                    $found = in_array($year->getDate()->format("Y"), $years);

                                                    if (!$found) {
                                                        $years[] = $year->getDate()->format("Y");
                                                    }

                                                }
                                                foreach ($years as $y) {

                                                    ?>
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h4 class="panel-title">
                                                                <a class="a-reportheading" data-toggle="collapse"
                                                                   data-parent="<?= "#tab" . $id ?>"
                                                                   href="#tab<?= $id . '-' . $key ?>">
                                                                    <?= $y ?></a>
                                                            </h4>
                                                        </div>
                                                        <div id="tab<?= $id . '-' . $key ?>"
                                                             class="panel-collapse collapse" aria-expanded="false"
                                                             style="height: 0px;">
                                                            <div class="panel-body report-accordion">
                                                                <ul>
                                                                    <?php

                                                                    $reports->addConditionParam("YEAR(FROM_UNIXTIME(DATE)) = ? ", (int)$y, "AND");
                                                                    $reports->load();
                                                                    $total = count($reports);
                                                                    foreach ($reports as $i => $data):?>
                                                                        <div class="content-list">
                                                                            <li>
                                                                                <?= $data->getFileName(); ?>
                                                                            </li>
                                                                            <div>
                                                                                <div class="download-btn">
                                                                                    <div class="down-box">
                                                                                        <a href="<?= $data->getUrl(); ?>"
                                                                                           class="cta cta-down">
                                                                                            <span><?= $this->t("download-document") ?></span>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php echo $i < $total ? "<hr>" : "" ?>
                                                                    <?php endforeach; ?>

                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $key++; ?>
                                                <?php }
                                            }?>

                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }?>

        </div>
    </div>
</div>
