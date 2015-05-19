<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\Index as Form;

class IndexController extends ActionController 
{
    public function indexAction()
    {
        $form = new Form();
        $request = $this->getRequest();
        if ($request->isPost()){
            $dados = $form->getData();
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }
}
