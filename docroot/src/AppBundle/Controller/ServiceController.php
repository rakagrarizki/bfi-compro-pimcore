<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Kecamatan;
use Pimcore\Model\DataObject\Kelurahan;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Province;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class ServiceController extends FrontendController
{
    public function defaultAction(Request $request)
    {

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
        $data->setCondition('Province__id = '.$id);
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
            $marketingOffice = new DataObject\Province();
            $marketingOffice->setParent($parent);
            $marketingOffice->setKey($key);
            $marketingOffice->setPublished(true);
            //$marketingOffice->setId($no);
            $marketingOffice->setName($name);
            try {
                $marketingOffice->save();
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
            $marketingOffice = new DataObject\City();
            $marketingOffice->setParent($parent);
            $marketingOffice->setKey($key);
            $marketingOffice->setPublished(true);
            $marketingOffice->setName($name);
            try {
                $marketingOffice->save();
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
            $marketingOffice = new DataObject\Kecamatan();
            $marketingOffice->setParent($parent);
            $marketingOffice->setKey($key);
            $marketingOffice->setPublished(true);
            $marketingOffice->setName($name);
            try {
                $marketingOffice->save();
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
            $marketingOffice = new DataObject\Kelurahan();
            $marketingOffice->setParent($parent);
            $marketingOffice->setKey($key);
            $marketingOffice->setPublished(true);
            $marketingOffice->setName($name);
            try {
                $marketingOffice->save();
                echo "Succes save " . $name . "\n";
            } catch (\Exception $exception) {
                echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
            }

        }
        exit;
    }


}
