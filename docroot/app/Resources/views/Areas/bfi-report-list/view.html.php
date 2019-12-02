<div class="row">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input("title")?></h2>
            <p><?= $this->textarea('text');?></p>
        </article>
        <div class="list-container">
            <div class="information">
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
            <div class="information">
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
