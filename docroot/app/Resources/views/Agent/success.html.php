<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<div class="container">
    <div class="row">
        <div id="success" class="contact-us success-wrapper corporate">
            <div class="img-wrap">
                <img class="icon-thank-page" src="/static/images/icon/m_thank_you.png" alt="">
            </div>
            <div class="text-wrap text-center">
                <h3><?= $this->t('thankyou_msg_agent'); ?></h3>
                <p><?= $this->t('success_msg_agent'); ?></p>
            </div>
        </div>
    </div>
    <div class="blog-promo">
        <article class="sect-title text-center">
            <h2 class="title"><?= $this->t('berita_head'); ?></h2>
            <p class="subtitle"><?= $this->t('berita_sub_head'); ?></p>
        </article>
        <div class="list-card success-news">
            <?php foreach ($this->blog as $blog) : ?>
            <a href="<?= '/' . $this->getLocale() . '/blog/' . $blog->getSlug(); ?>" class="card-item">
                <picture>
                    <img src="<?= $blog->getImage(); ?>" alt="">
                </picture>
                <div class="caption">
                    <h3 class="tag"><?= $blog->getBlogCategory()->getName(); ?></h3>
                    <h2 class="title"><?= $blog->getTitle(); ?></h2>
                    <p class="date"><?= date('d.m.y', strtotime($blog->getDate())); ?> | <i class="fa fa-eye"></i>
                        <?= $blog->getViews(); ?></p>
                    <!-- <div class="dateview">
                        <span class="date"></?= date('d.m.y', strtotime($blog->getDate())); ?></span>
                        <span class="view"><i class="fa fa-eye"></i></?= $blog->getViews(); ?></span>
                    </div> -->
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="button-area text-center backtohome">
        <button class="cta cta-primary cta-big cta-see buttonnext backtohome" id="button7" type="button"
            onclick="return checkStatusPengajuan()"><?= $this->translate('backtohome') ?></button>
    </div>
</div>
