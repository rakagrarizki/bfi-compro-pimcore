<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$blog = $this->blog;
$relatedBlogs = $this->relatedBlogs;
?>

<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-2"><?= $blog->getBlogCategory() ? $blog->getBlogCategory()->getName(): "";?></div>
            <div class="col-sm-2"><?= $blog->getImage();?></div>
            <div class="col-sm-2"><?= $blog->getTitle();?></div>

            <div class="col-sm-2"><?= $blog->getContent();?></div>
            <div class="col-sm-2"><?= $blog->getDate();?></div>


        </div>
    </div>
</div>
<?php if($relatedBlogs):?>
<h3><?= $this->t("related-promo");?></h3>
<div class="row">
    <div class="col-sm-12">
        <?php foreach($relatedBlogs as $relatedBlog) :?>
        <div class="row">
            <div class="col-sm-2"><?= $relatedBlog->getImage();?></div>
            <div class="col-sm-2"><?= $relatedBlog->getTitle();?></div>
            <div class="col-sm-2"><?= $relatedBlog->getContent();?></div>
            <div class="col-sm-2"><?= $relatedBlog->getDate();?></div>


        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif;?>
