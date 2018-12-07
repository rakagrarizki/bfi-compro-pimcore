<?php

namespace AppBundle\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Model\WebsiteSetting;
use AppBundle\Service\SendApi;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;
class CreditController extends FrontendController
{
    protected $sendAPI;

    public function __construct(SendApi $sendAPI)
    {
        $this->sendAPI = $sendAPI;
    }

    public function sendMobilAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d")."T".date("H:i:s");
        $param['CustomerName'] = $request->get('nama_lengkap');
        $param['EmailCustomer'] = $request->get('email');
        $param['CustomerAddress'] = $request->get('alamat_lengkap');
        $param['CustomerNumber1'] = $request->get('no_handphone');
        $param['CustomerNumber2'] = $request->get('no_handphone');
        $param['City'] = $request->get('kota');
        $param['Kelurahan'] = $request->get('kelurahan');
        $param['Kecamatan'] = $request->get('kecamatan');
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "xxxxx";
        $param['ListingID'] = "sssss";
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOBIL";
        $param['VehicleType'] = $request->get('model_kendaraan');
        $param['Year'] = $request->get('tahun_kendaraan');
        $param['Funding'] = $request->get('funding');
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = $request->get('merk_kendaraan');
        $param['Tenor'] = $request->get('jangka_waktu');
        $param['Installment'] = $request->get('installment');

        $url = WebsiteSetting::getByName('URL_CREDIT_MOBIL')->getData();

        try {
            $this->sendAPI->sendDataCredit($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses"
        ]);
    }

    public function sendMotorAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d")."T".date("H:i:s");
        $param['CustomerName'] = $request->get('nama_lengkap');
        $param['EmailCustomer'] = $request->get('email');
        $param['CustomerAddress'] = $request->get('alamat_lengkap');
        $param['CustomerNumber1'] = $request->get('no_handphone');
        $param['CustomerNumber2'] = $request->get('no_handphone');
        $param['City'] = $request->get('kota');
        $param['Kelurahan'] = $request->get('kelurahan');
        $param['Kecamatan'] = $request->get('kecamatan');
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "xxxxx";
        $param['ListingID'] = "sssss";
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();
        $param['Product'] = "MOTOR";
        $param['VehicleType'] = $request->get('model_kendaraan');
        $param['Year'] = $request->get('tahun_kendaraan');
        $param['Funding'] = $request->get('funding');
        $param['LinkIklan'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['MonthlyIncome'] = "0";
        $param['Brand'] = $request->get('merk_kendaraan');
        $param['Tenor'] = $request->get('jangka_waktu');
        $param['Installment'] = $request->get('installment');

        $url = WebsiteSetting::getByName('URL_CREDIT_MOTOR')->getData();

        try {
            $this->sendAPI->sendDataCredit($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses"
        ]);
    }

    public function sendRumahAction(Request $request)
    {
        $param = [];
        $param['PartnerID'] = WebsiteSetting::getByName('PARTNER_ID')->getData();
        $param['Datetime'] = date("Y-M-d")."T".date("H:i:s");
        $param['CustomerName'] = $request->get('nama_lengkap');
        $param['EmailCustomer'] = $request->get('email');
        $param['CustomerAddress'] = $request->get('alamat_lengkap');
        $param['CustomerNumber1'] = $request->get('no_handphone');
        $param['CustomerNumber2'] = $request->get('no_handphone');
        $param['City'] = $request->get('kota');
        $param['Kelurahan'] = $request->get('kelurahan');
        $param['Kecamatan'] = $request->get('kecamatan');
        $param['CustDateOfBirth'] = date("Y-m-d");
        $param['SubmissionID'] = "xxxxx";
        $param['ListingID'] = "sssss";
        $param['SellerName'] = WebsiteSetting::getByName('SELLER_NAME')->getData();
        $param['SellerNumber'] = WebsiteSetting::getByName('SELLER_NUMBER')->getData();
        $param['EmailSeller'] = WebsiteSetting::getByName('SELLER_EMAIL')->getData();
        $param['SellerAddress'] = WebsiteSetting::getByName('SELLER_ADDRESS')->getData();

        $param['SertificateStatus'] = $request->get('model_kendaraan');
        $param['OwnerSertificate'] = $request->get('tahun_kendaraan');
        $param['AddressSertificate'] = $request->get('funding');
        $param['ProvinsiSertificate'] = WebsiteSetting::getByName('LINK_IKLAN')->getData();
        $param['KotaSertificate'] = "0";
        $param['KecamatanSertificate'] = $request->get('merk_kendaraan');
        $param['KelurahanSertificate'] = $request->get('jangka_waktu');
        $param['KodeposSertificate'] = $request->get('installment');

        $url = WebsiteSetting::getByName('URL_CREDIT_RUMAH')->getData();

        try {
            $this->sendAPI->sendDataCredit($url, $param);
        } catch (\Exception $e) {
            return new JsonResponse([
                'success' => "0",
                'message' => "Service Request Credit Down"
            ]);
        }

        return new JsonResponse([
            'success' => "1",
            'message' => "Sukses"
        ]);
    }


}
