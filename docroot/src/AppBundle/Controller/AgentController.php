<?php

namespace AppBundle\Controller;

use AppBundle\Service\SendApi;
use AppBundle\Service\SendApiDummy;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\WebsiteSetting;
use Pimcore\Model\DataObject;
use Symfony\Component\HttpFoundation\Request;

class AgentController extends FrontendController
{
    protected $sendAPI;
    protected $randomNumber;
    private $redis;
    private $isDev;

    public function __construct(SendApi $sendAPI, sendApiDummy $sendApiDummy)
    {
        $this->sendAPI = $sendAPI;
        $this->redis = new \Credis_Client(REDIS, 6379, null, '', 1, PASSREDIS);
        $this->isDev = ENV === 'dev';
    }
    public function defaultAction(Request $request)
    {
    }

    public function successAction()
    {
        $blog = new DataObject\BlogArticle\Listing();
        $blog->setOrderKey("Date");
        $blog->setOrder("desc");
        $blog->setLimit(4);

        $this->view->blog = $blog;
    }

    public function getListProductIsAgentAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PRODUCT_AGENT')->getData();

        try {
            $data = $this->sendAPI->getListProductIsAgent($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListEducationAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_EDUCATION')->getData();

        try {
            $data = $this->sendAPI->getListEducation($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListMaritalStatusAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_MARITAL_STATUS')->getData();

        try {
            $data = $this->sendAPI->getListMaritalStatus($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListPekerjaanAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_PEKERJAAN')->getData();

        try {
            $data = $this->sendAPI->getListPekerjaan($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListBankAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_BANK')->getData();

        try {
            $data = $this->sendAPI->getListBank($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListWaktuKerjaAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_WAKTU_KERJA')->getData();

        try {
            $data = $this->sendAPI->getListWaktuKerja($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function getListSellingChannelAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_GET_LIST_SELLING_CHANNEL')->getData();

        try {
            $data = $this->sendAPI->getListSellingChannel($url);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveAgentCandidateStep1Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('SAVE_AGENT_CANDIDATE_STEP_1')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["collateral_type_id"] = htmlentities(addslashes($request->get('collateral_type_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));

        try {
            $data = $this->sendAPI->saveAgentCandidateStep1($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
    public function saveAgentCandidateStep1AfterOtpAction(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('SAVE_AGENT_CANDIDATE_STEP_1_AFTER_OTP')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["name"] = htmlentities(addslashes($request->get('name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));
        $param["education_id"] = htmlentities(addslashes($request->get('education_id')));
        $param["marital_status_id"] = htmlentities(addslashes($request->get('marital_status_id')));
        $param["jumlah_tanggungan"] = htmlentities(addslashes($request->get('jumlah_tanggungan')));
        $param["occupation_id"] = htmlentities(addslashes($request->get('occupation_id')));
        $param["no_npwp"] = htmlentities(addslashes($request->get('no_npwp')));
        $param["no_ktp"] = htmlentities(addslashes($request->get('no_ktp')));
        $param["stream_ktp"] = htmlentities(addslashes($request->get('stream_ktp')));
        $param["code_are"] = htmlentities(addslashes($request->get('code_are')));
        $param["have_smartphone"] = htmlentities(addslashes($request->get('have_smartphone')));
        $limitTime = WebsiteSetting::getByName('LIMIT_TIME')->getData();
        $differentTime = WebsiteSetting::getByName('DIFF_TIME')->getData();
        $limit = $limitTime * 3600;

        $expireTime = $this->redis->ttl($param["phone_number"]);
        if($expireTime === false || $expireTime === -2 ){
            $dateSend = $this->redis->hGet($param["phone_number"], "time-send");
            $attempts = $this->redis->hGet($param["phone_number"], "attempt-hit");
            $timenow = time();
            $clear = false;
            if($attempts && $attempts <= 25){
                $diff = $timenow - $dateSend;
                if($diff >= 80){
                    if($attempts < 25){
                        $send = true;
                    }else{
                        $this->redis->setEx($param["phone_number"], $limit, "expiry");
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

        if (!$send) {
            return new JsonResponse([
                'success' => "0",
                'message' => "error multiple request otp",
            ]);
        }

        try {
            $data = $this->sendAPI->saveAgentCandidateStep1AfterOtp($url, $param);
            $this->redis->hSet($param['phone_number'], 'time-send', time());
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($clear) {
            $this->redis->hSet($param['phone_number'], 'attempt-hit', 1);
        } else {
            $this->redis->hSet($param['phone_number'], 'attempt-hit', $attempts + 1);
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => true,
                ] + ($this->isDev ? ['code_otp' => $data->data->opt_code] : [])
            );
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveAgentCandidateStep2Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('SAVE_AGENT_CANDIDATE_STEP_2')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["province_id"] = htmlentities(addslashes($request->get('province_id')));
        $param["city_id"] = htmlentities(addslashes($request->get('city_id')));
        $param["district_id"] = htmlentities(addslashes($request->get('district_id')));
        $param["subdistrict_id"] = htmlentities(addslashes($request->get('subdistrict_id')));
        $param["zipcode_id"] = htmlentities(addslashes($request->get('zipcode_id')));
        $param["jumlah_tanggungan"] = htmlentities(addslashes($request->get('jumlah_tanggungan')));
        $param["address"] = htmlentities(addslashes($request->get('address')));

        try {
            $data = $this->sendAPI->saveAgentCandidateStep2($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveAgentCandidateStep3Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('SAVE_AGENT_CANDIDATE_STEP_3')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["bank_id"] = htmlentities(addslashes($request->get('bank_id')));
        $param["account_number"] = htmlentities(addslashes($request->get('account_number')));
        $param["account_name"] = htmlentities(addslashes($request->get('account_name')));

        try {
            $data = $this->sendAPI->saveAgentCandidateStep3($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveAgentCandidateStep4Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('SAVE_AGENT_CANDIDATE_STEP_4')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["is_paham_financing"] = htmlentities(addslashes($request->get('is_paham_financing')));
        $param["id_waktu_kerja"] = htmlentities(addslashes($request->get('id_waktu_kerja')));
        $selling = htmlentities($request->get('selling_channel'));
        $selling_channels = explode(",", $selling);
        $param["selling_channel"] = $selling_channels;

        try {
            $data = $this->sendAPI->saveAgentCandidateStep4($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }

    public function saveAgentCandidateStep5Action(Request $request)
    {
        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('SAVE_AGENT_CANDIDATE_STEP_5')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));
        $param["is_patuh"] = htmlentities(addslashes($request->get('is_patuh')));

        try {
            $data = $this->sendAPI->saveAgentCandidateStep5($url, $param);
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong!');
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "success",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => $this->get("translator")->trans("api-error")
            ]);
        }
    }
}
