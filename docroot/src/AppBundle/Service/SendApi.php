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

class SendApi
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
                "form_params" => $params
            ]);

        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }

        return $this->getData($data);
    }

    public function requestOtp($handphone)
    {
        $url = WebsiteSetting::getByName('URL_REQUEST_OTP')->getData();
        $params["phone_number"] = $handphone;
        //$params["first_name"] = $name;

        return $this->executeApi('api-request-otp', $url, $params,"POST");
    }

    public function validateOtp($handphone, $code)
    {
        $url = WebsiteSetting::getByName('URL_VALIDATE_OTP')->getData();
        $params["phone_number"] = $handphone;
        $params["otp_code"] = $code;

        return $this->executeApi('api-validate-otp', $url, $params,"POST");
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

    public function getData($data)
    {
        return json_decode($data->getBody());
    }

    public function getTenor($url, $params)
    {
        return $this->executeApi('api-tenor', $url, $params,"POST");

    }

    public function getInsurance($url, $params)
    {
        return $this->executeApi('api-insurance', $url, $params,"POST");

    }
    public function getProvince($url){

        return $this->executeApi('api-province', $url,[],"GET");
    }

    public function getCity($url,$params){

        return $this->executeApi('api-city', $url,$params,"POST");
    }

    public function getDistrict($url,$params){

        return $this->executeApi('api-district', $url,$params,"POST");
    }

    public function getSubdistrict($url,$params){

        return $this->executeApi('api-subdistrict', $url,$params,"POST");
    }
    public function getZipcode($url,$params){

        return $this->executeApi('api-zipcode', $url,$params,"POST");
    }

    public function getCar($url){

        return $this->executeApi('api-car-type', $url,[],"GET");
    }

    public function getCarBrand($url){

        return $this->executeApi('api-car-brand', $url,[],"GET");
    }

    public function getCarModel($url, $params){

        return $this->executeApi('api-car-model', $url,$params,"POST");
    }

    public function getCarYear($url, $params){

        return $this->executeApi('api-car-year', $url,$params,"POST");
    }

    public function getCarFunding($url, $params){

        return $this->executeApi('api-car-funding', $url,$params,"POST");
    }
    public function getCarCalculate($url, $params){

        return $this->executeApi('api-car-calculate', $url,$params,"POST");
    }

    public function saveCarLeads1($url, $params){

        return $this->executeApi('api-save-car-leads1', $url,$params,"POST");
    }

    public function saveCarLeads2($url, $params){

        return $this->executeApi('api-save-car-leads2', $url,$params,"POST");
    }

    public function saveCarLeads3($url, $params){

        return $this->executeApi('api-save-car-leads3', $url,$params,"POST");
    }

    public function saveCarLeads4($url, $params){

        return $this->executeApi('api-save-car-leads4', $url,$params,"POST");
    }

    public function saveCarLeads5($url, $params){

        return $this->executeApi('api-save-car-leads5', $url,$params,"POST");
    }
    public function saveCarLeads6($url, $params){

        return $this->executeApi('api-save-car-leads6', $url,$params,"POST");
    }

    public function getMotorcycle($url){

        return $this->executeApi('api-motorcycle-type', $url,[],"GET");
    }

    public function getMotorcycleBrand($url){

        return $this->executeApi('api-motorcycle-brand', $url,[],"GET");
    }

    public function getMotorcycleModel($url, $params){

        return $this->executeApi('api-motorcycle-model', $url,$params,"POST");
    }

    public function getMotorcycleYear($url, $params){

        return $this->executeApi('api-motorcycle-year', $url,$params,"POST");
    }

    public function getMotorcycleFunding($url, $params){

        return $this->executeApi('api-motorcycle-funding', $url,$params,"POST");
    }

    public function getMotorcycleTenor($url, $params){

        return $this->executeApi('api-motorcycle-tenor', $url,$params,"POST");
    }
    public function getMotorcycleCalculate($url, $params){

        return $this->executeApi('api-motorcycle-calculate', $url,$params,"POST");
    }

    public function saveMotorcycleLeads1($url, $params){

        return $this->executeApi('api-save-motorcycle-leads1', $url,$params,"POST");
    }

    public function saveMotorcycleLeads2($url, $params){

        return $this->executeApi('api-save-motorcycle-leads2', $url,$params,"POST");
    }

    public function saveMotorcycleLeads3($url, $params){

        return $this->executeApi('api-save-motorcycle-leads3', $url,$params,"POST");
    }

    public function saveMotorcycleLeads4($url, $params){

        return $this->executeApi('api-save-motorcycle-leads4', $url,$params,"POST");
    }

    public function saveMotorcycleLeads5($url, $params){

        return $this->executeApi('api-save-motorcycle-leads5', $url,$params,"POST");
    }
    public function saveMotorcycleLeads6($url, $params){

        return $this->executeApi('api-save-motorcycle-leads6', $url,$params,"POST");
    }

    public function getProfession($url){

        return $this->executeApi('api-pbf-prosession', $url,[],"GET");
    }

    public function getPbfCertificateType($url){

        return $this->executeApi('api-get-list-pbf-certificate-type', $url,[],"GET");
    }

    public function getPbfCertificateOnBehalf($url){

        return $this->executeApi('api-get-list-pbf-certificate-on-behalf', $url,[],"GET");
    }

    public function getPbfPropertyType($url){

        return $this->executeApi('api-get-list-pbf-property-type', $url,[],"GET");
    }

    public function getPbfFunding($url, $params){

        return $this->executeApi('api-pbf-funding', $url,$params,"POST");
    }
    public function getPbfTenor($url, $params){

        return $this->executeApi('api-pbf-tenor', $url,$params,"POST");
    }
    public function getPbfCalculate($url, $params){

        return $this->executeApi('api-pbf-calculate', $url,$params,"POST");
    }

    public function savePbfLeads1($url, $params){

        return $this->executeApi('api-save-pbf-leads1', $url,$params,"POST");
    }

    public function savePbfLeads2($url, $params){

        return $this->executeApi('api-save-pbf-leads2', $url,$params,"POST");
    }

    public function savePbfLeads3($url, $params){

        return $this->executeApi('api-save-pbf-leads3', $url,$params,"POST");
    }

    public function savePbfLeads4($url, $params){

        return $this->executeApi('api-save-pbf-leads4', $url,$params,"POST");
    }

    public function savePbfLeads5($url, $params){

        return $this->executeApi('api-save-pbf-leads5', $url,$params,"POST");
    }
    public function savePbfLeads6($url, $params){

        return $this->executeApi('api-save-pbf-leads6', $url,$params,"POST");
    }



}
