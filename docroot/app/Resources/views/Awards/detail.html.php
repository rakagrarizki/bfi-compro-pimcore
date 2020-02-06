<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$this->document->setProperty("site","Text","corporate",true );
$this->headTitle()->append('BFI - ' . $data->getYear());

$this->headMeta('BFI - ' . $data->getYear());


?>
<div class="container btn-back">
    <div class="row">
        <div class="col-md-6 col-sm-6 left-side-top">
            <a href="javascript:history.back()" class="text-btn"><?= $this->t("back-button"); ?></a>
        </div>
    </div>
</div>
<div class="container main-card">
    <div class="page-title"><?= $this->t("award-title");?></div>
    <div class="page-sub-title"><?= $data->getYear();?></div>
</div>


<div class="container">

    <?php $awards = $data->getAwards();
        if($awards){ ?>
    <div class="row">
        <?php foreach($awards as $key => $award){ ?>
        <div class="awards-card col-md-4">
            <picture>
                <img src="<?= $award->getImage(); ?>" alt="">
            </picture>
            <div class="title"><?= $award->getTitle(); ?></div>
            <div class="desc"><?= $award->getDescription(); ?></div>
        </div>
        <?php } ?>

    </div>
    <?php }?>
</div>

<?php $past = $data->getYear()-1;
$next = $data->getYear() + 1;
?>

<div class="container">
    <div class="page-title"><?= $this->t("other-awards");?></div>
</div>

<div class="container">
    <div class="row button-type-18">
        <?php
        $checkPast = \Pimcore\Model\DataObject\Penghargaan::getByYear($past,1);
        if($checkPast):?>
        <div class="col-xs-6">
            <a href="<?= '/'.$this->getLocale().'/award/'.$past?>">
                <div class="side-left">

                     <span class="arrow-left"><i class="icon-next"></i></span> <?= $past ?>

                </div>
            </a>
        </div>
        <?php endif;?>
        <?php
        $checkNext = \Pimcore\Model\DataObject\Penghargaan::getByYear($next,1);
        if($checkNext):?>
        <div class="col-xs-6">
            <a href="<?= '/'.$this->getLocale().'/award/'.$next?>">
                <div class="side-right">

                    <?= $next ?> <span class="arrow-right"><i class="icon-next"></i></span>

                </div>
            </a>
        </div>
        <?php endif;?>
    </div>
</div>
