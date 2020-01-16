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
    {
    }

    public function registerNewsletterAction(TranslatorInterface $translator, Request $request)
    {
        $lang = htmlentities($request->get('lang'));
        $param = [];
        $param["submission_id"] = htmlentities($request->get('submission_id'));
        $param["is_news_letter"] = htmlentities($request->get('is_news_letter'));

        $host = WebsiteSetting::getByName("HOST")->getData();
        $url = $host . WebsiteSetting::getByName('URL_NEWSLETTER')->getData();

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
