<?php

namespace AppBundle\Controller;

use AppBundle\Service\SendApi;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\BrandProduct;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Kecamatan as Kecamatan;
use Pimcore\Model\DataObject\Kelurahan as Kelurahan;
use Pimcore\Model\DataObject\Province;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpFoundation\Request;

class ServiceController extends FrontendController
{
    public function defaultAction(Request $request)
    {

    }

    public function registerNewsletterAction(Request $request)
    {
        $param = [];
        $param["email"] = $request->get('email');
        $url = WebsiteSetting::getByName('URL_NEWSLETTER')->getData();

        $sendAPI = new SendApi();


        try {
            $data = $sendAPI->sendNewsletter($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Alamat Email sudah terdaftar / service tidak bisa diakses"
            ]);
        }

        if(is_array($data))
        {
            if($data->code == "413"){
                return new JsonResponse([
                    'success' => "0",
                    'message' => $data->message
                ]);
            }
        }else{
            if($data == true){
                return new JsonResponse([
                    'success' => "1",
                    'message' => "Sukses"
                ]);
            }
        }

        return new JsonResponse([
            'success' => "0",
            'message' => "Gagal Mendaftarkan email newslettter"
        ]);
    }

    /**
     * @Route("/service/provinsi/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function provinsiListJsonAction()
    {
        $data = new Province\Listing();
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/city/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function cityListJsonAction(Request $request)
    {
        $id = $request->get('id');

        if($id == null){
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }

        $data = new City\Listing();
        $data->setCondition('ProvinceCode = '.$id);
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/kecamatan/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kecamatanListJsonAction(Request $request)
    {
        $id = $request->get('id');
        if($id == null){
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }
        $data = new Kecamatan\Listing();
        $data->setCondition('CityCode = '.$id);
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/kelurahan/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kelurahanListJsonAction(Request $request)
    {
        $id = $request->get('id');
        if($id == null){
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }
        $data = new Kelurahan\Listing();
        $data->setCondition('KecamatanCode = '.$id);
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $temp['postcode'] = $item->getPostCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/brandmobil/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function brandMobilListJsonAction()
    {
        $data = new Brand\Listing();
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/brandmotor/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function brandMotorListJsonAction()
    {
        $data = new Brand\Listing();
        $id = "2";
        $data->setCondition('Tipe = '.$id);
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getId();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/brandproduct/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function brandproductListJsonAction(Request $request)
    {
        $id = $request->get('id');
        if($id == null){
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }
        $data = new BrandProduct\Listing();
        $data->setCondition('Brand__id = '.$id);
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['codeProduct'] = $item->getCodeProduct();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }
}
