<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php
    $this->headScript()->offsetSetFile(100, '/static/js/Includes/tabbing.js');
?>

<div class="tabs-accor">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10">Informasi Keuangan</h2>
        </article>
        <div id="" class="tabs-outer">
            <ul class="nav nav-tabs" role="tablist" id="outer-choice">
                <li style="display: none" role="presentation" onclick="prev()" class="arrow" onclick="scrollPosition('<?= $id;?>')" id="prevButton">
                    <a class="arrow-outer"><i class="icon-left-arrow"></i></a>
                </li>
                <li class="active">
                    <a  href="#1a" data-toggle="tab">Informasi Keuangan Triwulan</a>
                </li>
                <li>
                    <a href="#2a" data-toggle="tab">Informasi Keuangan Semester</a>
                </li>
                <li>
                    <a href="#3a" data-toggle="tab">Informasi Keuangan Tahunan</a>
                </li>
                <li role="presentation" class="arrow" onclick="next()" id="nextButton">
                    <a class="arrow-outer"><i class="icon-right-arrow"></i></a>
                </li>
            </ul>
        </div>	
        <div class="tab-content clearfix">
            <div role="tabpanel" class="tab-pane active" id="1a">
                <div class="accordion">
                    <div class="accordion__wrap produk">
                        <div class="container">
                            <div class="row">
                                <div class="panel-group" id="coba">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="a-panelheading" data-toggle="collapse" data-parent="#triwulan" href="#triwulan">
                                                    2019</a>
                                            </h4>
                                        </div>
                                        <div id="triwulan" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    <li>Laporan Keuangan September 2019</li>
                                                    <li>Laporan Keuangan Juli 2019</li>
                                                    <li>Laporan Keuangan Maret 2019</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="a-panelheading" data-toggle="collapse" data-parent="#triwulan1" href="#triwulan1">
                                                    2018</a>
                                            </h4>
                                        </div>
                                        <div id="triwulan1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>        
                                                    <li>Laporan Keuangan September 2018</li>
                                                    <li>Laporan Keuangan Juli 2018</li>
                                                    <li>Laporan Keuangan Maret 2018</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="2a">
            <div class="accordion">
                    <div class="accordion__wrap produk">
                        <div class="container">
                            <div class="row">
                                <div class="panel-group" id="coba">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="a-panelheading" data-toggle="collapse" data-parent="#semester" href="#semester">
                                                    2019</a>
                                            </h4>
                                        </div>
                                        <div id="semester" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>
                                                    <div class="download-box">
                                                        <div class="container" style="padding: 30px 40px;">
                                                            <div class="down-box" style="padding: 20px 0px;">
                                                                <h3><li>Desember</li></h3>
                                                                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                    <span><?=  $this->t("Unduh Dokumen")?></span>
                                                                </a>
                                                            </div>
                                                            <div class="down-box" style="padding: 20px 0px;">
                                                                <h3><li>Juni</li></h3>
                                                                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                    <span><?=  $this->t("Unduh Dokumen")?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="a-panelheading" data-toggle="collapse" data-parent="#semester1" href="#semester1">
                                                    2018</a>
                                            </h4>
                                        </div>
                                        <div id="semester1" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <ul>        
                                                    <div class="download-box">
                                                        <div class="container" style="padding: 30px 40px;">
                                                            <div class="down-box" style="padding: 20px 0px;">
                                                                <h3><li>Desember</li></h3>
                                                                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                    <span><?=  $this->t("Unduh Dokumen")?></span>
                                                                </a>
                                                            </div>
                                                            <div class="down-box" style="padding: 20px 0px;">
                                                                <h3><li>Juni</li></h3>
                                                                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                                                    <span><?=  $this->t("Unduh Dokumen")?></span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="3a">
                <div style="padding: 12px; background-color: #CBCBCB; margin-top: 20px;">
                    <div class="container">
                        2019
                        <div style="font-size: 20px; display: flex;">
                            <div class="down-box">
                                <strong>
                                    Informasi Keuangan Tahunan Juni 2019
                                </strong>
                                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                    <span><?=  $this->t("Unduh Dokumen")?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding: 12px; background-color: #CBCBCB; margin-top: 20px;">
                    <div class="container">
                        2018
                        <div style="font-size: 20px">
                            <div class="down-box">
                                <strong>
                                    Informasi Keuangan Tahunan Juni 2018
                                </strong>
                                <a href="<?= $this->link('url')->getHref(); ?>" class="cta cta-down">
                                    <span><?=  $this->t("Unduh Dokumen")?></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>