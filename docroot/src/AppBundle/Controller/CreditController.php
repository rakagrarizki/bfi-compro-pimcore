<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\WebsiteSetting;
use AppBundle\Service\SendApi;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class CreditController extends FrontendController
{
    protected $sendAPI;

    protected $randomNumber;

    public function __construct(SendApi $sendAPI)
    {
        $this->sendAPI = $sendAPI;
        $this->randomNumber = rand(000001,999999);
    }

    public function mobilAction(Request $request)
    {

    }

    public function motorAction(Request $request)
    {

    }

    public function rumahAction(Request $request)
    {

    }

    public function rukoAction(Request $request)
    {

    }

    public function sendDataSimulatorAction(Request $request)
    {
        $param = [];
        $param['Merk'] = $request->get('merk');
        $param['City'] = $request->get('kota');
        $param['Brand'] = $request->get('brand');
        $param['Year'] = $request->get('tahun');

        $data = [];
        $data['funding'] = "100.000.000";
        $data['installment'] = "12";
        $data['asuransi_1'] = "all_risk";
        $data['asuransi_2'] = "Total Lost";

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses",
            'data' => $data
        ]);
    }

    public function sendMobilAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d")."T".date("H:i:s");
        $param['CustomerName'] = $request->get('nama_lengkap');
        $param['EmailCustomer'] = $request->get('email');
        $param['CustomerAddress'] = $request->get('alamat_lengkap');
        $param['CustomerNumber1'] = $request->get('no_handphone');
        $param['CustomerNumber2'] = $request->get('no_handphone');
        $param['City'] = $request->get('kota');
        $param['Kelurahan'] = $request->get('kelurahan');
        $param['Kecamatan'] = $request->get('kecamatan');
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOBIL";
        $param['VehicleType'] = $request->get('model_kendaraan');
        $param['Year'] = $request->get('tahun_kendaraan');
        $param['Funding'] = $request->get('funding');
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = $request->get('merk_kendaraan');
        $param['Tenor'] = $request->get('jangka_waktu');
        $param['Installment'] = $request->get('installment');

        $url = WebsiteSetting::getByName('URL_CREDIT_MOBIL')->getData();

        try {
            $data = $this->sendAPI->sendDataCredit($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function sendMotorAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d")."T".date("H:i:s");
        $param['CustomerName'] = $request->get('nama_lengkap');
        $param['EmailCustomer'] = $request->get('email');
        $param['CustomerAddress'] = $request->get('alamat_lengkap');
        $param['CustomerNumber1'] = $request->get('no_handphone');
        $param['CustomerNumber2'] = $request->get('no_handphone');
        $param['City'] = $request->get('kota');
        $param['Kelurahan'] = $request->get('kelurahan');
        $param['Kecamatan'] = $request->get('kecamatan');
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOTOR";
        $param['VehicleType'] = $request->get('model_kendaraan');
        $param['Year'] = $request->get('tahun_kendaraan');
        $param['Funding'] = $request->get('funding');
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = $request->get('merk_kendaraan');
        $param['Tenor'] = $request->get('jangka_waktu');
        $param['Installment'] = $request->get('installment');

        $url = WebsiteSetting::getByName('URL_CREDIT_MOTOR')->getData();

        try {
            $data = $this->sendAPI->sendDataCredit($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function sendRumahAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d")."T".date("H:i:s");
        $param['CustomerName'] = $request->get('nama_lengkap');
        $param['EmailCustomer'] = $request->get('email');
        $param['CustomerAddress'] = $request->get('alamat_lengkap');
        $param['CustomerNumber1'] = $request->get('no_handphone');
        $param['CustomerNumber2'] = $request->get('no_handphone');
        $param['City'] = $request->get('kota');
        $param['Kelurahan'] = $request->get('kelurahan');
        $param['Kecamatan'] = $request->get('kecamatan');
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();

        $param['SertificateStatus'] = $request->get('status_sertificate');
        $param['OwnerSertificate'] = $request->get('own_sertificate');
        $param['AddressSertificate'] = $request->get('alamat_lengkap_sertificate');
        $param['ProvinsiSertificate'] = $request->get('provinsi_sertificate');
        $param['KotaSertificate'] = $request->get('kota_sertificate');
        $param['KecamatanSertificate'] = $request->get('kecamatan_sertificate');
        $param['KelurahanSertificate'] = $request->get('kelurahan_sertificate');
        $param['KodeposSertificate'] = $request->get('kode_pos_sertificate');

        $url = WebsiteSetting::getByName('URL_CREDIT_RUMAH')->getData();

        try {
            $data = $this->sendAPI->sendDataCredit($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function sendOtpRequestAction(Request $request)
    {
        $nama_lengkap = $request->get('nama_lengkap');
        $handphone = $request->get('no_handphone');

        try {
            $data = $this->sendAPI->requestOtp($handphone, $nama_lengkap);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        if($data->code == 1){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function sendOtpValidateAction(Request $request)
    {
        $code = $request->get('otp1'). $request->get('otp2'). $request->get('otp3'). $request->get('otp4');
        dump($code);
        exit;
        $handphone = $request->get('no_handphone');

        try {
           $data = $this->sendAPI->validateOtp($handphone, $code);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        if($data->code == 1){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }


}
