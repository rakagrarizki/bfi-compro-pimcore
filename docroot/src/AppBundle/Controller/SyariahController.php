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

class SyariahController extends FrontendController
{
    public function defaultAction(Request $request){

    }

    // My Talim
    public function MyTalimAction(Request $request){
        
    }

    public function saveMyTalimStep1Action(Request $request){
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['name'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phone'] = htmlentities(addslashes($request->get('phone_number')));
        
        try{
            if($param['appId'] == null){
                $param['appId'] = uniqid();
                $filename = File::getValidFilename(date('Y') . '-' . $param['appId']);
                
                $myTalim = new DataObject\Syariah;
                $myTalim->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyTalim'));
                $myTalim->setKey($filename);
                $myTalim->setPublished(true);
                $myTalim->setAppId($param['appId']);
                $myTalim->setProduct("MyTalim");
                $myTalim->setName($param['name']);
                $myTalim->setEmail($param['email']);
                $myTalim->setPhone($param['phone']);
                $myTalim->setLastStep('1');
                $myTalim->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
                ]);
            } else {
                $myTalim = DataObject\Syariah::getByAppId($param['appId'], 1);
                $myTalim->setName($param['name']);
                $myTalim->setEmail($param['email']);
                $myTalim->setPhone($param['phone']);
                $myTalim->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
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
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['district'] = htmlentities(addslashes($request->get('district')));
        $param['subdistrict'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['zipcode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['fullAddress'] = htmlentities(addslashes($request->get('fullAddress')));
        $param['assetBrand'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['assetModel'] = htmlentities(addslashes($request->get('assetModel')));
        $param['assetYear'] = htmlentities(addslashes($request->get('assetYear')));

        try {
            $myTalim = DataObject\Syariah::getByAppId($param['appId'], 1);
            $myTalim->setProvince($param['province']);
            $myTalim->setCity($param['city']);
            $myTalim->setDistrict($param['district']);
            $myTalim->setSubdistrict($param['subdistrict']);
            $myTalim->setZipcode($param['zipcode']);
            $myTalim->setFullAddress($param['fullAddress']);
            $myTalim->setAssetBrand($param['assetBrand']);
            $myTalim->setAssetModel($param['assetModel']);
            $myTalim->setAssetYear($param['assetYear']);
            $myTalim->setLastStep('2');
            $myTalim->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyTalimStep3Action(Request $request) {
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['needs'] = htmlentities(addslashes($request->get('needs')));
        $param['funding'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['buyDate'] = htmlentities(addslashes($request->get('buyDate')));
        
        try {
            $myTalim = DataObject\Syariah::getByAppId($param['appId'], 1);
            $myTalim->setNeeds($param['needs']);
            $myTalim->setFinancing($param['funding']);
            $myTalim->setTenor($param['tenor']);
            $myTalim->setPurchaseDate($param['buyDate']);
            $myTalim->setLastStep('3');
            $myTalim->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    // My Hajat
    public function MyHajatAction(Request $request){

    }

    public function saveMyHajatStep1Action(Request $request){
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['name'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phone'] = htmlentities(addslashes($request->get('phone_number')));
        
        try{
            if($param['appId'] == null){
                $param['appId'] = uniqid();
                $filename = File::getValidFilename(date('Y') . '-' . $param['appId']);
                
                $MyHajat = new DataObject\Syariah;
                $MyHajat->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyHajat'));
                $MyHajat->setKey($filename);
                $MyHajat->setPublished(true);
                $MyHajat->setAppId($param['appId']);
                $MyHajat->setProduct("MyHajat");
                $MyHajat->setName($param['name']);
                $MyHajat->setEmail($param['email']);
                $MyHajat->setPhone($param['phone']);
                $MyHajat->setLastStep('1');
                $MyHajat->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
                ]);
            } else {
                $MyHajat = DataObject\Syariah::getByAppId($param['appId'], 1);
                $MyHajat->setName($param['name']);
                $MyHajat->setEmail($param['email']);
                $MyHajat->setPhone($param['phone']);
                $MyHajat->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
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
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['district'] = htmlentities(addslashes($request->get('district')));
        $param['subdistrict'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['zipcode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['fullAddress'] = htmlentities(addslashes($request->get('fullAddress')));
        $param['assetBrand'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['assetModel'] = htmlentities(addslashes($request->get('assetModel')));
        $param['assetYear'] = htmlentities(addslashes($request->get('assetYear')));

        try {
            $MyHajat = DataObject\Syariah::getByAppId($param['appId'], 1);
            $MyHajat->setProvince($param['province']);
            $MyHajat->setCity($param['city']);
            $MyHajat->setDistrict($param['district']);
            $MyHajat->setSubdistrict($param['subdistrict']);
            $MyHajat->setZipcode($param['zipcode']);
            $MyHajat->setFullAddress($param['fullAddress']);
            $MyHajat->setAssetBrand($param['assetBrand']);
            $MyHajat->setAssetModel($param['assetModel']);
            $MyHajat->setAssetYear($param['assetYear']);
            $MyHajat->setLastStep('2');
            $MyHajat->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyHajatStep3Action(Request $request) {
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['needs'] = htmlentities(addslashes($request->get('needs')));
        $param['funding'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['buyDate'] = htmlentities(addslashes($request->get('buyDate')));
        
        try {
            $MyHajat = DataObject\Syariah::getByAppId($param['appId'], 1);
            $MyHajat->setNeeds($param['needs']);
            $MyHajat->setFinancing($param['funding']);
            $MyHajat->setTenor($param['tenor']);
            $MyHajat->setPurchaseDate($param['buyDate']);
            $MyHajat->setLastStep('3');
            $MyHajat->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    // My Faedah
    public function MyFaedahAction(Request $request){
        
    }

    public function saveMyFaedahStep1Action(Request $request){
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['name'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phone'] = htmlentities(addslashes($request->get('phone_number')));
        
        try{
            if($param['appId'] == null){
                $param['appId'] = uniqid();
                $filename = File::getValidFilename(date('Y') . '-' . $param['appId']);
                
                $MyFaedah = new DataObject\Syariah;
                $MyFaedah->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyFaedah'));
                $MyFaedah->setKey($filename);
                $MyFaedah->setPublished(true);
                $MyFaedah->setAppId($param['appId']);
                $MyFaedah->setProduct("MyFaedah");
                $MyFaedah->setName($param['name']);
                $MyFaedah->setEmail($param['email']);
                $MyFaedah->setPhone($param['phone']);
                $MyFaedah->setLastStep('1');
                $MyFaedah->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
                ]);
            } else {
                $MyFaedah = DataObject\Syariah::getByAppId($param['appId'], 1);
                $MyFaedah->setName($param['name']);
                $MyFaedah->setEmail($param['email']);
                $MyFaedah->setPhone($param['phone']);
                $MyFaedah->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
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
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['district'] = htmlentities(addslashes($request->get('district')));
        $param['subdistrict'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['zipcode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['fullAddress'] = htmlentities(addslashes($request->get('fullAddress')));
        $param['assetBrand'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['assetModel'] = htmlentities(addslashes($request->get('assetModel')));
        $param['assetYear'] = htmlentities(addslashes($request->get('assetYear')));

        try {
            $MyFaedah = DataObject\Syariah::getByAppId($param['appId'], 1);
            $MyFaedah->setProvince($param['province']);
            $MyFaedah->setCity($param['city']);
            $MyFaedah->setDistrict($param['district']);
            $MyFaedah->setSubdistrict($param['subdistrict']);
            $MyFaedah->setZipcode($param['zipcode']);
            $MyFaedah->setFullAddress($param['fullAddress']);
            $MyFaedah->setAssetBrand($param['assetBrand']);
            $MyFaedah->setAssetModel($param['assetModel']);
            $MyFaedah->setAssetYear($param['assetYear']);
            $MyFaedah->setLastStep('2');
            $MyFaedah->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyFaedahStep3Action(Request $request) {
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['needs'] = htmlentities(addslashes($request->get('needs')));
        $param['funding'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['buyDate'] = htmlentities(addslashes($request->get('buyDate')));
        
        try {
            $MyFaedah = DataObject\Syariah::getByAppId($param['appId'], 1);
            $MyFaedah->setNeeds($param['needs']);
            $MyFaedah->setFinancing($param['funding']);
            $MyFaedah->setTenor($param['tenor']);
            $MyFaedah->setPurchaseDate($param['buyDate']);
            $MyFaedah->setLastStep('3');
            $MyFaedah->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    // My Cars
    public function MyCarsAction(Request $request){
        
    }
    
    public function saveMyCarsStep1Action(Request $request){
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['name'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phone'] = htmlentities(addslashes($request->get('phone_number')));
        
        try{
            if($param['appId'] == null){
                $param['appId'] = uniqid();
                $filename = File::getValidFilename(date('Y') . '-' . $param['appId']);
                
                $MyCars = new DataObject\Syariah;
                $MyCars->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyCars'));
                $MyCars->setKey($filename);
                $MyCars->setPublished(true);
                $MyCars->setAppId($param['appId']);
                $MyCars->setProduct("MyCars");
                $MyCars->setName($param['name']);
                $MyCars->setEmail($param['email']);
                $MyCars->setPhone($param['phone']);
                $MyCars->setLastStep('1');
                $MyCars->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
                ]);
            } else {
                $MyCars = DataObject\Syariah::getByAppId($param['appId'], 1);
                $MyCars->setName($param['name']);
                $MyCars->setEmail($param['email']);
                $MyCars->setPhone($param['phone']);
                $MyCars->save();
    
                return new JsonResponse([
                    'success' => 1,
                    'message' => "success",
                    'data' => $param,
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
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['province'] = htmlentities(addslashes($request->get('province')));
        $param['city'] = htmlentities(addslashes($request->get('city')));
        $param['district'] = htmlentities(addslashes($request->get('district')));
        $param['subdistrict'] = htmlentities(addslashes($request->get('subdistrict')));
        $param['zipcode'] = htmlentities(addslashes($request->get('zipcode')));
        $param['fullAddress'] = htmlentities(addslashes($request->get('fullAddress')));

        try {
            $MyCars = DataObject\Syariah::getByAppId($param['appId'], 1);
            $MyCars->setProvince($param['province']);
            $MyCars->setCity($param['city']);
            $MyCars->setDistrict($param['district']);
            $MyCars->setSubdistrict($param['subdistrict']);
            $MyCars->setZipcode($param['zipcode']);
            $MyCars->setFullAddress($param['fullAddress']);
            $MyCars->setLastStep('2');
            $MyCars->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }

    public function saveMyCarsStep3Action(Request $request) {
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['assetBrand'] = htmlentities(addslashes($request->get('assetBrand')));
        $param['assetYear'] = htmlentities(addslashes($request->get('assetYear')));
        $param['isAvailable'] = htmlentities(addslashes($request->get('isAvailable')));
        $param['needs'] = htmlentities(addslashes($request->get('needs')));
        $param['funding'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['buyDate'] = htmlentities(addslashes($request->get('buyDate')));
        
        try {
            $MyCars = DataObject\Syariah::getByAppId($param['appId'], 1);
            $MyCars->setAssetBrand($param['assetBrand']);
            $MyCars->setAssetYear($param['assetYear']);
            $MyCars->setIsAvailable($param['isAvailable']);
            $MyCars->setNeeds($param['needs']);
            $MyCars->setFinancing($param['funding']);
            $MyCars->setTenor($param['tenor']);
            $MyCars->setPurchaseDate($param['buyDate']);
            $MyCars->setLastStep('3');
            $MyCars->save();

            return new JsonResponse([
                'success' => 1,
                'message' => "success",
                'data' => $param,
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => 0,
                'message' => $e->getMessage()
           ]);
        }
    }
}