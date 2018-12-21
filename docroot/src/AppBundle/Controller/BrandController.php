<?php

namespace AppBundle\Controller;

use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Brand;
use Pimcore\Model\DataObject\BrandProduct;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class BrandController extends FrontendController
{
    public function defaultAction(Request $request)
    {

    }

    /**
     * @Route("/brand/mobil/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function mobilListJsonAction()
    {
        $id = "1";
        $data = new Brand\Listing();
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
     * @Route("/brand/motor/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function motorListJsonAction()
    {

        $id = "2";
        $data = new Brand\Listing();
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
     * @Route("/brand/product/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function productListJsonAction(Request $request)
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
