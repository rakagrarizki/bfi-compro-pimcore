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
        <?= $this->t("blog-title");?>

    </div>

</div>

<div class="row">
    <div class="col-sm-12">
        <?= $this->t("blog-text1");?>

    </div>

</div>

<div class="row">
    <div class="col-sm-12">
        <?= $this->t("blog-text2");?>

    </div>

</div>
<form action="">
    <div class="filter">
        <label><?= $this->t("blog-category");?></label>
        <select class="device-select jcf-ignore" id="category"  onchange="this.form.submit()" name="category">
            <option value="" <?php echo ($this->getParam("category") == "") ? "selected" : ""; ?>><?= $this->t("all-blog");?></option>
            <?php foreach ($this->blogCategories as $category):?>
            <option value="<?= $category->getId()?>" <?php echo ($this->getParam("category") == $category->getId()) ? "selected" : ""; ?>><?= $category->getName();?></option>
            <?php endforeach ?>


        </select>
    </div>
</form>
<div class="row">
    <div class="col-sm-12">
<?php

foreach($this->blogs as $blog) : ?>
    <div class="row">
        <div class="col-sm-2"><a href="<?= '/'.$lang.'/blog/'.$blog->getSlug();?>"><?= $blog->getTitle();?></a></div>
        <div class="col-sm-2"><?= $blog->getImage();?></div>

        <div class="col-sm-2"><?= $blog->getDate();?></div>



    </div>


<?php endforeach;?>
 </div>
</div>
