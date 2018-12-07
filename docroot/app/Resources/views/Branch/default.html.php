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
                    <div id="branch" class="col-md-12 wrapper-parent-branchlist"></div>
                </div>
            </div>
        </div>
    </div>
</div>