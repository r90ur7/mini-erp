<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function testeEmail()
    {
        $email = \Config\Services::email();

        $email->setFrom('no-reply@minierp.local', 'Mini ERP');
        $email->setTo('cliente@teste.com');
        $email->setSubject('Pedido');
        $email->setMessage('<h1>Pedido recebido!</h1><p>Seu pedido foi confirmado com sucesso.</p>');
        $email->setMailType('html');
        
        if ($email->send()) {
            echo '✅ Enviado com sucesso!';
        } else {
            echo '❌ Falhou:<br>';
            print_r($email->printDebugger(['headers']));
        }
        
    }
}
