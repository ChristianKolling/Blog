<?php

namespace Core\Service;

use Core\Service\Service;
use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Transport\SmtpOptions;

class EmailSender extends Service
{
    public function sendEmailRecoverPassword($senha, $usuario) 
    {
        $message = new Message();
            $message->addTo($usuario->getEmail())
                ->addFrom('noreply@youselfie.com.br')
                ->setSubject('Recuperação de Senha');
        $transport = new SmtpTransport();
        $html = new MimePart('<b>Olá <i>'.$usuario->getNome().'</i>, uma nova senha foi solicitada no Youselfie. <br> Seguem a baixo suas novas credenciais. <br>'
                . ' <hr>'
                . 'E-mail: '.$usuario->getEmail().''
                . '<br>'
                . 'Senha: '.$senha.'</b>');
        $html->type = "text/html";

        $body = new MimeMessage();
        $body->addPart($html);

        $message->setBody($body);

        $transport->setOptions($this->getOptions());
        $transport->send($message);
    }

    private function getOptions()
    {
        $options = new SmtpOptions(array(
            "host" => "smtp.gmail.com",
            "port" => 465,
            "connection_class" => "login",
            "connection_config" => array(
                "username" => "christian.si@unochapeco.edu.br ",
                "password" => "",
                'ssl' => 'ssl')
        ));
        
        return $options;
    }
}