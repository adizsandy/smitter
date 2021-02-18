<?php

namespace App;

use \stdClass;
use \Swift_SendmailTransport;
use \Swift_SmtpTransport;
use \Swift_Mailer;
use \Swift_Message;

class Registry {

    protected $connection;
    protected $transport;
    protected $config;

    public function __construct()
    {   
        $this->config = require __DIR__. '/../config/app.php';
        $this->setConnection();
        $this->setMailTransport();
    }

    private function setConnection() 
    {
        // Set Database connection
        $this->connection = $this->config['database'];
    }

    public function getConnection() 
    {
        return $this->connection;
    }

    private function setMailTransport() 
    {   
        $this->transport = new stdClass();
        switch($this->config['mail']['default']['driver']) {
            case 'sendmail' : 
                $transport = new \Swift_SendmailTransport($this->config['mail']['default']['host'], $this->config['mail']['default']['port']);
                break;
            case 'smtp' :
            default:
                $transport = new \Swift_SmtpTransport($this->config['mail']['default']['host'], $this->config['mail']['default']['port']);
        }

        $transport->setUsername($this->config['mail']['default']['username'])->setPassword($this->config['mail']['default']['password']);
        
        $this->transport->mailer = new \Swift_Mailer($transport);
        $this->transport->composer = new \Swift_Message();
    }

    public function getMailTransport() 
    {
        return $this->transport;
    }
}