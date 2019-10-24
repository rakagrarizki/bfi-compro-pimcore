<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\WebsiteSetting;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Assurance;
use AppBundle\Service\SendApi;
use AppBundle\Service\SendApiDummy;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class CreditController extends FrontendController
{
    protected $sendAPI;

    protected $randomNumber;

    public function __construct(SendApi $sendAPI, sendApiDummy $sendApiDummy)
    {
        $this->sendAPI = $sendAPI;
        //$this->sendAPI = $sendApiDummy;
        $this->randomNumber = rand(000001,999999);
//        if(ENV != "dev"){
//            $this->sendAPI = $sendAPI;
//            $this->randomNumber = rand(000001,999999);
//        } else {
//            $this->sendAPI = $sendApiDummy;
//            $this->randomNumber = rand(000001,999999);
//        }





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

    public function eduAction(Request $request)
    {

    }

    public function leisureAction(Request $request)
    {

    }

    public function mesinAction(Request $request)
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
                'message' => $this->get("translator")->trans("api-error")
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
                'message' => $this->get("translator")->trans("api-error")
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


        $url =  WebsiteSetting::getByName('URL_CREDIT_MOTOR')->getData();

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
                'message' => $this->get("translator")->trans("api-error")
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
                'message' => $this->get("translator")->trans("api-error")
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
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Credit Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($clear){
            $redis->hSet($handphone, 'attempt-hit', 1);
        }else{
            $redis->hSet($handphone, 'attempt-hit', $attempts + 1);
        }



        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses",
            'data' => $data->data
        ]);

    }

    public function sendOtpValidateAction(Request $request)
    {
        //$code = htmlentities(addslashes($request->get('otp1'))). htmlentities(addslashes($request->get('otp2'))). htmlentities(addslashes($request->get('otp3'))). htmlentities(addslashes($request->get('otp4')));
        $handphone = htmlentities(addslashes($request->get('phone_number')));
        $code = htmlentities(addslashes($request->get('otp_code')));

        try {
            $data = $this->sendAPI->validateOtp($handphone, $code);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getTenorAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));

         $url = HOST . WebsiteSetting::getByName('URL_GET_TENOR')->getData();

        try {
            $data = $this->sendAPI->getTenor($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Tenor Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }

    }

    public function getInsuranceAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));
        $param['tenor'] = (int)htmlentities(addslashes($request->get('tenor')));
         $url = HOST . WebsiteSetting::getByName('URL_GET_INSURANCE')->getData();

        try {
            $data = $this->sendAPI->getInsurance($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Insurance Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }

    }

    public function getProvinceAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_PROVINCE')->getData();

        try {
            $data = $this->sendAPI->getProvince($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Province Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }
        //sdump($data->header->status);exit;
        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCityAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_CITY')->getData();
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));

        try {
            $data = $this->sendAPI->getCity($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request City Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getDistrictAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_DISTRICT')->getData();
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));

        try {
            $data = $this->sendAPI->getDistrict($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request District Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getSubdistrictAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_SUBDISTRICT')->getData();
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));

        try {
            $data = $this->sendAPI->getSubdistrict($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request SubDistrict Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getZipcodeAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_ZIPCODE')->getData();
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));

        try {
            $data = $this->sendAPI->getZipcode($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Zipcode Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarTypeAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_CAR')->getData();


        try {
            $data = $this->sendAPI->getCar($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Car Type Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarBrandAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_CAR_BRAND')->getData();


        try {
            $data = $this->sendAPI->getCarBrand($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Car Brand Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarModelAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_CAR_MODEL')->getData();
        $param["type_id"] = htmlentities(addslashes($request->get('type_id')));
        $param["brand_id"] = htmlentities(addslashes($request->get('brand_id')));

        try {
            $data = $this->sendAPI->getCarModel($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Car Model Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            if($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses",
                    'data' => $data->data
                ]);
            } else {
//                return new JsonResponse([
//                    'success' => "0",
//                    'message' => $this->get("translator")->trans("api-error")
//                ]);
            }

        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarYearAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_CAR_YEAR')->getData();
        $param["model_id"] = htmlentities(addslashes($request->get('model_id')));


        try {
            $data = $this->sendAPI->getCarYear($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Car Year Down"
//            ]);
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarFundingAction(Request $request){

         $host = WebsiteSetting::getByName("HOST")->getData();
         $url = HOST . $host . WebsiteSetting::getByName('URL_GET_CAR_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getCarFunding($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Car Funding Down"
//            ]);
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarCalculateAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_CAR_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int)htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));
        $insurance = htmlentities($request->get('insurance'));
        //$ins = "F8D301F8-7045-4DA9-9EB8-EC8DE6E92855, F8D301F8-7045-4DA9-9EB8-EC8DE6E9285, F8D301F8-7045-4DA9-9EB8-EC8DE6E92855";
        $insurance_arr = explode(",",$insurance);

        $param["insurance"]= $insurance_arr;


        try {
            $data = $this->sendAPI->getCarCalculate($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => $e->getMessage()
//            ]);
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads1Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));


        try {
            $data = $this->sendAPI->saveCarLeads1($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car Leads 1 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads2Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_2')->getData();
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
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save car Leads 2 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads3Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["car_type_id"] = htmlentities(addslashes($request->get('car_type_id')));
        $param["car_brand_id"] = htmlentities(addslashes($request->get('car_brand_id')));
        $param["car_model_id"] = htmlentities(addslashes($request->get('car_model_id')));
        $param["car_year_id"] = htmlentities(addslashes($request->get('car_year_id')));
        $param["bpkb_atas_nama"] = htmlentities(addslashes($request->get('bpkb_atas_nama')));



        try {
            $data = $this->sendAPI->saveCarLeads3($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car Leads 3 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads4Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads4($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car leads 4 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads5Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads5($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car Leads 5 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads6Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads6($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car leads 6 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    // Motorcycle

    public function getMotorcycleTypeAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_TYPE')->getData();


        try {
            $data = $this->sendAPI->getMotorcycle($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Motorcycle Type Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleBrandAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_BRANDS')->getData();


        try {
            $data = $this->sendAPI->getMotorcycleBrand($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Motorcycle Brand Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleModelAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_MODELS')->getData();
        $param["type_id"] = htmlentities(addslashes($request->get('type_id')));
        $param["brand_id"] = htmlentities(addslashes($request->get('brand_id')));

        try {
            $data = $this->sendAPI->getMotorcycleModel($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Motorcycle Model Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            if($data->data != []){
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }

        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleYearAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_YEAR')->getData();
        $param["model_id"] = htmlentities(addslashes($request->get('model_id')));


        try {
            $data = $this->sendAPI->getMotorcycleYear($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Motorcycle Year Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleFundingAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getMotorcycleFunding($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Motorcycle Funding Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleTenorAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));

         $url = HOST . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_TENOR')->getData();

        try {
            $data = $this->sendAPI->getMotorcycleTenor($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Tenor Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }

    }

    public function getMotorcycleCalculateAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_MOTORCYCLE_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int)htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getMotorcycleCalculate($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Motorcycle Calculate Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads1Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));


        try {
            $data = $this->sendAPI->saveMotorcycleLeads1($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Motorcycle Leads 1 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads2Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_2')->getData();
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
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Motorcycle Leads 2 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads3Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["motorcycle_type_id"] = htmlentities(addslashes($request->get('motorcycle_type_id')));
        $param["motorcycle_brand_id"] = htmlentities(addslashes($request->get('motorcycle_brand_id')));
        $param["motorcycle_model_id"] = htmlentities(addslashes($request->get('motorcycle_model_id')));
        $param["motorcycle_year_id"] = htmlentities(addslashes($request->get('motorcycle_year_id')));
        $param["bpkb_atas_nama"] = htmlentities(addslashes($request->get('bpkb_atas_nama')));



        try {
            $data = $this->sendAPI->saveMotorcycleLeads3($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Motorcycle Leads 3 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads4Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads4($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Save Motorcycle Leads 4 Request Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads5Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads5($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Motorcycle Leads 5 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads6Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads6($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Motorcycle Leads 6 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    // PBF

    public function getPbfProfessionAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_PROFESSION')->getData();


        try {
            $data = $this->sendAPI->getProfession($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request PBF Profession Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfCertificateTypeAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_PBF_CERTIFICATE_TYPE')->getData();


        try {
            $data = $this->sendAPI->getPbfCertificateType($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Pbf Certificate Type Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfCertificateOnBehalfAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_PBF_CERTIFICATE_ON_BEHALF')->getData();


        try {
            $data = $this->sendAPI->getPbfCertificateOnBehalf($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request PBF Certificate on Behalf Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getPbfPropertyTypeAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LIST_PBF_PROPERTY_TYPE')->getData();


        try {
            $data = $this->sendAPI->getPbfPropertyType($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Pbf Property type Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }



    public function getPbfFundingAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_PBF_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["estimasi_harga"] = (int)htmlentities(addslashes($request->get('estimasi_harga')));


        try {
            $data = $this->sendAPI->getPbfFunding($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Pbf Funding Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfTenorAction(Request $request)
    {
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));

         $url = HOST . WebsiteSetting::getByName('URL_GET_PBF_TENOR_LIST')->getData();

        try {
            $data = $this->sendAPI->getPbfTenor($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Tenor Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }

    }

    public function getPbfCalculateAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_PBF_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int)htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getPbfCalculate($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Pbf Calculate Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function savePbfLeads1Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["dob"] = htmlentities(addslashes($request->get('dob')));
        $param["profession_id"] = htmlentities(addslashes($request->get('profession_id')));
        $param["salary"] = htmlentities(addslashes($request->get('salary')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));
        $param["path_ktp"] =htmlentities(addslashes($request->get('path_ktp')));


        try {
            $data = $this->sendAPI->savePbfLeads1($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Pbf Leads 1 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function savePbfLeads2Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));


        try {
            $data = $this->sendAPI->savePbfLeads2($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Pbf Leads 2 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function savePbfLeads3Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));
        $param["certificate_type_id"] = htmlentities(addslashes($request->get('certificate_type_id')));
        $param["certificate_on_behalf_id"] = htmlentities(addslashes($request->get('certificate_on_behalf_id')));
        $param["property_type_id"] = htmlentities(addslashes($request->get('property_type_id')));
        $param["is_dihuni"] = htmlentities(addslashes($request->get('is_dihuni')));




        try {
            $data = $this->sendAPI->savePbfLeads3($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Pbf Leads 3 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function savePbfLeads4Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->savePbfLeads4($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Pbf Leads 4 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function savePbfLeads5Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->savePbfLeads5($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Pbf Leads 5 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function savePbfLeads6Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["is_news_letter"] = htmlentities(addslashes($request->get('is_news_letter')));

        try {
            $data = $this->sendAPI->savePbfLeads6($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Pbf Leads 6 Down"
//            ]);
            throw new \Exception('Something went wrong!');

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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getLeisurePackageAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LEISURE_PACKAGE')->getData();


        try {
            $data = $this->sendAPI->getLeisurePackage($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Leisure Package Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getLeisureTenorAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_LEISURE_TENOR_LIST')->getData();


        try {
            $data = $this->sendAPI->getLeisureTenor($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Tenor Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getLeisureProvisionPackageAction(Request $request){

        $url = HOST . WebsiteSetting::getByName('url_GET_LEISURE_PROVISION_PACKAGE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["leisure_package_price"] = (int)htmlentities(addslashes($request->get('leisure_package_price')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getLeisureProvisionPackage($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Leisure Calculator Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function leisureCalculatorAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_LEISURE_CALCULATOR')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["leisure_package_price"] = (int)htmlentities(addslashes($request->get('leisure_package_price')));
        $param["down_payment"] = (int)htmlentities(addslashes($request->get('down_payment')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));
        $param["pocket_money"] = (int)htmlentities(addslashes($request->get('pocket_money')));

        try {
            $data = $this->sendAPI->leisureCalculator($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Leisure Calculator Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads1Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));
        $param["path_ktp"]= htmlentities(addslashes($request->get('path_ktp')));


        try {
            $data = $this->sendAPI->saveLeisureLeads1($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Leisure Leads 1 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads2Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));


        try {
            $data = $this->sendAPI->saveLeisureLeads2($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Leisure Leads 2 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads3Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_3')->getData();
            $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveLeisureLeads3($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Leisure Leads 3 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads4Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveLeisureLeads4($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Leisure Leads 4 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads5Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveLeisureLeads5($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Leisure Leads 5 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getEduPackageAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_EDU_PACKAGE')->getData();


        try {
            $data = $this->sendAPI->getEduPackage($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Edu Package Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getEduTenorAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_EDU_TENOR_LIST')->getData();


        try {
            $data = $this->sendAPI->getEduTenor($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Tenor Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function eduProvisionPackageAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_EDU_PROVISION_PACKAGE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["edu_package_price"] = (int)htmlentities(addslashes($request->get('edu_package_price')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getEduProvisionPackage($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Edu Provision Package Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function eduCalculatorAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_EDU_CALCULATOR')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["edu_package_price"] = (int)htmlentities(addslashes($request->get('edu_package_price')));
        $param["down_payment"] = (int)htmlentities(addslashes($request->get('down_payment')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->eduCalculator($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Edu calculator Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads1Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));
        $param["path_ktp"] =htmlentities(addslashes($request->get('path_ktp')));


        try {
            $data = $this->sendAPI->saveEduLeads1($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Edu Leads 1 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads2Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));


        try {
            $data = $this->sendAPI->saveEduLeads2($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Edu Leads 2 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads3Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveEduLeads3($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Edu Leads 3 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads4Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveEduLeads4($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Edu Leads 4 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads5Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveEduLeads5($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Edu Leads 5 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryServicesAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_SERVICES')->getData();


        try {
            $data = $this->sendAPI->getMachineryServices($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Services Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryIndustryAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_INDUSTRY')->getData();


        try {
            $data = $this->sendAPI->getMachineryIndustry($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Industry Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryTypeAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_TYPE')->getData();


        try {
            $data = $this->sendAPI->getMachineryType($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Type Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryBrandAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_BRAND')->getData();


        try {
            $data = $this->sendAPI->getMachineryBrand($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Brand Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryModelAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_MODEL')->getData();
        $param["machinery_brand_id"] = htmlentities(addslashes($request->get('machinery_brand_id')));
        $param["machinery_type_id"] = htmlentities(addslashes($request->get('machinery_type_id')));

        try {
            $data = $this->sendAPI->getMachineryModel($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Model Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            if($data->data != []){
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses",
                    'data' => $data->data
                ]);
            }else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }

        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryYearAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_YEAR')->getData();
        $param["machinery_model_id"] = htmlentities(addslashes($request->get('machinery_model_id')));


        try {
            $data = $this->sendAPI->getMachineryYear($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Year Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            if($data->data != []){
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses",
                    'data' => $data->data
                ]);
            }else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }

        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryFundingAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getMachineryFunding($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Year Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            if($data->data != []){
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses",
                    'data' => $data->data
                ]);
            }else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }

        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryTenorAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_GET_MACHINERY_TENOR_LIST')->getData();


        try {
            $data = $this->sendAPI->getMachineryTenor($url);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Tenor Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryCalculateAction(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_MACHINERY_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int)htmlentities(addslashes($request->get('funding')));
        $param["down_payment"] = (int)htmlentities(addslashes($request->get('down_payment')));
        $param["tenor"] = (int)htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->machineryCalculate($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Machinery Calculate Down"
//            ]);
            throw new \Exception('Something went wrong!');
        }

        if($data->header->status == 200){
            if($data->data != []){
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses",
                    'data' => $data->data
                ]);
            }else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }

        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads1Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] =htmlentities(addslashes($request->get('phone_number')));


        try {
            $data = $this->sendAPI->saveCarLeads1($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car Leads 1 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads2Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["address"] = htmlentities(addslashes($request->get('address')));


        try {
            $data = $this->sendAPI->saveMachineryLeads2($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save car Leads 2 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads3Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["machinery_service_id"] = htmlentities(addslashes($request->get('machinery_service_id')));
        $param["machinery_industry_id"] = htmlentities(addslashes($request->get('machinery_industry_id')));
        $param["machinery_type_id"] = htmlentities(addslashes($request->get('machinery_type_id')));
        $param["machinery_brand_id"] = htmlentities(addslashes($request->get('machinery_brand_id')));
        $param["machinery_model_id"] = htmlentities(addslashes($request->get('machinery_model_id')));
        $param["machinery_year_id"] = htmlentities(addslashes($request->get('machinery_year_id')));
        $param["machinery_total"] = (int)htmlentities(addslashes($request->get('machinery_total')));
        $param["estimated_price"] = (int)htmlentities(addslashes($request->get('estimated_price')));



        try {
            $data = $this->sendAPI->saveMachineryLeads3($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Machinery Leads 3 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads4Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMachineryLeads4($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car leads 4 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads5Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMachineryLeads5($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Car Leads 5 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads6Action(Request $request){

         $url = HOST . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMachineryLeads6($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Machinery leads 6 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }


    public function getListProductCategoryAction(Request $request){

        $url = HOST . WebsiteSetting::getByName('URL_GET_PRODUCT_CATEGORY')->getData();

        try {
            $data = $this->sendAPI->getProductCategory($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Product Category Down"
            ]);
            //throw new \Exception('Something went wrong!');
        }
        //sdump($data->header->status);exit;
        if($data->header->status == 200){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        }else{
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListProductAction(Request $request){

        $url = HOST . WebsiteSetting::getByName('URL_GET_PRODUCT')->getData();
        $param["category_id"] = htmlentities(addslashes($request->get('category_id')));

        try {
            $data = $this->sendAPI->getProduct($url, $param);
        } catch (\Exception $e) {
//            return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Save Machinery leads 6 Down"
//            ]);
            throw new \Exception('Something went wrong!');
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
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }


}
