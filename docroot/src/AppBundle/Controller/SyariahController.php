<?php

namespace AppBundle\Controller;

use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Pimcore\File;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\WebsiteSetting;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Carbon\Carbon;
use AppBundle\Service\SendApi;

class SyariahController extends FrontendController
{
    protected $sendAPI;
    protected $randomNumber;
    private $redis;
    private $isDev;

    public function __construct(SendApi $sendAPI)
    {
        $this->sendAPI = $sendAPI;
        $this->randomNumber = rand(000001, 999999);
        $this->redis = new \Credis_Client(REDIS, 6379, null, '', 1, PASSREDIS);
        $this->isDev = ENV === 'dev';
    }

    public function defaultAction(Request $request){

    }

    // My Talim
    public function talimAction(Request $request){
        
    }

    public function saveMyTalimStep1Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYTALIM_STEP1')->getData();
        $appId = htmlentities(addslashes($request->get('appId')));
        if($appId != null || $appId != "") {
            $param['id'] = $appId;
        }
        $param['fullName'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phoneNumber1'] = htmlentities(addslashes($request->get('phone_number')));
        $param["utmSource"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utmCampaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utmTerm"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utmMedium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utmContent"] = htmlentities(addslashes($request->get('utm_content')));
        
        try{
            $data = $this->sendAPI->saveSyariahLeads("my-talim-step-1", $url, $param);
            if ($data->header->message == "Success") {
                if($appId == null){
                    $param['id'] = $data->data[0]->id;
                    $filename = File::getValidFilename(date('Y') . '-' . $param['id']);
                    
                    $myTalim = new DataObject\Syariah;
                    $myTalim->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyTalim'));
                    $myTalim->setKey($filename);
                    $myTalim->setPublished(true);
                    $myTalim->setAppId($param['id']);
                    $myTalim->setProduct('MyTalim');
                    $myTalim->setName($param['fullName']);
                    $myTalim->setEmail($param['email']);
                    $myTalim->setPhone($param['phoneNumber1']);
                    $myTalim->setLastStep('1');
                    $myTalim->save();
                } else {
                    $myTalim = DataObject\Syariah::getByAppId($param['id'], 1);
                    $myTalim->setName($param['fullName']);
                    $myTalim->setEmail($param['email']);
                    $myTalim->setPhone($param['phoneNumber1']);
                    $myTalim->save();
                }
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyTalimStep2Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYTALIM_STEP2')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['districts'] = htmlentities(addslashes($request->get('district')));
        $param['subdistricts'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['postalCode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['address'] = htmlentities(addslashes($request->get('fullAddress')));
        $param['brandVehicle'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['modelVehicle'] = htmlentities(addslashes($request->get('assetModel')));
        $param['yearVehicle'] = htmlentities(addslashes($request->get('assetYear')));

        try {
            $data = $this->sendAPI->saveSyariahLeads("my-talim-step-2", $url, $param);
            if ($data->header->message == "Success") {
                $myTalim = DataObject\Syariah::getByAppId($param['id'], 1);
                $myTalim->setProvince($param['province']);
                $myTalim->setCity($param['city']);
                $myTalim->setDistrict($param['districts']);
                $myTalim->setSubdistrict($param['subdistricts']);
                $myTalim->setZipcode($param['postalCode']);
                $myTalim->setFullAddress($param['address']);
                $myTalim->setAssetBrand($param['brandVehicle']);
                $myTalim->setAssetModel($param['modelVehicle']);
                $myTalim->setAssetYear($param['yearVehicle']);
                $myTalim->setLastStep('2');
                $myTalim->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyTalimStep3Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYTALIM_STEP3')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['procurementNeeds'] = htmlentities(addslashes($request->get('needs')));
        $param['institutionName'] = htmlentities(addslashes($request->get('institution')));
        $param['loanAmount'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['purchasePlanTime'] = htmlentities(addslashes($request->get('buyDate')));
        $param['disclaimerToBeSurveyed'] = htmlentities(addslashes($request->get('disclaimer')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-talim-step-3", $url, $param);
            if ($data->header->message == "Success") {
                $myTalim = DataObject\Syariah::getByAppId($param['id'], 1);
                $myTalim->setNeeds($param['procurementNeeds']);
                $myTalim->setInstansi($param['institutionName']);
                $myTalim->setFinancing($param['loanAmount']);
                $myTalim->setTenor($param['tenor']);
                $myTalim->setPurchaseDate($param['purchasePlanTime']);
                $myTalim->setLastStep('3');
                $myTalim->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyTalimStep4Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYTALIM_STEP4')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-talim-step-4", $url, $param);
            if ($data->header->message == "Success") {
                $myTalim = DataObject\Syariah::getByAppId($param['id'], 1);
                $myTalim->setLastStep('4');
                $myTalim->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    // My Hajat
    public function hajatAction(Request $request){

    }

    public function saveMyHajatStep1Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYHAJAT_STEP1')->getData();
        $appId = htmlentities(addslashes($request->get('appId')));
        if($appId != null || $appId != "") {
            $param['id'] = $appId;
        }
        $param['fullName'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phoneNumber1'] = htmlentities(addslashes($request->get('phone_number')));
        $param["utmSource"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utmCampaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utmTerm"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utmMedium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utmContent"] = htmlentities(addslashes($request->get('utm_content')));
        
        try{
            $data = $this->sendAPI->saveSyariahLeads("my-hajat-step-1", $url, $param);
            if ($data->header->message == "Success") {
                if($appId == null){
                    $param['id'] = $data->data[0]->id;
                    $filename = File::getValidFilename(date('Y') . '-' . $param['id']);
                    
                    $MyHajat = new DataObject\Syariah;
                    $MyHajat->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyHajat'));
                    $MyHajat->setKey($filename);
                    $MyHajat->setPublished(true);
                    $MyHajat->setAppId($param['id']);
                    $MyHajat->setProduct('MyHajat');
                    $MyHajat->setName($param['fullName']);
                    $MyHajat->setEmail($param['email']);
                    $MyHajat->setPhone($param['phoneNumber1']);
                    $MyHajat->setLastStep('1');
                    $MyHajat->save();
                } else {
                    $MyHajat = DataObject\Syariah::getByAppId($param['id'], 1);
                    $MyHajat->setName($param['fullName']);
                    $MyHajat->setEmail($param['email']);
                    $MyHajat->setPhone($param['phoneNumber1']);
                    $MyHajat->save();
                }
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyHajatStep2Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYHAJAT_STEP2')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['districts'] = htmlentities(addslashes($request->get('district')));
        $param['subdistricts'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['postalCode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['address'] = htmlentities(addslashes($request->get('fullAddress')));
        $param['brandVehicle'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['modelVehicle'] = htmlentities(addslashes($request->get('assetModel')));
        $param['yearVehicle'] = htmlentities(addslashes($request->get('assetYear')));

        try {
            $data = $this->sendAPI->saveSyariahLeads("my-hajat-step-2", $url, $param);
            if ($data->header->message == "Success") {
                $MyHajat = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyHajat->setProvince($param['province']);
                $MyHajat->setCity($param['city']);
                $MyHajat->setDistrict($param['districts']);
                $MyHajat->setSubdistrict($param['subdistricts']);
                $MyHajat->setZipcode($param['postalCode']);
                $MyHajat->setFullAddress($param['address']);
                $MyHajat->setAssetBrand($param['brandVehicle']);
                $MyHajat->setAssetModel($param['modelVehicle']);
                $MyHajat->setAssetYear($param['yearVehicle']);
                $MyHajat->setLastStep('2');
                $MyHajat->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyHajatStep3Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYHAJAT_STEP3')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['procurementNeeds'] = htmlentities(addslashes($request->get('needs')));
        $param['detailProcurementNeeds'] = htmlentities(addslashes($request->get('detailNeeds')));
        $param['loanAmount'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['purchasePlanTime'] = htmlentities(addslashes($request->get('buyDate')));
        $param['disclaimerToBeSurveyed'] = htmlentities(addslashes($request->get('disclaimer')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-hajat-step-3", $url, $param);
            if ($data->header->message == "Success") {
                $MyHajat = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyHajat->setNeeds($param['procurementNeeds']);
                $MyHajat->setDetailNeeds($param['detailProcurementNeeds']);
                $MyHajat->setFinancing($param['loanAmount']);
                $MyHajat->setTenor($param['tenor']);
                $MyHajat->setPurchaseDate($param['purchasePlanTime']);
                $MyHajat->setLastStep('3');
                $MyHajat->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyHajatStep4Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYHAJAT_STEP4')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-hajat-step-4", $url, $param);
            if ($data->header->message == "Success") {
                $MyHajat = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyHajat->setLastStep('4');
                $MyHajat->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    // My Faedah
    public function faedahAction(Request $request){
        
    }

    public function saveMyFaedahStep1Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYFAEDAH_STEP1')->getData();
        $appId = htmlentities(addslashes($request->get('appId')));
        if($appId != null || $appId != "") {
            $param['id'] = $appId;
        }
        $param['fullName'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phoneNumber1'] = htmlentities(addslashes($request->get('phone_number')));
        $param["utmSource"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utmCampaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utmTerm"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utmMedium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utmContent"] = htmlentities(addslashes($request->get('utm_content')));
        
        try{
            $data = $this->sendAPI->saveSyariahLeads("my-faedah-step-1", $url, $param);
            if ($data->header->message == "Success") {
                if($appId == null){
                    $param['id'] = $data->data[0]->id;
                    $filename = File::getValidFilename(date('Y') . '-' . $param['id']);
                    
                    $MyFaedah = new DataObject\Syariah;
                    $MyFaedah->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyFaedah'));
                    $MyFaedah->setKey($filename);
                    $MyFaedah->setPublished(true);
                    $MyFaedah->setAppId($param['id']);
                    $MyFaedah->setProduct('MyFaedah');
                    $MyFaedah->setName($param['fullName']);
                    $MyFaedah->setEmail($param['email']);
                    $MyFaedah->setPhone($param['phoneNumber1']);
                    $MyFaedah->setLastStep('1');
                    $MyFaedah->save();
                } else {
                    $MyFaedah = DataObject\Syariah::getByAppId($param['id'], 1);
                    $MyFaedah->setName($param['fullName']);
                    $MyFaedah->setEmail($param['email']);
                    $MyFaedah->setPhone($param['phoneNumber1']);
                    $MyFaedah->save();
                }
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyFaedahStep2Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYFAEDAH_STEP2')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['districts'] = htmlentities(addslashes($request->get('district')));
        $param['subdistricts'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['postalCode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['address'] = htmlentities(addslashes($request->get('fullAddress')));
        $param['brandVehicle'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['modelVehicle'] = htmlentities(addslashes($request->get('assetModel')));
        $param['yearVehicle'] = htmlentities(addslashes($request->get('assetYear')));

        try {
            $data = $this->sendAPI->saveSyariahLeads("my-faedah-step-2", $url, $param);
            if ($data->header->message == "Success") {
                $MyFaedah = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyFaedah->setProvince($param['province']);
                $MyFaedah->setCity($param['city']);
                $MyFaedah->setDistrict($param['districts']);
                $MyFaedah->setSubdistrict($param['subdistricts']);
                $MyFaedah->setZipcode($param['postalCode']);
                $MyFaedah->setFullAddress($param['address']);
                $MyFaedah->setAssetBrand($param['brandVehicle']);
                $MyFaedah->setAssetModel($param['modelVehicle']);
                $MyFaedah->setAssetYear($param['yearVehicle']);
                $MyFaedah->setLastStep('2');
                $MyFaedah->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyFaedahStep3Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYFAEDAH_STEP3')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['procurementNeeds'] = htmlentities(addslashes($request->get('needs')));
        $param['detailProcurementNeeds'] = htmlentities(addslashes($request->get('detailNeeds')));
        $param['loanAmount'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['purchasePlanTime'] = htmlentities(addslashes($request->get('buyDate')));
        $param['disclaimerToBeSurveyed'] = htmlentities(addslashes($request->get('disclaimer')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-faedah-step-3", $url, $param);
            if ($data->header->message == "Success") {
                $MyFaedah = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyFaedah->setNeeds($param['procurementNeeds']);
                $MyFaedah->setDetailNeeds($param['detailProcurementNeeds']);
                $MyFaedah->setFinancing($param['loanAmount']);
                $MyFaedah->setTenor($param['tenor']);
                $MyFaedah->setPurchaseDate($param['purchasePlanTime']);
                $MyFaedah->setLastStep('3');
                $MyFaedah->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyFaedahStep4Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYFAEDAH_STEP4')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-faedah-step-4", $url, $param);
            if ($data->header->message == "Success") {
                $MyHajat = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyHajat->setLastStep('4');
                $MyHajat->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    // My Cars
    public function carsAction(Request $request){
        
    }
    
    public function saveMyCarsStep1Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYCARS_STEP1')->getData();
        $appId = htmlentities(addslashes($request->get('appId')));
        if($appId != null || $appId != "") {
            $param['id'] = $appId;
        }
        $param['fullName'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phoneNumber1'] = htmlentities(addslashes($request->get('phone_number')));
        $param["utmSource"] = htmlentities(addslashes($request->get('utm_source')));
        $param["utmCampaign"] = htmlentities(addslashes($request->get('utm_campaign')));
        $param["utmTerm"] = htmlentities(addslashes($request->get('utm_term')));
        $param["utmMedium"] = htmlentities(addslashes($request->get('utm_medium')));
        $param["utmContent"] = htmlentities(addslashes($request->get('utm_content')));
        
        try{
            $data = $this->sendAPI->saveSyariahLeads("my-cars-step-1", $url, $param);
            if ($data->header->message == "Success") {
                if($appId == null){
                    $param['id'] = $data->data[0]->id;
                    $filename = File::getValidFilename(date('Y') . '-' . $param['id']);
                    
                    $MyCars = new DataObject\Syariah;
                    $MyCars->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyCars'));
                    $MyCars->setKey($filename);
                    $MyCars->setPublished(true);
                    $MyCars->setAppId($param['id']);
                    $MyCars->setProduct('MyCars');
                    $MyCars->setName($param['fullName']);
                    $MyCars->setEmail($param['email']);
                    $MyCars->setPhone($param['phoneNumber1']);
                    $MyCars->setLastStep('1');
                    $MyCars->save();
                } else {
                    $MyCars = DataObject\Syariah::getByAppId($param['id'], 1);
                    $MyCars->setName($param['fullName']);
                    $MyCars->setEmail($param['email']);
                    $MyCars->setPhone($param['phoneNumber1']);
                    $MyCars->save();
                }
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyCarsStep2Action(Request $request){
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYCARS_STEP2')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['districts'] = htmlentities(addslashes($request->get('district')));
        $param['subdistricts'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['postalCode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['address'] = htmlentities(addslashes($request->get('fullAddress')));

        try {
            $data = $this->sendAPI->saveSyariahLeads("my-cars-step-2", $url, $param);
            if ($data->header->message == "Success") {
                $MyCars = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyCars->setProvince($param['province']);
                $MyCars->setCity($param['city']);
                $MyCars->setDistrict($param['districts']);
                $MyCars->setSubdistrict($param['subdistricts']);
                $MyCars->setZipcode($param['postalCode']);
                $MyCars->setFullAddress($param['address']);
                $MyCars->setLastStep('2');
                $MyCars->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyCarsStep3Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYCARS_STEP3')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        $param['brandVehicle'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['yearVehicle'] = htmlentities(addslashes($request->get('assetYear')));
        $param['unitsAvailable'] = htmlentities(addslashes($request->get('isAvailable')));
        $param['estimatePriceVehicle'] = htmlentities(addslashes($request->get('estimatePriceVehicle')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['purchasePlanTime'] = htmlentities(addslashes($request->get('buyDate')));
        $param['disclaimerToBeSurveyed'] = htmlentities(addslashes($request->get('disclaimer')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-cars-step-3", $url, $param);
            if ($data->header->message == "Success") {
                $MyCars = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyCars->setAssetBrand($param['brandVehicle']);
                $MyCars->setAssetYear($param['yearVehicle']);
                $MyCars->setIsAvailable($param['unitsAvailable']);
                $MyCars->setEstimatePrice($param['estimatePriceVehicle']);
                $MyCars->setTenor($param['tenor']);
                $MyCars->setPurchaseDate($param['purchasePlanTime']);
                $MyCars->setLastStep('3');
                $MyCars->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyCarsStep4Action(Request $request) {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_SAVE_MYCARS_STEP4')->getData();
        $param['id'] = htmlentities(addslashes($request->get('appId')));
        
        try {
            $data = $this->sendAPI->saveSyariahLeads("my-cars-step-4", $url, $param);
            if ($data->header->message == "Success") {
                $MyCars = DataObject\Syariah::getByAppId($param['id'], 1);
                $MyCars->setLastStep('4');
                $MyCars->save();

                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $data->data,
                ]);
            } else {
                return new JsonResponse([
                    'success' => 0,
                    'message' => $this->get("translator")->trans("api-error"),
                    'data' => $data
                ]);
            }
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }
}