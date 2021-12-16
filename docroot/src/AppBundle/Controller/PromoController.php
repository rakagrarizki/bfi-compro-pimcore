<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\Promo;
use Symfony\Component\HttpFoundation\Request;

use Pimcore\Model\DataObject\PromoCategory;

class PromoController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        $category = htmlentities($request->get("category"));

        $page = htmlentities(addslashes($request->get("page")));

        $promoCategories = new PromoCategory\Listing();

        $promos = new Promo\Listing();
        if($category != ""){
            $promos->addConditionParam("PromoCategory__id = ?", $category,'AND');
        }
        $promos->addConditionParam("PromoEndDate > ?",time(),'AND');
        $promos->setOrderKey("o_creationDate");
        $promos->setOrder("desc");

        $paginator = new \Zend\Paginator\Paginator($promos);
        $paginator->setCurrentPageNumber( $page );
        $paginator->setItemCountPerPage(9);

        $this->view->promoCategories = $promoCategories;
        $this->view->paginator = $paginator;

    }
    public function detailAction(Request $request){
        $slug = htmlentities(addslashes($request->get("slug")));

        $promo = Promo::getBySlug($slug,["limit"=>1]);
        $this->view->promo = $promo;

    }
}
