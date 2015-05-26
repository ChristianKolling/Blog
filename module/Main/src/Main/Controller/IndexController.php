<?php

namespace Main\Controller;

use Core\Controller\ActionController;
use Zend\View\Model\ViewModel;
use Main\Form\Comentario as ComentarioForm;
use Main\Validator\Comentario as Validacao;
use Core\Form\Busca as BuscaForm;

class IndexController extends ActionController 
{
    public function indexAction()
    {
        $buscaForm = new BuscaForm();
        if ($this->getRequest()->isPost()) {
            $search = $this->getRequest()->getPost();
            $buscaForm->setData($search);
            if ($buscaForm->isValid()) {
                $dados = $buscaForm->getData();
            }
        }
        $posts = $this->getService('Main\Service\Index')->getPosts($dados);
        return new ViewModel(array(
            'posts' => $posts,
            'busca' => $buscaForm,
        ));
    }
    
    public function verAction()
    {
        $id = $this->params()->fromRoute('id',0);
        $form = new ComentarioForm();
        $validacao = new Validacao();
        $postagem = $this->getObjectManager()->getRepository('\Admin\Model\Post')->findOneBy(array(
            'id' => $id
        ));
        $comentarios = $this->getService('Main\Service\Comentario')->getComentarios($id);
        if ($this->getRequest()->isPost()){
            $form->setInputFilter($validacao->getInputFilter());
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()){  
                $dados = $form->getData();
                try {
                    $this->getService('Main\Service\Comentario')->saveComentario($dados,$id);
                    $this->flashMessenger()->addSuccessMessage('Obrigado por seu comentário.');
                } catch (\Exception $ex) {
                    $this->flashMessenger()->addErrorMessage('Erro durante comentário. Codigo do Erro: '.$ex->getCode());
                }
                $this->redirect()->toUrl('/main/index/ver/id/'.$id);
            }
        }
        return new ViewModel(array(
            'form' => $form,    
            'publicacao' => $postagem,
            'comentarios' => $comentarios,
        ));
    }
}
