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

<div class="blog-promo detail">
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
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo nulla perspiciatis placeat repudiandae laborum aspernatur quo, consequatur eos, mollitia pariatur deleniti quod debitis nesciunt culpa perferendis dolores veritatis labore ratione.
                <?= $promo->getContent();?>
            </div>
            <div class="share">
                <span>Share:</span>
                <a href="javscript:void(0)" class="share-fb"><i class="fa fa-facebook"></i></a>
                <a href="javscript:void(0)" class="share-tw"><i class="fa fa-twitter"></i></a>
                <a href="javscript:void(0)" class="share-cp"><i class="fa fa-chain"></i></a>
            </div>
        </article>
    </div>
    <!-- [disini gak ada related promo, tapi pasang widget bfi-three-box] -->
    
    <!-- <?php// if($relatedPromos):?>
    <h3><?//= $this->t("related-promo");?></h3>
    <div class="row">
        <div class="col-sm-12">
            <?php// foreach($relatedPromos as $relatedPromo) :?>
            <div class="row">
                <div class="col-sm-2"><?//= $relatedPromo->getImage();?></div>
                <div class="col-sm-2"><?//= $relatedPromo->getTitle();?></div>
                <div class="col-sm-2"><?//= $relatedPromo->getDescription();?></div>
                <div class="col-sm-2"><?//= $relatedPromo->getContent();?></div>
                <div class="col-sm-2"><?//= $relatedPromo->getPromoStartDate();?></div>
                <div class="col-sm-2"><?//= $relatedPromo->getPromoEnddate();?></div>

            </div>
            <?php// endforeach; ?>
        </div>
    </div>
    <?php// endif;?> -->
</div>
