<?php

namespace AppBundle\Controller;

use AppBundle\Form\ContactForm;
use Pimcore\File;
use Pimcore\Model\DataObject;
use Pimcore\Tool;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends FrontendController
{
    public function defaultAction(Request $request)
    { }

    public function contactAction(Request $request)
    {
        $success = false;

        // initialize form and handle request data
        $form = $this->createForm(ContactForm::class);
        $form->handleRequest($request);

        // handle social login and pre-fill form
        if (!$form->isSubmitted()) {
            if ($request->get('provider')) {
                /** @var \Hybrid_Provider_Adapter|\Hybrid_Provider_Model $adapter */
                $adapter = Tool\HybridAuth::authenticate($request->get('provider'));
                if ($adapter) {
                    $userData = $adapter->getUserProfile();
                    if ($userData) {
                        $form->setData([
                            'name' => $userData->name,
                            'handphone' => $userData->handphone,
                            'email' => $userData->email,
                            'phone2' => $userData->phone2,
                            'trxType' => $userData->trxType,
                            'comment' => $userData->comment
                        ]);
                    }
                }
            }
        } else if ($form->isSubmitted() && $form->isValid()) {
            $success = true;

            $data = $form->getData();

            // check for an existing contact with this email and phone
            $contact['handphone'] = DataObject\Contact::getByHandphone($data['handphone'], 1);
            $contact['email'] = DataObject\Contact::getByEmail($data['email'], 1);

            if (!$contact) {
                // if there isn't an existing, ... create one
                $filename = File::getValidFilename($data['email']);

                // first we need to create a new object, and fill some system-related information
                $contact = new DataObject\Contact();
                $contact->setParent(DataObject\AbstractObject::getByPath('/Contact')); // we store all objects in /Contact
                $contact->setKey($filename); // the filename of the object
                $contact->setPublished(true); // yep, it should be published :)

                // of course this needs some validation here in production...
                $contact->setName($data['name']);
                $contact->setHandphone($data['handphone']);
                $contact->setEmail($data['email']);
                $contact->setPhone2($data['phone2']);
                $contact->setTrxType($data['trxType']);
                $contact->setComment($data['comment']);
                $contact->save();
            }

            // $mail = new Mail();
            // $mail->setIgnoreDebugMode(true);

            // To is used from the email document, but can also be set manually here (same for subject, CC, BCC, ...)
            //$mail->addTo("info@pimcore.org");

            // $emailDocument = $this->document->getProperty('email');
            // if (!$emailDocument) {
            //     $emailDocument = Document::getById(2);
            // }

            // $mail->setDocument($emailDocument);
            // $mail->setParams($data);
            // $mail->send();

            // add form data as view parameters
            $this->view->getParameters()->add($data);
        }

        $this->view->success = $success;

        // add the form view
        $this->view->form = $form->createView();
    }
}
