<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\Index as Form;
use Admin\Validator\Index as validacao;

class IndexController extends ActionController 
{
    public function indexAction()
    {
        $form = new Form();
        $validacao = new validacao();
        if ($this->getRequest()->isPost()){
            $form->setInputFilter($validacao->getInputFilter());
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()){
                $dados = $form->getData();
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }
}
