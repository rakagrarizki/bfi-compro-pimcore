<?php

/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:15
 */
?>

<!-- template -->
<section id="pengajuan">
    <div class="container">
        <div class="submission-wrapper">
            <h4><?= $this->input('title'); ?></h4>
            <form action="" id="selection-form">
                <div class="selection-wrapper">
                    <div class="selection-1">
                        <select id="category-1"class="c-custom-select-home form-control formRequired">
                        </select>
                          <div id="spinner" class="d-flex align-items-center">
                            <div class="spinnericon" role="status" aria-hidden="true"></div>
                        </div>
                    </div>
                    <div class="selection-2">
                    <select id="category-2" class="c-custom-select-home form-control formRequired" name="category-2" disabled="disabled">
                        </select>
                    </div>
                </div>
                <button class="btn-next"><?= $this->translate('ajukan-sekarang'); ?><i class="fa fa-angle-right" type="submit"></i></button>
            </form>
        </div>
    </div>
</section>
<!-- template -->

