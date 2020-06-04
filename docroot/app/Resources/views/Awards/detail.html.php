<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$this->document->setProperty("site", "Text", "corporate", true);
$this->headTitle()->append($award->getTitle());

$this->headMeta($award->getTitle());
// setting content type and character set
$this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')->appendHttpEquiv('Content-Language', 'en-US');
$this->headMeta()->appendName('description', $award->getDescription());
// setting open graph tags
// <!-- Open Graph / Facebook -->
$this->headMeta()->appendName('og:url', BASEURL . '/' . $lang . $url . $award->getYear());
$this->headMeta()->appendName('og:type', 'article');
$this->headMeta()->appendName('og:title', $award->getTitle());
$this->headMeta()->appendName('og:description', $award->getDescription());
$this->headMeta()->appendName('og:image', BASEURL . $award->getImage());

// <!-- Twitter -->
$this->headMeta()->appendName('twitter:card', 'summary');
$this->headMeta()->appendName('twitter:title', $award->getTitle());
$this->headMeta()->appendName('twitter:url', BASEURL . '/' . $lang . $url . $award->getYear());
$this->headMeta()->appendName('twitter:image', BASEURL . $award->getImage());
$this->headMeta()->appendName('twitter:description', $award->getDescription());


?>
<div class="pimcore_area_bfi-back-widget pimcore_area_content">
    <div class="container btn-back">
        <div class="row">
            <div class="col-md-6 col-sm-6 left-side-top">
                <a href="javascript:history.back()" class="text-btn"><?= $this->t("back-button"); ?></a>
            </div>
        </div>
    </div>
</div>
<div class="container main-card">
    <div class="page-title"><?= $this->t("award-title"); ?></div>
    <div class="page-sub-title"><?= $this->translate("year"); ?> <?= $award->getYear(); ?></div>
</div>


<div class="container award-page">
    <picture>
        <img src="<?= $award->getImage(); ?>" alt="">
    </picture>
    <?php $awards = $award->getAwards();
    $i = 1;
    ?>
    <?php if ($awards) { ?>
        <?php foreach ($awards as $key => $data) { ?>
            <?php if ($i == 1) { ?>
                <div class="row">
                <?php } ?>
                <div class="awards-card col-xs-12">
                    <div class="title">
                        <?= $data->getTitle(); ?>
                    </div>
                    <div class="desc">
                        <?= $data->getDescription(); ?>
                    </div>
                </div>
                <?php if ($i == 3) { ?>
                </div>
            <?php $i = 0;
                } ?>
        <?php $i++;
        } ?>
    <?php } ?>
</div>

<?php $past = $award->getYear() - 1;
$next = $award->getYear() + 1;
?>

<div class="container">
    <div class="page-title"><?= $this->t("other-awards"); ?></div>
</div>

<div class="container">
    <div class="row button-type-18">
        <?php
        $checkPast = \Pimcore\Model\DataObject\Penghargaan::getByYear($past, 1);
        if ($checkPast) : ?>
            <div class="col-xs-6">
                <a href="<?= '/' . $this->getLocale() . '/award/' . $past ?>">
                    <div class="side-left">

                        <span class="arrow-left"><i class="icon-next"></i></span><?= $this->translate("year") ?> <?= $past ?>

                    </div>
                </a>
            </div>
        <?php endif; ?>
        <?php
        $checkNext = \Pimcore\Model\DataObject\Penghargaan::getByYear($next, 1);
        if ($checkNext) : ?>
            <div class="col-xs-6">
                <a href="<?= '/' . $this->getLocale() . '/award/' . $next ?>">
                    <div class="side-right">

                        <?= $this->translate("year") ?> <?= $next ?> <span class="arrow-right"><i class="icon-next"></i></span>

                    </div>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>