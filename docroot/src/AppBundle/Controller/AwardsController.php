<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Penghargaan;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class AwardsController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        $page = $request->get("page",1);
        $managements = "";
        $awards = new Penghargaan\Listing();
        $awards->setOrderKey("Year");
        $awards->setOrder("desc");
        $awards->load();
        $paginator = new \Zend\Paginator\Paginator($awards);
        $paginator->setCurrentPageNumber( $page );
        $paginator->setItemCountPerPage(9);
        $this->view->paginator = $paginator;

    }

    public function detailAction(Request $request){
        $year = htmlentities(addslashes($request->get("year")));
        //dump($id);exit;
        $data = Penghargaan::getByYear($year, 1);

       $this->view->data = $data;
    }
}
