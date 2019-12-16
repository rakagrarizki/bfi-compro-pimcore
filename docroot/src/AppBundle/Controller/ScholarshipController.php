<?php

namespace AppBundle\Controller;

use Pimcore\Model\DataObject;
use Pimcore\File;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class ScholarshipController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->get('scholarship');
            // dump($data);
            // exit();

            // check for an existing scholarship with this email
            $scholarship = DataObject\Scholarship::getByEmail($data['email'], 1);
            if (!$scholarship) {
                $scholarship = new DataObject\Scholarship;
                // $filename = File::getValidFilename($name);
                $filename = File::getValidFilename($data['email']);

                $scholarship->setParent(DataObject\AbstractObject::getByPath('/Scholarship')); // we store all objects in /Scholarship
                $scholarship->setKey($filename); // the filename of the object
                $scholarship->setPublished(true); // yep, it should be published :)

                $scholarship->setName($data['name']);
                $scholarship->setEmail($data['email']);
                $scholarship->setPhone($data['phone']);
                $scholarship->setPhone2($data['phone2']);
                $scholarship->setPhoto($data['photo']);
                $scholarship->setUniversityName($data['university']);
                $scholarship->setNim($data['nim']);
                $scholarship->setFaculty($data['faculty']);
                $scholarship->setProgramStudy($data['prodi']);
                $scholarship->setSemester($data['semester']);
                $scholarship->setAcademicSemester1($data['academicSemester1']);
                $scholarship->setIpk1('3.' . $data['ipk1']);
                $scholarship->setAcademicSemester2($data['academicSemester2']);
                $scholarship->setIpk2('3.' . $data['ipk2']);
                $scholarship->setAcademicSemester3($data['academicSemester3']);
                $scholarship->setIpk3('3.' . $data['ipk3']);
                $scholarship->setTranscript($data['transcript']);
                $scholarship->save();
            }
            // add form data as view parameters
            $this->view->getParameters()->add($data);
        }
    }
}
