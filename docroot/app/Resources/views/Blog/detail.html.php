<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$blog = $this->blog;
$relatedBlogs = $this->relatedBlogs;

use Pimcore\Model\Asset;


$url = '/blog/';
$titleshare = $blog->getTitle();
$lang = $this->getLocale();

$fixedurl = BASEURL.'/'.$lang. $url . $blog->getSlug();
$imagethumbnail = BASEURL . $blog->getImage();
$urlcheck = Pimcore\Model\Asset::getByPath($imagethumbnail);
$urlFacebook = " https://www.facebook.com/sharer/sharer.php?u=" . $fixedurl . "&title=" . $titleshare . "&picture=" . $imagethumbnail;
$urlTwitter = " https://twitter.com/share?text=$titleshare&url=$fixedurl&wrap_links=true ";
?>

<div class="blog-promo detail">
    <div class="container">
        <article>
            <div class="sect-title text-center">
                <p class="tag"><?= $blog->getBlogCategory() ? $blog->getBlogCategory()->getName(): "";?></p>
                <h1 class="title"><?= $blog->getTitle();?></h1>
                <div class="dateview">
                    <span class="date"><?= $blog->getDate();?></span>
                    <span class="view"><i class="fa fa-eye"></i> <?= $blog->getViews();?></span>
                </div>
            </div>
            <picture>
                <img src="<?= $blog->getImage();?>" alt="">
            </picture>
            <div class="article-content">

                <?= $blog->getContent();?>
            </div>
            <div class="share">
                <span>Share:</span>
                <a href="<?= $urlFacebook;?>" class="share-fb"><i class="fa fa-facebook"></i></a>
                <a href="<?= $urlTwitter;?>" class="share-tw"><i class="fa fa-twitter"></i></a>
                <a href="javscript:void(0)" class="share-cp" id="copy"><i class="fa fa-chain"></i></a>
            </div>
            <div class="sumber">
                <span><?= $this->t("source")?>:</span> <a href="javscript:void(0)">Lorem</a>, <a href="javscript:void(0)">Ipsum</a>, <a href="javscript:void(0)">Dolor</a>
            </div>
        </article>
    </div>
    <br>
    <br>
    <?php if($relatedBlogs):?>
    <div class="container related">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->t("related-promo");?></h2>
            <p>Lorem Ipsum</p>
        </article>
        <div class="list-card">
        <?php foreach($relatedBlogs as $relatedBlog) :?>
            <a href="<?= '/'.$lang.'/blog/'.$blog->getSlug();?>" class="card-item">
                <picture>
                    <img src="<?= $relatedBlog->getImage();?>" alt="">
                </picture>
                <div class="caption">
                    <h3 class="tag">Enterpreneur</h3>
                    <h2 class="title"><?= $relatedBlog->getTitle();?></h2>
                    <div class="dateview">
                        <span class="date"><?= $relatedBlog->getDate();?></span>
                        <span class="view"><i class="fa fa-eye"></i> <?= $relatedBlog->getViews()?></span>
                    </div>
                </div>
            </a>
        <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</div>
