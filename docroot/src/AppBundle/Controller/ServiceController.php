<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Kecamatan;
use Pimcore\Model\DataObject\Kelurahan;
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
        $data->setCondition('City__id = '.$id);
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
        $data->setCondition('Kecamatan__id = '.$id);
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
     * @Route("/service/provinsi/export")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function provinsiExportAction()
    {
        $parent = DataObject::getByPath("/Provinsi");

        if ($parent == null) {
            die("/Provinsi path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/provinces.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name);
            $data = new DataObject\Province();
            $data->setParent($parent);
            $data->setKey($key);
            $data->setPublished(true);
            $data->setCode($no);
            $data->setName($name);
            try {
                $data->save();
                echo "Succes save " . $name . "\n";
            } catch (\Exception $exception) {
                echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
            }

        }
        exit;
    }

    /**
     * @Route("/service/kota/export")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kotaExportAction()
    {
        $parent = DataObject::getByPath("/Kota");

        if ($parent == null) {
            die("/Kota path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/kota.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $no2, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name);
            $data = new DataObject\City();
            $data->setParent($parent);
            $data->setKey($key);
            $data->setPublished(true);
            $data->setName($name);
            $data->setCode($no);
            $data->setProvinceCode($no2);
            try {
                $data->save();
                echo "Succes save " . $name . "\n";
            } catch (\Exception $exception) {
                echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
            }

        }
        exit;
    }

    /**
     * @Route("/service/kecamatan/export")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kecamatanExportAction()
    {
        $parent = DataObject::getByPath("/Kecamatan");

        if ($parent == null) {
            die("/Kecamatan path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/kecamatan.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $no2, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name);
            $data = new DataObject\Kecamatan();
            $data->setParent($parent);
            $data->setKey($key);
            $data->setPublished(true);
            $data->setName($name);
            $data->setCode($no);
            $data->setCityCode($no2);
            try {
                $data->save();
                echo "Succes save " . $name . "\n";
            } catch (\Exception $exception) {
                echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
            }

        }
        exit;
    }

    /**
     * @Route("/service/kelurahan/export")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kelurahanExportAction()
    {
        $parent = DataObject::getByPath("/Kelurahan");

        if ($parent == null) {
            die("/Kelurahan path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/kelurahan.csv");


        while (!$file->eof() && ($row = $file->fgetcsv(",")) && $row[0] !== null) {

            list($no, $no2, $name) = $row;

            $key = \Pimcore\File::getValidFilename($name);
            $data = new DataObject\Kelurahan();
            $data->setParent($parent);
            $data->setKey($key);
            $data->setPublished(true);
            $data->setName($name);
            $data->setCode($no);
            $data->setKecamatanCode($no2);
            try {
                $data->save();
                echo "Succes save " . $name . "\n";
            } catch (\Exception $exception) {
                echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
            }

        }
        exit;
    }


}
