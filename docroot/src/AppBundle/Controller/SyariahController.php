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

    public function MyTalimAction(Request $request){
        
    }

    public function saveMyTalimStep1Action(Request $request){
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['name'] = htmlentities(addslashes($request->get('name')));
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $param['phone'] = htmlentities(addslashes($request->get('phone_number')));
        
        if($param['appId'] == null){
            $param['appId'] = uniqid();
            $filename = File::getValidFilename(date('Y') . '-' . $param['appId']);
            
            $myTalim = new DataObject\MyTalim;
            $myTalim->setParent(DataObject\AbstractObject::getByPath('/Syariah/MyTalim'));
            $myTalim->setKey($filename);
            $myTalim->setPublished(true);
            $myTalim->setAppId($param['appId']);
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
            $myTalim = DataObject\MyTalim::getByAppId($param['appId'], 1);
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

        $myTalim = DataObject\MyTalim::getByAppId($param['appId'], 1);
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
    }

    public function saveMyTalimStep3Action(Request $request) {
        $param['appId'] = htmlentities(addslashes($request->get('appId')));
        $param['needs'] = htmlentities(addslashes($request->get('needs')));
        $param['funding'] = htmlentities(addslashes($request->get('funding')));
        $param['tenor'] = htmlentities(addslashes($request->get('tenor')));
        $param['buyDate'] = htmlentities(addslashes($request->get('buyDate')));
        
        $myTalim = DataObject\MyTalim::getByAppId($param['appId'], 1);
        $myTalim->setNeeds($param['needs']);
        $myTalim->setFinancing($param['funding']);
        $myTalim->setTenor($param['tenor']);
        $myTalim->setBuyDate($param['buyDate']);
        $myTalim->setLastStep('3');
        $myTalim->save();

        return new JsonResponse([
            'success' => 1,
            'message' => "success",
            'data' => $param,
        ]);
    }
}