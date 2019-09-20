<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$lang = $this->getLocale();
?>

<div class="row">
    <div class="col-sm-12">
        <?= $this->t("promo-title");?>

    </div>

</div>

<div class="row">
    <div class="col-sm-12">
        <?= $this->t("promo-text1");?>

    </div>

</div>

<div class="row">
    <div class="col-sm-12">
        <?= $this->t("promo-text2");?>

    </div>

</div>
<form action="">
    <div class="filter">
        <label><?= $this->t("promo-category");?></label>
        <select class="device-select jcf-ignore" id="category"  onchange="this.form.submit()" name="category">
            <option value="" <?php echo ($this->getParam("category") == "") ? "selected" : ""; ?>><?= $this->t("all-promo");?></option>
            <?php foreach ($this->promoCategories as $category):?>
            <option value="<?= $category->getId()?>" <?php echo ($this->getParam("category") == $category->getId()) ? "selected" : ""; ?>><?= $category->getName();?></option>
            <?php endforeach ?>


        </select>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
<?php

foreach($this->promos as $promo) : ?>
    <div class="row">
        <div class="col-sm-2"><a href="<?= '/'.$lang.'/promo/'.$promo->getSlug();?>"><?= $promo->getTitle();?></a></div>
        <div class="col-sm-2"><?= $promo->getDescription();?></div>
        <div class="col-sm-2"><?= $promo->getPromoStartDate();?></div>
        <div class="col-sm-2"><?= $promo->getPromoEndDate();?></div>


    </div>


<?php endforeach;?>
 </div>
</div>
