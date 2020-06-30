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
<?php 
$this->headTitle()->append($blog->getTitle());
// setting content type and character set
$this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')->appendHttpEquiv('Content-Language', 'en-US');
// setting open graph tags
// <!-- Open Graph / Facebook -->
$this->headMeta()->appendName('og:url', BASEURL . '/' . $lang . $url . $blog->getSlug());
$this->headMeta()->appendName('og:type', 'article');
$this->headMeta()->appendName('og:title',$blog->getTitle());
$this->headMeta()->appendName('og:description', $blog->getDescription());
$this->headMeta()->appendName('og:keyword', $blog->getKeyword());
$this->headMeta()->appendName('og:image', BASEURL . $blog->getImage());
// ------ 
$this->headMeta()->appendName('title',$blog->getTitle());
$this->headMeta()->appendName('description', $blog->getDescription());
$this->headMeta()->appendName('keyword', $blog->getKeyword());
// ------

// <!-- Twitter -->
$this->headMeta()->appendName('twitter:card', 'summary');
$this->headMeta()->appendName('twitter:title',$blog->getTitle());
$this->headMeta()->appendName('twitter:url', BASEURL . '/' . $lang . $url . $blog->getSlug());
$this->headMeta()->appendName('twitter:image', BASEURL . $blog->getImage());
$this->headMeta()->appendName('twitter:description', $blog->getDescription());
?>

<div class="blog-promo detail">
    <div class="pimcore_area_bfi-back-widget pimcore_area_content">
        <div class="container btn-back">
            <div class="row">
                <div class="col-md-6 col-sm-6 left-side-top">
                    <a href="javascript:history.back()" class="text-btn"><?= $this->t("back-button"); ?></a>
                </div>
            </div>
        </div>
    </div>
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
                <a href="<?= $urlFacebook;?>" class="share-fb" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                <a href="<?= $urlTwitter;?>" class="share-tw" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                <a class="share-cp" id="copy" onclick="copyURL('<?= $fixedurl ?>')"><i class="fa fa-chain"></i></a>
                <div style="display: none;padding: 0px 20px;" id="copied">Copied</div>
            </div>
            <div class="sumber">
                <span><?= $this->t("source")?>:</span> <?= $blog->getSource();?>
            </div>
        </article>
    </div>
    <br>
    <br>
    <?php if($relatedBlogs):?>
    <div class="container related">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->t("related-blog");?></h2>
            <p><?= $this->t("related-blog-description");?></p>
        </article>
        <div class="list-card">
        <?php foreach($relatedBlogs as $relatedBlog) :?>
            <a href="<?= '/'.$lang.'/blog/'.$relatedBlog->getSlug();?>" class="card-item">
                <picture>
                    <img src="<?= $relatedBlog->getImage();?>" alt="">
                </picture>
                <?php
                    $timestampDate = \Carbon\Carbon::parse($relatedBlog->getDate());
                    $dateUnix = $timestampDate->timestamp;
                    $date = date("d.m.y", $dateUnix);
                ?>
                <div class="caption">
                    <h3 class="tag"><?= $relatedBlog->getBlogCategory()->getName();?></h3>
                    <h2 class="title"><?= $relatedBlog->getTitle();?></h2>
                    <p class="date"><?= $date; ?> | <i class="fa fa-eye"></i> <?= $relatedBlog->getViews(); ?></p>
                    <!-- <div class="dateview">
                        <span class="date"></?= $date;?></span>
                        <span class="view"><i class="fa fa-eye"></i> </?= $relatedBlog->getViews()?></span>
                    </div> -->
                </div>
            </a>
        <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</div>
