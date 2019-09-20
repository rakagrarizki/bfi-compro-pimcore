<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Pimcore\Model\DataObject\BlogArticle;
use Symfony\Component\HttpFoundation\Request;

use Pimcore\Model\DataObject\BlogCategory;

class BlogController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        $category = htmlentities(addslashes($request->get("category")));

        $blogCategories = new BlogCategory\Listing();
        $blogCategories->load();

        $blogs = new BlogArticle\Listing();
        if($category != ""){
            $blogs->setCondition("BlogCategory__id = ?", $category);
        }
        $blogs->setOrderKey("Date");
        $blogs->setOrder("desc");
        $blogs->load();

        $this->view->blogCategories = $blogCategories;
        $this->view->blogs = $blogs;

    }
    public function detailAction(Request $request){
        $slug = htmlentities(addslashes($request->get("slug")));

        $blog = BlogArticle::getBySlug($slug,["limit"=>1]);
        $this->view->blog = $blog;


        if($blog->getBlogCategory()) {
            $relatedBlogs = new BlogArticle\Listing();
            $relatedBlogs->addConditionParam("BlogCategory__id = ?",$blog->getBlogCategory()->getId(),"AND");
            $relatedBlogs->addConditionParam("oo_id != ?", $blog->getId(),"AND");
            $relatedBlogs->load();
            $this->view->relatedBlogs = $relatedBlogs;
        }



    }
}
