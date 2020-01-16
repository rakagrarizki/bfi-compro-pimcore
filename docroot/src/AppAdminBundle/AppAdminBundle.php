<?php

namespace AppAdminBundle;

use Pimcore\Extension\Bundle\AbstractPimcoreBundle;

class AppAdminBundle extends AbstractPimcoreBundle
{
    public function getEditmodeJsPaths()
    {
        return [
            '/bundles/appadmin/js/editmode.js'
        ];
    }
}
