<style>
    .list-container {
        padding: 15px 25px; 
        background-color: #F4F4F4; 
        margin-top: 20px;
        width: 100%;
        height: 73px;
        justify-content: space-between; 
        display: flex;
    }
    
    .report-download-container {
        font-size: 18px;
        width: 100%;
        margin: 0 auto;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: justify;
    }

    .list-container .title{
        font-weight: 900;
        color: #04559F;
    }

    .year{
        font-size: 12px;
        color: #565656;
        margin-bottom: 5px;
    }

    .download-btn{
        margin: auto 0;
    }

    .down-box .cta-down{
        position: relative;
        padding-left: 56px;
        padding-right: 0;
        letter-spacing: 0;
    }

    .down-box .cta-down::before{
        content: "\f019";
        display: block;
        width: 40px;
        height: 40px;
        text-align: center;
        line-height: 40px;
        font-family: FontAwesome;
        font-size: 14px;
        color: #000;
        background-color: #F9991C;
        position: absolute;
        top: 0px;
        left: 0;
    }

    .down-box .cta-down span{
        font-family: HelveticaNeue-Bold;
        font-size: 14px;
        text-transform: uppercase;
        color: #565656;
        border-bottom: 2px solid #000;
    }

</style>
<div class="row">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input("title")?></h2>
            <p><?= $this->textarea('text');?></p>
        </article>
        <div class="list-container">
            <div class="">
                <div class="year">
                    2019
                </div>
                <div class="report-download-container">
                    <div class="title">
                        Informasi Keuangan Tahunan Juni 2019
                    </div>
                </div>
            </div>
            <div class="download-btn">
                <div class="down-box">
                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                        <span><?=  $this->t("Unduh Dokumen")?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="list-container">
            <div class="">
                <div class="year">
                    2018
                </div>
                <div class="report-download-container">
                    <div class="title">
                        Informasi Keuangan Tahunan Juni 2018
                    </div>
                </div>
            </div>
            <div class="download-btn">
                <div class="down-box">
                    <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                        <span><?=  $this->t("Unduh Dokumen")?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php //$category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");

?>
<?php foreach($reports as $data):?>
<?= $data->getFilename();?>
<?= $data->getUrl();?>
<?= $data->get?>

    <?php
//$thumb = "/prev/".$data->getFileName();
//    $image = new \Pimcore\Image\Adapter\Imagick($data->getUrl().'[0]'); // first page only
//    //$image->flattenImages();
////    $image->setImageFormat('jpg');
////    $image->setImageCompression(Imagick::COMPRESSION_JPEG);
////    $image->setImageCompressionQuality(80);
////    $image->thumbnailImage("300", 0);
//    $image->load($thumb);
    ?>
<?php endforeach;?>
