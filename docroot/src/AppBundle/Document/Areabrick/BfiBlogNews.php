<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:44
 */

namespace AppBundle\Document\Areabrick;
use Pimcore\Model\DataObject\BlogArticle;
use Pimcore\Model\Document\Tag\Area\Info;

class BfiBlogNews extends AbstractAreabrick
{
    public function action(Info $info){
        $blog = new BlogArticle\Listing();

        $info->getView()->blog = $blog;
    }
}
