<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\WebsiteSetting;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Assurance;
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

    public function getBranchBfi($postCode)
    {
        $value = null;
        $param = [];
        $param['post_code'] = $postCode;

        $url = WebsiteSetting::getByName('URL_GET_BRANCH')->getData();

        try {
            $data = $this->sendAPI->getPriceCar($url, $param);
        } catch (\Exception $e) {
            return $value;
        }

        if($data->code != "1"){
            return $value;
        }

        $value = $data->data;

        return $value;
    }

    public function getPriceAction(Request $request)
    {
        $data = $this->getBranchBfi((string)htmlentities($request->get('post_code')));
        $nameKota = $data[0]->branch;

        $param = [];
        $param['loan_type'] = (string)htmlentities($request->get('tipe'));
        $param['model'] = (string)htmlentities($request->get('model_kendaraan'));
        $param['branch'] = $nameKota;
        $param['brand_name'] = (string)htmlentities($request->get('merk_kendaraan'));
        $param['year'] = (string)htmlentities($request->get('tahun'));

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

        $dataApi = [];
        if($data->data[0]->price){
            $price = $data->data[0]->price;
        }else{
            $price = "0";
        }

        $dataApi['maxPrice'] = $price;
        if($price == "0"){
            $minPrice = "0";
        }else{
            if((string)$request->get('tipe') == "MOBIL"){
                $minPrice = "10000000";
            }else{
                $minPrice = "1000000";
            }
        }
        $dataApi['minPrice'] = $minPrice;

        $assurance = new Assurance\Listing();
        if ($assurance) {
            foreach ($assurance as $item) {
                $temp['name'] = $item->getName();
                $temp['code'] = $item->getCode();
                $dataApi['asuransi'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses",
            'data' => $dataApi
        ]);
    }

    public function sendLoanDataAction(Request $request)
    {
        $data = $this->getBranchBfi((string)htmlentities($request->get('post_code')));

        if($data == null){
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Branch Down"
            ]);
        }

        $nameKota = $data[0]->branch;
        $areaCode = $data[0]->area_code;

        $param = [];
        $param['branch'] = $nameKota;
        $param['area_code'] = $areaCode;
        $param['vehicleType'] = htmlentities($request->get('tipe'));
        $param['brandName'] = htmlentities($request->get('merk_kendaraan'));
        $param['model'] = htmlentities($request->get('model_kendaraan'));
        $param['year'] = htmlentities($request->get('tahun'));
        $param['funding'] = htmlentities($request->get('funding'));
        $param['tenor'] = htmlentities($request->get('tenor'));
        $param['asuransi'] = htmlentities($request->get('asuransi'));
        $param['taksasi'] = htmlentities($request->get('taksasi'));

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
        $param['CustomerName'] = htmlentities($request->get('nama_lengkap'));
        $param['EmailCustomer'] = htmlentities($request->get('email'));
        $param['CustomerAddress'] = htmlentities($request->get('alamat_lengkap'));
        $param['CustomerNumber1'] = htmlentities($request->get('no_handphone'));
        $param['CustomerNumber2'] = htmlentities($request->get('no_handphone'));
        $param['City'] = htmlentities($request->get('kota'));
        $param['Kelurahan'] = htmlentities($request->get('kelurahan'));
        $param['Kecamatan'] = htmlentities($request->get('kecamatan'));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOBIL";
        $param['VehicleType'] = htmlentities($request->get('model_kendaraan'));
        $param['Year'] = htmlentities($request->get('tahun_kendaraan'));
        $param['Funding'] = htmlentities($request->get('funding'));
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = htmlentities($request->get('merk_kendaraan'));
        $param['Tenor'] = htmlentities($request->get('jangka_waktu'));
        $param['Installment'] = htmlentities($request->get('installment'));

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
        $param['CustomerName'] = htmlentities($request->get('nama_lengkap'));
        $param['EmailCustomer'] = htmlentities($request->get('email'));
        $param['CustomerAddress'] = htmlentities($request->get('alamat_lengkap'));
        $param['CustomerNumber1'] = htmlentities($request->get('no_handphone'));
        $param['CustomerNumber2'] = htmlentities($request->get('no_handphone'));
        $param['City'] = htmlentities($request->get('kota'));
        $param['Kelurahan'] = htmlentities($request->get('kelurahan'));
        $param['Kecamatan'] = htmlentities($request->get('kecamatan'));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOTOR";
        $param['VehicleType'] = htmlentities($request->get('model_kendaraan'));
        $param['Year'] = htmlentities($request->get('tahun_kendaraan'));
        $param['Funding'] = htmlentities($request->get('funding'));
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = htmlentities($request->get('merk_kendaraan'));
        $param['Tenor'] = htmlentities($request->get('jangka_waktu'));
        $param['Installment'] = htmlentities($request->get('installment'));

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
        $param['CustomerName'] = htmlentities($request->get('nama_lengkap'));
        $param['EmailCustomer'] = htmlentities($request->get('email'));
        $param['CustomerAddress'] = htmlentities($request->get('alamat_lengkap'));
        $param['CustomerNumber1'] = htmlentities($request->get('no_handphone'));
        $param['CustomerNumber2'] = htmlentities($request->get('no_handphone'));
        $param['City'] = htmlentities($request->get('kota'));
        $param['Kelurahan'] = htmlentities($request->get('kelurahan'));
        $param['Kecamatan'] = htmlentities($request->get('kecamatan'));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();

        $param['SertificateStatus'] = htmlentities($request->get('status_sertificate'));
        $param['OwnerSertificate'] = htmlentities($request->get('own_sertificate'));
        $param['AddressSertificate'] = htmlentities($request->get('alamat_lengkap_sertificate'));
        $param['ProvinsiSertificate'] = htmlentities($request->get('provinsi_sertificate'));
        $param['KotaSertificate'] = htmlentities($request->get('kota_sertificate'));
        $param['KecamatanSertificate'] = htmlentities($request->get('kecamatan_sertificate'));
        $param['KelurahanSertificate'] = htmlentities($request->get('kelurahan_sertificate'));
        $param['KodeposSertificate'] = htmlentities($request->get('kode_pos_sertificate'));

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
        $nama_lengkap = htmlentities($request->get('nama_lengkap'));
        $handphone = htmlentities($request->get('no_handphone'));

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
        $code = htmlentities($request->get('otp1')). htmlentities($request->get('otp2')). htmlentities($request->get('otp3')). htmlentities($request->get('otp4'));
        $handphone = htmlentities($request->get('no_handphone'));

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
