<?php

namespace Admin\Service;

use Core\Service\Service;
use Admin\Model\Post as Model;

class Post extends Service
{
    public function fetchAll()
    {
        $query = $this->getObjectManager()->getRepository('Admin\Model\Post')
                ->createQueryBuilder('Post');
        return $query;
    }

    public function savePost($dados)
    {
        if ($dados['id'] != 0) {
            $post = $this->getObjectmanager()->find('Admin\Model\Post', $dados['id']);
        } else {
            $post = new Model();
        }
        $post->setTitulo(mb_strtoupper($dados['titulo'],'UTF-8'));
        $post->setPostCompleto($dados['postagem']);
        $post->setMiniText($dados['resumo']);
        $post->setStatus($this->getObjectManager()->find('Admin\Model\Status',$dados['status']));
        $post->setDataCadastro(new \DateTime('now'));
        $post->setUsuario($this->getObjectManager()->find('Admin\Model\Usuario',1));
        $this->getObjectManager()->persist($post);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            var_dump($ex->getMessage());exit;
            throw new \Exception('Erro ao Salvar, tente novamente mais tarde.');
        }
    }
    
    public function populate($id,$form){
        $post = $this->getObjectManager()->find('Admin\Model\Post',$id);
        $form->get('id')->setValue($post->getId());
        $form->get('titulo')->setValue($post->getTitulo());
        $form->get('postagem')->setValue($post->getPostCompleto());
        $form->get('resumo')->setValue($post->getMiniText());
        $form->get('status')->setValue($post->getStatus());
        $form->get('data_publicacao')->setValue($post->getDataCadastro()->format('d-m-Y'));
        return $form;
    }

    public function deletePost($id)
    {
        $post = $this->getObjectManager()->find('Admin\Model\Post', $id);
        $this->getObjectManager()->remove($post);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            throw new \Exception('O registro não pode ser excluido, por favor tente mais tarde.');
        }
    }
}
