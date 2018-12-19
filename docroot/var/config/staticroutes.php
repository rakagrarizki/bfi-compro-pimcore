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
    ],
    7 => [
        "id" => 7,
        "name" => "Newsletter",
        "pattern" => "/\\/register\\/newsletter/",
        "reverse" => "/register/newsletter",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\ServiceController",
        "action" => "registerNewsletter",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1545192991,
        "modificationDate" => 1545193045
    ],
    8 => [
        "id" => 8,
        "name" => "get price",
        "pattern" => "/\\/credit\\/get-price/",
        "reverse" => "/credit/get-price",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "getPrice",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1545204832,
        "modificationDate" => 1545204960
    ],
    9 => [
        "id" => 9,
        "name" => "get loan",
        "pattern" => "/\\/credit\\/get-loan/",
        "reverse" => "/credit/get-loan",
        "module" => "AppBundle",
        "controller" => "@AppBundle\\Controller\\CreditController",
        "action" => "sendLoanData",
        "variables" => NULL,
        "defaults" => NULL,
        "siteId" => [

        ],
        "priority" => 0,
        "legacy" => FALSE,
        "creationDate" => 1545204967,
        "modificationDate" => 1545204998
    ]
];
