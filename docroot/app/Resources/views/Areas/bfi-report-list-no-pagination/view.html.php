<?php 
$category = $this->document->getProperty("category")->getId();
$id = $this->document->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
$reports->setOrderKey("Date");
?>

<div class="container report-list-wrapper" id =<?= $id;?>>
    <div class="">
        <article class="sect-title text-center">
        <?php 
            if($this->input('title') == '') { ?>
            <?php } else {?>
            <h2 class=""><?= $this->input('title');?></h2>
            <p><?= $this->textarea('text');?></p>
            <?php }?>
        </article>

        <?php foreach($reports as $data):?>


        <div class="list-container">
            <div class="information">
                <div class="report-download-container">
                    <div class="title">
                        <h2>
                            <?= $data->getFilename();?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="download-btn">
                <div class="down-box">
                    <a href=" <?= $data->getUrl();?>" target="_blank" class="cta cta-down mobile-cta">
                        <span><?=  $this->t("download-document")?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
</div>
