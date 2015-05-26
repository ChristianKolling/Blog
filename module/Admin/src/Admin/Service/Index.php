<?php

namespace Admin\Service;

use Core\Service\Service;

class Index extends Service
{
    public function authenticate($params)
    {
        if (!isset($params['usuario']) || !isset($params['senha'])) {

            throw new \Exception("Parâmetros inválidos");
        }
        $senha = md5($params['senha']);
        $authService = $this->getServiceManager()->get('Zend\Authentication\AuthenticationService');
        $authAdapter = $authService->getAdapter();
        $authAdapter->setIdentityValue($params['usuario'])
            ->setCredentialValue($senha);
        $result = $authService->authenticate();
        if (!$result->isValid()) {
            throw new \Exception("Login ou senha inválidos");
        }   
        $session = $this->getServiceManager()->get('Session');
	$identity = $result->getIdentity();
        $session->offsetSet('user', $identity);
        $session->offsetSet('role', $identity->getPerfil());
        return true;
    }
}