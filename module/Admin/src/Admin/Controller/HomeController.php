<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;

class HomeController extends ActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
}
