

<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
$page = htmlentities(addslashes($_GET["page"]));
$paginator = new \Zend\Paginator\Paginator($reports);
$paginator->setCurrentPageNumber($page);
$paginator->setItemCountPerPage(5);
?>

<div class="container report-list-wrapper">
    <div class="row">
        <article class="sect-title text-center">
            <h2 class=""><?= $this->input("title")?></h2>
            <p><?= $this->textarea('text');?></p>
        </article>

        <?php foreach($paginator as $data):?>


        <div class="list-container">
            <div class="information">
                <?php if($data->getDate() != null) : ?>
                    <div class="year">
                        <?= $data->getDate()->formatLocalized("%Y");?>
                    </div>
                <?php endif; ?>
                <div class="report-download-container">
                    <div class="title">
                        <?= $data->getFilename();?>
                    </div>
                </div>
            </div>
            <div class="download-btn">
                <div class="down-box">
                    <a href=" <?= $data->getUrl();?>" target="_blank" class="cta cta-down">
                        <span><?=  $this->t("download-document")?></span>
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach;?>

        <?php if (count($paginator) > 1) : ?>
            <?= $this->render("Includes/paging.html.php", get_object_vars($paginator->getPages("Sliding")), [
                'urlprefix' => $this->document->getFullPath() . '?page=', // just example (this parameter could be used in paging.php to construct the URL)
                'appendQueryString' => true // just example (this parameter could be used in paging.php to construct the URL)
            ]); ?>
        <?php endif; ?>
    </div>
</div>
