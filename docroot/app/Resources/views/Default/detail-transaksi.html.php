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
                <span>Kembali ke Halaman Sebelumnya</span>
            </button>
        </div>
    </div>

    <div class="container">
        <div class="title-wrapper">
            <h1>Detail Transaksi</h1>
            <p>Berikut ini detail transaksi Anda</p>
        </div>
    </div>

    <div id="tabel-transaksi">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Tanggal Jatuh Tempo</th>
                    <th scope="col">Angsuran per Bulan</th>
                    <th scope="col">Angsuran yang telah Dibayar</th>
                    <th scope="col">Tanggal Pembayaran</th>
                    <th scope="col">Denda Keterlambatan</th>
                    <th scope="col">Sisa Hutang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="installment_no"></td>
                    <td class="tanggal_jatuh_tempo"></td>
                    <td class="angsuran_per_bulan"></td>
                    <td class="angsuran_telah_dibayar"></td>
                    <td class="tanggal_pembayaran"></td>
                    <td class="denda_keterlambatan"></td>
                    <td class="sisa_angsuran"></td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>Total</td>
                    <td class="total_installment"></td>
                    <td></td>
                    <td></td>
                    <td class="total_late_charge"></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">
        <ul class="notes">
            <li>* Berikut denda dan biaya lainnya</li>
            <li>Silahkan hubungi cabang pencairan untuk pelunasan</li>
        </ul>
    </div>
</section>

<?php $this->headScript()->prependFile('/static/js/Includes/contract.js'); ?>
