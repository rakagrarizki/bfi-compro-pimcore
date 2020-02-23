
<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
$years = [];
$page = htmlentities(addslashes($_GET["page"]));
foreach($reports as $year){
    $found = in_array($year->getDate()->format("Y"), $years);

    if(!$found){
        $years[] = $year->getDate()->format("Y");
    }

}

$key = 0;

$randId = rand(10,100);

$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($years));
$paginator->setCurrentPageNumber($page);
$paginator->setItemCountPerPage(2);
?>
<div class="container">
    <article class="sect-title text-center">
        <h2 class=""><?= $this->input("title")?></h2>
    </article>
    <div class="accordion">
        <div class="accordion__wrap produk">
            <!-- <div class="container"> -->
                <div class="">
                    <div class="panel-group" id="<?= $randId?>">
                    <?php
                    foreach($paginator as $y ){

                        ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="a-reportheading" data-toggle="collapse" data-parent="#<?=$randId?>" href="#<?=$randId.'-'.$key?>">
                                        <?= $y?></a>
                                </h4>
                            </div>
                            <div id="<?=$randId.'-'.$key?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body report-accordion">
                                    <ul>
                                        <?php
                                        $reports->addConditionParam("YEAR(FROM_UNIXTIME(DATE)) = ? ", (int)$y,"AND");
                                        $reports->load();
                                        $total = count($reports);
                                        foreach($reports as $i => $data):?>
                                        <div class="content-list">
                                            <li>
                                                <?= $data->getFileName();?>
                                            </li>
                                            <div class="download-btn">
                                                <div class="down-box">
                                                    <a href="<?= $data->getUrl(); ?>" target="_blank" class="cta cta-down">
                                                        <span><?=  $this->t("download-document")?></span>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <?php echo  $i < $total ? "<hr>" : ""?>
                                        <?php endforeach;?>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php $key++;?>
                        <?php } ?>
                        
                    </div>

                    <?php if (count($paginator) > 1) : ?>
                            <?= $this->render("Includes/paging.html.php", get_object_vars($paginator->getPages("Sliding")), [
                                'urlprefix' => $this->document->getFullPath() . '?page=', // just example (this parameter could be used in paging.php to construct the URL)
                                'appendQueryString' => true // just example (this parameter could be used in paging.php to construct the URL)
                            ]); ?>
                        <?php endif; ?>
                </div>
            <!-- </div> -->
        </div>
    </div>
</div>

