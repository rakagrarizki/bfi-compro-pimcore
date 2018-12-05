<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject\BranchOffice;

class BranchController extends FrontendController
{
    public function defaultAction(Request $request)
    {

    }

    public function branchListJsonAction()
    {
        $branch = new BranchOffice\Listing();
        $maps = [];
        if ($branch) {
            foreach ($branch as $item) {
                $temp['name'] = $item->getName();
                $temp['address'] = $item->getAddress();
                $temp['telephone'] = $item->getTelephone();
                $temp['latitude'] = $item->getMap() ? $item->getMap()->getLatitude() : '';
                $temp['longitude'] = $item->getMap() ? $item->getMap()->getLongitude() : '';
                $maps['data'][] = $temp;
            }
        }
        $this->_helper->json(['success' => true, 'result' => $maps]);
    }
}
