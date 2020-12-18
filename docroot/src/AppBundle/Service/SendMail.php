<?php
Namespace AppBundle\Service;

use Monolog\Logger;
use Pimcore\Model\WebsiteSetting;
use Symfony\Component\HttpFoundation\Request;
use SendGrid\Mail\Mail;
use SendGrid\Mail\HtmlContent;
use Pimcore\Bundle\AdminBundle\HttpFoundation\JsonResponse;



class SendMail
{

    // for Documentation visit : https://github.com/sendgrid/sendgrid-php/blob/main/USE_CASES.md#send-an-sms-message
    public function textMail($address, $name,$subject, $emailcontent ){
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("info@bfifinance.co.id", "BFI INFO");
        $email->setSubject($subject);
        $email->addTo($address, $name);
        $email->addContent("text/plain", $emailcontent);
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            return $response->statusCode() . "\n";
            
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    public function contactUsMail($subject, $emailcontent ){
        $email = new \SendGrid\Mail\Mail();
        $address = WebsiteSetting::getByName('EMAIL_ADDRESS')->getData();
        $name = WebsiteSetting::getByName('EMAIL_NAME')->getData();
        $email->setFrom("info@bfifinance.co.id", "BFI INFO - Digital Technology");
        $email->setSubject($subject);
        $email->addTo($address, $name);
        $time = date("H:i:s , d-m-Y");
        $type = $emailcontent["type"];
        if($type == "corporate"){
            $htmlContent = new HtmlContent(
                "<p>Dear ".$name.",</p>
                <br>
                <p>Berikut data 'Hubungi Kami' yang disubmit:</p>
                <table style='width: 100%;'>
                    <tbody>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Nama Lengkap&nbsp;</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["name"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Nomor Handphone</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["phoneNumber"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Email</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["email"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Perihal</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["subject"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Isi Pesan</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["message"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Waktu Submit</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$time."</td>
                        </tr>
                    </tbody>
                    <p>Terima kasih.</p>
                </table>
                <p>PS. This email was sent automatically by system.</p>
                <p>Team Digital Technology</p>
                <p>www.bfi.co.id (c)2020 - All Right Reserved - #SELALU ADA JALAN::.</p>
                "
            );
        }else{
            $htmlContent = new HtmlContent(
                "<p>Dear ".$name.",</p>
                <br>
                <p>Berikut data 'Hubungi Kami' yang disubmit:</p>
                <table style='width: 100%;'>
                    <tbody>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Nama Lengkap&nbsp;</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["name"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Nomor Handphone</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["phoneNumber"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>&nbsp;Email</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["email"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Tipe Nasabah&nbsp;</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["Identity"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Nomor Kontrak&nbsp;</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["contractNumber"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Nama Pelanggan&nbsp;</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["customerName"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Jenis Pesan</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["messageType"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Isi Pesan</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$emailcontent["message"]."</td>
                        </tr>
                        <tr style='height: 23px;'>
                            <td style='width: 20%; height: 23px;'>Waktu Submit</td>
                            <td style='width: 5%; height: 23px;'>&nbsp;:</td>
                            <td style='width: 75%; height: 23px;'>&nbsp;".$time."</td>
                        </tr>
                    </tbody>
                    <p>Terima kasih.</p>
                </table>
                <p>PS. This email was sent automatically by system.</p>
                <p>Team Digital Technology</p>
                <p>www.bfi.co.id (c)2020 - All Right Reserved - #SELALU ADA JALAN::.</p>
                "
            );
            
        }
        
        $email->addContent($htmlContent);
        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            return $response->statusCode() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }

    
}

?>