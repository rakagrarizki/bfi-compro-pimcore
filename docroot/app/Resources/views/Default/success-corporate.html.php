<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php
$this->headScript()->offsetSetFile(100, '/static/js/Includes/contact-us.js');
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
    <div id="news" class="news">
        <div class="row">
            <div class="sect-title text-center">
                <h2>Berita</h2>
                <p>Temukan berita inspiratif untuk kehidupan finansial Anda</p>
            </div>
        </div>
        <div class="row list-news-container">
            <div class="col-md-3 col-xs-6">
                <article class="article__post">
                    <div class="article__post__img" style="background-image: url('https://dummyimage.com/600x400/000/ff')">
                    </div>
                    <div class="article__post__text">
                        <p>Entrepeneur</p>
                        <h4><a href="#">Ketika Kerja Keras Berbuah Kesuksesan</a></h4>
                        <div class="dateview">
                            <span class="date">03.11.18</span>
                            <span class="view"><i class="fa fa-eye"></i>1.234</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-md-3 col-xs-6">
                <article class="article__post">
                    <div class="article__post__img" style="background-image: url('https://dummyimage.com/600x400/000/ff')">
                    </div>
                    <div class="article__post__text">
                        <p>Sekilas BFI</p>
                        <h4><a href="#">Kampanye Uber Milyaran BFI Rebut Perhatian</a></h4>
                        <div class="dateview">
                            <span class="date">03.11.18</span>
                            <span class="view"><i class="fa fa-eye"></i>1.234</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-md-3 col-xs-6">
                <article class="article__post">
                    <div class="article__post__img" style="background-image: url('https://dummyimage.com/600x400/000/ff')">
                    </div>
                    <div class="article__post__text">
                        <p>Entrepeneur</p>
                        <h4><a href="#">Ketika Kerja Keras Berbuah Kesuksesan</a></h4>
                        <div class="dateview">
                            <span class="date">03.11.18</span>
                            <span class="view"><i class="fa fa-eye"></i>1.234</span>
                        </div>
                    </div>
                </article>
            </div>
            <div class="col-md-3 col-xs-6">
                <article class="article__post">
                    <div class="article__post__img" style="background-image: url('https://dummyimage.com/600x400/000/ff')">
                    </div>
                    <div class="article__post__text">
                        <p>Sekilas BFI</p>
                        <h4><a href="#">Kampanye Uber Milyaran BFI Rebut Perhatian</a></h4>
                        <div class="dateview">
                            <span class="date">03.11.18</span>
                            <span class="view"><i class="fa fa-eye"></i>1.234</span>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="row">
            <div class="button-area text-center btn-beranda">
                <a href="/<?php echo $this->getLocale() ?>" class="cta cta-primary cta-big">
                    <i class="icon-home"></i>
                    <span>Kembali Ke Beranda</span></a>    
            </div>
        </div>
    </div>
</div>
