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
    public function executeApi($name, $url, $params)
    {
        $logger = new Logger($name);
        $logger->pushHandler(new StreamHandler(PIMCORE_LOG_DIRECTORY . DIRECTORY_SEPARATOR .date('d') . date('m') . date("Y") ."-".$name), Logger::DEBUG);
        $stack = HandlerStack::create();
        $stack->push(Middleware::log(
            $logger,
            new MessageFormatter('{url} - {req_body} - {res_body}')
        ));

        $client = new Client([
            "base_uri" => $url,
            "verify" => false,
            'handler' => $stack,
        ]);

        try {
            $data = $client->request("POST", $url, [
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

        return $this->executeApi('api-request-otp', $url, $params);
    }

    public function validateOtp($handphone, $code)
    {
        $url = WebsiteSetting::getByName('URL_VALIDATE_OTP')->getData();
        $params["phone_number"] = $handphone;
        $params["sms_code"] = $code;

        return $this->executeApi('api-validate-otp', $url, $params);
    }

    public function sendDataCredit($url, $params)
    {
        return $this->executeApi('api-credit', $url, $params);
    }

    public function sendNewsletter($url, $params)
    {
        return $this->executeApi('api-newsletter', $url, $params);
    }

    public function getPriceCar($url, $params)
    {
        return $this->executeApi('api-price-car', $url, $params);
    }

    public function getBranch($url)
    {
        $client = new Client([
            "base_uri" => $url,
            "verify" => false
        ]);

        try {
            $data = $client->request("GET", $url);

        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }

        return $this->getData($data);
    }

    public function getLoan($url, $params)
    {
        return $this->executeApi('api-loan', $url, $params);
    }

    public function getData($data)
    {
        return json_decode($data->getBody());
    }
}