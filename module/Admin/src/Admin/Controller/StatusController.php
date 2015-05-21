<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Core\Form\Busca as Busca;
use Admin\Form\Status as Form;
use Admin\Validator\Status as Validacao;
use Zend\View\Model\ViewModel;

class StatusController extends ActionController
{
    public function indexAction()
    {
        $busca = new Busca();
        if ($this->getRequest()->isPost()) {
            $search = $this->getRequest()->getPost();
            $busca->setData($search);
            if ($busca->isValid()) {
                $dados = $busca->getData();
            }
        }
        $result = $this->getService('Admin\Service\Status')->fetchAll($dados);
        return new ViewModel(array(
            'busca' => $busca,
            'dados' => $result,
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
                    $this->getService('Admin\Service\Status')->saveStatus($dados);
                    $this->flashMessenger()->addSuccessMessage('Status salvo com sucesso.');
                } catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('Erro ao salvar status. Codigo do Erro: '.$ex->getCode());
                }
                $this->redirect()->toUrl('/admin/status');
            }
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if($id > 0){
            $form = $this->getService('Admin\Service\Status')->populate($id,$form);
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if($id > 0){
            try {
                $this->getService('Admin\Service\Status')->deleteStatus($id);
                $this->flashMessenger()->addSuccessMessage('Status deletado com sucesso.');
            } catch (\Exception $ex) {
                $this->flashMessenger()->addErrorMessage('O status não pode ser deletado, por favor tente mais tarde.');
            }
        }
        $this->redirect()->toUrl('/admin/status');
    }
}