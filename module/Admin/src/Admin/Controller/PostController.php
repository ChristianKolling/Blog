<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\Post as Form;
use Admin\Validator\Post as Validacao;

class PostController extends ActionController
{
    public function indexAction() 
    {
        $result = $this->getService('Admin\Service\Post')->fetchAll();
        
        return new ViewModel(array(
            'dados' => $result
        ));
    }

    public function novoAction()
    {
        $form = new Form();
        $validacao = new Validacao();
        if ($this->getRequest()->isPost()){
            $form->setInputFilter($validacao->getInputFilter());
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()){
                $dados = $form->getData();
                try {
                    $this->getService('Admin\Service\Post')->savePost($dados);
                    $this->flashMessenger()->addSuccessMessage('Postagem publicada com sucesso.');
                } catch (\Exception $ex) {
                    var_dump($ex->getMessage());exit;
                    $this->flashMessenger()->addErrorMessage('Erro durante publicação. Codigo do Erro: '.$ex->getCode());
                }
                $this->redirect()->toUrl('/admin/post/index');
            }
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        
    }
}