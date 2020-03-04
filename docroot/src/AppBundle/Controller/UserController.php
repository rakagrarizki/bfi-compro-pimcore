<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Pimcore\Model\WebsiteSetting;
use AppBundle\Service\SendApi;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class UserController extends FrontendController
{
    private $sendApi;

    public function __construct()
    {
        $this->sendApi = new SendApi;
    }

    public function defaultAction(Request $request)
    {
    }

    public function getToken()
    {
        // $token = $this->get('session')->get('token');

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

        if ($data->status == "success") {
            // add something
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


        $redis = new \Credis_Client("localhost", 6379, null, '', 1);
        $dateSend = $redis->hGet($params['phone_number'], "time-send");
        $attempts = $redis->hGet($params['phone_number'], "attempt-hit");
        $timenow = time();
        /*$a = "attemp =".$attempts;

        return new JsonResponse([
            'success' => "0",
            'message' => $a
        ]);*/

        $clear = false;
        if($attempts){
            $diff = $timenow - $dateSend;
            if($diff >= 600){
                $send = true;
                $clear = true;
            }else{
                if($attempts < 3){
                    $send = true;
                }else{
                    $redis->setEx($params['phone_number'],$limit,"expiry");
                    $send = false;
                }
            }
        }else{
            $clear = true;
            $send = true;
        }

        if(!$send){
            return new JsonResponse([
                'success' => "0",
                'message' => "error multiple request otp",
            ]);
        }

        try {
            $data = $this->sendApi->loginRequestOtp($url, $params);
            $redis->hSet($params['phone_number'], 'time-send', time());
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'data' => $url
            ]);
        }

        if($clear){
            $redis->hSet($params['phone_number'], 'attempt-hit', 1);
        }else{
            $redis->hSet($params['phone_number'], 'attempt-hit', $attempts + 1);
        }

        if($data->header->status != 200){
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }

        // if ($data->status == "success") {
        //     add something
        // }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
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
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
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

        if ($data->status == "success") {
            // add something
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

        if ($data->status == "success") {
            // fill something
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function verifyEmailConfirmJsonAction(Request $request)
    {
        $success = false;
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
            $redirect = BASEURL."/id/user/dashboard";
            $success = true;
        }
        // return new JsonResponse([
        //     'success' => true,
        //     'result' => $data,
        //     'test' => $data->header->status
        // ]);
        // /* Redirect to dashboard */
        $this->view->success = $success;

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

        if ($data->status == "success") {
            // fill something
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
        if(ENV != "dev"){
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
    
            if ($data->status == "success") {
                // fill something
            }
    
            return new JsonResponse([
                'success' => true,
                'result' => $data
            ]);
        } else {
            $datas = [];

            for($i = 1; $i <= 15; $i++) {
                $params['assignment_id'] = "2018074010000000087";
                $params['submission_id'] = "";
                $params['category_desc'] = "Pembiayaan Agunan";
                $params['product_desc'] = "BPKB Mobil";
                $datas[] = $params;
            }

            return new JsonResponse([
                'success' => true,
                'result' => [
                    'header' => [
                        'status' => 200,
                        'message' => "success fetch data"
                    ],
                    'status' => 'success',
                    'data' => $datas
                ]
            ]);
        }

        // $token = $this->getToken();

        // $param = [];

        // $host = WebsiteSetting::getByName("HOST")->getData();
        // $url = $host . WebsiteSetting::getByName('ASSIGNMENT_LIST')->getData();

        // try {
        //     $data = $this->sendApi->listAssignment($url, $param, $token);
        // } catch (\Exception $e) {
        //     return new JsonResponse([
        //         'success' => "0",
        //         'message' => "Failed to retrieve the data!",
        //         // 'detail' => $data . '" ' . $token . ' "'
        //         'detail' => $token
        //     ]);
        // }

        // if ($data->status == "success") {
        //     // fill something
        // }

        // return new JsonResponse([
        //     'success' => true,
        //     'result' => $data
        // ]);
    }

    // public function assignmentListJsonAction()
    // {
    //     $datas = [];

    //     for($i = 1; $i <= 15; $i++) {
    //         $params['assignment_id'] = "2018074010000000087";
    //         $params['submission_id'] = "";
    //         $params['category_desc'] = "Pembiayaan Agunan";
    //         $params['product_desc'] = "BPKB Mobil";
    //         $datas[] = $params;
    //     }

    //     return new JsonResponse([
    //         'success' => true,
    //         'result' => [
    //             'header' => [
    //                 'status' => 200,
    //                 'message' => "success fetch data"
    //             ],
    //             'status' => 'success',
    //             'data' => $datas
    //         ]
    //     ]);
    // }

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

        if ($data->status == "success") {
            // fill something
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

        if ($data->status == "success") {
            // fill something
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    public function contractStatusListJsonAction(Request $request)
    {
        if(ENV != "staging"){
            
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
    
            if ($data->status == "success") {
                // fill something
            }
    
            return new JsonResponse([
                'success' => true,
                'result' => $data
            ]);
        } else {
            $datas = [];

                $param['started_index'] = htmlentities(addslashes($request->get('started_index')));
                $param['length'] = htmlentities(addslashes($request->get('length')));
                $length = $param['started_index'] + $param['length'];
        
                for($i = $param['started_index']; $i <= $length; $i++) {
                    $params['contract_number'] = "134534535-" . $i;
                    $params['angsuran_perbulan'] = 4500000;
                    $params['tanggal_jatuh_tempo'] = "15-06-2019";
                    $params['category_desc'] = "Pembiayaan Agunan";
                    $params['product_desc'] = "BPKB Mobil";
                    $datas[] = $params;
                }
        
                return new JsonResponse([
                    'success' => true,
                    'result' => [
                        'header' => [
                            'status' => 200,
                            'message' => "success fetch data"
                        ],
                        'status' => 'success',
                        'total_record' => 100,
                        'data' => $datas
                    ]
                ]);
        }

        // try {
        //     $data = $this->sendApi->listContractStatus($url, $param, $token);
        // } catch (\Exception $e) {
        //     return new JsonResponse([
        //         'success' => "0",
        //         'message' => "Failed to retrieve the data!",
        //         'detail' => $data
        //     ]);
        // }

        // if ($data->status == "success") {
        //     // fill something
        // }

        // return new JsonResponse([
        //     'success' => true,
        //     'result' => $data
        // ]);
    }

    // public function contractStatusListJsonAction(Request $request)
    // {
    //     $datas = [];

    //     $param['started_index'] = htmlentities(addslashes($request->get('started_index')));
    //     $param['length'] = htmlentities(addslashes($request->get('length')));
    //     $length = $param['started_index'] + $param['length'];

    //     for($i = $param['started_index']; $i <= $length; $i++) {
    //         $params['contract_number'] = "134534535-" . $i;
    //         $params['angsuran_perbulan'] = 4500000;
    //         $params['tanggal_jatuh_tempo'] = "15-06-2019";
    //         $params['category_desc'] = "Pembiayaan Agunan";
    //         $params['product_desc'] = "BPKB Mobil";
    //         $datas[] = $params;
    //     }

    //     return new JsonResponse([
    //         'success' => true,
    //         'result' => [
    //             'header' => [
    //                 'status' => 200,
    //                 'message' => "success fetch data"
    //             ],
    //             'status' => 'success',
    //             'total_record' => 100,
    //             'data' => $datas
    //         ]
    //     ]);
    // }

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

        if ($data->status == "success") {
            // fill something
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

        if ($data->status == "success") {
            // fill something
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

        if ($data->status == "success") {
            // fill something
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

        if ($data->status == "success") {
            // fill something
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

        if ($data->status == "success") {
            // fill something
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

        if ($data->status == "success") {
            // fill something
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }
}
