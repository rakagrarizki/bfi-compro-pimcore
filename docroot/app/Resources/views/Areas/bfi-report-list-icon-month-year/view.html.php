

<?php $category = $this->document->getProperty("category")->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");
$page = htmlentities(addslashes($_GET["page"]));
$paginator = new \Zend\Paginator\Paginator($reports);
$paginator->setCurrentPageNumber($page);
$paginator->setItemCountPerPage(4);
?>



<!-- Template -->
<div class="container">
<?php if (!$this->input("title")->isEmpty()) { ?>
    <article class="sect-title text-center">
        <h2 class="margin-top-10"><?= $this->input("title")?></h2>
    </article>
<?php } ?>
    <ul class="card-list-box">
        <?php foreach($paginator as $data):?>
        <li class="card-list">
            <?php $asset = Pimcore\Model\Asset::getById($data->getPdf()->getId());
            ?>


            <img src="<?php echo $asset->getImageThumbnail('tes'); ?>" alt="">
            <div class="card-content">
                <h6><?= $data->getDate()->formatLocalized("%B %Y")?></h6>
                <h3><?= $data->getFilename();?></h3>
                <a href="<?= $data->getUrl();?>">
                    <img src="/static/images/download.png" alt="">
                    <span><u><?= $this->t("download-document")?></u></span>
                </a>
            </div>
        </li>
        <?php endforeach;?>

    </ul>
    <?php if (count($paginator) > 1) : ?>
            <?= $this->render("Includes/paging.html.php", get_object_vars($paginator->getPages("Sliding")), [
                'urlprefix' => $this->document->getFullPath() . '?page=', // just example (this parameter could be used in paging.php to construct the URL)
                'appendQueryString' => true // just example (this parameter could be used in paging.php to construct the URL)
            ]); ?>
        <?php endif; ?>
</div>
<!-- Template -->
