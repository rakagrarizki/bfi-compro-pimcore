<?php

namespace AppBundle\Controller;

use Pimcore\Model\DataObject;
use Pimcore\File;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends FrontendController
{
    public function defaultAction(Request $request)
    { }

    public function corporateAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->get('corporate');

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
    }
}
