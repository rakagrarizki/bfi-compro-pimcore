<?= $this->input("title")?>

<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
?>



<!-- Template -->
<div class="container">
    <ul class="card-list-box">
        <?php foreach($reports as $data):?>
        <li class="card-list">
            <img src="/static/images/people.jpg" alt="">
            <div class="card-content">
                <h6><?= $data->getDate()->formatLocalized("%Y");?></h6>
                <h3><?= $data->getFilename();?></h3>
                <a href="<?= $data->getUrl();?>">
                    <img src="image/logo/download.png" alt="">
                    <span><u><?= $this->t("download-document")?></u></span>
                </a>
            </div>
        </li>
        <?php endforeach;?>

    </ul>
</div>
<!-- Template -->
