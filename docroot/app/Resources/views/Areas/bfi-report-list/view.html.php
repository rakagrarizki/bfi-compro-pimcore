<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");

?>

<div class="row">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input("title")?></h2>
            <p><?= $this->textarea('text');?></p>
        </article>

        <?php foreach($reports as $data):?>


        <div class="list-container">
            <div class="information">
                <div class="year">
                    <?= $data->getDate()->formatLocalized("%Y");?>
                </div>
                <div class="report-download-container">
                    <div class="title">
                        <?= $data->getFilename();?>
                    </div>
                </div>
            </div>
            <div class="download-btn">
                <div class="down-box">
                    <a href=" <?= $data->getUrl();?>" class="cta cta-down">
                        <span><?=  $this->t("download-document")?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach;?>

    </div>
</div>




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

