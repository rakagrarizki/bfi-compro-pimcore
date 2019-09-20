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
        $category = htmlentities(addslashes($request->get("category")));

        $promoCategories = new PromoCategory\Listing();
        $promoCategories->load();

        $promos = new Promo\Listing();
        if($category != ""){
            $promos->setCondition("PromoCategory__id = ?", $category);
        }
        $promos->setCondition("PromoEndDate > ?",strtotime(date("Y-m-d")));
        $promos->load();

        $this->view->promoCategories = $promoCategories;
        $this->view->promos = $promos;

    }
    public function detailAction(Request $request){
        $slug = htmlentities(addslashes($request->get("slug")));

        $promo = Promo::getBySlug($slug,["limit"=>1]);
        $this->view->promo = $promo;

        if($promo->getPromoCategory()){
            $relatedPromos = new Promo\Listing();
            $relatedPromos->addConditionParam("PromoCategory__id = ?",$promo->getPromoCategory()->getId(),"AND");
            $relatedPromos->addConditionParam("oo_id != ?", $promo->getId(),"AND");
            $relatedPromos->load();
            $this->view->relatedPromos = $relatedPromos;
        }


    }
}
