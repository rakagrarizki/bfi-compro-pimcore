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

class BfiBlogNews extends AbstractAreabrick
{
    public function action(Info $info){
        $news = new DataObject\BlogArticle\Listing();

        $news->setLimit(3);
        $info->getView()->news = $news;
    }
}
