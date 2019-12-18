<?php

namespace AppBundle\Controller;

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

            $success = true;

            $time = time();

            $contactCorporate = new DataObject\ContactCorporate;
            // $filename = File::getValidFilename($name);
            $filename = File::getValidFilename($data['email'] . $time);

            $contactCorporate->setParent(DataObject\AbstractObject::getByPath('/Contact/Corporate')); // we store all objects in /Contact/Corporate
            $contactCorporate->setKey($filename); // the filename of the object
            $contactCorporate->setPublished(true); // yep, it should be published :)

            $contactCorporate->setName($data['name']);
            $contactCorporate->setPhone($data['phone']);
            $contactCorporate->setEmail($data['email']);
            $contactCorporate->setSubject($data['subject']);
            $contactCorporate->setMessage($data['message']);
            $contactCorporate->save();
        }
        $this->view->success = $success;
    }

    public function personalAction(Request $request)
    {
        $success = false;

        if ($request->isMethod('POST')) {
            $data = $request->get('personal');
            // dump($data);
            // exit();
            $success = true;

            $time = time();

            $contactPersonal = new DataObject\ContactPersonal;
            // $filename = File::getValidFilename($name);
            $filename = File::getValidFilename($data['email'] . $time);

            $contactPersonal->setParent(DataObject\AbstractObject::getByPath('/Contact/Personal')); // we store all objects in /Contact/Personal
            $contactPersonal->setKey($filename); // the filename of the object
            $contactPersonal->setPublished(true); // yep, it should be published :)

            $contactPersonal->setName($data['name']);
            $contactPersonal->setPhone($data['phone']);
            $contactPersonal->setEmail($data['email']);
            $contactPersonal->setIdentity($data['identity']);
            $contactPersonal->setNo_kontrak($data['no_kontrak']);
            $contactPersonal->setCustomer_name($data['customer_name']);
            $contactPersonal->setType_message($data['type_message']);
            $contactPersonal->setMessage($data['message']);
            $contactPersonal->setFile($data['file']);
            $contactPersonal->save();
        }
        $this->view->success = $success;
    }
}
