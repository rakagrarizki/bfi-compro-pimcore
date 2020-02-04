<?php

namespace AppBundle\Controller;

use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Pimcore\File;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends FrontendController
{
    public function defaultAction(Request $request)
    {
    }

    public function corporateAction(Request $request)
    {
        $success = false;
        $msg_error = false;
        $lang = $request->getLocale();

        if ($request->isMethod('POST')) {
            $data = $request->get('corporate');
            $name = htmlentities($data['name']);
            $email = htmlentities($data['email']);
            $message = htmlentities($data['message']);
            $time = time();

            if ($name != "" && $email != "" && $message != "") {
                $contactCorporate = new DataObject\ContactCorporate;
                // $filename = File::getValidFilename($name);
                $filename = File::getValidFilename($email . $time);

                $contactCorporate->setParent(DataObject\AbstractObject::getByPath('/Contact/Corporate')); // we store all objects in /Contact/Corporate
                $contactCorporate->setKey($filename); // the filename of the object
                $contactCorporate->setPublished(true); // yep, it should be published :)

                $contactCorporate->setName($name);
                $contactCorporate->setPhone(htmlentities($data['phone']));
                $contactCorporate->setEmail($email);
                $contactCorporate->setSubject(htmlentities($data['subject']));
                $contactCorporate->setMessage($message);
                $contactCorporate->save();

                $this->_successCorporate();
                $success = true;
            } else {
                $success = false;
                $msg_error = $this->get("translator")->trans("contact-error");
            }
        }
        // $this->view->url = "/". $lang . "/corporate/hubungan-investor/berita-informasi";
        $this->view->success = $success;
        $this->view->msg_error = $msg_error;
    }

    public function personalAction(Request $request)
    {
        $success = false;
        $msg_error = false;
        $lang = $request->getLocale();

        if ($request->isMethod('POST')) {
            $time = time();
            $data = $request->get('personal');
            $name = htmlentities($data['name']);
            $email = htmlentities($data['email']);
            $message = htmlentities($data['message']);
            $document = $_FILES['document']['name'];
            $documentTmp = $_FILES['document']['tmp_name'];
            $documentSize = $_FILES['document']['size'];

            if ($email != "" && $name != "" && $message != "") {
                if ($documentSize <= 500000) {
                    $contactPersonal = new DataObject\ContactPersonal;
                    $filename = File::getValidFilename($email . $time);

                    $contactPersonal->setParent(DataObject\AbstractObject::getByPath('/Contact/Personal')); // we store all objects in /Contact/Personal
                    $contactPersonal->setKey($filename); // the filename of the object
                    $contactPersonal->setPublished(true); // yep, it should be published :)

                    //creating and saving new asset
                    if ($document != "") {
                        $asset = new Asset();
                        $asset->setFilename($email . "-" . $time . $document);
                        $status = move_uploaded_file($documentTmp, tmp . $email . "-" . $document);
                        $fileDocument = tmp . $email . "-" . $document;
                        if (!$status) {
                            dump($_FILES);
                            dump($status);
                            exit();
                        } else {
                            $asset->setData(file_get_contents($fileDocument));
                            $asset->setParent(Asset::getByPath("/Contact/Document"));
                            $asset->save();
                            unlink($fileDocument);
                        }
                    }

                    $contactPersonal->setName($name);
                    $contactPersonal->setPhone(htmlentities($data['phone']));
                    $contactPersonal->setEmail($email);
                    $contactPersonal->setIdentity(htmlentities($data['identity']));
                    $contactPersonal->setNo_kontrak(htmlentities($data['no_kontrak']));
                    $contactPersonal->setCustomer_name(htmlentities($data['customer_name']));
                    $contactPersonal->setType_message(htmlentities($data['type_message']));
                    $contactPersonal->setMessage($message);
                    $contactPersonal->setFile($asset);
                    $contactPersonal->save();

                    $this->_success();
                    $success = true;
                } else {
                    $success = false;
                    $msg_error = $this->get("translator")->trans("contact-file-error");
                }
            } else {
                $success = false;
                $msg_error = $this->get("translator")->trans("contact-error");
            }
        }
        // $this->view->url = "/". $lang . "/blog";
        $this->view->success = $success;
        $this->view->msg_error = $msg_error;
    }

    private function _success()
    {
        $blog = new DataObject\BlogArticle\Listing();
        $blog->setOrderKey("Date");
        $blog->setOrder("desc");
        $blog->setLimit(4);
        $blog->load();

        return $this->view->blog = $blog;
    }

    private function _successCorporate()
    {
        $news = new DataObject\News\Listing();
        $news->setOrderKey("Date");
        $news->setOrder("desc");
        $news->setLimit(4);
        $news->load();

        return $this->view->news = $news;
    }
}
