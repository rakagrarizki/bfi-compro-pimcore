<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject\Manajemen;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class ManagementController extends FrontendController
{
    public function defaultAction(Request $request)
    {
//        $level = $this->document->getProperty("level");
//        $page = $request->get("page",1);
//        $managements = "";
//        if($level){
//            $managements = new Manajemen\Listing();
//            $managements->addConditionParam("Level__id == ? ", $level->getId(),"AND");
//            $managements->load();
//
//        }
//        $this->view->data = $managements;


    }
    /**
     * @Route("/management/get-detail")
     * @Method({"GET"})
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function getDetailAction(Request $request){
        $id = htmlentities(addslashes($request->get("id")));
        $lang = htmlentities($request->get("lang"));

        $data = Manajemen::getById($id);
        $allData = [];
        if($data){
            $allData = ["id" => $data->getId(),
                "Nama"=> $data->getNama(),
                "Jabatan" => $data->getJabatan(),
                "Biodata" => $data->getBiodata($lang),
                "RiwayatKerja" => $data->getRiwayatkerja($lang),
                "RiwayatPekerjaan" =>$data->getRiwayatPendidikan($lang),
                "Image" => $data->getImage()->getFullPath()];

        }

        $response = new JsonResponse([
            "status" => 1,
            "message" => "success",
            "data" => $allData

        ]);
        return $response;
    }
}
