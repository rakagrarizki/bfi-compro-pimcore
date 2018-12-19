<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Kecamatan as Kecamatan;
use Pimcore\Model\DataObject\Kelurahan as Kelurahan;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Province;
use Pimcore\Model\WebsiteSetting;
use AppBundle\Service\SendApi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

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

        if($data == true){
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses"
            ]);
        }

        if($data->code == "413"){
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }

        return new JsonResponse([
            'success' => "0",
            'message' => "Gagal"
        ]);
    }

    /**
     * @Route("/service/delete/kelurahan")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kelurahanDeleteAction()
    {
        $kel = new Kelurahan\Listing();
        $kel->delete();
        return new JsonResponse([
            'success' => true
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
     * @Route("/service/areacode/export")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function areacodeExportAction()
    {
        $url = WebsiteSetting::getByName('URL_GET_BRANCH')->getData();

        $sendApi = new SendApi();
        try {
            $data = $sendApi->getBranch($url);
        } catch (\Exception $e) {
            echo "gagal connect";
        }

        if($data->code != 1){
            echo "gagal connect";
        }

        dump($data);

        exit;
    }
}
