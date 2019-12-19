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
use GuzzleHttp\RequestOptions;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\MessageFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FirePHPHandler;
use Monolog\Logger;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SendApi
{
    public function executeApi($name, $url, $params, $method)
    {
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(PIMCORE_LOG_DIRECTORY . DIRECTORY_SEPARATOR . date('d') . date('m') . date("Y") . "-" . $name . ".log"), Logger::DEBUG);
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

    public function executeApiBearer($name, $url, $params, $method, $token)
    {
        // $token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyRGF0YSI6eyJwaG9uZV9udW1iZXIiOiIwODkxMTg4MTgxOCIsIm90cF9jb2RlIjoiODQzNSIsImlzX2xvZ2luIjoxfSwiaWF0IjoxNTc1ODczODI1LCJleHAiOjE1NzU5NjAyMjV9.1Ls5s42eaZqDld4_HBPacmQWL1mJ86BJIj8bJC6DWVg";

        $client = new Client();

        try {
            $response = $client->request(
                $method,
                $url,
                [
                    RequestOptions::HEADERS => [
                        'Accept' => 'application/json',
                        'Authorization' => 'Bearer ' . $token['key'],
                    ],
                    "json" => $params
                ]
            );
        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }

        return $this->getData($response);
    }

    public function login($url, $params)
    {
        return $this->executeApi('login', $url, $params, "POST");
    }

    public function requestOtp($handphone)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_REQUEST_OTP')->getData();
        $params["phone_number"] = $handphone;
        //$params["first_name"] = $name;

        return $this->executeApi('api-request-otp', $url, $params, "POST");
    }

    public function validateOtp($handphone, $code)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_VALIDATE_OTP')->getData();
        $params["phone_number"] = $handphone;
        $params["otp_code"] = $code;

        return $this->executeApi('api-validate-otp', $url, $params, "POST");
    }

    public function loginRequestOtp($url, $params)
    {
        return $this->executeApi('otpRequest', $url, $params, "POST");
    }

    public function loginConfirmOtp($url, $params)
    {
        return $this->executeApi('otpConfirm', $url, $params, "POST");
    }

    public function verifyStatus($url, $params, $token)
    {
        return $this->executeApiBearer('verifyKtp', $url, $params, "GET", $token);
    }

    public function verifyEmailRequest($url, $params, $token)
    {
        return $this->executeApiBearer('verifyEmailRequest', $url, $params, "POST", $token);
    }

    public function verifyEmailConfirm($url, $params, $token)
    {
        return $this->executeApiBearer('verifyEmailConfirm', $url, $params, "POST", $token);
    }

    public function verifyNoKtp($url, $params, $token)
    {
        return $this->executeApiBearer('verifyNoKtp', $url, $params, "POST", $token);
    }

    public function logout($url, $params, $token)
    {
        return $this->executeApiBearer('logout', $url, $params, "POST", $token);
    }

    public function listAssignment($url, $params, $token)
    {
        return $this->executeApiBearer('listAssignment', $url, $params, "GET", $token);
    }

    public function listApplicationStep($url, $params, $token)
    {
        return $this->executeApiBearer('listApplicationStep', $url, $params, "GET", $token);
    }

    public function listApplicationStatus($url, $params, $token)
    {
        return $this->executeApiBearer('listApplicationStatus', $url, $params, "POST", $token);
    }

    public function listContractStatus($url, $params, $token)
    {
        return $this->executeApiBearer('listContractStatus', $url, $params, "POST", $token);
    }

    public function detailContract($url, $params, $token)
    {
        return $this->executeApiBearer('detailContract', $url, $params, "POST", $token);
    }

    public function detailContractTransaction($url, $params, $token)
    {
        return $this->executeApiBearer('detailContractTransaction', $url, $params, "POST", $token);
    }

    public function detailAgunanRumah($url, $params, $token)
    {
        return $this->executeApiBearer('detailAgunanRumah', $url, $params, "POST", $token);
    }

    public function detailAgunanMobil($url, $params, $token)
    {
        return $this->executeApiBearer('detailAgunanMobil', $url, $params, "POST", $token);
    }

    public function detailAgunanMotor($url, $params, $token)
    {
        return $this->executeApiBearer('detailAgunanMotor', $url, $params, "POST", $token);
    }

    public function detailAgunanAlatberat($url, $params, $token)
    {
        return $this->executeApiBearer('detailAgunanAlatberat', $url, $params, "POST", $token);
    }

    public function register($url, $params)
    {
        return $this->executeApi('register', $url, $params, "POST");
    }

    public function sendDataCredit($url, $params)
    {
        return $this->executeApi('api-credit', $url, $params, "POST");
    }

    public function sendNewsletter($url, $params)
    {
        return $this->executeApi('api-newsletter', $url, $params, "POST");
    }

    public function getPriceCar($url, $params)
    {
        return $this->executeApi('api-price-car', $url, $params, "POST");
    }

    public function getBrand($url, $params)
    {
        return $this->executeApi('api-brand-product', $url, $params, "POST");
    }

    public function getCodeProduct($url, $params)
    {
        return $this->executeApi('api-code-product', $url, $params, "POST");
    }

    public function getBranchName($url, $params)
    {
        return $this->executeApi('api-branch-name', $url, $params, "POST");
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
        return $this->executeApi('api-loan', $url, $params, "POST");
    }

    public function getProductCategory($url)
    {

        return $this->executeApi('api-product-category', $url, [], "GET");
    }

    public function getProduct($url, $params)
    {

        return $this->executeApi('api-product-test', $url, $params, "POST");
    }

    public function getData($data)
    {
        return json_decode($data->getBody());
    }

    public function getTenor($url, $params)
    {
        return $this->executeApi('api-tenor', $url, $params, "POST");
    }

    public function getInsurance($url, $params)
    {
        return $this->executeApi('api-insurance', $url, $params, "POST");
    }
    public function getProvince($url)
    {

        return $this->executeApi('api-province', $url, [], "GET");
    }

    public function getCity($url, $params)
    {

        return $this->executeApi('api-city', $url, $params, "POST");
    }

    public function getDistrict($url, $params)
    {

        return $this->executeApi('api-district', $url, $params, "POST");
    }

    public function getSubdistrict($url, $params)
    {

        return $this->executeApi('api-subdistrict', $url, $params, "POST");
    }
    public function getZipcode($url, $params)
    {

        return $this->executeApi('api-zipcode', $url, $params, "POST");
    }

    public function getCar($url)
    {

        return $this->executeApi('api-car-type', $url, [], "GET");
    }

    public function getCarBrand($url)
    {

        return $this->executeApi('api-car-brand', $url, [], "GET");
    }

    public function getCarModel($url, $params)
    {

        return $this->executeApi('api-car-model', $url, $params, "POST");
    }

    public function getCarYear($url, $params)
    {

        return $this->executeApi('api-car-year', $url, $params, "POST");
    }

    public function getCarFunding($url, $params)
    {

        return $this->executeApi('api-car-funding', $url, $params, "POST");
    }
    public function getCarCalculate($url, $params)
    {

        return $this->executeApi('api-car-calculate', $url, $params, "POST");
    }

    public function saveCarLeads1($url, $params)
    {

        return $this->executeApi('api-save-car-leads1', $url, $params, "POST");
    }

    public function saveCarLeads2($url, $params)
    {

        return $this->executeApi('api-save-car-leads2', $url, $params, "POST");
    }

    public function saveCarLeads3($url, $params)
    {

        return $this->executeApi('api-save-car-leads3', $url, $params, "POST");
    }

    public function saveCarLeads4($url, $params)
    {

        return $this->executeApi('api-save-car-leads4', $url, $params, "POST");
    }

    public function saveCarLeads5($url, $params)
    {

        return $this->executeApi('api-save-car-leads5', $url, $params, "POST");
    }
    public function saveCarLeads6($url, $params)
    {

        return $this->executeApi('api-save-car-leads6', $url, $params, "POST");
    }

    public function getMotorcycle($url)
    {

        return $this->executeApi('api-motorcycle-type', $url, [], "GET");
    }

    public function getMotorcycleBrand($url)
    {

        return $this->executeApi('api-motorcycle-brand', $url, [], "GET");
    }

    public function getMotorcycleModel($url, $params)
    {

        return $this->executeApi('api-motorcycle-model', $url, $params, "POST");
    }

    public function getMotorcycleYear($url, $params)
    {

        return $this->executeApi('api-motorcycle-year', $url, $params, "POST");
    }

    public function getMotorcycleFunding($url, $params)
    {

        return $this->executeApi('api-motorcycle-funding', $url, $params, "POST");
    }

    public function getMotorcycleTenor($url, $params)
    {

        return $this->executeApi('api-motorcycle-tenor', $url, $params, "POST");
    }
    public function getMotorcycleCalculate($url, $params)
    {

        return $this->executeApi('api-motorcycle-calculate', $url, $params, "POST");
    }

    public function saveMotorcycleLeads1($url, $params)
    {

        return $this->executeApi('api-save-motorcycle-leads1', $url, $params, "POST");
    }

    public function saveMotorcycleLeads2($url, $params)
    {

        return $this->executeApi('api-save-motorcycle-leads2', $url, $params, "POST");
    }

    public function saveMotorcycleLeads3($url, $params)
    {

        return $this->executeApi('api-save-motorcycle-leads3', $url, $params, "POST");
    }

    public function saveMotorcycleLeads4($url, $params)
    {

        return $this->executeApi('api-save-motorcycle-leads4', $url, $params, "POST");
    }

    public function saveMotorcycleLeads5($url, $params)
    {

        return $this->executeApi('api-save-motorcycle-leads5', $url, $params, "POST");
    }
    public function saveMotorcycleLeads6($url, $params)
    {

        return $this->executeApi('api-save-motorcycle-leads6', $url, $params, "POST");
    }

    public function getProfession($url)
    {

        return $this->executeApi('api-pbf-prosession', $url, [], "GET");
    }

    public function getPbfCertificateType($url)
    {

        return $this->executeApi('api-get-list-pbf-certificate-type', $url, [], "GET");
    }

    public function getPbfCertificateOnBehalf($url)
    {

        return $this->executeApi('api-get-list-pbf-certificate-on-behalf', $url, [], "GET");
    }

    public function getPbfPropertyType($url)
    {

        return $this->executeApi('api-get-list-pbf-property-type', $url, [], "GET");
    }

    public function getPbfFunding($url, $params)
    {

        return $this->executeApi('api-pbf-funding', $url, $params, "POST");
    }
    public function getPbfTenor($url, $params)
    {

        return $this->executeApi('api-pbf-tenor', $url, $params, "POST");
    }
    public function getPbfCalculate($url, $params)
    {

        return $this->executeApi('api-pbf-calculate', $url, $params, "POST");
    }

    public function savePbfLeads1($url, $params)
    {

        return $this->executeApi('api-save-pbf-leads1', $url, $params, "POST");
    }

    public function savePbfLeads2($url, $params)
    {

        return $this->executeApi('api-save-pbf-leads2', $url, $params, "POST");
    }

    public function savePbfLeads3($url, $params)
    {

        return $this->executeApi('api-save-pbf-leads3', $url, $params, "POST");
    }

    public function savePbfLeads4($url, $params)
    {

        return $this->executeApi('api-save-pbf-leads4', $url, $params, "POST");
    }

    public function savePbfLeads5($url, $params)
    {

        return $this->executeApi('api-save-pbf-leads5', $url, $params, "POST");
    }
    public function savePbfLeads6($url, $params)
    {

        return $this->executeApi('api-save-pbf-leads6', $url, $params, "POST");
    }

    //Leisure
    public function getLeisurePackage($url)
    {

        return $this->executeApi('api-get-leisure-package', $url, [], "GET");
    }
    public function getLeisureTenor($url)
    {

        return $this->executeApi('api-get-leisure-tenor', $url, [], "GET");
    }
    public function getLeisureProvisionPackage($url, $params)
    {

        return $this->executeApi('api-get-leisure-provision-package', $url, $params, "GET");
    }
    public function leisureCalculator($url, $params)
    {

        return $this->executeApi('api-leisure-calculator', $url, $params, "POST");
    }

    public function saveLeisureLeads1($url, $params)
    {

        return $this->executeApi('api-save-leisure-leads1', $url, $params, "POST");
    }

    public function saveLeisureLeads2($url, $params)
    {

        return $this->executeApi('api-save-leisure-leads2', $url, $params, "POST");
    }

    public function saveLeisureLeads3($url, $params)
    {

        return $this->executeApi('api-save-leisure-leads3', $url, $params, "POST");
    }

    public function saveLeisureLeads4($url, $params)
    {

        return $this->executeApi('api-save-leisure-leads4', $url, $params, "POST");
    }

    public function saveLeisureLeads5($url, $params)
    {

        return $this->executeApi('api-save-leisure-leads5', $url, $params, "POST");
    }

    //Education
    public function getEduPackage($url)
    {

        return $this->executeApi('api-get-edu-package', $url, [], "GET");
    }
    public function getEduTenor($url)
    {

        return $this->executeApi('api-get-edu-tenor', $url, [], "GET");
    }
    public function getEduProvisionPackage($url, $params)
    {

        return $this->executeApi('api-edu-provision-package', $url, $params, "POST");
    }
    public function eduCalculator($url, $params)
    {

        return $this->executeApi('api-edu-calculator', $url, $params, "POST");
    }

    public function saveEduLeads1($url, $params)
    {

        return $this->executeApi('api-save-edu-leads1', $url, $params, "POST");
    }

    public function saveEduLeads2($url, $params)
    {

        return $this->executeApi('api-save-edu-leads2', $url, $params, "POST");
    }

    public function saveEduLeads3($url, $params)
    {

        return $this->executeApi('api-save-edu-leads3', $url, $params, "POST");
    }

    public function saveEduLeads4($url, $params)
    {

        return $this->executeApi('api-save-edu-leads4', $url, $params, "POST");
    }

    public function saveEduLeads5($url, $params)
    {

        return $this->executeApi('api-save-edu-leads5', $url, $params, "POST");
    }

    //Education
    public function getMachineryServices($url)
    {

        return $this->executeApi('api-get-machinery-services', $url, [], "GET");
    }
    public function getMachineryIndustry($url)
    {

        return $this->executeApi('api-get-machinery-industry', $url, [], "GET");
    }
    public function getMachineryType($url)
    {

        return $this->executeApi('api-get-machinery-type', $url, [], "GET");
    }
    public function getMachineryBrand($url)
    {

        return $this->executeApi('api-get-machinery_brand', $url, [], "GET");
    }
    public function getMachineryModel($url, $params)
    {

        return $this->executeApi('api-machinery-model', $url, $params, "POST");
    }
    public function getMachineryYear($url, $params)
    {

        return $this->executeApi('api-machinery-year', $url, $params, "POST");
    }
    public function getMachineryFunding($url, $params)
    {

        return $this->executeApi('api-machinery-funding', $url, $params, "POST");
    }
    public function getMachineryTenor($url)
    {

        return $this->executeApi('api-get-machinery-tenor', $url, [], "GET");
    }

    public function machineryCalculate($url, $params)
    {

        return $this->executeApi('api-machinery-calculator', $url, $params, "POST");
    }

    public function saveMachineryLeads1($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads1', $url, $params, "POST");
    }

    public function saveMachineryLeads2($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads2', $url, $params, "POST");
    }

    public function saveMachineryLeads3($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads3', $url, $params, "POST");
    }

    public function saveMachineryLeads4($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads4', $url, $params, "POST");
    }

    public function saveMachineryLeads5($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads5', $url, $params, "POST");
    }
    public function saveMachineryLeads6($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads6', $url, $params, "POST");
    }

    //peluang bisnis
    public function getListProductIsAgent($url)
    {

        return $this->executeApi('api-get-list-product-is-agent', $url, [], "GET");
    }

    public function getListEducation($url)
    {

        return $this->executeApi('api-get-list-education', $url, [], "GET");
    }
    public function getListMaritalStatus($url)
    {

        return $this->executeApi('api-get-list-marital-status', $url, [], "GET");
    }
    public function getListPekerjaan($url)
    {

        return $this->executeApi('api-get-list-pekerjaan', $url, [], "GET");
    }
    public function getListBank($url)
    {

        return $this->executeApi('api-get-list-bank', $url, [], "GET");
    }
    public function getListWaktuKerja($url)
    {

        return $this->executeApi('api-get-list-waktu-kerja', $url, [], "GET");
    }
    public function getListSellingChannel($url)
    {

        return $this->executeApi('api-get-list-selling-channel', $url, [], "GET");
    }

    public function saveAgentCandidateStep1($url, $params)
    {

        return $this->executeApi('api-save-agent-candidate1', $url, $params, "POST");
    }
    public function saveAgentCandidateStep1AfterOtp($url, $params)
    {

        return $this->executeApi('api-save-agent-candidate1-after-otp', $url, $params, "POST");
    }

    public function saveAgentCandidateStep2($url, $params)
    {

        return $this->executeApi('api-save-agent-candidate2', $url, $params, "POST");
    }

    public function saveAgentCandidateStep3($url, $params)
    {

        return $this->executeApi('api-save-agent-candidate3', $url, $params, "POST");
    }

    public function saveAgentCandidateStep4($url, $params)
    {

        return $this->executeApi('api-save-machinery-leads4', $url, $params, "POST");
    }

    public function saveAgentCandidateStep5($url, $params)
    {

        return $this->executeApi('api-save-agent-candidate5', $url, $params, "POST");
    }
}
