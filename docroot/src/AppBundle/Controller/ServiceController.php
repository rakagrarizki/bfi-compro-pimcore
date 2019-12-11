<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\DataObject;
use Pimcore\Model\DataObject\Kecamatan as Kecamatan;
use Pimcore\Model\DataObject\Kelurahan as Kelurahan;
use Pimcore\Model\DataObject\City;
use Pimcore\Model\DataObject\Province;
use Pimcore\Model\WebsiteSetting;
use AppBundle\Service\SendApi;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ServiceController extends FrontendController
{
    public function getToken()
    {
        $token = $this->get('session')->get('token');
        return $token;
    }

    public function defaultAction(Request $request)
    { }

    /**
     * @Route("/service/login/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function loginListJsonAction(Request $request)
    {
        $param['phone_number'] = htmlentities(addslashes($request->get('phone_number')));

        $url = "http://www.bficorporatedev.com/login";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->login($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!"
            ]);
        }

        if ($data->status == "success") {
            // $session->invalidate();
            // $result = $data->data->is_ktp_verify;
            // $session->set('token', $result);
            // $ses = $session->get('token');
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
            // , 'session' => $ses
        ]);
    }

    /**
     * @Route("/service/otp-request/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function otpRequestListJsonAction(Request $request)
    {
        $handphone = htmlentities($request->get('phone_number'));

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->requestOtp($handphone);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!"
            ]);
        }

        if ($data->status == "success") {
            // $ses = $this->get('session')->get('token');
            $ses = $this->getToken();
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data,
            'session' => $ses
        ]);
    }

    /**
     * @Route("/service/otp-confirm/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function otpConfirmListJsonAction(Request $request)
    {
        $handphone = htmlentities($request->get('phone_number'));
        $code = htmlentities($request->get('otp_code'));

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->validateOtp($handphone, $code);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!"
            ]);
        }

        if ($data->status == "success") {
            $redis = new \Credis_Client("localhost", 6379, null, '', 1);
            // $session = new SessionInterface();
            // $session = new Session();
            // $session->clear();
            // $session->invalidate();
            // $session->start();
            $result = $data->data->customer_token;
            // $redis->set('token', $result);
            $this->get('session')->set('token', ['key' => $result]);
            // $session->set('token', $result);
            // $token = $session->get('token');
            // $session->setName('key') = $token;
            // $ses = $session->get('token');
            // $_SESSION['token'] = $result;
            // $ses = $_SESSION['token'];
            // $ses = $redis->get('token');
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data,
            'session' => $this->getToken()
        ]);
    }

    /**
     * @Route("/service/checkverifystatus/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function checkVerifyStatusListJsonAction()
    {
        // $session = new Session();
        $token = $this->getToken();

        $param = [];

        $url = "http://www.bficorporatedev.com/login_get_verify_status";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->verifyStatus($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        if ($data->status == "success") {
            // $session->invalidate();
            // $result = $data->data->is_ktp_verify;
            // $session->set('token', $result);
            // $ses = $session->get('token');
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
            // , 'session' => $ses
        ]);
    }

    /**
     * @Route("/service/verifyemailrequest/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function verifyEmailRequestListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['email'] = htmlentities(addslashes($request->get('email')));

        $url = "http://www.bficorporatedev.com/login_email_verify_request";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->verifyEmailRequest($url, $param, $token);
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

    /**
     * @Route("/service/verifyemailconfirm/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function verifyEmailConfirmListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['email_verify_code'] = htmlentities(addslashes($request->get('email_verify_code')));

        $url = "http://www.bficorporatedev.com/login_email_verify_confirm";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->verifyEmailConfirm($url, $param, $token);
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

    /**
     * @Route("/service/verifynoktp/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function verifyNoKtpListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['no_ktp'] = htmlentities(addslashes($request->get('no_ktp')));
        $param['path_ktp'] = htmlentities(addslashes($request->get('path_ktp')));

        $url = "http://www.bficorporatedev.com/login_noktp_verify";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->verifyNoKtp($url, $param, $token);
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

    /**
     * @Route("/service/logout/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function logoutListJsonAction()
    {
        $token = $this->getToken();

        $param = [];

        $url = "http://www.bficorporatedev.com/logout";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->logout($url, $param, $token);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Failed to retrieve the data!",
                'detail' => $data
            ]);
        }

        if ($data->status == "success") {
            // fill something
            $this->get('session')->clear();
        }

        return new JsonResponse([
            'success' => true,
            'result' => $data
        ]);
    }

    /**
     * @Route("/service/assignment/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function assignmentListJsonAction()
    {
        $token = $this->getToken();

        $param = [];

        $url = "http://www.bficorporatedev.com/dashboard_get_list_assignment";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->listAssignment($url, $param, $token);
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

    /**
     * @Route("/service/applicationstep/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function applicationStepListJsonAction()
    {
        $token = $this->getToken();

        $param = [];

        $url = "http://www.bficorporatedev.com/dashboard_get_list_application_step";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->listApplicationStep($url, $param, $token);
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

    /**
     * @Route("/service/applicationstatus/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function applicationStatusListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['assignment_id'] = htmlentities(addslashes($request->get('assignment_id')));

        $url = "http://www.bficorporatedev.com/dashboard_get_list_application_status";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->listApplicationStatus($url, $param, $token);
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

    /**
     * @Route("/service/contractstatus/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function contractStatusListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['started_index'] = htmlentities(addslashes($request->get('started_index')));
        $param['length'] = htmlentities(addslashes($request->get('length')));

        $url = "http://www.bficorporatedev.com/dashboard_get_list_contract_status";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->listContractStatus($url, $param, $token);
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

    /**
     * @Route("/service/contractdetail/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function contractDetailListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));

        $url = "http://www.bficorporatedev.com/dashboard_get_detail_contract";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->detailContract($url, $param, $token);
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

    /**
     * @Route("/service/contractdetailtransaction/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function contractDetailTransactionListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));

        $url = "http://www.bficorporatedev.com/dashboard_get_detail_transaksi_pembayaran";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->detailContractTransaction($url, $param, $token);
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

    /**
     * @Route("/service/detailagunanrumah/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function detailAgunanRumahListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));

        $url = "http://www.bficorporatedev.com/dashboard_get_detail_pbf_collateral";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->detailAgunanRumah($url, $param, $token);
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

    /**
     * @Route("/service/detailagunanmobil/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function detailAgunanMobilListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));

        $url = "http://www.bficorporatedev.com/dashboard_get_detail_car_collateral";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->detailAgunanMobil($url, $param, $token);
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

    /**
     * @Route("/service/detailagunanmotor/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function detailAgunanMotorListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));

        $url = "http://www.bficorporatedev.com/dashboard_get_detail_motorcycle_collateral";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->detailAgunanMotor($url, $param, $token);
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

    /**
     * @Route("/service/detailagunanalatberat/listJson")
    @Method({"POST"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function detailAgunanAlatBeratListJsonAction(Request $request)
    {
        $token = $this->getToken();

        $param['contract_number'] = htmlentities(addslashes($request->get('contract_number')));

        $url = "http://www.bficorporatedev.com/dashboard_get_detail_machinery_collateral";

        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->detailAgunanAlatBerat($url, $param, $token);
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

    public function registerNewsletterAction(TranslatorInterface $translator, Request $request)
    {
        $lang = htmlentities($request->get('lang'));
        $param = [];
        $param["submission_id"] = htmlentities($request->get('submission_id'));
        $param["is_news_letter"] = htmlentities($request->get('is_news_letter'));

        $url = HOST . WebsiteSetting::getByName('URL_NEWSLETTER')->getData();

        if ($lang == "en") {
            $emailRegistered = 'Your Email Address had been Registered / Service down';
            $emailSuccess = 'Success';
            $emailFailed = 'Failed to Register your Email Address to Newsletter';
        } else {
            $emailRegistered = 'Alamat Email sudah terdaftar / service tidak bisa diakses';
            $emailSuccess = 'Sukses';
            $emailFailed = 'Gagal Mendaftarkan email newslettter';
        }
        //        $translation = $translator->trans("email",[],'',$lang);

        //        $request->setLocale($lang);
        //        dump($this->get("translator")->trans("email-had-been-registered"));exit;
        $sendAPI = new SendApi();

        try {
            $data = $sendAPI->sendNewsletter($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $emailRegistered
            ]);
        }

        if (is_array($data)) {
            if ($data->code == "413") {
                return new JsonResponse([
                    'success' => "0",
                    'message' => $data->message
                ]);
            }
        } else {
            if ($data == true) {
                return new JsonResponse([
                    'success' => "1",
                    'message' => $emailSuccess
                ]);
            }
        }

        return new JsonResponse([
            'success' => "0",
            'message' => $emailFailed
        ]);
    }

    /**
     * @Route("/service/delete/kelurahan")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kelurahanDeleteAction()
    {
        $kel = new Kelurahan\Listing();
        $kel->delete();
        return new JsonResponse([
            'success' => true
        ]);
    }

    /**
     * @Route("/service/provinsi/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function provinsiListJsonAction()
    {
        $data = new Province\Listing();
        $data->setOrderKey("Name");
        $data->setOrder("ASC");
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/city/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function cityListJsonAction(Request $request)
    {
        $id = htmlentities($request->get('id'));

        if ($id == null) {
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }

        $data = new City\Listing();
        $data->setCondition('ProvinceCode = :id', ["id" => $id]);
        $data->setOrderKey("Name");
        $data->setOrder("ASC");
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/kecamatan/listJson")0
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kecamatanListJsonAction(Request $request)
    {
        $id = htmlentities($request->get('id'));
        if ($id == null) {
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }
        $data = new Kecamatan\Listing();
        $data->setCondition('CityCode = ?', $id);
        $data->setOrderKey("Name");
        $data->setOrder("ASC");
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }

    /**
     * @Route("/service/kelurahan/listJson")
    @Method({"GET"})
    @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function kelurahanListJsonAction(Request $request)
    {
        $id = htmlentities($request->get('id'));
        if ($id == null) {
            return new JsonResponse([
                'success' => false,
                'message' => "must include id"
            ]);
        }
        $data = new Kelurahan\Listing();
        $data->setCondition('KecamatanCode = ?', $id);
        $data->setOrderKey("Name");
        $data->setOrder("ASC");
        $maps = [];
        if ($data) {
            foreach ($data as $item) {
                $temp['name'] = $item->getName();
                $temp['id'] = $item->getCode();
                if ($item->getPostCode() == null) {
                    $postcode = "";
                } else {
                    $postcode = $item->getPostCode();
                }
                $temp['postcode'] = $postcode;
                $maps['data'][] = $temp;
            }
        }

        return new JsonResponse([
            'success' => true,
            'result' => $maps
        ]);
    }
}
