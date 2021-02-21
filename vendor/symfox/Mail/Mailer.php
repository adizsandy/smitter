<?php

namespace Symfox\Mail;

use Boot\Env\Configurator;

class Mailer {

    private $transport;
    private $composer;
    private $mailer;
    
    public function __contruct() 
    {
		$this->setTransport(Configurator::getMailTransportCollection());
    }

    private function getTransport() 
    {
        return $this->transport;
    }

    private function setTransport($mail_config) 
    {   
        switch($mail_config['driver']) {
            case 'sendmail' : 
                $this->transport = new \Swift_SendmailTransport($mail_config['host'], $mail_config['port']);
                break;
            case 'smtp' :
            default:
                $this->transport = new \Swift_SmtpTransport($mail_config['host'], $mail_config['port']);
        }
        $this->transport->setUsername($mail_config['username'])->setPassword($mail_config['password']);
    }

    public function getMailer() 
    {   
        if (empty($this->mailer)) {
            $this->setMailer();
        }
        return $this->mailer;
    }

    protected function setMailer() 
    {
        $this->mailer = new \Swift_Mailer($this->getTransport());
    }

    public function getComposer() 
    {
        return $this->composer;
    }

    protected function setComposer() 
    {
        $this->composer = new \Swift_Message(); 
    }
}