<?php $category = $this->document->getProperty("category")->getId();
$tab = $this->document->getProperty("tab");
$id = $this->document->getId();
$reports = new \Pimcore\Model\DataObject\Report\Listing();
$reports->addConditionParam("Category__id = ?", $category, "AND");
$reports->setOrderKey("Date");
$reports->setOrder('desc');
$years = [];
$p = htmlentities(addslashes($_GET["page" . $id]));
foreach ($reports as $year) {
    $found = in_array($year->getDate()->format("Y"), $years);

    if (!$found) {
        $years[] = $year->getDate()->format("Y");
    }
}
$key = 0;

$randId = rand(10, 100);

$paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($years));
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
<div class="container">
    <?php if (!$this->input("title")->isEmpty()) { ?>
        <article class="sect-title text-center">
            <h2 class=""><?= $this->input("title") ?></h2>
        </article>
    <?php } ?>
    <div class="accordion">
        <div class="accordion__wrap produk">
            <div class="">
                <div class="panel-group" id="<?= $randId ?>">
                    <?php
                    foreach ($paginator as $y) {
                    ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <p class="panel-title">
                                    <a class="a-reportheading" data-toggle="collapse" data-parent="#<?= $randId ?>" href="#<?= $randId . '-' . $key ?>">
                                        <?= $y ?></a>
                                </p>
                            </div>
                            <div id="<?= $randId . '-' . $key ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                <div class="panel-body report-accordion">
                                    <ul>
                                        <?php
                                        $reports->addConditionParam("YEAR(FROM_UNIXTIME(DATE)) = ? ", (int) $y, "AND");
                                        $total = count($reports);
                                        foreach ($reports as $i => $data) : ?>
                                            <li>
                                                <div class="content-list">
                                                    <div class="content-list-item">
                                                        <h3>
                                                            <?= $data->getFileName(); ?>
                                                        </h3>
                                                    </div>
                                                    <div class="download-btn">
                                                        <div class="down-box">
                                                            <a href="<?= $data->getUrl(); ?>" target="_blank" class="cta cta-down">
                                                                <span><?= $this->t("download-document") ?></span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php echo  $i < $total ? "<hr>" : "" ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php $key++; ?>
                    <?php } ?>
                </div>

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
    </div>
</div>