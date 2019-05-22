<?php
/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout-branch.html.php');
?>
<?= $this->areablock('areaBlock');?>

<div class="map-wrapper">
    <div id="map"></div>
    <div class="input-type-autocomplete">
        <div class="container">
            <div class="row">
                <div class="form-autocomplete">
                    <input type="text" id="searchTextField" class="form-autocomplete__input" placeholder="<?= $this->translate('placeholder-branch'); ?>">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <div id="branch" class="col-md-12 wrapper-parent-branchlist"></div>
                </div>
                <div class="container-map-arrowback">
                    
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://maps.google.com/maps/api/js?libraries=places,geometry&key=AIzaSyAd5-VfeP_L4EzX9HwrFsSP9ETaaAXEC3U&region=id&language=id&libraries=geometry,places&sensor=true"></script>