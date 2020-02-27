

<?php $category = $this->document->getProperty("category")->getId();
$id = $this->document->getId();
$p = htmlentities($_GET["page".$id]);
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?",$category,"AND");

$paginator = new \Zend\Paginator\Paginator($reports);
$paginator->setCurrentPageNumber($p);
$paginator->setItemCountPerPage(2);


$t =  $_GET["t"];

$s = $this->pimcoreUrl();
$u = parse_url($s);
$u = array_shift($u);
if(isset($t)){
    $url = $u . '?t='.$t.'&page'.$id.'=';
}
$url = $u . '?page'.$id.'=';



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
        <?php $pages = $paginator->getPages('Sliding');?>
        <nav aria-label="Page navigation" id="paginating">
            <ul class="pagination">
                <?php
                if (isset($pages->previous)) {
                    ?>
                    <li>
                        <a href="<?= urldecode($url.$pages->previous); ?>" aria-label="Previous">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <?php foreach ($pages->pagesInRange as $page) : ?>

                    <?php if ($page == $p) : ?>

                        <li class="active"><a href="javascript:void(0)"><?= $page; ?></a></li>
                    <?php else : ?>

                        <li><a href="<?= $url.$page; ?>"><?= $page; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php if (isset($pages->next)) { ?>
                    <li>
                        <a href="<?= $url.$pages->next; ?>" aria-label="Next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    <?php endif; ?>

</div>
<!-- Template -->
