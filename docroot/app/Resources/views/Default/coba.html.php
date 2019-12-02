<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<?php include 'Areas/bfi-report-list-icon-year/edit.html.php'; ?>

<div class="tabs-accor">
    <div class="container">
        <article class="sect-title text-center">
            <h2 class="margin-top-10"><?= $this->input('title');?></h2>
        </article>
        <div id="<?= $this->select("group")->getData();?>" class="tabs-outer">
            <ul class="nav nav-tabs" role="tablist" id="outer-choice">
                <li style="display: none" role="presentation" onclick="prev()" class="arrow" onclick="scrollPosition('<?= $id;?>')" id="prevButton">
                    <a class="arrow-outer">A<i class="icon-left-arrow"></i></a>
                </li>

                <li role="presentation" class="active" id="div 1" style="width:<?= 100 / $this->block("tab")->getCount()?>%">
                    <a href="#1" id="href<?= $id;?>"  data-prev="<?= $id == 0 ? '' : $id - 1 ?>" data-next="<?=$id == ($this->block("tab")->getCount() -1) ? "" : $id + 1;?>" aria-controls="<?= $id?>" role="tab" data-toggle="tab" onclick="setPreviewId(<?= $id == 0 ? '' : $id - 1 ?>,<?=$id == ($this->block('tab')->getCount() -1) ? '' : $id + 1;?>)"><?= $this->input("text");?>Informasi Keuangan Triwulan</a>
                </li>
                <li role="presentation" class="" id="div 2" style="width:<?= 100 / $this->block("tab")->getCount()?>%">
                    <a href="#2" id="href<?= $id;?>"  data-prev="<?= $id == 0 ? '' : $id - 1 ?>" data-next="<?=$id == ($this->block("tab")->getCount() -1) ? "" : $id + 1;?>" aria-controls="<?= $id?>" role="tab" data-toggle="tab" onclick="setPreviewId(<?= $id == 0 ? '' : $id - 1 ?>,<?=$id == ($this->block('tab')->getCount() -1) ? '' : $id + 1;?>)"><?= $this->input("text");?>Informasi Keuangan Semester</a>
                </li>
                <li role="presentation" class="" id="div 3" style="width:<?= 100 / $this->block("tab")->getCount()?>%">
                    <a href="#3" id="href<?= $id;?>"  data-prev="<?= $id == 0 ? '' : $id - 1 ?>" data-next="<?=$id == ($this->block("tab")->getCount() -1) ? "" : $id + 1;?>" aria-controls="<?= $id?>" role="tab" data-toggle="tab" onclick="setPreviewId(<?= $id == 0 ? '' : $id - 1 ?>,<?=$id == ($this->block('tab')->getCount() -1) ? '' : $id + 1;?>)"><?= $this->input("text");?>Informasi Keuangan Tahunan</a>
                </li>
                <li role="presentation" class="arrow" onclick="next()" id="nextButton">
                    <a class="arrow-outer"><i class="icon-right-arrow"></i>C</a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="1">
                <div class="container">
                  <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"> 
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              2019
                            </h4>
                          </div>
                      </a>
                      <div id="collapse1" class="panel-collapse collapse in">
                        <ul>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Januari 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Februari 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Maret 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"> 
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              2018
                            </h4>
                          </div>
                      </a>
                      <div id="collapse2" class="panel-collapse collapse">
                        <ul>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Januari 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Februari 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Maret 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                        </ul>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse3"> 
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              2017
                            </h4>
                          </div>
                      </a>
                      <div id="collapse3" class="panel-collapse collapse">
                        <ul>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Januari 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Februari 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                            <li style="display: flex; justify-content: space-between;">
                                <h6>Laporan Keuangan Maret 2019</h6>
                                <a href="">Unduh Dokumen</a>
                            </li>
                        </ul>
                      </div>
                    </div>
                  </div> 
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="2">
                ISIAN TAB 2
            </div>
            <div role="tabpanel" class="tab-pane" id="3">
                ISIAN TAB 3
            </div>
        </div>
    </div>
</div>