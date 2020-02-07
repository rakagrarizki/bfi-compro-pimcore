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
                <h3><?= $this->t('thankyou_msg_scholar'); ?></h3>
                <p><?= $this->t('success_msg_scholar'); ?></p>
            </div>
        </div>
    </div>
    <div id="news" class="news">
        <div class="row">
            <div class="sect-title text-center">
                <h2><?= $this->t('berita_head'); ?></h2>
                <p><?= $this->t('berita_sub_head'); ?></p>
            </div>
        </div>
        <div class="row list-news-container">
            <?php foreach ($this->news as $news) : ?>
                <div class="col-md-3 col-xs-6">
                    <article class="article__post">
                        <div class="article__post__img" style="background-image: url('<?= $news->getImage(); ?>')">
                        </div>
                        <div class="article__post__text">
                            <p><?= $news->getCategory()->getName(); ?></p>
                            <h4><a href="<?= '/' . $this->getLocale() . '/news/' . $news->getSlug(); ?>"><?= $news->getTitle(); ?></a></h4>
                            <div class="dateview">
                                <span class="date"><?= date('Y-m-d', strtotime($news->getDate())); ?></span>
                                <span class="view"><i class="fa fa-eye"></i><?= $news->getViews(); ?></span>
                            </div>
                        </div>
                    </article>
                </div>
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