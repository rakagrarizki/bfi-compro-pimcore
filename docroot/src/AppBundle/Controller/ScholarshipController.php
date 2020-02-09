<?php

namespace AppBundle\Controller;

use Pimcore\Model\Asset;
use Pimcore\Model\DataObject;
use Pimcore\File;
use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;

class ScholarshipController extends FrontendController
{
    public function defaultAction(Request $request)
    {
        $success = false;

        if ($request->isMethod('POST')) {
            $data = $request->get('scholarship');
            $name = htmlentities($data['name']);
            $email = htmlentities($data['email']);
            $periode = date("Y");
            $photo = $_FILES['photo']['name'];
            $transcript = $_FILES['transcript']['name'];
            $photoTmp = $_FILES['photo']['tmp_name'];
            $transcriptTmp = $_FILES['transcript']['tmp_name'];
            $photoSize = $_FILES['photo']['size'];

            if ($email != "" && $name != "") {
                if ($photoSize <= 300000) {
                    // check for an existing scholarship with this email
                    $scholarship = DataObject\Scholarship::getByEmail($email, 1);
                    if (!$scholarship) {
                        $scholarship = new DataObject\Scholarship;
                        // $filename = File::getValidFilename($name);
                        $filename = File::getValidFilename($email.$periode);

                        $scholarship->setParent(DataObject\AbstractObject::getByPath('/Scholarship')); // we store all objects in /Scholarship
                        
                        if($scholarship->getKey() != $filename) {
                            $scholarship->setKey($filename); // the filename of the object
                            $scholarship->setPublished(true); // yep, it should be published :)

                            //creating and saving new asset
                            if ($photo != "") {
                                $asset1 = new Asset();
                                $asset1->setFilename($email . "-" . $photo);
                                $status1 = move_uploaded_file($photoTmp, tmp . $email . "-" . $photo);
                                $filePhoto = tmp . $email . "-" . $photo;
                                if (!$status1) {
                                    dump($_FILES);
                                    dump($status1);
                                    exit();
                                } else {
                                    $asset1->setData(file_get_contents($filePhoto));
                                    $asset1->setParent(Asset::getByPath("/Scholarship/Ktp"));
                                    $asset1->save();
                                    unlink($filePhoto);
                                }
                            }
                            if ($transcript != "") {
                                $asset2 = new Asset();
                                $asset2->setFilename($email . "-" . $transcript);
                                $status2 = move_uploaded_file($transcriptTmp, tmp . $email . "-" . $transcript);
                                $fileTranscript = tmp . $email . "-" . $transcript;
                                if (!$status2) {
                                    dump($_FILES);
                                    dump($status2);
                                    exit();
                                } else {
                                    $asset2->setData(file_get_contents($fileTranscript));
                                    $asset2->setParent(Asset::getByPath("/Scholarship/Transcript"));
                                    $asset2->save();
                                    unlink($fileTranscript);
                                }
                            }


                            $scholarship->setName($name);
                            $scholarship->setEmail($email);
                            $scholarship->setPhone(htmlentities($data['phone']));
                            $scholarship->setPhone2(htmlentities($data['phone2']));
                            $scholarship->setPhoto($asset1);
                            $scholarship->setUniversityName(htmlentities($data['university']));
                            $scholarship->setNim(htmlentities($data['nim']));
                            $scholarship->setFaculty(htmlentities($data['faculty']));
                            $scholarship->setProgramStudy(htmlentities($data['prodi']));
                            $scholarship->setSemester(htmlentities($data['semester']));
                            $scholarship->setAcademicSemester1(htmlentities($data['academicSemester1']));
                            $scholarship->setIpk1('3.' . htmlentities($data['ipk1']));
                            $scholarship->setAcademicSemester2(htmlentities($data['academicSemester2']));
                            $scholarship->setIpk2('3.' . htmlentities($data['ipk2']));
                            $scholarship->setAcademicSemester3(htmlentities($data['academicSemester3']));
                            $scholarship->setIpk3('3.' . htmlentities($data['ipk3']));
                            $scholarship->setTranscript($asset2);
                            $scholarship->setPeriode($periode);
                            $scholarship->save();

                            $this->_successCorporate();
                            $success = true;
                        }
                    } else {
                        $success = false;
                        $msg_error = $this->get("translator")->trans("scholarship-email-periode");
                    }
                } else {
                    $success = false;
                    $msg_error = $this->get("translator")->trans("scholarship-file-error");
                }
            } else {
                $success = false;
                $msg_error = $this->get("translator")->trans("scholarship-error");
            }
        }
        $this->view->success = $success;
        $this->view->msg_error = $msg_error;
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
