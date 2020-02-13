<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:44
 */

namespace AppBundle\Document\Areabrick;
use Pimcore\Model\DataObject;
use Pimcore\Model\Document\Tag\Area\Info;
use Symfony\Component\HttpFoundation\Request;

class BfiBlogNews extends AbstractAreabrick
{
    public function action(Info $info){
        $request = Request::createFromGlobals();
        
        $page = $request->server->get('REQUEST_URI');

        if ($page == "/" || $page == "/en" || $page == "/id") {
            $news = new DataObject\BlogArticle\Listing();
        } else {
            $news = new DataObject\News\Listing();
        }

        $news->setLimit(3);
        $info->getView()->news = $news;
    }
}
