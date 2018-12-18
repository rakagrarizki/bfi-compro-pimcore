<?php 

return [
    1 => [
        "id" => 1,
        "name" => "send Credit Mobil",
        "pattern" => "/\\/credit\\/send-mobil/",
        "reverse" => "/credit/send-mobil",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "sendMobil",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1544186385,
        "modificationDate" => 1544186552
    ],
    2 => [
        "id" => 2,
        "name" => "send Credit Motor",
        "pattern" => "/\\/credit\\/send-motor/",
        "reverse" => "/credit/send-motor",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "sendMotor",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1544186404,
        "modificationDate" => 1544186557
    ],
    3 => [
        "id" => 3,
        "name" => "send Credit Rumah",
        "pattern" => "/\\/credit\\/send-rumah/",
        "reverse" => "/credit/send-rumah",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "sendRumah",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1544186417,
        "modificationDate" => 1544186561
    ],
    5 => [
        "id" => 5,
        "name" => "Request OTP",
        "pattern" => "/\\/otp\\/send-otp/",
        "reverse" => "/otp/send-otp",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "sendOtpRequest",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1544186491,
        "modificationDate" => 1544186565
    ],
    6 => [
        "id" => 6,
        "name" => "Validate OTP",
        "pattern" => "/\\/otp\\/validate-otp/",
        "reverse" => "/otp/validate-otp",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "sendOtpValidate",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1544186567,
        "modificationDate" => 1544186596
    ]
];