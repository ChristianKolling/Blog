<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Admin\Form\Post as Form;
use Admin\Validator\Post as Validacao;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

class PostController extends ActionController
{
    public function indexAction() 
    {
        $result = $this->getService('Admin\Service\Post')->fetchAll();
//        $paginator = new Paginator(
//                new DoctrinePaginator(new ORMPaginator($result))
//        );
//        $paginator->setCurrentPageNumber($this->params()->fromRoute('page'))
//        ->setItemCountPerPage(10);
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
        $id = (int) $this->params()->fromRoute('id', 0);
        if($id > 0){
            try {
                $this->getService('Admin\Service\Post')->deletePost($id);
                $this->flashMessenger()->addSuccessMessage('Publicação deletada com sucesso.');
            } catch (\Exception $ex) {
                $this->flashMessenger()->addErrorMessage('A publicação não pode ser deletada, por favor tente mais tarde.');
            }
        }
        $this->redirect()->toUrl('/admin/post');
    }
}