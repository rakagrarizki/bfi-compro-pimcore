<?php
/**
 * Created by PhpStorm.
 * User: salt
 * Date: 07/12/18
 * Time: 13:11
 */

namespace AppBundle\Service;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Logger;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpFoundation\JsonResponse;

class SendApiDummy
{
    public function executeApi($name, $url, $params, $method)
    {
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(PIMCORE_LOG_DIRECTORY . DIRECTORY_SEPARATOR .date('d') . date('m') . date("Y") ."-".$name.".log"), Logger::DEBUG);
        $stack = HandlerStack::create();
        $stack->push(Middleware::log(
            $logger,
            new MessageFormatter('{url} - {req_body} - {res_body}')
        ));
        //$credentials = base64_encode('userapi.bfi.co.id:D1g1t4l4p1');

        $client = new Client([
            "base_uri" => $url,
            "verify" => false,
            'handler' => $stack,
            'auth' => ['userapi.bfi.co.id', 'D1g1t4l4p1']
        ]);



        try {
            $data = $client->request($method, $url, [
                "json" => $params
            ]);

        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }

        return $this->getData($data);
    }

    public function requestOtp($handphone)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host.WebsiteSetting::getByName('URL_REQUEST_OTP')->getData();
        $params["phone_number"] = $handphone;
        //$params["first_name"] = $name;

        return $this->executeApi('api-request-otp', $url, $params,"POST");
    }

    public function validateOtp($handphone, $code)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host. WebsiteSetting::getByName('URL_VALIDATE_OTP')->getData();
        $params["phone_number"] = $handphone;
        $params["otp_code"] = $code;

        return $this->executeApi('api-validate-otp', $url, $params,"POST");
    }

    public function register($url, $params){
        return $this->executeApi('register', $url, $params,"POST");
    }

    public function sendDataCredit($url, $params)
    {
        return $this->executeApi('api-credit', $url, $params,"POST");
    }

    public function sendNewsletter($url, $params)
    {
        return $this->executeApi('api-newsletter', $url, $params,"POST");
    }

    public function getPriceCar($url, $params)
    {
        return $this->executeApi('api-price-car', $url, $params,"POST");
    }

    public function getBrand($url, $params)
    {
        return $this->executeApi('api-brand-product', $url, $params,"POST");
    }

    public function getCodeProduct($url, $params)
    {
        return $this->executeApi('api-code-product', $url, $params,"POST");
    }

    public function getBranchName($url, $params)
    {
        return $this->executeApi('api-branch-name', $url, $params,"POST");
    }

    public function getBranch($url)
    {
        $client = new Client([
            "base_uri" => $url,
            "verify" => false
        ]);

        try {
            $data = $client->request("POST", $url);

        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }

        return $this->getData($data);
    }

    public function getLoan($url, $params)
    {
        return $this->executeApi('api-loan', $url, $params,"POST");
    }

    public function getProductCategory($url){

        return $this->executeApi('api-product-category', $url,[],"GET");
    }

    public function getProduct($url, $params){

        return $this->executeApi('api-product', $url,$params,"POST");
    }

    public function getData($data)
    {
        return json_decode($data->getBody());
    }

    public function getTenor($url, $params)
    {
        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                ["tenor"=> 12,
                    "desc"=> "12 Bulan"
                ],
                ["tenor"=> 36,
                    "desc"=> "36 Bulan"
                ],
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;

    }

    public function getInsurance($url, $params)
    {
        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "count"=> "3",
                        "insurance_list" => [
                            0 => [
                                ["id"=> "67E91332-E5B2-4ED2-9126-2BB828B00F82",
                                "desc"=>"Total Lost only",
                                "is_only"=>false],
                                ["id"=> "F8D301F8-7045-4DA9-9EB8-EC8DE6E92855",
                                    "desc"=>"All Risk",
                                    "is_only"=>false ]
                            ],
                            1 => [
                                ["id"=> "67E91332-E5B2-4ED2-9126-2BB828B00F82",
                                "desc"=>"Total Lost only",
                                "is_only"=>false ],
                                ["id"=> "F8D301F8-7045-4DA9-9EB8-EC8DE6E92855",
                                    "desc"=>"All Risk",
                                    "is_only"=>false ]
                            ],
                            2 => [
                                ["id"=> "67E91332-E5B2-4ED2-9126-2BB828B00F82",
                                "desc"=>"Total Lost only",
                                "is_only"=>false],
                                ["id"=> "F8D301F8-7045-4DA9-9EB8-EC8DE6E92855",
                                    "desc"=>"All Risk",
                                    "is_only"=>false ]
                            ],
                        ]
                      ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;

    }
    public function getProvince($url){

        //return $this->executeApi('api-province', $url,[],"GET");
//        return new JsonResponse([
//                'success' => "0",
//                'message' => "Service Request Province Down"
//            ]);
        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "EA12EA20-40ED-466F-9A3B-94067C55580F",
                        "desc"=> "DKI Jakarta"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getCity($url,$params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "5F28B2A1-1968-4251-B52A-0179B1017AD9",
                "desc"=> "Palmerah"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getDistrict($url,$params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "F1B6255F-7571-4C4B-A5BB-1F826BFFB1EC",
                "desc"=> "Jakarta Barat"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getSubdistrict($url,$params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "141D34C3-784D-4E21-82B2-23BB2EF61A24",
                "desc"=> "Kota Bambu Utara"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getZipcode($url,$params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "0706E029-23DE-47FE-99DE-1C604B9D03ED",
                "desc"=> "11420"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getCar($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "72D6FB87-10FC-4316-ABEC-45A48D725328",
                "desc"=> "Sedan"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getCarBrand($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "6A939796-1738-4CF5-B6E5-C02550CB9ABD",
                "desc"=> "MERCEDES"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getCarModel($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "18F4F1C0-4A69-4727-8D40-1F83F7708E2D",
                "desc"=> "MERCEDESBENZ C 200 ELEGANCE 2.0 AT"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getCarYear($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "A6524ACC-EFBA-4B71-A88E-DDD990D7C305",
                "desc"=> "2018"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getCarFunding($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "minimum_funding"=> 10000000,
                        "maximum_funding"=> 34400000]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getCarCalculate($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "monthly_installment"=> 450500,
                        "monthly_insurance"=> 101500,
                        "monthly_installment_est_total" => 552000
                    ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveCarLeads1($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_custumer_id"=> "9F3E1CFC-FE88-4DD4-98DD-FCE02F38104E",
                        "submission_id"=> "E5062BE5-D8B1-4CF1-AB6F-9763BF0B2550"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveCarLeads2($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_address_id"=> "647AF464-93D0-4708-9903-1A744915D305",
                        "submission_id"=> "24477359-0469-4811-AA6A-7CB26E81CF38"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveCarLeads3($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [  "submission_id"=> "24477359-0469-4811-AA6A-7CB26E81CF38"]

        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveCarLeads4($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "24477359-0469-4811-AA6A-7CB26E81CF38"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveCarLeads5($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "24477359-0469-4811-AA6A-7CB26E81CF38"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function saveCarLeads6($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "24477359-0469-4811-AA6A-7CB26E81CF38"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getMotorcycle($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "D2962CBA-E4C6-404A-ADDD-2A962D12329F",
                "desc"=> "Bebek"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getMotorcycleBrand($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "84DB5FD8-43B2-4FA4-BA0F-414D9960600A",
                "desc"=> "HONDA"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getMotorcycleModel($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "3F2F23BC-658E-4FAC-B2FD-00B54420C69E",
                "desc"=> "NEW PCX 150"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getMotorcycleYear($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "26A00859-9825-4562-89ED-7C3BF717E640",
                "desc"=> "2018"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getMotorcycleFunding($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "minimum_funding"=> 1000000,
                "maximum_funding"=> 17956250]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getMotorcycleTenor($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                        ["tenor"=> 6,
                        "desc"=> "6 Bulan"
                        ],
                        ["tenor"=> 12,
                            "desc"=> "12 Bulan"
                        ],
                        ["tenor"=> 36,
                            "desc"=> "36 Bulan"
                        ],
                      ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMotorcycleCalculate($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "monthly_installment_est_total"=> 219500]

        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMotorcycleLeads1($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_custumer_id"=> "2E02E3B3-4A77-4BF0-9F8C-72929B2FFDF3",
                "submission_id"=> "344830B5-C50A-48CD-91FE-4F7AAF8670B3"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMotorcycleLeads2($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_address_id"=> "6C015215-C722-4DC7-B752-A9B2D4DF1AF3",
                "submission_id"=> "E18245C6-7FBE-4B49-8D7E-F42ECC27FB72"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMotorcycleLeads3($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "E18245C6-7FBE-4B49-8D7E-F42ECC27FB72"]

        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMotorcycleLeads4($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "E18245C6-7FBE-4B49-8D7E-F42ECC27FB72"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMotorcycleLeads5($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "E18245C6-7FBE-4B49-8D7E-F42ECC27FB72"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function saveMotorcycleLeads6($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "E18245C6-7FBE-4B49-8D7E-F42ECC27FB72"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getProfession($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                    ["id"=> "F8AC5539-B18A-4981-8192-DA89E59C0686",
                     "desc"=> "Pengusaha"],
                    ["id"=> "C8BE940A-820B-4CA7-BB75-E349197C1ED9",
                        "desc"=> "Karyawan"],
                    ["id"=> "79991814-2410-4E49-8281-FE985B8836CF",
                    "desc"=> "Profesional"]
                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getPbfCertificateType($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                    ["id"=> "1A6398BA-ED4F-4797-87A1-2C9F768A855D",
                        "desc"=> "Sertifikat Hak Satuan Rumah Susun"],
                    ["id"=> "18E7E7C2-75D3-4E70-82CB-4130721623E7",
                        "desc"=> "Akta Jual Beli"],
                    ["id"=> "D33CDEFA-6CBF-4094-BC05-A2EEC82F4C1A",
                        "desc"=> "Girik"]
                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getPbfCertificateOnBehalf($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                    ["id"=> "9FAD3E3A-B187-48BE-BC50-41A8E3D5553C",
                        "desc"=> "Orang Lain"],
                    ["id"=> "D50B7418-A880-4B68-98BE-D927CE62620F",
                        "desc"=> "Diri Sendiri"],
                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getPbfPropertyType($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                    ["id"=> "F7FEAB3C-0246-4272-8677-A3DC614A1DFE",
                        "desc"=> "Rumah"],
                    ["id"=> "4842DC25-4E02-4910-9AC1-E87AC183BAAE",
                        "desc"=> "Ruko"],
                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function getPbfFunding($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "minimum_funding"=> 10000000,
                "maximum_funding"=> 500000000]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getPbfTenor($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                    ["tenor"=> 12,
                        "desc"=> "12 Bulan"
                    ],
                    ["tenor"=> 36,
                        "desc"=> "36 Bulan"
                    ],
                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getPbfCalculate($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "monthly_installment_est_total"=> 5139000]

        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function savePbfLeads1($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_custumer_id"=> "D30205D7-948B-4F39-A27C-E735714740A8",
                "submission_id"=> "9888DF0C-7CA6-4E7F-AD04-2F24355090D1"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function savePbfLeads2($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_address_id"=> "88A339A8-9A4B-4D93-B9DB-504703CFDE01",
                "submission_id"=> "BA99B456-3E2A-4787-BD79-1AC178D34338"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function savePbfLeads3($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "BA99B456-3E2A-4787-BD79-1AC178D34338"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function savePbfLeads4($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "BA99B456-3E2A-4787-BD79-1AC178D34338"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function savePbfLeads5($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "BA99B456-3E2A-4787-BD79-1AC178D34338"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function savePbfLeads6($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "BA99B456-3E2A-4787-BD79-1AC178D34338"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    //Leisure
    public function getLeisurePackage($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "minimum_funding"=> 3000000,
                "maximum_funding"=> 40000000]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getLeisureTenor($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                    ["tenor"=> 12,
                        "desc"=> "12 Bulan"
                    ],
                    ["tenor"=> 36,
                        "desc"=> "36 Bulan"
                    ],
                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getLeisureProvisionPackage($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "down_payment_min"=> 1800000,
                "pocket_money_max"=> 3600000]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function leisureCalculator($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "total_funding"=> 40944000,
                "pocket_money"=> 4000000,
                "monthly_installment" => 6860000,
                "life_insurance" => 91000,
                "monthly_installment_est_total" => 7351000
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveLeisureLeads1($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_custumer_id"=> "9B332AB2-49D3-4FBC-BBF4-8ED9CB13510E",
                "submission_id"=> "9014818F-329D-4E4F-A73E-FBBE6678F088"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveLeisureLeads2($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_address_id"=> "56FD2FE5-D234-46BA-BAA5-67595A5FFA9E",
                "submission_id"=> "9014818F-329D-4E4F-A73E-FBBE6678F088"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveLeisureLeads3($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "9014818F-329D-4E4F-A73E-FBBE6678F088"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveLeisureLeads4($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "9014818F-329D-4E4F-A73E-FBBE6678F088"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveLeisureLeads5($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "9014818F-329D-4E4F-A73E-FBBE6678F088"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    //Education
    public function getEduPackage($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "minimum_funding"=> 2000000,
                "maximum_funding"=> 40000000]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getEduTenor($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                ["tenor"=> 3,
                    "desc"=> "3 Bulan"
                ],
                ["tenor"=> 6,
                    "desc"=> "6 Bulan"
                ],
                ["tenor"=> 12,
                    "desc"=> "12 Bulan"
                ],

                ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getEduProvisionPackage($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "down_payment_min"=> 1800000]

        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function eduCalculator($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "total_funding"=> 16820500,
                "monthly_installment"=> 2583000,
                "life_insurance"=>37000,
                "monthly_installment_est_total" => 3020000
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveEduLeads1($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_custumer_id"=> "C4A18D41-E1A7-4078-9A90-870C46590B30",
                "submission_id"=> "357351FE-E470-4B6A-AD57-7609D926AFA9"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveEduLeads2($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_address_id"=> "34D2D46F-C16E-4336-9006-412BD6D40667",
                "submission_id"=> "357351FE-E470-4B6A-AD57-7609D926AFA9"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveEduLeads3($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "357351FE-E470-4B6A-AD57-7609D926AFA9"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveEduLeads4($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "357351FE-E470-4B6A-AD57-7609D926AFA9"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveEduLeads5($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "357351FE-E470-4B6A-AD57-7609D926AFA9"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    //Machinery
    public function getMachineryServices($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                [ "id"=> "6D768F84-BB5A-4A64-87ED-01277EDCD27C",
                    "desc"=> "Machinery Financing"],
                [ "id"=> "EB35DB4F-07E2-4891-83F8-CC94AC4B1962",
                    "desc"=> "Machinery Refinancing"],
                [ "id"=> "EB35DB4F-07E2-4891-83F8-CC94AC4B1963",
                    "desc"=> "Heto Financing"],
                [ "id"=> "EB35DB4F-07E2-4891-83F8-CC94AC4B1964",
                    "desc"=> "Heto Refinancing"]
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryIndustry($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                [ "id"=> "8C4CF124-E129-4BD7-AAD6-018928A0BC2E",
                    "desc"=> "Pertanian - Penggilingan Padi"],
                [ "id"=> "96A6A01D-788C-48B6-A49B-05EBFE873AC8",
                    "desc"=> "Households (Private Warehouse)"],

            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryType($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [

                [
                    "id"=> "F536F5D8-D5CE-42E7-BA02-00E3321984A8",
                    "desc"=> "Digital Printing Large Format Uv Lef"
                ],
                [
                    "id"=> "DB7D3657-CF15-4E9C-A7D0-015211635B3E",
                    "desc"=> "Digital Printing Large Format Jfx"
                ]
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryBrand($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                [
                    "id"=> "62E39C6E-A895-44BC-A229-062A443047D5",
                    "desc"=> "Kotung"
                ],
                [
                    "id"=> "5ACFB5A2-F390-4F26-BF4B-0799531E910C",
                    "desc"=> "Mutoh"
                ]
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryModel($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                [
                    "id"=> "7EA5CCF9-2738-4C74-845B-0042CEF2A351",
                    "desc"=> "size : 20"
                ],
                [
                    "id"=> "E5034736-F708-44E3-AF9F-4209401D4BC7",
                    "desc"=> "size : 20 - Deskripsi : Versa Studio"
                ]
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryYear($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "id"=> "5BD13C25-2AEC-459E-A5CD-FB1B8AC0EFBE",
                "year"=> "2019"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryFunding($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "935B0633-7466-433F-BA54-1E29D433E8D8",
                "funding_min"=> 50000000,
                "funding_max"=> 75000000,
                "down_payment_min" =>50000000,
                'down_payment_max'=>112500000
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function getMachineryTenor($url){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [
                ["tenor"=> 12,
                    "desc"=> "12 Bulan"
                ],
                ["tenor"=> 36,
                    "desc"=> "36 Bulan"
                ],
            ]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function machineryCalculate($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "monthly_installment_est_total"=> 42041000]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMachineryLeads1($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_custumer_id"=> "1B4F3267-D54D-4C9B-8AD6-C5FAF05F1C81",
                "submission_id"=> "162B8214-9FB9-492E-9AED-F52CC1F9C756"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMachineryLeads2($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_address_id"=> "3EF9D783-BEB1-4DE7-B031-449C5162FCB1",
                "submission_id"=> "162B8214-9FB9-492E-9AED-F52CC1F9C756"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMachineryLeads3($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "162B8214-9FB9-492E-9AED-F52CC1F9C756"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMachineryLeads4($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "162B8214-9FB9-492E-9AED-F52CC1F9C756"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }

    public function saveMachineryLeads5($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "162B8214-9FB9-492E-9AED-F52CC1F9C756"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }
    public function saveMachineryLeads6($url, $params){

        $data = [
            'header' => [
                "status" => "200",
                "message" => "success to fetch data"
            ],
            'status' => "success",
            'data' => [ "submission_id"=> "162B8214-9FB9-492E-9AED-F52CC1F9C756"]
        ];
        $result = json_encode($data);
        $decode = json_decode($result);

        return $decode;
    }



}
