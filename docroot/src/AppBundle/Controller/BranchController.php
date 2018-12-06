<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\BranchOffice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class BranchController extends FrontendController
{
    public function defaultAction(Request $request)
    {

    }

    /**
     * @Route("/branch/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function branchListJsonAction()
    {
        $branch = new BranchOffice\Listing();
        $maps = [];
        if ($branch) {
            foreach ($branch as $item) {
                $temp['name'] = $item->getName();
                $temp['address'] = $item->getAddress();
                $temp['telephone'] = $item->getTelephone();
                $temp['latitude'] = $item->getMap() ? $item->getMap()->getLatitude() : '';
                $temp['longitude'] = $item->getMap() ? $item->getMap()->getLongitude() : '';
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/branch/export")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function branchExportAction()
    {
        $parent = DataObject::getByPath("/Branch");

        if ($parent == null) {
            die("/Branch path not found");
        }

        $file = new \SplFileObject(PIMCORE_TEMPORARY_DIRECTORY . "/branchdocument2.csv");
        dump("aaa");
        dump($file);
        dump($file->eof());
        exit;

        while ($file->eof()) {
            $data = $file->fgetcsv();

            dump($data);

            //list($name, $address, $map) = $data;

            /*$key = \Pimcore\File::getValidFilename($name . "-" . $city);
            $marketingOffice = new DataObject\BranchOffice();
            $marketingOffice->setParent($parent);
            $marketingOffice->setKey($key);
            $marketingOffice->setPublished(true);
            $marketingOffice->setName($name);
            $marketingOffice->setAddress($address);
            $map = new DataObject\Data\Geopoint();
            $map->setLatitude($lat);
            $map->setLongitude($long);

            $marketingOffice->setMap($map);
            try {
                $marketingOffice->save();
                echo "Succes save " . $name . "\n";
            } catch (\Exception $exception) {
                echo "Failed save " . $name . " because " . $exception->getMessage() . "\n";
            }*/

        }
        exit;
    }
}
