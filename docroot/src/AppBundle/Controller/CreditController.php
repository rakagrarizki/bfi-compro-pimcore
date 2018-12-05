<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class CreditController extends FrontendController
{
    public function mobilAction(Request $request)
    {
        $nama = $request->get('nama_lengkap');
        $email = $request->get('email');
        $hp = $request->get('no_handphone');
        $province = $request->get('provinsi');
        $city = $request->get('kota');
        $kecamatan = $request->get('kecamatan');
        $kelurahan = $request->get('kelurahan');
        $poscode = $request->get('kode_pos');
        $address = $request->get('alamat_lengkap');
        $merk = $request->get('merk_kendaraan');
        $model = $request->get('model_kendaraan');
        $year = $request->get('tahun_kendaraan');
        $status = $request->get('status_kep');
        $funding = $request->get('funding');
        $term = $request->get('jangka_waktu');
        $installment = $request->get('installment');

    }

    public function motorAction(Request $request)
    {
        $nama = $request->get('nama_lengkap');
        $email = $request->get('email');
        $hp = $request->get('no_handphone');
        $province = $request->get('provinsi');
        $city = $request->get('kota');
        $kecamatan = $request->get('kecamatan');
        $kelurahan = $request->get('kelurahan');
        $poscode = $request->get('kode_pos');
        $address = $request->get('alamat_lengkap');
        $merk = $request->get('merk_kendaraan');
        $model = $request->get('model_kendaraan');
        $year = $request->get('tahun_kendaraan');
        $status = $request->get('status_kep');
        $funding = $request->get('funding');
        $term = $request->get('jangka_waktu');
        $installment = $request->get('installment');
    }

    public function rumahAction(Request $request)
    {
        $nama = $request->get('nama_lengkap');
        $email = $request->get('email');
        $hp = $request->get('no_handphone');
        $province = $request->get('provinsi');
        $city = $request->get('kota');
        $kecamatan = $request->get('kecamatan');
        $kelurahan = $request->get('kelurahan');
        $poscode = $request->get('kode_pos');
        $address = $request->get('alamat_lengkap');
        $statusSertificate = $request->get('status_sertificate');
        $ownSertificate = $request->get('own_sertificate');
        $provinceSertificate = $request->get('provinsi_sertificate');
        $kecamatanSertificate = $request->get('kecamatan_sertificate');
        $kelurahanSertificate = $request->get('kelurahan_sertificate');
        $addressSertificate = $request->get('alamat_lengkap_sertificate');
    }

}
