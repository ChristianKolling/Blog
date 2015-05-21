<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Core\Form\Busca as Busca;
use Admin\Form\Usuario as Form;
use Admin\Validator\Usuario as Validacao;

class UsuariosController extends ActionController
{
    public function indexAction()
    {
        $busca = new Busca();
        
        $result = $this->getService('Admin\Service\Usuario')->fetchAll();   
        return new ViewModel(array(
            'dados' => $result,
            'busca' => $busca
        ));
    }
    
    public function novoAction()
    {
        $form = new Form();
        $validacao = new Validacao();
        if ($this->getRequest()->isPost()){
            $form->setInputFilter($validacao->getInputFilter());
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                $dados = $form->getData();
                try {
                    $this->getService('Admin\Service\Usuario')->saveUsuario($dados);
                    $this->flashMessenger()->addSuccessMessage('Usuário cadastrado com sucesso.');
                } catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('Erro ao cadastrar usuário. Codigo do Erro: '.$ex->getCode());
                }
                $this->redirect()->toUrl('/admin/usuarios');
            }
        }
        $id = $this->params()->fromRoute('id',0);
        if($id > 0){
            $this->getService('Admin\Service\Usuario')->populate($id,$form);
        }
        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id',0);
        if($id > 0){
            try {
                $this->getService('Admin\Service\Usuario')->deleteUsuario($id);
                $this->flashMessenger()->addSuccessMessage('Usuário deletado com sucesso.');
            } catch (\Exception $ex) {
                $this->flashMessenger()->addErrorMessage('O usuário não pode ser excluido, por favor tente mais tarde.');
            }
            $this->redirect()->toUrl('/admin/usuarios');
        }
    }
}