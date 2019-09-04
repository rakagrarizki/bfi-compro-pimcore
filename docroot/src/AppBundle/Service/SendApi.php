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

    public function requestOtp($handphone, $name)
    {
        $url = WebsiteSetting::getByName('URL_REQUEST_OTP')->getData();
        $params["phone_number"] = $handphone;
        $params["first_name"] = $name;

        return $this->executeApi('api-request-otp', $url, $params,"POST");
    }

    public function validateOtp($handphone, $code)
    {
        $url = WebsiteSetting::getByName('URL_VALIDATE_OTP')->getData();
        $params["phone_number"] = $handphone;
        $params["sms_code"] = $code;

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

}
