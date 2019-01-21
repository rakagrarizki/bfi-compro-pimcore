<?php

namespace AppBundle\Controller;

use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\BrandProduct;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\SendApi;
use Pimcore\Model\WebsiteSetting;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BrandController extends FrontendController
{
    protected $sendAPI;

    protected $randomNumber;

    public function __construct(SendApi $sendAPI)
    {
        $this->sendAPI = $sendAPI;
        $this->randomNumber = rand(000001,999999);
    }

    public function defaultAction(Request $request)
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

    /**
     * @Route("/brand/product/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function productListJsonAction(Request $request)
    {
        $data = $this->getBranchBfi((string)$request->get('post_code'));
        $nameKota = $data[0]->branch;

        $param = [];
        $param['loan_type'] = (string)$request->get('tipe');
        $param['branch'] = $nameKota;

        $url = WebsiteSetting::getByName('URL_GET_CAR')->getData();

        try {
            $data = $this->sendAPI->getBrand($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Car Down"
            ]);
        }

        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Car Down"
            ]);
        }
        if ($data->data) {
            foreach ($data->data as $item) {
                $temp['name'] = $item->brand_name;
                $temp['id'] = $item->brand_name;
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }


    /**
     * @Route("/brand/detail/product/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function detailListJsonAction(Request $request)
    {
        $data = $this->getBranchBfi((string)$request->get('post_code'));
        $nameKota = $data[0]->branch;

        $param = [];
        $param['loan_type'] = (string)$request->get('tipe');
        $param['branch'] = $nameKota;
        $param['brand_name'] = (string)$request->get('brand');

        $url = WebsiteSetting::getByName('URL_GET_CAR')->getData();

        try {
            $data = $this->sendAPI->getCodeProduct($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Car Down"
            ]);
        }

        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Car Down"
            ]);
        }

        if ($data->data) {
            foreach ($data->data as $item) {
                $temp['name'] = $item->model;
                $temp['codeProduct'] = $item->model;
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/brand/year/product/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function yearListJsonAction(Request $request)
    {
        $data = $this->getBranchBfi((string)$request->get('post_code'));
        $nameKota = $data[0]->branch;

        $param = [];
        $param['loan_type'] = (string)$request->get('tipe');
        $param['branch'] = $nameKota;
        $param['brand_name'] = (string)$request->get('brand');
        $param['model'] = (string)$request->get('model');

        $url = WebsiteSetting::getByName('URL_GET_CAR')->getData();

        try {
            $data = $this->sendAPI->getCodeProduct($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Car Down"
            ]);
        }

        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Car Down"
            ]);
        }

        if ($data->data) {
            foreach ($data->data as $item) {
                $temp['year'] = $item->year;
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }


}
