<?php

namespace Admin\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;

class ComentariosController extends ActionController
{
    public function indexAction() 
    {
        $comentarios = $this->getService('Admin\Service\Comentario')->fetchAll();
        return new ViewModel(array(
            'comentarios' => $comentarios
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