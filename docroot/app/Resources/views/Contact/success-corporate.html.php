<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

// $this->extend('layout.html.php');
?>

<?php
$this->headScript()->offsetSetFile(100, '/static/js/Includes/contact-us.js');
$site = $this->document->getProperty("site");
$link = "";
if ($site == "corporate") {
    $link = "corporate";
}
?>

<div class="container">
    <div class="row">
        <div id="success" class="contact-us success-wrapper corporate">
            <div class="img-wrap">
                <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
            </div>
            <div class="text-wrap text-center">
                <h3><?= $this->t('thankyou_msg'); ?></h3>
                <p><?= $this->t('success_msg'); ?></p>
            </div>
        </div>
    </div>
    <div class="blog-promo">
        <article class="sect-title text-center">
            <h2 class="title"><?= $this->t('berita_head'); ?></h2>
            <p class="subtitle"><?= $this->t('berita_sub_head'); ?></p>
        </article>
        <div class="list-card success-news">
        <?php foreach ($this->news as $news) : ?>
            <a href="<?= '/' . $this->getLocale() . '/news/' . $news->getSlug(); ?>" class="card-item">
                <picture>
                    <img src="<?= $news->getImage(); ?>" alt="">
                </picture>
                <div class="caption">
                    <h3 class="tag"><?= $news->getCategory()->getName(); ?></h3>
                    <h2 class="title"><?= $news->getTitle(); ?></h2>
                    <div class="dateview">
                        <span class="date"><?= date('d.m.y', strtotime($news->getDate())); ?></span>
                        <span class="view"><i class="fa fa-eye"></i><?= $news->getViews(); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <div class="button-area text-center btn-beranda">
                <a href="<?php echo "/" . $this->getLocale() . '/' . $link; ?>" class="cta cta-primary cta-big">
                    <i class="icon-home"></i>
                    <span><?= $this->translate('backtohome') ?></span></a>
            </div>
        </div>
    </div>
</div>