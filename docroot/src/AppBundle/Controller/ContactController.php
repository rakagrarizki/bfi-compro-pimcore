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

        if ($request->isMethod('POST')) {
            $data = $request->get('corporate');
            // dump($data);
            // exit();


            $time = time();

            $contactCorporate = new DataObject\ContactCorporate;
            // $filename = File::getValidFilename($name);
            $filename = File::getValidFilename($data['email'] . $time);

            $contactCorporate->setParent(DataObject\AbstractObject::getByPath('/Contact/Corporate')); // we store all objects in /Contact/Corporate
            $contactCorporate->setKey($filename); // the filename of the object
            $contactCorporate->setPublished(true); // yep, it should be published :)

            $contactCorporate->setName(htmlentities($data['name']));
            $contactCorporate->setPhone(htmlentities($data['phone']));
            $contactCorporate->setEmail(htmlentities($data['email']));
            $contactCorporate->setSubject(htmlentities($data['subject']));
            $contactCorporate->setMessage(htmlentities($data['message']));
            $contactCorporate->save();

            $this->_success();
            $success = true;
        }
        $this->view->success = $success;
    }

    public function personalAction(Request $request)
    {
        $success = false;

        if ($request->isMethod('POST')) {
            $time = time();
            $data = $request->get('personal');
            $email = htmlentities($data['email']);
            $document = $_FILES['document']['name'];
            $documentTmp = $_FILES['document']['tmp_name'];
            $documentSize = $_FILES['document']['size'];

            if ($documentSize <= 500) {
                $contactPersonal = new DataObject\ContactPersonal;
                // $filename = File::getValidFilename($name);
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
                // dump($data);
                // dump($document);
                // exit;

                $contactPersonal->setName(htmlentities($data['name']));
                $contactPersonal->setPhone(htmlentities($data['phone']));
                $contactPersonal->setEmail($email);
                $contactPersonal->setIdentity(htmlentities($data['identity']));
                $contactPersonal->setNo_kontrak(htmlentities($data['no_kontrak']));
                $contactPersonal->setCustomer_name(htmlentities($data['customer_name']));
                $contactPersonal->setType_message(htmlentities($data['type_message']));
                $contactPersonal->setMessage(htmlentities($data['message']));
                $contactPersonal->setFile($asset);
                $contactPersonal->save();

                $success = true;
            } else {
                $success = false;
                echo "File tidak boleh lebih dari 500kb";
            }
        }
        $this->view->success = $success;
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
}
