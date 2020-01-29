<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

use Pimcore\Model\Asset;
$this->extend('layout.html.php');
$promo = $this->promo;





?>
<?php
//dump($this->getTitle());exit;
$this->headTitle()->append('BFI - '. $promo->getTitle());
//echo $this->headTitle();
$this->headMeta('BFI - '. $promo->getTitle(), "title");

?>
<div class="blog-promo detail">

        <?php

            $url = '/promo/';
            $titleshare = $promo->getTitle();
            $lang = $this->getLocale();

            $fixedurl = BASEURL.'/'.$lang. $url . $promo->getSlug();
            $imagethumbnail = BASEURL . $promo->getImage();
            $urlcheck = Pimcore\Model\Asset::getByPath($imagethumbnail);
            $urlFacebook = " https://www.facebook.com/sharer/sharer.php?u=" . $fixedurl . "&title=" . $titleshare . "&picture=" . $imagethumbnail;
            $urlTwitter = " https://twitter.com/share?text=$titleshare&url=$fixedurl&wrap_links=true ";
        ?>
        <div class="container">
            <article>
                <div class="sect-title text-center">
                    <p class="tag"><?= $promo->getPromoCategory() ? $promo->getPromoCategory()->getName(): "";?></p>
                    <h1 class="title"><?= $promo->getTitle();?></h1>
                    <p><?= $promo->getDescription();?></p>
                </div>
                <picture>
                    <img src="<?= $promo->getImage();?>" alt="">
                </picture>
                <div class="article-content">

                    <?= $promo->getContent();?>
                </div>
                <div class="share">
                    <span><?= $this->t("share")?>:</span>
                    <a href="<?= $urlFacebook;?>" class="share-fb"><i class="fa fa-facebook"></i></a>
                    <a href="<?= $urlTwitter;?>" class="share-tw"><i class="fa fa-twitter"></i></a>
                    <a class="share-cp" id="copy" onclick="copyURL('<?= $fixedurl ?>')"><i class="fa fa-chain"></i></a>
                    <div style="display: none;padding: 0px 20px;" id="copied">Copied</div>
                </div>
            </article>
        </div>
     <?= $this->inc("/" . $this->getLocale() . "/shared/includes/snippet") ?>


    </div>
