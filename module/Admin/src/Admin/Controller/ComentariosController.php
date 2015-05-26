<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineModule\Paginator\Adapter\Collection as Adapter;
use Core\Form\Busca as Busca;

class ComentariosController extends ActionController
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
        $collection = new ArrayCollection($this->getService('Admin\Service\Comentario')->fetchAll($dados));
        $paginator = new Paginator(new Adapter($collection));
        $paginator->setCurrentPageNumber($this->params()->fromQuery('page', 1))
                ->setItemCountPerPage(5);
        return new ViewModel(array(
            'busca' => $busca,
            'comentarios' => $paginator
        ));
    }
    
    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if($id > 0){
            try {
                $this->getService('Admin\Service\Comentario')->deleteComentario($id);
                $this->flashMessenger()->addSuccessMessage('Comentário deletado com sucesso.');
            } catch (\Exception $ex) {
                $this->flashMessenger()->addErrorMessage('O comentário não pode ser deletado, por favor tente mais tarde.');
            }
        }
        $this->redirect()->toUrl('/admin/comentarios');
    }
}