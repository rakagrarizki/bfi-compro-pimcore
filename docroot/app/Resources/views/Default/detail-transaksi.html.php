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
                    <td>1</td>
                    <td>05/03/2018</td>
                    <td>3,343,500.00</td>
                    <td>3,343,500.00</td>
                    <td>06/03/2018</td>
                    <td>0.00</td>
                    <td>36,778,500.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>05/03/2018</td>
                    <td>3,343,500.00</td>
                    <td>3,343,500.00</td>
                    <td>06/03/2018</td>
                    <td>0.00</td>
                    <td>36,778,500.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>05/03/2018</td>
                    <td>3,343,500.00</td>
                    <td>3,343,500.00</td>
                    <td>06/03/2018</td>
                    <td>0.00</td>
                    <td>36,778,500.00</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>05/03/2018</td>
                    <td>3,343,500.00</td>
                    <td>3,343,500.00</td>
                    <td>06/03/2018</td>
                    <td>0.00</td>
                    <td>36,778,500.00</td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td>Total</td>
                    <td>40,122,000.00</td>
                    <td>0</td>
                    <td></td>
                    <td>4,122,000.00</td>
                    <td>0</td>
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