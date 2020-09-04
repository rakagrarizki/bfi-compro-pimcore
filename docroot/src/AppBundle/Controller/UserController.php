<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\WebsiteSetting;
use AppBundle\Service\SendApi;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class UserController extends FrontendController
{
    private $sendApi;
    private $redis;
    private $isDev;

    public function __construct()
    {
        $this->sendApi = new SendApi;
        $this->redis = new \Credis_Client(REDIS, 6379, null, '', 1, PASSREDIS);
        $this->isDev = ENV === 'dev';
    }

    public function defaultAction(Request $request)
    {
    }

    public function dashboardAction(Request $request)
    {
        $lang = $request->getLocale();
        if (!isset($_COOKIE['customer'])) {
            return $this->redirect("/{$lang}/login");
        }
    }

    public function getToken()
    {
        $request = Request::createFromGlobals();
        $token = $request->headers->get('sessionId');

        return $token;
    }

    public function loginJsonAction(Request $request)
    {
        $param['phone_number'] = htmlentities(addslashes($request->get('phone_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('LOGIN')->getData();

        try {
            $data = $this->sendApi->login($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!"
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function otpRequestJsonAction(Request $request)
    {
        $params['phone_number'] = htmlentities($request->get('phone_number'));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('LOGIN_OTP_REQUEST')->getData();
        $limitTime = WebsiteSetting::getByName('LIMIT_TIME')->getData();
        
        $limit = $limitTime * 3600;

        $expireTime = $this->redis->ttl($params['phone_number']);
        if($expireTime === false || $expireTime === -2 ){
            $attempts = $this->redis->hGet($params['phone_number'], "attempt-hit");
            $dateSend = $this->redis->hGet($params['phone_number'], "time-send");
            $timenow = time();
            $clear = false;
            if($attempts && $attempts <= 25){
                $diff = $timenow - $dateSend;
                if($diff >= 80){
                    if($attempts < 25){
                        $send = true;
                    }else{
                        $this->redis->setEx($params['phone_number'], $limit, "expiry");
                        $send = false;
                    }
                } else {
                    $send = false;
                }
            }else {
                $clear = true;
                $send = true;
            }
        } else {
            return new JsonResponse([
                'success' => '0',
                'message' => 'Your reached limit, please contact the administrator',
            ]);
        }

        if(!$send){
            return new JsonResponse([
                'success' => "0",
                'message' => "error multiple request otp",
            ]);
        } 

        try {
            $data = $this->sendApi->loginRequestOtp($url, $params);
            $this->redis->hSet($params['phone_number'], 'time-send', time());
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'data' => $url,
            ]);
        }

        if($clear){
            $this->redis->hSet($params['phone_number'], 'attempt-hit', 1);
        }else{
            $this->redis->hSet($params['phone_number'], 'attempt-hit', $attempts + 1);
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
             ] + ($this->isDev ? ['code_otp' => $data->data->opt_code] : [])
            );
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error"),
            ]);
        }
    }

    public function otpConfirmJsonAction(Request $request)
    {
        $params["phone_number"] = htmlentities($request->get('phone_number'));
        $params["otp_code"] = htmlentities($request->get('otp_code'));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('LOGIN_OTP_CONFIRM')->getData();

        try {
            $data = $this->sendApi->loginConfirmOtp($url, $params);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!"
            ]);
        }

        if ($data->status == "success") {
            $result = $data->data->customer_token;
            $this->get('session')->set('token', ['key' => $result]);

            return new JsonResponse([
                'success' => true,
                'result' => $data,
            ] + ($this->isDev ? ['code_otp' => $data->data->opt_code] : []));
        } else {
            return new JsonResponse([
                'success' => false,
                'result' => $data
            ]);
        }

    }

    public function checkVerifyStatusJsonAction()
    {
        $token = $this->getToken();
        $param = [];
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('CHECK_VERIFY_STATUS')->getData();

        try {
            $data = $this->sendApi->verifyStatus($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data . $token
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function verifyEmailRequestJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['email'] = htmlentities(addslashes($request->get('email')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('VERIFY_EMAIL_REQUEST')->getData();
        try {
            $data = $this->sendApi->verifyEmailRequest($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function verifyEmailConfirmJsonAction(Request $request)
    {
        $token = htmlentities(addslashes($request->get("token")));        
        $param['email_verify_code'] = $token;        
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('VERIFY_EMAIL_CONFIRM')->getData();
        $redirect = BASEURL."/confirm-email";

        try {
            $data = $this->sendApi->verifyEmailConfirm($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        if ($data->header->status == 200) {
            $redirect = "/id/user/dashboard";
        }
        return $this->redirect($redirect);

    }

    public function verifyNoKtpJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['no_ktp'] = htmlentities(addslashes($request->get('no_ktp')));
        $param['path_ktp'] = htmlentities(addslashes($request->get('path_ktp')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('VERIFY_NO_KTP')->getData();

        try {
            $data = $this->sendApi->verifyNoKtp($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function logoutJsonAction()
    {
        $token = $this->getToken();
        $param = [];
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('LOGOUT')->getData();

        try {
            $data = $this->sendApi->logout($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data . '" ' . $token . ' "'
            ]);
        }

        if ($data->status == "success") {
            $this->get('session')->clear();
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function assignmentListJsonAction()
    {
        $token = $this->getToken();
        $param = [];    
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('ASSIGNMENT_LIST')->getData();
    
        try {
            $data = $this->sendApi->listAssignment($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                // 'detail' => $data . '" ' . $token . ' "'
                'detail' => $token
            ]);
        }
    
        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function applicationStepListJsonAction()
    {
        $token = $this->getToken();
        $param = [];
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('APPLICATION_STEP_LIST')->getData();

        try {
            $data = $this->sendApi->listApplicationStep($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function applicationStatusListJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['assignment_id'] = htmlentities(addslashes($request->get('assignment_id')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('APPLICATION_STATUS_LIST')->getData();

        try {
            $data = $this->sendApi->listApplicationStatus($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function contractStatusListJsonAction(Request $request)
    {
            
        $token = $this->getToken();
        $param['started_index'] = htmlentities(addslashes($request->get('started_index')));
        $param['length'] = htmlentities(addslashes($request->get('length')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('CONTRACT_STATUS_LIST')->getData();

        try {
            $data = $this->sendApi->listContractStatus($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }
    
        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function contractDetailJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('CONTRACT_DETAIL')->getData();

        try {
            $data = $this->sendApi->detailContract($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function detailAgunanRumahJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('DETAIL_AGUNAN_RUMAH')->getData();

        try {
            $data = $this->sendApi->detailAgunanRumah($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function detailAgunanMobilJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('DETAIL_AGUNAN_MOBIL')->getData();

        try {
            $data = $this->sendApi->detailAgunanMobil($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function detailAgunanMotorJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('DETAIL_AGUNAN_MOTOR')->getData();

        try {
            $data = $this->sendApi->detailAgunanMotor($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        if ($data->status == "success") {
            // fill something
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function detailAgunanAlatBeratJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('DETAIL_AGUNAN_ALAT_BERAT')->getData();

        try {
            $data = $this->sendApi->detailAgunanAlatberat($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function contractDetailTransactionJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('DETAIL_TRANSAKSI')->getData();

        try {
            $data = $this->sendApi->detailContractTransaction($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function dataCustomerJsonAction(Request $request)
    {
        $token = $this->getToken();
        $param = [];
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('DATA_CUSTOMER')->getData();

        try {
            $data = $this->sendApi->dataCustomer($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }
}
