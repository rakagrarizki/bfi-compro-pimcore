<style>
    .accordion .accordion__wrap .panel-default>.panel-heading a.a-reportheading {
        padding: 35px 70px;
    }

    .accordion .accordion__wrap .panel-default>.panel-heading a::after {
        padding-right: 35px;
        top: 30px;
    }

    .accordion .accordion__wrap .panel .panel-body {
        color: #565656;
        font-size: 20px;
        padding: 50px 110px;
        background-color: #FCFCFC;
    }

    
    .accordion .accordion__wrap .panel .panel-body ul{
        list-style: none;
    }

    .accordion .accordion__wrap .panel .panel-body .content-list{
        justify-content: space-between; 
        display: flex;        
    }
    
    .accordion .accordion__wrap .panel .panel-body li{
        padding-bottom: 0px; 
    }

    .accordion .accordion__wrap .panel .panel-body li::before{
        margin-right: 25px;
        content: '\25AA';
        color: #04559F;
        font-size: 150%;
    }
    
    .content-list .download-btn{
        margin: auto 0;
    }

    .content-list .download-btn .down-box .cta-down{
        position: relative;
        padding-left: 56px;
        padding-right: 0;
        letter-spacing: 0;
    }

    .content-list .download-btn .down-box .cta-down::before{
        content: "\f019";
        display: block;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        font-family: FontAwesome;
        font-size: 14px;
        color: #F9991C;
        background-color: #fff;
        position: absolute;
        top: 0px;
        left: 0;
    }

    .content-list .download-btn  .down-box .cta-down span{
        font-family: HelveticaNeue-Bold;
        font-size: 14px;
        text-transform: uppercase;
        color: #F9991C;
        border-bottom: 2px solid #F9991C;
    }


</style>

<div class="row">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input("title")?></h2>
        </article>
        <div class="accordion">
            <div class="accordion__wrap produk">
                <div class="panel-group">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="a-reportheading" data-toggle="collapse" data-parent="#semester" href="#semester">
                                    2019</a>
                            </h4>
                        </div>
                        <div id="semester" class="panel-collapse collapse">
                            <div class="panel-body">
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
                                <a class="a-reportheading" data-toggle="collapse" data-parent="#semester1" href="#semester1">
                                    2018</a>
                            </h4>
                        </div>
                        <div id="semester1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <div class="content-list">
                                        <li>
                                            <div>
                                                Laporan Keuangan September 2018
                                            </div>
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
                                            <div>
                                                Laporan Keuangan Juli 2018
                                            </div>
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
                                            <div>
                                                Laporan Keuangan Maret 2018
                                            </div>
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
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
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


