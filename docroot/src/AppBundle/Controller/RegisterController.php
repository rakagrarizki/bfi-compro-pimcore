<?php

namespace AppBundle\Controller;

use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Service\SendApi;


class RegisterController extends FrontendController
{
    protected $sendAPI;

    protected $randomNumber;

    public function __construct(SendApi $sendAPI)
    {
        $this->sendAPI = $sendAPI;
        $this->randomNumber = rand(000001, 999999);
    }

    public function defaultAction(Request $request)
    {
    }

    public function registerAction(Request $request)
    {
        $url = HOST . WebsiteSetting::getByName('URL_REGISTER')->getData();
        $param["full_name"] = htmlentities(addslashes($request->get('full_name')));
        $param["email"] = htmlentities(addslashes($request->get('email')));
        $param["phone_number"] = htmlentities(addslashes($request->get('phone_number')));

        try {
            $data = $this->sendAPI->register($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }

    public function registerSubmissionAction(Request $request)
    {
        $url = HOST . WebsiteSetting::getByName('URL_REGISTER_SUBMISSION')->getData();
        $param["submission_id"] = htmlentities(addslashes($request->get('submission_id')));

        try {
            $data = $this->sendAPI->registerSubmission($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => $e->getMessage()
            ]);
        }

        if ($data->header->status == 200) {
            return new JsonResponse([
                'success' => "1",
                'message' => "Sukses",
                'data' => $data->data
            ]);
        } else {
            return new JsonResponse([
                'success' => "0",
                'message' => "Gagal"
            ]);
        }
    }
}
