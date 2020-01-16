<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProfileController extends FrontendController
{
    public function defaultAction(Request $request)
    {
    }

    public function profileAction(Request $request)
    {
    }

    public function detailKontrakAction(Request $request)
    {
        $contract_number = htmlentities(addslashes($request->get("contract_number")));

        if (!$contract_number) {
            throw new NotFoundHttpException('Not found');
        }
    }
}
