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
        $data = $this->getBranchBfi((string)htmlentities(addslashes($request->get('post_code'))));
        $nameKota = $data[0]->branch;

        $param = [];
        $param['loan_type'] = (string)htmlentities(addslashes($request->get('tipe')));
        $param['model'] = (string)htmlentities(addslashes($request->get('model_kendaraan')));
        $param['branch'] = $nameKota;
        $param['brand_name'] = (string)htmlentities(addslashes($request->get('merk_kendaraan')));
        $param['year'] = (string)htmlentities(addslashes($request->get('tahun')));

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

        // $dataApi = [];
        // if($data->data[0]->price){
        //     $price = $data->data[0]->price;
        // }else{
        //     $price = "0";
        // }

        // $dataApi['maxPrice'] = $price;
        // if($price == "0"){
        //     $minPrice = "0";
        // }else{
        //     if((string)$request->get('tipe') == "MOBIL"){
        //         $minPrice = "10000000";
        //     }else{
        //         $minPrice = "1000000";
        //     }
        // }
        // $dataApi['minPrice'] = $minPrice;

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
            'data' => $data->data
        ]);
    }

    public function sendLoanDataAction(Request $request)
    {
        $data = $this->getBranchBfi((string)htmlentities(addslashes($request->get('post_code'))));

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
        $param['vehicleType'] = htmlentities(addslashes($request->get('tipe')));
        $param['brandName'] = htmlentities(addslashes($request->get('merk_kendaraan')));
        $param['model'] = htmlentities(addslashes($request->get('model_kendaraan')));
        $param['year'] = htmlentities(addslashes($request->get('tahun')));
        $param['funding'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));

        if($request->get('tipe') == "MOBIL"){
            $param['asuransi'] = htmlentities(addslashes($request->get('asuransi')));
            //$param['taksasi'] = htmlentities(addslashes($request->get('taksasi')));
        }
        $bpkb = htmlentities(addslashes($request->get('status_kep')));
        if($bpkb == "Milik Pribadi"){
            $param['bpkb'] = "true";
        } else{
            $param['bpkb'] = "false";
        }

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
        $param['CustomerName'] = htmlentities(addslashes($request->get('nama_lengkap')));
        $param['EmailCustomer'] = htmlentities(addslashes($request->get('email')));
        $param['CustomerAddress'] = htmlentities(addslashes($request->get('alamat_lengkap')));
        $param['CustomerNumber1'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['CustomerNumber2'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['City'] = htmlentities(addslashes($request->get('kota')));
        $param['Kelurahan'] = htmlentities(addslashes($request->get('kelurahan')));
        $param['Kecamatan'] = htmlentities(addslashes($request->get('kecamatan')));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOBIL";
        $param['VehicleType'] = htmlentities(addslashes($request->get('model_kendaraan')));
        $param['Year'] = htmlentities(addslashes($request->get('tahun_kendaraan')));
        $param['Funding'] = htmlentities(addslashes($request->get('funding')));
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = htmlentities(addslashes($request->get('merk_kendaraan')));
        $param['Tenor'] = htmlentities(addslashes($request->get('jangka_waktu')));
        $param['Installment'] = htmlentities(addslashes($request->get('installment')));

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
        $param['CustomerName'] = htmlentities(addslashes($request->get('nama_lengkap')));
        $param['EmailCustomer'] = htmlentities(addslashes($request->get('email')));
        $param['CustomerAddress'] = htmlentities(addslashes($request->get('alamat_lengkap')));
        $param['CustomerNumber1'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['CustomerNumber2'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['City'] = htmlentities(addslashes($request->get('kota')));
        $param['Kelurahan'] = htmlentities(addslashes($request->get('kelurahan')));
        $param['Kecamatan'] = htmlentities(addslashes($request->get('kecamatan')));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOTOR";
        $param['VehicleType'] = htmlentities(addslashes($request->get('model_kendaraan')));
        $param['Year'] = htmlentities(addslashes($request->get('tahun_kendaraan')));
        $param['Funding'] = htmlentities(addslashes($request->get('funding')));
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = htmlentities(addslashes($request->get('merk_kendaraan')));
        $param['Tenor'] = htmlentities(addslashes($request->get('jangka_waktu')));
        $param['Installment'] = htmlentities(addslashes($request->get('installment')));

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
        $param['CustomerName'] = htmlentities(addslashes($request->get('nama_lengkap')));
        $param['EmailCustomer'] = htmlentities(addslashes($request->get('email')));
        $param['CustomerAddress'] = htmlentities(addslashes($request->get('alamat_lengkap')));
        $param['CustomerNumber1'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['CustomerNumber2'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['City'] = htmlentities(addslashes($request->get('kota')));
        $param['Kelurahan'] = htmlentities(addslashes($request->get('kelurahan')));
        $param['Kecamatan'] = htmlentities(addslashes($request->get('kecamatan')));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI".date("Y").date("m").$this->randomNumber;
        $param['ListingID'] = $this->randomNumber;
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();

        $param['SertificateStatus'] = htmlentities(addslashes($request->get('status_sertificate')));
        $param['OwnerSertificate'] = htmlentities(addslashes($request->get('own_sertificate')));
        $param['AddressSertificate'] = htmlentities(addslashes($request->get('alamat_lengkap_sertificate')));
        $param['ProvinsiSertificate'] = htmlentities(addslashes($request->get('provinsi_sertificate')));
        $param['KotaSertificate'] = htmlentities(addslashes($request->get('kota_sertificate')));
        $param['KecamatanSertificate'] = htmlentities(addslashes($request->get('kecamatan_sertificate')));
        $param['KelurahanSertificate'] = htmlentities(addslashes($request->get('kelurahan_sertificate')));
        $param['KodeposSertificate'] = htmlentities(addslashes($request->get('kode_pos_sertificate')));

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
        //$nama_lengkap = htmlentities(addslashes($request->get('nama_lengkap')));
        $handphone = htmlentities(addslashes($request->get('phone_number')));
        $limitTime = WebsiteSetting::getByName('LIMIT_TIME')->getData();
        $limit = $limitTime * 3600;


        $redis = new \Credis_Client("localhost", 6379, null, '', 1);
        $dateSend = $redis->hGet($handphone, "time-send");
        $attempts = $redis->hGet($handphone, "attempt-hit");
        $timenow = time();
        /*$a = "attemp =".$attempts;

        return new JsonResponse([
            'success' => "0",
            'message' => $a
        ]);*/

        $clear = false;
        if($attempts){
            $diff = $timenow - $dateSend;
            if($diff >= 600){
                $send = true;
                $clear = true;
            }else{
                if($attempts < 3){
                    $send = true;
                }else{
                    $redis->setEx($handphone,$limit,"expiry");
                    $send = false;
                }
            }
        }else{
            $clear = true;
            $send = true;
        }

        if(!$send){
            return new JsonResponse([
                'success' => "0",
                'message' => "error multiple request otp",
            ]);
        }

        try {
            $data = $this->sendAPI->requestOtp($handphone);
            $redis->hSet($handphone, 'time-send', time());
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        if($clear){
            $redis->hSet($handphone, 'attempt-hit', 1);
        }else{
            $redis->hSet($handphone, 'attempt-hit', $attempts + 1);
        }



        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses"
        ]);

    }

    public function sendOtpValidateAction(Request $request)
    {
        $code = htmlentities(addslashes($request->get('otp1'))). htmlentities(addslashes($request->get('otp2'))). htmlentities(addslashes($request->get('otp3'))). htmlentities(addslashes($request->get('otp4')));
        $handphone = htmlentities(addslashes($request->get('phone_number')));

        try {
            $data = $this->sendAPI->validateOtp($handphone, $code);
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

    public function getTenorAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));

        $url = WebsiteSetting::getByName('URL_GET_TENOR')->getData();

        try {
            $data = $this->sendAPI->getTenor($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Tenor Down"
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }

    }

    public function getInsuranceAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $url = WebsiteSetting::getByName('URL_GET_INSURANCE')->getData();

        try {
            $data = $this->sendAPI->getInsurance($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Insurance Down"
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }

    }

    public function getProvinceAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_LIST_PROVINCE')->getData();

        try {
            $data = $this->sendAPI->getProvince($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCityAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_LIST_CITY')->getData();
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));

        try {
            $data = $this->sendAPI->getCity($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getDistrictAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_LIST_DISTRICT')->getData();
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));

        try {
            $data = $this->sendAPI->getDistrict($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getSubdistrictAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_LIST_SUBDISTRICT')->getData();
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));

        try {
            $data = $this->sendAPI->getSubdistrict($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getZipcodeAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_ZIPCODE')->getData();
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));

        try {
            $data = $this->sendAPI->getZipcode($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCarTypeAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_CAR')->getData();


        try {
            $data = $this->sendAPI->getCar($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCarBrandAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_CAR_BRAND')->getData();


        try {
            $data = $this->sendAPI->getCarBrand($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCarModelAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_CAR_MODEL')->getData();
        $param["type_id"] = htmlentities(addslashes($request->get('type_id')));
        $param["brand_id"] = htmlentities(addslashes($request->get('brand_id')));

        try {
            $data = $this->sendAPI->getCarModel($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCarYearAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_CAR_YEAR')->getData();
        $param["model_id"] = htmlentities(addslashes($request->get('model_id')));


        try {
            $data = $this->sendAPI->getCarYear($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCarFundingAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_CAR_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getCarFunding($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getCarCalculateAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_CAR_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = htmlentities(addslashes($request->get('tenor')));
        $param["insurance"] = htmlentities($request->get('insurance'));


        try {
            $data = $this->sendAPI->getCarCalculate($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveCarLeads1Action(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));


        try {
            $data = $this->sendAPI->saveCarLeads1($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveCarLeads2Action(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));


        try {
            $data = $this->sendAPI->saveCarLeads2($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveCarLeads3Action(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["car_type_id"] = htmlentities(addslashes($request->get('car_type_id')));
        $param["car_brand_id"] = htmlentities(addslashes($request->get('car_brand_id')));
        $param["car_model_id"] = htmlentities(addslashes($request->get('car_model_id')));
        $param["car_year_id"] = htmlentities(addslashes($request->get('car_year_id')));
        $param["bpkb_atas_nama"] = htmlentities(addslashes($request->get('bpkb_atas_nama')));



        try {
            $data = $this->sendAPI->saveCarLeads3($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveCarLeads4Action(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads4($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveCarLeads5Action(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads5($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveCarLeads6Action(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads6($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    // Motorcycle

    public function getMotorcycleTypeAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_MOTORCYCLE_TYPE')->getData();


        try {
            $data = $this->sendAPI->getMotorcycle($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getMotorcycleBrandAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_MOTORCYCLE_BRANDS')->getData();


        try {
            $data = $this->sendAPI->getMotorcycleBrand($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getMotorcycleModelAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_MOTORCYCLE_MODELS')->getData();
        $param["type_id"] = htmlentities(addslashes($request->get('type_id')));
        $param["brand_id"] = htmlentities(addslashes($request->get('brand_id')));

        try {
            $data = $this->sendAPI->getMotorcycleModel($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getMotorcycleYearAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_MOTORCYCLE_YEAR')->getData();
        $param["model_id"] = htmlentities(addslashes($request->get('model_id')));


        try {
            $data = $this->sendAPI->getMotorcycleYear($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getMotorcycleFundingAction(Request $request){

        $url = WebsiteSetting::getByName('URL_GET_MOTORCYCLE_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getMotorcycleFunding($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function getMotorcycleTenorAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));

        $url = WebsiteSetting::getByName('URL_GET_MOTORCYCLE_TENOR')->getData();

        try {
            $data = $this->sendAPI->getMotorcycleTenor($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Tenor Down"
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }

    }

    public function getMotorcycleCalculateAction(Request $request){

        $url = WebsiteSetting::getByName('URL_MOTORCYCLE_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getMotorcycleCalculate($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveMotorcycleLeads1Action(Request $request){

        $url = WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));


        try {
            $data = $this->sendAPI->saveMotorcycleLeads1($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveMotorcycleLeads2Action(Request $request){

        $url = WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));


        try {
            $data = $this->sendAPI->saveMotorcycleLeads2($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveMotorcycleLeads3Action(Request $request){

        $url = WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["motorcycle_type_id"] = htmlentities(addslashes($request->get('motorcycle_type_id')));
        $param["motorcycle_brand_id"] = htmlentities(addslashes($request->get('motorcycle_brand_id')));
        $param["motorcycle_model_id"] = htmlentities(addslashes($request->get('motorcycle_model_id')));
        $param["motorcycle_year_id"] = htmlentities(addslashes($request->get('motorcycle_year_id')));
        $param["bpkb_atas_nama"] = htmlentities(addslashes($request->get('bpkb_atas_nama')));



        try {
            $data = $this->sendAPI->saveMotorcycleLeads3($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveMotorcycleLeads4Action(Request $request){

        $url = WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads4($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveMotorcycleLeads5Action(Request $request){

        $url = WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads5($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function saveMotorcycleLeads6Action(Request $request){

        $url = WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads6($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }
}
