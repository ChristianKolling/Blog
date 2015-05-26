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
                try {
                    $this->getService('Admin\Service\Index')->authenticate($dados);
                    return $this->redirect()->toUrl('/admin/home');
                } catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage($ex->getMessage());
                }
                return $this->redirect()->toUrl('/admin');
            }
        }
        
        return new ViewModel(array(
            'form' => $form
        ));
    }
}
