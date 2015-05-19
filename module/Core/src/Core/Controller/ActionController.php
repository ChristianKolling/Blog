<?php

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;

class ActionController extends AbstractActionController {
    
    public function getObjectManager() {
        $objectManager = $this->getService('Doctrine\ORM\EntityManager');
        return $objectManager;
    }

    protected function getService($service) {
        return $this->getServiceLocator()->get($service);
    }
  
    protected function getRole(){
        $role = $this->getService('Session')->offsetGet('role');
        return $role;
    }

}