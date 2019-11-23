<?= $this->input("title")?>

<?php $category = $this->document->getProperty("category")->getId();
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
