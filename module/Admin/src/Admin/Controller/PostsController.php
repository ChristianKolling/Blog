<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Adapter;
use Admin\Form\Post as Form;
use Admin\Validator\Post as Validacao;
use Core\Form\Busca as Busca;

class PostsController extends ActionController
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
        $collection = new ArrayCollection($this->getService('Admin\Service\Post')->fetchAll($dados));
        $paginator = new Paginator(new Adapter($collection));
        $paginator->setCurrentPageNumber($this->params()->fromQuery('page', 1))
                  ->setItemCountPerPage(5);
        return new ViewModel(array(
            'busca' => $busca,
            'paginator' => $paginator
        ));
    }

    public function novoAction()
    {
        $form = new Form($this->getObjectManager());
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
                    $this->flashMessenger()->addErrorMessage('Erro ao salvar publicação. Codigo do Erro: '.$ex->getCode());
                }
                $this->redirect()->toUrl('/admin/posts');
            }
        }
        $id = (int) $this->params()->fromRoute('id',0);
        if($id > 0){
            $form = $this->getService('Admin\Service\Post')->populate($id,$form);
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
                $this->getService('Admin\Service\Post')->deletePost($id);
                $this->flashMessenger()->addSuccessMessage('Publicação deletada com sucesso.');
            } catch (\Exception $ex) {
                $this->flashMessenger()->addErrorMessage('A publicação não pode ser deletada, por favor tente mais tarde.');
            }
        }
        $this->redirect()->toUrl('/admin/posts');
    }
}