<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

use Pimcore\Model\Asset;

$this->extend('layout.html.php');
$promo = $this->promo;

$this->headTitle()->append($promo->getTitle());

// setting content type and character set
$this->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')->appendHttpEquiv('Content-Language', 'en-US');

$this->headMeta()->appendName('description', $promo->getDescription());
$this->headMeta($promo->getTitle(), "title");

// setting open graph tags
// <!-- Open Graph / Facebook -->
$this->headMeta()->appendName('og:url', BASEURL . '/' . $lang . $url . $promo->getSlug());
$this->headMeta()->appendName('og:type', 'article');
$this->headMeta()->appendName('og:title', $promo->getTitle());
$this->headMeta()->appendName('og:description', $promo->getDescription());
$this->headMeta()->appendName('og:image', BASEURL . $promo->getImage());

// <!-- Twitter -->
$this->headMeta()->appendName('twitter:card', 'summary');
$this->headMeta()->appendName('twitter:title', $promo->getTitle());
$this->headMeta()->appendName('twitter:url', BASEURL . '/' . $lang . $url . $promo->getSlug());
$this->headMeta()->appendName('twitter:image', BASEURL . $promo->getImage());
$this->headMeta()->appendName('twitter:description', $promo->getDescription());
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

    <?php

    $url = '/promo/';
    $titleshare = $promo->getTitle();
    $lang = $this->getLocale();

    $fixedurl = BASEURL . '/' . $lang . $url . $promo->getSlug();
    $imagethumbnail = BASEURL . $promo->getImage();
    $urlcheck = Pimcore\Model\Asset::getByPath($imagethumbnail);
    $urlFacebook = " https://www.facebook.com/sharer/sharer.php?u=" . $fixedurl . "&title=" . $titleshare . "&picture=" . $imagethumbnail;
    $urlTwitter = " https://twitter.com/share?text=$titleshare&url=$fixedurl&wrap_links=true ";
    ?>
    <div class="container">
        <article>
            <div class="sect-title text-center">
                <p class="tag"><?= $promo->getPromoCategory() ? $promo->getPromoCategory()->getName() : ""; ?></p>
                <h1 class="title"><?= $promo->getTitle(); ?></h1>
                <p><?= $promo->getDescription(); ?></p>
            </div>
            <picture>
                <img src="<?= $promo->getImage(); ?>" alt="">
            </picture>
            <div class="article-content">

                <?= $promo->getContent(); ?>
            </div>
            <div class="share">
                <span><?= $this->t("share") ?>:</span>
                <a href="<?= $urlFacebook; ?>" class="share-fb" target="_blank"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
                <a href="<?= $urlTwitter; ?>" class="share-tw" target="_blank"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                <a class="share-cp" id="copy" onclick="copyURL('<?= $fixedurl ?>')"><i class="fa fa-chain"></i></a>
                <div style="display: none;padding: 0px 20px;" id="copied">Copied</div>
            </div>
        </article>
    </div>
    <?= $this->inc("/" . $this->getLocale() . "/shared/includes/snippet") ?>


</div>