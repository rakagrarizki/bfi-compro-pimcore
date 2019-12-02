<div class="row">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input("title")?></h2>
        </article>
        <div class="accordion">
            <div class="accordion__wrap produk">
                <!-- <div class="container"> -->
                    <div class="row">
                        <div class="panel-group" id="5de097092fd27">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="a-reportheading" data-toggle="collapse" data-parent="#5de097092fd27" href="#5de097092fd27-1">
                                            2019</a>
                                    </h4>
                                </div>
                                <div id="5de097092fd27-1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body report-accordion">
                                        <ul>
                                            <div class="content-list">
                                                <li>
                                                    Laporan Keuangan September 2019
                                                </li>
                                                <div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                <span><?=  $this->t("Unduh Dokumen")?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div> 
                                            <hr>
                                            <div class="content-list">
                                                <li>
                                                    Laporan Keuangan Juli 2019
                                                </li>
                                                <div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                <span><?=  $this->t("Unduh Dokumen")?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div> 
                                            <hr>
                                            <div class="content-list">
                                                <li>
                                                    Laporan Keuangan Maret 2019
                                                </li>
                                                <div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                <span><?=  $this->t("Unduh Dokumen")?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="a-reportheading collapsed" data-toggle="collapse" data-parent="#5de097092fd27" href="#5de097092fd27-2" aria-expanded="false">
                                            2018</a>
                                    </h4>
                                </div>
                                <div id="5de097092fd27-2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                    <div class="panel-body report-accordion">
                                        <ul>
                                            <div class="content-list">
                                                <li>
                                                    Laporan Keuangan September 2018
                                                </li>
                                                <div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                <span><?=  $this->t("Unduh Dokumen")?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div> 
                                            <hr>
                                            <div class="content-list">
                                                <li>
                                                    Laporan Keuangan Juli 2018
                                                </li>
                                                <div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                <span><?=  $this->t("Unduh Dokumen")?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div> 
                                            <hr>
                                            <div class="content-list">
                                                <li>
                                                    Laporan Keuangan Maret 2018
                                                </li>
                                                <div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                <span><?=  $this->t("Unduh Dokumen")?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>                                    
                                            </div> 
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>

<?php //$category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
$years = [];
foreach($reports as $year){
    $years[] = $year->getDate()->format("Y");
}

?>
<?php
    foreach($years as $y ){
        $reports->addConditionParam("YEAR(Date) = ? ", $y,"AND");
        echo $y. "__________ <br>";?>

        <?php foreach($reports as $data):?>
            <?= $data->getFilename();?>
            <?= $data->getUrl();?>
            <?= $data->get?>
            <?php echo "<br>";?>


        <?php endforeach;?>
<?php }
?>