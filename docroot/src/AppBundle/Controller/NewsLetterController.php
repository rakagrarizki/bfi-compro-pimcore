<?php

namespace AppBundle\Controller;

use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Pimcore\File;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;

class NewsLetterController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $time = time();
            $email = htmlentities($request->get('email'));

            // check for an existing newsletter with this email
            $newsLetter = DataObject\NewsLetter::getByEmail($email, 1);
            if (!$newsLetter) {
                $newsLetter = new DataObject\NewsLetter;
                // $filename = File::getValidFilename($name);
                $filename = File::getValidFilename($email . $time);

                $newsLetter->setParent(DataObject\AbstractObject::getByPath('/NewsLetter')); // we store all objects in /NewsLetter
                $newsLetter->setKey($filename); // the filename of the object
                $newsLetter->setPublished(true); // yep, it should be published :)

                $newsLetter->setEmail(htmlentities($email));
                // $newsLetter->setDate_time(htmlentities($time);
                $newsLetter->save();

                return new JsonResponse([
                    'success' => "1"
                ]);
            } else {
                $hasEmail = $this->get("translator")->trans("email-had-been-registered");
                return new JsonResponse([
                    'success' => "0",
                    'message' => $hasEmail
                ]);
            }
        }
    }
}
