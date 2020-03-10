<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        $lang = $request->getLocale();
        if ($_COOKIE['customer'] != null || $_COOKIE['customer'] != "") {
            header("Location: ". BASEURL . "/{$lang}/user/dashboard");
        } else {
            $page = $_SERVER['REQUEST_URI'];
            if (preg_match("/.\/service-contract/", $page)) {
                $trans1 = $this->get("translator")->trans('welcome-login-kontrak');
                $trans2 = $this->get("translator")->trans('welcome-login-sub-kontrak');
            } else if (preg_match("/.\/service-status/", $page)) {
                $trans1 = $this->get("translator")->trans('welcome-login-status');
                $trans2 = $this->get("translator")->trans('welcome-login-sub-status');
            } else {
                $trans1 = $this->get("translator")->trans('welcome-login');
                $trans2 = $this->get("translator")->trans('welcome-login-sub');
            }
            $this->view->trans1 = $trans1;
            $this->view->trans2 = $trans2;
        }
    }
}
