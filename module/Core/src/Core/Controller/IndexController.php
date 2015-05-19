<?php

namespace Core\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;

class IndexController extends ActionController
{
    public function indexAction() 
    {
        return new ViewModel();
    }
}