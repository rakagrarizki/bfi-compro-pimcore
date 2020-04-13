<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<<div class="error-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="error-text">
                    <div class="img-404">
                        <img src="/static/images/icon/404.png" class="img-responsive" alt="">
                    </div>
                    <div class="text-404">
                    Maaf, Halaman yang Anda cari tidak dapat ditemukan</div>
                    <div class="button-area text-center btn-beranda">
                        <a href="/id/" class="cta cta-primary cta-big cta-see buttonnext backtohome">
                        <span>Kembali ke Beranda</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

