<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
$this->document->setProperty("site","Text","corporate",true );
$news = $this->news;
$relatedNews = $this->relatedNews;

use Pimcore\Model\Asset;


$url = '/news/';
$titleshare = $news->getTitle();
$lang = $this->getLocale();

$fixedurl = BASEURL.'/'.$lang. $url . $news->getSlug();
$imagethumbnail = BASEURL . $news->getImage();
$urlcheck = Pimcore\Model\Asset::getByPath($imagethumbnail);
$urlFacebook = " https://www.facebook.com/sharer/sharer.php?u=" . $fixedurl . "&title=" . $titleshare . "&picture=" . $imagethumbnail;
$urlTwitter = " https://twitter.com/share?text=$titleshare&url=$fixedurl&wrap_links=true ";
?>
<?php 
($news->getMetaTitle()) ? $this->headTitle()->append($news->getMetaTitle()) : $this->headTitle()->append($news->getTitle() . " - BFI Finance");
// setting content type and character set
$this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')->appendHttpEquiv('Content-Language', 'en-US');
// setting open graph tags
// <!-- Open Graph / Facebook -->
$this->headMeta()->appendName('og:url', BASEURL . '/' . $lang . $url . $news->getSlug());
$this->headMeta()->appendName('og:type', 'article');
$this->headMeta()->appendName('og:title',$news->getTitle());
$this->headMeta()->appendName('og:description', $news->getDescription());
$this->headMeta()->appendName('og:keyword', $news->getKeyword());
$this->headMeta()->appendName('og:image', BASEURL . $news->getImage());

$this->headMeta()->appendName('title',$news->getTitle());
$this->headMeta()->appendName('description', $news->getDescription());
$this->headMeta()->appendName('keyword', $news->getKeyword());

// <!-- Twitter -->
$this->headMeta()->appendName('twitter:card', 'summary');
$this->headMeta()->appendName('twitter:title',$news->getTitle());
$this->headMeta()->appendName('twitter:url', BASEURL . '/' . $lang . $url . $news->getSlug());
$this->headMeta()->appendName('twitter:image', BASEURL . $news->getImage());
$this->headMeta()->appendName('twitter:description', $news->getDescription());
if($news->getProperty('url_canonical')){
    $this->headLink(['rel' => 'canonical', 'href' => $news->getProperty('url_canonical')]);
}

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
                <p class="tag"><?= $news->getCategory() ? $news->getCategory()->getName(): "";?></p>
                <h1 class="title"><?= $news->getTitle();?></h1>
                <div class="dateview">
                    <span class="date"><?= $news->getDate();?></span>
                    <span class="view"><i class="fa fa-eye"></i> <?= $news->getViews();?></span>
                </div>
            </div>
            <picture>
                <img src="<?= $news->getImage();?>" alt="">
            </picture>
            <div class="article-content">

                <?= $news->getContent();?>
            </div>
            <div class="article-gallery row">
                <?php 
                $galleryCount = count($news->getGallery()->getItems()) - 1;
                foreach( $news->getGallery()->getItems() as $key => $galleryitem ):                    
                        if ($key % 2 == 0 && $key == $galleryCount) : 
                ?>
                        <div class='article-items col-12 col-md-12 col-xs-12'>
                            <div class="item-img"> 
                                <img src="<?= $galleryitem->getImage() ?>" alt="">
                            </div>
                            <div class="item-break"></div>
                            <p><?= $galleryitem->getImage()->getMetadata('Caption',$lang)?></p>
                        </div>    
                        <?php else: 
                        ?>
                        <div class='article-items col-6 col-md-6 col-xs-12'>
                            <div class="item-img"> 
                                <div class="blur-filter" style="background-image: url('<?= $galleryitem->getImage();?>');"></div>
                                <img src="<?= $galleryitem->getImage() ?>" alt="">
                            </div>
                            <p><?= $galleryitem->getImage()->getMetadata('Caption',$lang)?></p>
                        </div>
                    <?php endif;
                endforeach; ?>
            </div>
            <div class="share">
                <span>Share:</span>
                <a href="<?= $urlFacebook;?>" class="share-fb" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                <a href="<?= $urlTwitter;?>" class="share-tw" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                <a class="share-cp" id="copy" onclick="copyURL('<?= $fixedurl ?>')"><i class="fa fa-chain"></i></a>
                <div style="display: none;padding: 0px 20px;" id="copied">Copied</div>
            </div>
            <div class="sumber">
                <span><?= $this->t("source")?>:</span> <?= $news->getSource();?>
            </div>
        </article>
    </div>
    <br>
    <br>
    <?php if($relatedNews):?>
    <div class="container related">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->t("related-news");?></h2>
            <p><?= $this->t("related-news-description");?></p>
        </article>
        <div class="list-card">
        <?php foreach($relatedNews as $relatedNewsData) :?>
            <a href="<?= '/'.$lang.'/news/'.$relatedNewsData->getSlug();?>" class="card-item">
                <picture>
                    <img src="<?= $relatedNewsData->getImage();?>" alt="">
                </picture>
                <?php
                    $timestampDate = \Carbon\Carbon::parse($relatedNewsData->getDate());
                    $dateUnix = $timestampDate->timestamp;
                    $date = date("d.m.y", $dateUnix);
                ?>
                <div class="caption">
                    <h3 class="tag"><?= $relatedNewsData->getCategory()->getName();?></h3>
                    <h2 class="title"><?= $relatedNewsData->getTitle();?></h2>
                    <p class="date"><?= $date;?> | <i class="fa fa-eye"></i><?= $relatedNewsData->getViews()?></p>
                    <!-- <div class="dateview">
                        <span class="date"></?= $date;?></span>
                        <span class="view"><i class="fa fa-eye"></i> </?= $relatedNewsData->getViews()?></span>
                    </div> -->
                </div>
            </a>
        <?php endforeach;?>
        </div>
    </div>
    <?php endif;?>
</div>
