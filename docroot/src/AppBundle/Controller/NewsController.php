<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\News;
use Symfony\Component\HttpFoundation\Request;

use Pimcore\Model\DataObject\NewsCategory;

class NewsController extends FrontendController
{

    public function defaultAction(Request $request)
    {
        $category = htmlentities(addslashes($request->get("category")));
        $page = htmlentities(addslashes($request->get("page")));

        $newsCategories = new NewsCategory\Listing();

        $news = new News\Listing();
        if($category != ""){
            $news->setCondition("Category__id = ?", $category);
        }
        $news->setOrderKey("Date");
        $news->setOrder("desc");

        $paginator = new \Zend\Paginator\Paginator($news);
        $paginator->setCurrentPageNumber( $page );
        $paginator->setItemCountPerPage(9);

        $this->view->newsCategories = $newsCategories;
        $this->view->paginator = $paginator;

    }

    public function detailAction(Request $request){


        $slug = htmlentities(addslashes($request->get("slug")));

        $news = News::getBySlug($slug,["limit"=>1]);

        $totalViews = $news->getViews() + 1;
        $news->setViews($totalViews);
        $news->save();

        $this->view->news = $news;


        if($news->getCategory()) {
            $relatedNews = new News\Listing();
            $relatedNews->addConditionParam("Category__id = ?",$news->getCategory()->getId(),"AND");
            $relatedNews->addConditionParam("oo_id != ?", $news->getId(),"AND");
            $relatedNews->setLimit(4);
            $this->view->relatedNews = $relatedNews;
        }



    }
}
