<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>
<?= $this->areablock('areaBlock');?>
<div class="map-wrapper">
    <div id="map"></div>
    <div class="input-type-autocomplete">
        <div class="container">
            <div class="row">
                <div class="form-autocomplete">
                    <input type="text" id="searchTextField" class="form-autocomplete__input" placeholder="Masukan kota/daerah dekat Anda">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <div class="col-md-12 wrapper-parent-branchlist">
                        <div class="parent-brachlist">
                            <div class="wrapper-branchlist">
                                <div class="col-md-2 branchlist"><img class="icon-gedung-branchlist" src="assets/images/gedung.png"></img></div>
                                <div class="col-md-8 branchlist">
                                    <p>BFI Cengkareng</p>
                                    <p>Sedayu Square Block C-2</p>
                                    <p>Jl. Outer Ringroad cengkareng</p>
                                    <p>PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></p>
                                </div>
                                <div class="col-md-2 branchlist"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="col-md-12 parent-brachlist">
                            <div class="wrapper-branchlist">
                                <div class="col-md-2 branchlist"><img class="icon-gedung-branchlist" src="assets/images/gedung.png"></img></div>
                                <div class="col-md-8 branchlist">
                                    <p>BFI Cengkareng</p>
                                    <p>Sedayu Square Block C-2</p>
                                    <p>Jl. Outer Ringroad cengkareng</p>
                                    <p>PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></p>
                                </div>
                                <div class="col-md-2 branchlist"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </div>
                        </div>
                        <div class="col-md-12 parent-brachlist">
                            <div class="wrapper-branchlist">
                                <div class="col-md-2 branchlist"><img class="icon-gedung-branchlist" src="assets/images/gedung.png"></img></div>
                                <div class="col-md-8 branchlist">
                                    <p>BFI Cengkareng</p>
                                    <p>Sedayu Square Block C-2</p>
                                    <p>Jl. Outer Ringroad cengkareng</p>
                                    <p>PETUNJUK ARAH <i class="fa fa-angle-right arrowlink" aria-hidden="true"></i></p>
                                </div>
                                <div class="col-md-2 branchlist"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>