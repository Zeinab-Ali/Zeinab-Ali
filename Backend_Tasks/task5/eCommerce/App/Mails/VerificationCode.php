<?php
namespace App\Mails;
use App\Mails\Mail;

class VerificationCode extends Mail {
    public string $mailFromName = 'NTI Ecommerce';
    public function send()
    {
        try {
            //Recipients
            $this->mail->setFrom($this->mailFrom, $this->mailFromName);
            $this->mail->addAddress($this->mailTo);     
        
            //Content
            $this->mail->isHTML(true);                                  
            $this->mail->Subject = $this->subject;
            $this->mail->Body    =  $this->body;        
            $this->mail->send();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}

