<?php $category = $this->document->getProperty("category")->getId();
$tab = $this->document->getProperty("tab");
$id = $this->document->getId();
$p = htmlentities($_GET["page" . $id]);
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?", $category, "AND");
$reports->setOrderKey("Date");
$reports->setOrder('desc');
$paginator = new \Zend\Paginator\Paginator($reports);
$paginator->setCurrentPageNumber($p);
$paginator->setItemCountPerPage(5);

$t =  $_GET["t"];

$s = $this->pimcoreUrl();
$u = parse_url($s);
$u = array_shift($u);
$url = $u . '?page' . $id . '=';
if ($tab != null) {
    $url = $u . '?t=' . $tab . '&page' . $id . '=';
}
?>

<div class="container report-list-wrapper" id=<?= $id; ?>>
    <div class="">
        <article class="sect-title text-center">
            <?php if (!$this->input("title")->isEmpty()) { ?>
                <h2 class=""><?= $this->input('title');?></h2>
            <?php } ?>
            <p><?= $this->textarea('text'); ?></p>
        </article>

        <?php foreach ($paginator as $data) : ?>
            <div class="list-container">
                <div class="information">
                    <?php if ($data->getDate() != null) : ?>
                        <div class="year">
                            <?= $data->getDate()->formatLocalized("%Y"); ?>
                        </div>
                    <?php endif; ?>
                    <div class="report-download-container">
                        <div >
                            <h2 class="title">
                                <?=$data->getFilename(); ?>
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="download-btn">
                    <div class="down-box">
                        <a href=" <?= $data->getUrl(); ?>" target="_blank" class="cta cta-down mobile-cta">
                            <span><?= $this->t("download-document") ?></span>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (count($paginator) > 1) : ?>
            <?php $pages = $paginator->getPages('Sliding'); ?>
            <nav aria-label="Page navigation" id="paginating">
                <ul class="pagination">
                    <?php
                    if (isset($pages->previous)) {
                    ?>
                        <li>
                            <a href="<?= urldecode($url . $pages->previous); ?>" aria-label="Previous">
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
                            <?php if ($page == 1 && $p == "") { ?>
                                <li class="active"><a href="javascript:void(0)"><?= $page; ?></a></li>
                            <?php } else { ?>
                                <li><a href="<?= $url . $page; ?>"><?= $page; ?></a></li>
                            <?php } ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if (isset($pages->next)) { ?>
                        <li>
                            <a href="<?= $url . $pages->next; ?>" aria-label="Next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
