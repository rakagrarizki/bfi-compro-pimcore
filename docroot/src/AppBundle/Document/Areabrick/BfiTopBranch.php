<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 03/12/18
 * Time: 17:44
 */

namespace AppBundle\Document\Areabrick;
use Pimcore\Model\DataObject\BranchOffice;
use Pimcore\Model\Document\Tag\Area\Info;

class BfiTopBranch extends AbstractAreabrick
{
    public function action(Info $info){
        $branch = new BranchOffice\Listing();
        $branch->setLimit(3);
        $branch->setOrderKey("date");
        $branch->setOrder("desc");

        $info->getView()->branch = $branch;
    }

}
