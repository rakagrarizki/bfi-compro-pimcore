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

    public function defaultAction(Request $request)
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

    public function getPriceAction(Request $request)
    {
        $param = [];
        $param['loan_type'] = $request->get('tipe');
        $param['model'] = $request->get('merk');
        $param['branch'] = $request->get('kota');
        $param['brand_name'] = $request->get('brand');
        $param['year'] = $request->get('tahun');

        $url = WebsiteSetting::getByName('URL_GET_PRICE')->getData();

        try {
            $data = $this->sendAPI->getPriceCar($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Price Down"
            ]);
        }

        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Price Down"
            ]);
        }

        $data = [];
        $data['maxPrice'] = $data->data->price;
        $data['minPrice'] = "10000000";
        $data['asuransi_1'] = "ALK";
        $data['asuransi_2'] = "TLO";

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses",
            'data' => $data
        ]);
    }

    public function sendLoanDataAction(Request $request)
    {

        $param = [];
        $param['branch'] = $request->get('city');
        $param['area_code'] = $request->get('area_code');
        $param['vehicleType'] = $request->get('tipe');
        $param['brandName'] = $request->get('brand');
        $param['model'] = $request->get('merk');
        $param['year'] = $request->get('tahun');
        $param['funding'] = $request->get('funding');
        $param['tenor'] = $request->get('tenor');
        $param['asuransi'] = $request->get('asuransi');
        $param['taksasi'] = $request->get('taksasi');

        $url = WebsiteSetting::getByName('URL_GET_LOAN')->getData();

        try {
            $data = $this->sendAPI->getLoan($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Send Loan Down"
            ]);
        }

        if($data->code != 1){
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses",
            'data' => $data->data
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
