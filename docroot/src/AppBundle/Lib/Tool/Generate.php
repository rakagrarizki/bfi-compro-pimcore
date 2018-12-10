<?php
/**
 * Created by PhpStorm.
 * User: yanni
 * Date: 5/15/2017
 * Time: 13:50
 */

namespace Website\Tool;

class Generate
{
    static function builQueryString()
    {
        $blockedRequestParams = ["controller", "action", "module", "document"];
        $front = \Zend_Controller_Front::getInstance();
        $requestParameters = $front->getRequest()->getParams();
        // remove blocked parameters from request
        foreach ($blockedRequestParams as $key) {
            if (array_key_exists($key, $requestParameters)) {
                unset($requestParameters[$key]);
            }
        }

        $string = array_toquerystring($requestParameters);
        return $string;
    }
}