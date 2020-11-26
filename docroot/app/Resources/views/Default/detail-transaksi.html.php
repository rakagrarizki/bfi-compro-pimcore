<?php

/**
 * @var \Pimcore\Templating\PhpEngine $this
 * @var \Pimcore\Templating\PhpEngine $view
 * @var \Pimcore\Templating\GlobalVariables $app
 */

$this->extend('layout.html.php');
?>

<section id="detail-transaksi">
    <div id="button-back">
        <div class="container">
            <button onclick="window.history.back();">
                <i class="fa fa-angle-left"></i>
                <span><?= $this->translate('back') ?></span>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="title-wrapper">
            <h1><?= $this->translate('detail-transaksi') ?></h1>
            <p><?= $this->translate('detail-transaksi-sub') ?></p>
        </div>
    </div>

    <div id="tabel-transaksi">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col"><?= $this->translate('label-jatuh-tempo') ?></th>
                        <th scope="col"><?= $this->translate('installment') ?></th>
                        <th scope="col"><?= $this->translate('angsuran-dibayar') ?></th>
                        <th scope="col"><?= $this->translate('tgl-bayar') ?></th>
                        <th scope="col"><?= $this->translate('denda-terlambat') ?></th>
                        <th scope="col"><?= $this->translate('sisa-hutang') ?></th>
                    </tr>
                </thead>
                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <ul class="notes">
            <li>* <?= $this->translate('denda-lainya') ?></li>
            <li><?= $this->translate('keterangan-cabang-pencairan') ?></li>
        </ul>
    </div>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/contract.js'); ?>