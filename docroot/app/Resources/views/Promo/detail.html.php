<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$promo = $this->promo;
$relatedPromos = $this->relatedPromos;
?>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-2"><?= $promo->getPromoCategory() ? $promo->getPromoCategory()->getName(): "";?></div>
            <div class="col-sm-2"><?= $promo->getImage();?></div>
            <div class="col-sm-2"><?= $promo->getTitle();?></div>
            <div class="col-sm-2"><?= $promo->getDescription();?></div>
            <div class="col-sm-2"><?= $promo->getContent();?></div>
            <div class="col-sm-2"><?= $promo->getPromoStartDate();?></div>
            <div class="col-sm-2"><?= $promo->getPromoEnddate();?></div>

        </div>
    </div>
</div>
<?php if($relatedPromos):?>
<h3><?= $this->t("related-promo");?></h3>
<div class="row">
    <div class="col-sm-12">
        <?php foreach($relatedPromos as $relatedPromo) :?>
        <div class="row">
            <div class="col-sm-2"><?= $relatedPromo->getImage();?></div>
            <div class="col-sm-2"><?= $relatedPromo->getTitle();?></div>
            <div class="col-sm-2"><?= $relatedPromo->getDescription();?></div>
            <div class="col-sm-2"><?= $relatedPromo->getContent();?></div>
            <div class="col-sm-2"><?= $relatedPromo->getPromoStartDate();?></div>
            <div class="col-sm-2"><?= $relatedPromo->getPromoEnddate();?></div>

        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif;?>
