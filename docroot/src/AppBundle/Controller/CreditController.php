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
    private $redis;
    private $isDev;

    public function __construct(SendApi $sendAPI, sendApiDummy $sendApiDummy)
    {
        $this->sendAPI = $sendAPI;
        $this->randomNumber = rand(000001, 999999);
        $this->redis = new \Credis_Client(REDIS, 6379, null, '', 1, PASSREDIS);
        $this->isDev = ENV === 'dev';
    }

    public function getToken()
    {
        $token = $this->get('session')->get('token');
        return $token;
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

    public function failedAction(Request $request)
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

        if ($data->code != "1") {
            return $value;
        }

        $value = $data->data;

        return $value;
    }

    public function getPriceAction(Request $request)
    {
        $data = $this->getBranchBfi((string) htmlentities(addslashes($request->get('post_code'))));
        $nameKota = $data[0]->branch;

        $param = [];
        $param['loan_type'] = (string) htmlentities(addslashes($request->get('tipe')));
        $param['model'] = (string) htmlentities(addslashes($request->get('model_kendaraan')));
        $param['branch'] = $nameKota;
        $param['brand_name'] = (string) htmlentities(addslashes($request->get('merk_kendaraan')));
        $param['year'] = (string) htmlentities(addslashes($request->get('tahun')));

        $url = WebsiteSetting::getByName('URL_GET_PRICE')->getData();

        try {
            $data = $this->sendAPI->getPriceCar($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Price Down"
            ]);
        }

        if ($data->header->status != 200) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Price Down"
            ]);
        }

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
            'message' => "success",
            'data' => $data->data
        ]);
    }

    public function sendLoanDataAction(Request $request)
    {
        $data = $this->getBranchBfi((string) htmlentities(addslashes($request->get('post_code'))));

        if ($data == null) {
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

        if ($request->get('tipe') == "MOBIL") {
            $param['asuransi'] = htmlentities(addslashes($request->get('asuransi')));
        }
        $bpkb = htmlentities(addslashes($request->get('status_kep')));
        if ($bpkb == "Milik Pribadi") {
            $param['bpkb'] = "true";
        } else {
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

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function sendMobilAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d") . "T" . date("H:i:s");
        $param['CustomerName'] = htmlentities(addslashes($request->get('nama_lengkap')));
        $param['EmailCustomer'] = htmlentities(addslashes($request->get('email')));
        $param['CustomerAddress'] = htmlentities(addslashes($request->get('alamat_lengkap')));
        $param['CustomerNumber1'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['CustomerNumber2'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['City'] = htmlentities(addslashes($request->get('kota')));
        $param['Kelurahan'] = htmlentities(addslashes($request->get('kelurahan')));
        $param['Kecamatan'] = htmlentities(addslashes($request->get('kecamatan')));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI" . date("Y") . date("m") . $this->randomNumber;
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

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success"
            ]);
        } else {
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
        $param['Datetime'] = date("Y-M-d") . "T" . date("H:i:s");
        $param['CustomerName'] = htmlentities(addslashes($request->get('nama_lengkap')));
        $param['EmailCustomer'] = htmlentities(addslashes($request->get('email')));
        $param['CustomerAddress'] = htmlentities(addslashes($request->get('alamat_lengkap')));
        $param['CustomerNumber1'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['CustomerNumber2'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['City'] = htmlentities(addslashes($request->get('kota')));
        $param['Kelurahan'] = htmlentities(addslashes($request->get('kelurahan')));
        $param['Kecamatan'] = htmlentities(addslashes($request->get('kecamatan')));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI" . date("Y") . date("m") . $this->randomNumber;
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

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success"
            ]);
        } else {
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
        $param['Datetime'] = date("Y-M-d") . "T" . date("H:i:s");
        $param['CustomerName'] = htmlentities(addslashes($request->get('nama_lengkap')));
        $param['EmailCustomer'] = htmlentities(addslashes($request->get('email')));
        $param['CustomerAddress'] = htmlentities(addslashes($request->get('alamat_lengkap')));
        $param['CustomerNumber1'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['CustomerNumber2'] = htmlentities(addslashes($request->get('no_handphone')));
        $param['City'] = htmlentities(addslashes($request->get('kota')));
        $param['Kelurahan'] = htmlentities(addslashes($request->get('kelurahan')));
        $param['Kecamatan'] = htmlentities(addslashes($request->get('kecamatan')));
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "WEBBFI" . date("Y") . date("m") . $this->randomNumber;
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

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success"
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function sendOtpRequestAction(Request $request)
    {
        $handphone = htmlentities(addslashes($request->get('phone_number')));
        $limitTime = WebsiteSetting::getByName('LIMIT_TIME')->getData();
        $limit = $limitTime * 3600;
        
        $expireTime = $this->redis->ttl($handphone);
        if($expireTime === false || $expireTime === -2 ){
            $dateSend = $this->redis->hGet($handphone, "time-send");
            $attempts = $this->redis->hGet($handphone, "attempt-hit");
            $timenow = time();
            $clear = false;
            if($attempts && $attempts <= 25){
                $diff = $timenow - $dateSend;
                if($diff >= 80){
                    if($attempts < 25){
                        $send = true;
                    }else{
                        $this->redis->setEx($handphone, $limit, "expiry");
                        $send = false;
                    }
                } else {
                    $send = false;
                }
            }else {
                $clear = true;
                $send = true;
            }
        } else {
            return new JsonResponse([
                'success' => '0',
                'message' => 'Your reached limit, please contact the administrator',
            ]);
        }

        if (!$send) {
            return new JsonResponse([
                'success' => "0",
                'message' => "error multiple request otp",
            ]);
        }

        try {
            $data = $this->sendAPI->requestOtp($handphone);
            $this->redis->hSet($handphone, 'time-send', time());
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                ] + ($this->isDev ? ['code_otp' => $data->data->opt_code] : [])
                );
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }

        if ($clear) {
            $this->redis->hSet($handphone, 'attempt-hit', 1);
        } else {
            $this->redis->hSet($handphone, 'attempt-hit', $attempts + 1);
        }
    }

    public function sendOtpValidateAction(Request $request)
    {
        $handphone = htmlentities(addslashes($request->get('phone_number')));
        $code = htmlentities(addslashes($request->get('otp_code')));

        try {
            $data = $this->sendAPI->validateOtp($handphone, $code);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success"
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function getTenorAction(Request $request)
    {
        $param['submission_id'] = (string) htmlentities(addslashes($request->get('submission_id')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_TENOR')->getData();

        try {
            $data = $this->sendAPI->getTenor($url, $param);
            if ($data->header->status == 200) { 
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }

        
    }

    public function getInsuranceAction(Request $request)
    {
        $param['submission_id'] = (string) htmlentities(addslashes($request->get('submission_id')));
        $param['tenor'] = (int) htmlentities(addslashes($request->get('tenor')));

        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_INSURANCE')->getData();

        try {
            $data = $this->sendAPI->getInsurance($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function getProvinceAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PROVINCE')->getData();

        try {
            $data = $this->sendAPI->getProvince($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }
        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCityAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_CITY')->getData();
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));

        try {
            $data = $this->sendAPI->getCity($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getDistrictAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_DISTRICT')->getData();
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));

        try {
            $data = $this->sendAPI->getDistrict($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getSubdistrictAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_SUBDISTRICT')->getData();
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));

        try {
            $data = $this->sendAPI->getSubdistrict($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getZipcodeAction(Request $request)
    {

        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_ZIPCODE')->getData();
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));

        try {
            $data = $this->sendAPI->getZipcode($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarTypeAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_CAR')->getData();

        try {
            $data = $this->sendAPI->getCar($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarBrandAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_CAR_BRAND')->getData();

        try {
            $data = $this->sendAPI->getCarBrand($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarModelAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_CAR_MODEL')->getData();
        $param["type_id"] = htmlentities(addslashes($request->get('type_id')));
        $param["brand_id"] = htmlentities(addslashes($request->get('brand_id')));

        try {
            $data = $this->sendAPI->getCarModel($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarYearAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_CAR_YEAR')->getData();
        $param["model_id"] = htmlentities(addslashes($request->get('model_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));

        try {
            $data = $this->sendAPI->getCarYear($url, $param);
        } catch (\Exception $e) {
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarFundingAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_CAR_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getCarFunding($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getCarCalculateAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_CAR_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int) htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));
        $insurance = htmlentities($request->get('insurance'));
        $insurance_arr = explode(",", $insurance);
        $param["insurance"] = $insurance_arr;

        try {
            $data = $this->sendAPI->getCarCalculate($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    // new api 

    public function getGatewayTokenAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_AUTH_BASIC_TOKEN')->getData();
        $author = htmlentities(addslashes($request->get('author')));

        try {
            $data = $this->sendAPI->getGatewayToken($url, $author);
            if ($data->header->status == 200) {
                $this->get('session')->set('tokenBearer', $data->data->access_token);
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
             return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
        
    }

    public function getListProvinceAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_DATALIST_PROVINCE')->getData();

        try {
            $data = $this->sendAPI->getListProvince($url, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }
    }

    public function getListCityAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_DATALIST_CITY')->getData();
        $param['query'] = "provinsi=" . rawurlencode($request->get('province'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getListCity($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListDistrictAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_DATALIST_DISTRICT')->getData();
        $param['query'] = "provinsi=" . rawurlencode($request->get('province'));
        $param['query'] .= "&city=" . rawurlencode($request->get('city'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getListDistrict($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListSubdistrictAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_DATALIST_SUBDISTRICT')->getData();
        $param['query'] = "provinsi=" . rawurlencode($request->get('province'));
        $param['query'] .= "&city=" . rawurlencode($request->get('city'));
        $param['query'] .= "&kecamatan=" . rawurlencode($request->get('district'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getListSubdistrict($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListZipcodeAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_DATALIST_ZIPCODE')->getData();
        $param['query'] .= "city=" . rawurlencode($request->get('city'));
        $param['query'] .= "&kecamatan=" . rawurlencode($request->get('district'));
        $param['query'] .= "&kelurahan=" . rawurlencode($request->get('subdistrict'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getListZipcode($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListAssetsAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_DATALIST_ASSETS')->getData();
        $param['query'] = "isactive=true";
        $param['query'] .= "&asset_type=" . rawurlencode($request->get('asset_type'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getListAssets($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data,
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListBpkbOwnershipAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_DATALIST_BPKB_OWNERSHIP')->getData();

        try {
            $data = $this->sendAPI->getListBpkbOwnership($url, $token);
            
            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListHouseOwnershipAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_DATALIST_HOUSE_OWNERSHIP')->getData();

        try {
            $data = $this->sendAPI->getListHouseOwnership($url, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getListHouseOwnershipAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_DATALIST_HOUSE_OWNERSHIP')->getData();

        try {
            $data = $this->sendAPI->getListHouseOwnership($url, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getBranchCoverageAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_BRANCH_COVERAGE')->getData();
        $param['query'] = "kelurahan=" . rawurlencode($request->get('kelurahan'));
        $param['query'] .= "&kecamatan=" . rawurlencode($request->get('kecamatan'));
        $param['query'] .= "&city=" . rawurlencode($request->get('city'));
        $param['query'] .= "&zip_code=" . rawurlencode($request->get('zip_code'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getBranchCoverage($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getAssetYearAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_ASSET_YEAR')->getData();
        $param['query'] = "asset_code=" . rawurlencode($request->get('asset_code'));
        $param['query'] .= "&branch_id=" . rawurlencode($request->get('branch_id'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getAssetYear($url, $param, $token);

            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getDuplicateLeadsAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = 'https://gateway-dev.bfi.co.id';
        $param['path'] = WebsiteSetting::getByName('URL_GET_DUPLICATE_LEADS')->getData();
        $param['query'] = "mobile_phone=" . rawurlencode($request->get('mobile_phone'));
        $param['query'] .= "&product_category=" . rawurlencode($request->get('product_category'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getDuplicateLeads($url, $param, $token);
            var_dump($data);
            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    public function getTokenBearer()
    {
        $tokenBearer = $this->get('session')->get('tokenBearer');
        return $tokenBearer;
    }

    public function getDuplicateLeadsAction(Request $request)
    {
        $token = $this->getTokenBearer();
        $host = WebsiteSetting::getByName("HOSTGATEWAY")->getData();
        $param['path'] = WebsiteSetting::getByName('URL_GET_DUPLICATE_LEADS')->getData();
        $param['query'] = "is_prospect=" . rawurlencode($request->get('is_prospect'));
        $param['query'] .= "&lead_program_id=" . rawurlencode($request->get('lead_program_id'));
        $param['query'] .= "&data_type_2=" . rawurlencode($request->get('data_type_2'));
        $param['query'] .= "&customer_type=" . rawurlencode($request->get('customer_type'));
        $param['query'] .= "&license_plate=" . rawurlencode($request->get('license_plate'));
        $param['query'] .= "&mobile_phone_1=" . rawurlencode($request->get('mobile_phone_1'));
        $url = $host . $param['path'] . "?" . $param['query'];

        try {
            $data = $this->sendAPI->getDuplicateLeads($url, $param, $token);
            if (empty($data->error)) {
                return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $data->data,
            ]);
            } else {
                return new JsonResponse([
                'success' => 0,
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }
    }

    // end of new api

    public function saveCarLeads1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_1')->getData();
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));
        $param["wa_number"] = htmlentities(addslashes($request->get('wa_number')));
        $param["utm_source"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utm_campaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utm_term"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utm_medium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utm_content"] = htmlentities(addslashes($request->get('utm_content')));

        try {
            $data = $this->sendAPI->saveCarLeads1($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveCarLeads2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_2')->getData();

        $info_address = $request->get('info_address');
        $info_assets = $request->get('info_assets');

        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["info_address"]["province_id_bfi"] = htmlentities(addslashes($info_address['province_id_bfi']));
        $param["info_address"]["province_desc_bfi"] = htmlentities(addslashes($info_address['province_desc_bfi']));
        $param["info_address"]["city_id_bfi"] = htmlentities(addslashes($info_address['city_id_bfi']));
        $param["info_address"]["city_desc_bfi"] = htmlentities(addslashes($info_address['city_desc_bfi']));
        $param["info_address"]["district_id_bfi"] = htmlentities(addslashes($info_address['district_id_bfi']));
        $param["info_address"]["district_desc_bfi"] = htmlentities(addslashes($info_address['district_desc_bfi']));
        $param["info_address"]["subdistrict_id_bfi"] = htmlentities(addslashes($info_address['subdistrict_id_bfi']));
        $param["info_address"]["subdistrict_desc_bfi"] = htmlentities(addslashes($info_address['subdistrict_desc_bfi']));
        $param["info_address"]["zipcode_id_bfi"] = htmlentities(addslashes($info_address['zipcode_id_bfi']));
        $param["info_address"]["zipcode_desc_bfi"] = htmlentities(addslashes($info_address['zipcode_desc_bfi']));
        $param["info_address"]["full_address"] = htmlentities(addslashes($info_address['full_address']));
        $param["info_assets"]["type_id_bfi"] = htmlentities(addslashes($info_assets['type_id_bfi']));
        $param["info_assets"]["type_desc_bfi"] = htmlentities(addslashes($info_assets['type_desc_bfi']));
        $param["info_assets"]["brand_id_bfi"] = htmlentities(addslashes($info_assets['brand_id_bfi']));
        $param["info_assets"]["brand_desc_bfi"] = htmlentities(addslashes($info_assets['brand_desc_bfi']));
        $param["info_assets"]["model_id_bfi"] = htmlentities(addslashes($info_assets['model_id_bfi']));
        $param["info_assets"]["model_desc_bfi"] = htmlentities(addslashes($info_assets['model_desc_bfi']));
        $param["info_assets"]["vehicle_year_bfi"] = htmlentities(addslashes($info_assets['vehicle_year_bfi']));
        $param["info_assets"]["license_plate"] = htmlentities(addslashes($info_assets['license_plate']));
        $param["info_assets"]["asset_ownership_id_bfi"] = htmlentities(addslashes($info_assets['asset_ownership_id_bfi']));
        $param["info_assets"]["asset_ownership_desc_bfi"] = htmlentities(addslashes($info_assets['asset_ownership_desc_bfi']));
        $param["info_assets"]["category_id_bfi"] = htmlentities(addslashes($info_assets['category_id_bfi']));
        $param["info_assets"]["category_desc_bfi"] = htmlentities(addslashes($info_assets['category_desc_bfi']));

        try {
            $data = $this->sendAPI->saveCarLeads2($url, $param);

            if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data->data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveCarLeads3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["car_type_id"] = htmlentities(addslashes($request->get('car_type_id')));
        $param["car_brand_id"] = htmlentities(addslashes($request->get('car_brand_id')));
        $param["car_model_id"] = htmlentities(addslashes($request->get('car_model_id')));
        $param["car_year_id"] = htmlentities(addslashes($request->get('car_year_id')));
        $param["bpkb_atas_nama"] = htmlentities(addslashes($request->get('bpkb_atas_nama')));

        try {
            $data = $this->sendAPI->saveCarLeads3($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads4($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads5($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveCarLeads6Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SAVE_CAR_LEADS_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveCarLeads6($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    // Motorcycle
    public function getMotorcycleTypeAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_TYPE')->getData();

        try {
            $data = $this->sendAPI->getMotorcycle($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleBrandAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_BRANDS')->getData();

        try {
            $data = $this->sendAPI->getMotorcycleBrand($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleModelAction(Request $request)
    {

        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_MODELS')->getData();
        $param["type_id"] = htmlentities(addslashes($request->get('type_id')));
        $param["brand_id"] = htmlentities(addslashes($request->get('brand_id')));

        try {
            $data = $this->sendAPI->getMotorcycleModel($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleYearAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_YEAR')->getData();
        $param["model_id"] = htmlentities(addslashes($request->get('model_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));


        try {
            $data = $this->sendAPI->getMotorcycleYear($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleFundingAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->getMotorcycleFunding($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleTenorAction(Request $request)
    {
        $param['submission_id'] = (string) htmlentities(addslashes($request->get('submission_id')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MOTORCYCLE_TENOR')->getData();

        try {
            $data = $this->sendAPI->getMotorcycleTenor($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMotorcycleCalculateAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_MOTORCYCLE_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int) htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getMotorcycleCalculate($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMotorcycleLeads1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_1')->getData();
        // $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));
        $param["utm_source"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utm_campaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utm_term"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utm_medium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utm_content"] = htmlentities(addslashes($request->get('utm_content')));
        
        try {
            $data = $this->sendAPI->saveMotorcycleLeads1($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveMotorcycleLeads2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_2')->getData();

        $info_address = $request->get('info_address');
        $info_assets = $request->get('info_assets');
        $info_customer = $request->get('info_customer');

        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["info_address"]["province_id_bfi"] = htmlentities(addslashes($info_address['province_id_bfi']));
        $param["info_address"]["province_desc_bfi"] = htmlentities(addslashes($info_address['province_desc_bfi']));
        $param["info_address"]["city_id_bfi"] = htmlentities(addslashes($info_address['city_id_bfi']));
        $param["info_address"]["city_desc_bfi"] = htmlentities(addslashes($info_address['city_desc_bfi']));
        $param["info_address"]["district_id_bfi"] = htmlentities(addslashes($info_address['district_id_bfi']));
        $param["info_address"]["district_desc_bfi"] = htmlentities(addslashes($info_address['district_desc_bfi']));
        $param["info_address"]["subdistrict_id_bfi"] = htmlentities(addslashes($info_address['subdistrict_id_bfi']));
        $param["info_address"]["subdistrict_desc_bfi"] = htmlentities(addslashes($info_address['subdistrict_desc_bfi']));
        $param["info_address"]["zipcode_id_bfi"] = htmlentities(addslashes($info_address['zipcode_id_bfi']));
        $param["info_address"]["zipcode_desc_bfi"] = htmlentities(addslashes($info_address['zipcode_desc_bfi']));
        $param["info_address"]["full_address"] = htmlentities(addslashes($info_address['full_address']));
        $param["info_assets"]["type_id_bfi"] = htmlentities(addslashes($info_assets['type_id_bfi']));
        $param["info_assets"]["type_desc_bfi"] = htmlentities(addslashes($info_assets['type_desc_bfi']));
        $param["info_assets"]["brand_id_bfi"] = htmlentities(addslashes($info_assets['brand_id_bfi']));
        $param["info_assets"]["brand_desc_bfi"] = htmlentities(addslashes($info_assets['brand_desc_bfi']));
        $param["info_assets"]["model_id_bfi"] = htmlentities(addslashes($info_assets['model_id_bfi']));
        $param["info_assets"]["model_desc_bfi"] = htmlentities(addslashes($info_assets['model_desc_bfi']));
        $param["info_assets"]["vehicle_year_bfi"] = htmlentities(addslashes($info_assets['vehicle_year_bfi']));
        $param["info_assets"]["license_plate"] = htmlentities(addslashes($info_assets['license_plate']));
        $param["info_assets"]["asset_ownership_id_bfi"] = htmlentities(addslashes($info_assets['asset_ownership_id_bfi']));
        $param["info_assets"]["asset_ownership_desc_bfi"] = htmlentities(addslashes($info_assets['asset_ownership_desc_bfi']));
        $param["info_assets"]["home_ownership_id_bfi"] = htmlentities(addslashes($info_assets['home_ownership_id_bfi']));
        $param["info_assets"]["home_ownership_desc_bfi"] = htmlentities(addslashes($info_assets['home_ownership_desc_bfi']));
        $param["info_customer"]["profession_id_bfi"] = htmlentities(addslashes($info_customer['profession_id_bfi']));
        $param["info_customer"]["profession_desc_bfi"] = htmlentities(addslashes($info_customer['profession_desc_bfi']));
        $param["info_customer"]["salary"] = htmlentities(addslashes($info_customer['salary']));
        $param["info_customer"]["dob"] = htmlentities(addslashes($info_customer['dob']));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads2($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveMotorcycleLeads3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_3')->getData();

        $info_calculator = $request->get('info_calculator');

        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["info_calculator"]["funding"] = htmlentities(addslashes($info_calculator['funding']));
        $param["info_calculator"]["tenor"] = htmlentities(addslashes($info_calculator['tenor']));
        $param["info_calculator"]["monthly_installment"] = htmlentities(addslashes($info_calculator['monthly_installment']));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads3($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveMotorcycleLeads4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["disclaimer"] = htmlentities(addslashes($request->get('disclaimer')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads4($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveMotorcycleLeads5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads5($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function saveMotorcycleLeads6Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MOTORCYCLE_LEADS_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMotorcycleLeads6($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    // PBF
    public function getPbfProfessionAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_PROFESSION')->getData();

        try {
            $data = $this->sendAPI->getProfession($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfCertificateTypeAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PBF_CERTIFICATE_TYPE')->getData();

        try {
            $data = $this->sendAPI->getPbfCertificateType($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfCertificateOnBehalfAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PBF_CERTIFICATE_ON_BEHALF')->getData();

        try {
            $data = $this->sendAPI->getPbfCertificateOnBehalf($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getPbfPropertyTypeAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PBF_PROPERTY_TYPE')->getData();

        try {
            $data = $this->sendAPI->getPbfPropertyType($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfFundingAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_PBF_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["estimasi_harga"] = (int) htmlentities(addslashes($request->get('estimasi_harga')));

        try {
            $data = $this->sendAPI->getPbfFunding($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getPbfTenorAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_PBF_TENOR_LIST')->getData();
        $param['submission_id'] = (string)htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->getPbfTenor($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error"),
                'params' => $param
            ]);
        }
    }

    public function getPbfCalculateAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_PBF_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int) htmlentities(addslashes($request->get('funding')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));


        try {
            $data = $this->sendAPI->getPbfCalculate($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function savePbfLeads1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_1')->getData();
        // $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));
        $param["utm_source"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utm_campaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utm_term"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utm_medium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utm_content"] = htmlentities(addslashes($request->get('utm_content')));

        try {
            $data = $this->sendAPI->savePbfLeads1($url, $param);
            if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data,
            ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

    }

    public function savePbfLeads2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_2')->getData();

        $info_address = $request->get('info_address');
        $info_assets = $request->get('info_assets');

        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["info_address"]["province_id"] = htmlentities(addslashes($info_address['province_id']));
        $param["info_address"]["city_id"] = htmlentities(addslashes($info_address['city_id']));
        $param["info_address"]["district_id"] = htmlentities(addslashes($info_address['district_id']));
        $param["info_address"]["subdistrict_id"] = htmlentities(addslashes($info_address['subdistrict_id']));
        $param["info_address"]["rt"] = htmlentities(addslashes($info_address['rt']));
        $param["info_address"]["rw"] = htmlentities(addslashes($info_address['rw']));
        $param["info_address"]["zipcode_id"] = htmlentities(addslashes($info_address['zipcode_id']));
        $param["info_address"]["address"] = htmlentities(addslashes($info_address['address']));
        $param["info_assets"]["province_id"] = htmlentities(addslashes($info_assets['province_id']));
        $param["info_assets"]["city_id"] = htmlentities(addslashes($info_assets['city_id']));
        $param["info_assets"]["district_id"] = htmlentities(addslashes($info_assets['district_id']));
        $param["info_assets"]["subdistrict_id"] = htmlentities(addslashes($info_assets['subdistrict_id']));
        $param["info_assets"]["rt"] = htmlentities(addslashes($info_assets['rt']));
        $param["info_assets"]["rw"] = htmlentities(addslashes($info_assets['rw']));
        $param["info_assets"]["zipcode_id"] = htmlentities(addslashes($info_assets['zipcode_id']));
        $param["info_assets"]["address"] = htmlentities(addslashes($info_assets['address']));
        $param["profession_id"] = htmlentities(addslashes($request->get('profession_id')));
        $param["salary"] = htmlentities(addslashes($request->get('salary')));
        $param["employee_status_id"] = htmlentities(addslashes($request->get('employee_status_id')));
        $param["age"] = htmlentities(addslashes($request->get('age')));
        $param["marital_status_id"] = htmlentities(addslashes($request->get('marital_status_id')));
        $param["spouse_name"] = htmlentities(addslashes($request->get('spouse_name')));
        $param["spouse_profession_id"] = htmlentities(addslashes($request->get('spouse_profession_id')));

        try {
            $data = $this->sendAPI->savePbfLeads2($url, $param);
            if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
             return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function savePbfLeads3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["property_type_id"] = htmlentities(addslashes($request->get('property_type_id')));
        $param["certificate_type_id"] = htmlentities(addslashes($request->get('certificate_type_id')));
        $param["certificatie_in_the_name_id"] = htmlentities(addslashes($request->get('certificatie_in_the_name_id')));
        $param["where_certificate"] = htmlentities(addslashes($request->get('where_certificate')));
        $param["is_have_imb"] = htmlentities(addslashes($request->get('is_have_imb')));
        $param["is_pbb_uptodate"] = htmlentities(addslashes($request->get('is_pbb_uptodate')));
        $param["is_sales_period_last_year"] = htmlentities(addslashes($request->get('is_sales_period_last_year')));
        $param["is_dihuni"] = htmlentities(addslashes($request->get('is_dihuni')));
        $param["asset_location"] = htmlentities(addslashes($request->get('asset_location')));
        $param["other_assets"] = htmlentities(addslashes($request->get('other_assets')));
        $param["is_vehicle_road"] = htmlentities(addslashes($request->get('is_vehicle_road')));
        $param["is_near_river"] = htmlentities(addslashes($request->get('is_near_river')));
        $param["is_near_railroads"] = htmlentities(addslashes($request->get('is_near_railroads')));
        $param["is_near_silk_tower"] = htmlentities(addslashes($request->get('is_near_silk_tower')));
        $param["is_near_provider_tower"] = htmlentities(addslashes($request->get('is_near_provider_tower')));
        $param["is_near_grave"] = htmlentities(addslashes($request->get('is_near_grave')));

        try {
            $data = $this->sendAPI->savePbfLeads3($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
            ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error"),
                    'param' => $param
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function savePbfLeads4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["disclaimer"] = htmlentities(addslashes($request->get('disclaimer')));

        try {
            $data = $this->sendAPI->savePbfLeads4($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }

    }

    public function savePbfLeads5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->savePbfLeads5($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function savePbfLeads6Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_PBF_LEADS_STEP_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["is_news_letter"] = htmlentities(addslashes($request->get('is_news_letter')));

        try {
            $data = $this->sendAPI->savePbfLeads6($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function getLeisurePackageAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LEISURE_PACKAGE')->getData();


        try {
            $data = $this->sendAPI->getLeisurePackage($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getLeisureTenorAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LEISURE_TENOR_LIST')->getData();

        try {
            $data = $this->sendAPI->getLeisureTenor($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getLeisureProvisionPackageAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('url_GET_LEISURE_PROVISION_PACKAGE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["leisure_package_price"] = (int) htmlentities(addslashes($request->get('leisure_package_price')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));

        try {
            $data = $this->sendAPI->getLeisureProvisionPackage($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function leisureCalculatorAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_LEISURE_CALCULATOR')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["leisure_package_price"] = (int) htmlentities(addslashes($request->get('leisure_package_price')));
        $param["down_payment"] = (int) htmlentities(addslashes($request->get('down_payment')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));
        $param["pocket_money"] = (int) htmlentities(addslashes($request->get('pocket_money')));

        try {
            $data = $this->sendAPI->leisureCalculator($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));
        $param["path_ktp"] = htmlentities(addslashes($request->get('path_ktp')));

        try {
            $data = $this->sendAPI->saveLeisureLeads1($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_2')->getData();
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
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveLeisureLeads3($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveLeisureLeads4($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveLeisureLeads5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_LEISURE_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveLeisureLeads5($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getEduPackageAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_EDU_PACKAGE')->getData();

        try {
            $data = $this->sendAPI->getEduPackage($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getEduTenorAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_EDU_TENOR_LIST')->getData();

        try {
            $data = $this->sendAPI->getEduTenor($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function eduProvisionPackageAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_EDU_PROVISION_PACKAGE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["edu_package_price"] = (int) htmlentities(addslashes($request->get('edu_package_price')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));

        try {
            $data = $this->sendAPI->getEduProvisionPackage($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function eduCalculatorAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_EDU_CALCULATOR')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["edu_package_price"] = (int) htmlentities(addslashes($request->get('edu_package_price')));
        $param["down_payment"] = (int) htmlentities(addslashes($request->get('down_payment')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));

        try {
            $data = $this->sendAPI->eduCalculator($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));
        $param["path_ktp"] = htmlentities(addslashes($request->get('path_ktp')));

        try {
            $data = $this->sendAPI->saveEduLeads1($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_2')->getData();
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
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveEduLeads3($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveEduLeads4($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveEduLeads5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_EDU_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveEduLeads5($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryServicesAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_SERVICES')->getData();

        try {
            $data = $this->sendAPI->getMachineryServices($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryIndustryAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_INDUSTRY')->getData();

        try {
            $data = $this->sendAPI->getMachineryIndustry($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryTypeAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_TYPE')->getData();

        try {
            $data = $this->sendAPI->getMachineryType($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryBrandAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_BRAND')->getData();


        try {
            $data = $this->sendAPI->getMachineryBrand($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryModelAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_MODEL')->getData();
        $param["machinery_brand_id"] = htmlentities(addslashes($request->get('machinery_brand_id')));
        $param["machinery_type_id"] = htmlentities(addslashes($request->get('machinery_type_id')));

        try {
            $data = $this->sendAPI->getMachineryModel($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryYearAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_YEAR')->getData();
        $param["machinery_model_id"] = htmlentities(addslashes($request->get('machinery_model_id')));

        try {
            $data = $this->sendAPI->getMachineryYear($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryPriceAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_PRICING')->getData();
        $param["machinery_service_id"] = htmlentities(addslashes($request->get('machinery_service_id')));
        $param["machinery_year_id"] = htmlentities(addslashes($request->get('machinery_year_id')));

        try {
            $data = $this->sendAPI->getMachineryPricing($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryFundingAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_FUNDING')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getMachineryFunding($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryDownPaymentAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_DOWN_PAYMENT')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));


        try {
            $data = $this->sendAPI->getMachineryDownPayment($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function getMachineryTenorAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MACHINERY_TENOR_LIST')->getData();

        try {
            $data = $this->sendAPI->getMachineryTenor($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getMachineryCalculateAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_MACHINERY_CALCULATE')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["funding"] = (int) htmlentities(addslashes($request->get('funding')));
        $param["down_payment"] = (int) htmlentities(addslashes($request->get('down_payment')));
        $param["tenor"] = (int) htmlentities(addslashes($request->get('tenor')));

        try {
            $data = $this->sendAPI->machineryCalculate($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            if ($data->data != []) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));

        try {
            $data = $this->sendAPI->saveCarLeads1($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_2')->getData();
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
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["machinery_service_id"] = htmlentities(addslashes($request->get('machinery_service_id')));
        $param["machinery_industry_id"] = htmlentities(addslashes($request->get('machinery_industry_id')));
        $param["machinery_type_id"] = htmlentities(addslashes($request->get('machinery_type_id')));
        $param["machinery_brand_id"] = htmlentities(addslashes($request->get('machinery_brand_id')));
        $param["machinery_model_id"] = htmlentities(addslashes($request->get('machinery_model_id')));
        $param["machinery_year_id"] = htmlentities(addslashes($request->get('machinery_year_id')));
        $param["machinery_total"] = (int) htmlentities(addslashes($request->get('machinery_total')));
        $param["estimated_price"] = (int) htmlentities(addslashes($request->get('estimated_price')));

        try {
            $data = $this->sendAPI->saveMachineryLeads3($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMachineryLeads4($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMachineryLeads5($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveMachineryLeads6Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MACHINERY_LEADS_STEP_6')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->saveMachineryLeads6($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }


    public function getListProductCategoryAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_PRODUCT_CATEGORY')->getData();

        try {
            $data = $this->sendAPI->getProductCategory($url);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Product Category Down"
            ]);
        }
        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListProductAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_PRODUCT')->getData();
        $param["category_id"] = htmlentities(addslashes($request->get('category_id')));

        try {
            $data = $this->sendAPI->getProduct($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    //getlist
    public function getListProfessionAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PROFESSION')->getData();
        $param["category"] = htmlentities(addslashes($request->get('category')));

        try {
            $data = $this->sendAPI->getListProfession($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                    
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function getListEmployeeStatusAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_EMPLOYEE_STATUS')->getData();
        $param["category"] = htmlentities(addslashes($request->get('category')));

        try {
            $data = $this->sendAPI->getListEmployeeStatus($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }
    }

    public function getListMaritalStatus2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_MARITAL_STATUS')->getData();
        $param["category"] = htmlentities(addslashes($request->get('category')));

        try {
            $data = $this->sendAPI->getListMaritalStatus2($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }


    }

    public function getListSpouseProfessionAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_SPOUSE_PROFESSION')->getData();
        $param["category"] = htmlentities(addslashes($request->get('category')));

        try {
            $data = $this->sendAPI->getListSpouseProfession($url, $param);
            if ($data->header->status == 200) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => "success",
                    'data' => $data->data
                ]);
            } else {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $this->get("translator")->trans("api-error")
                ], + ($this->isDev ? ['message' => $data->data] : []));
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                 'success' => "0",
                 'message' => $e->getMessage()
            ]);
        }


    }
}