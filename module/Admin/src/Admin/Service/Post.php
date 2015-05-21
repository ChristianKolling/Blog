<?php

namespace Admin\Service;

use Core\Service\Service;
use Admin\Model\Post as Model;

class Post extends Service
{
    public function fetchAll($search = null)
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Post.id, Post.titulo, Post.mini_text, Post.post_completo, Post.data_cadastro')
                ->from('Admin\Model\Post','Post')
                ->orderBy('Post.data_cadastro', 'ASC')
                ->where('Post.titulo LIKE ?1 OR Post.post_completo LIKE ?1')
                ->setParameters(array(1 => "%" . $search['search'] . "%"));
        return $query->getQuery()->getResult();
    }

    public function savePost($dados)
    {
        if ($dados['id'] != 0) {
            $post = $this->getObjectmanager()->find('Admin\Model\Post', $dados['id']);
        } else {
            $post = new Model();
        }
        $post->setTitulo($dados['titulo']);
        $post->setPostCompleto($dados['postagem']);
        $post->setMiniText($dados['postagem']);
        $post->setStatus($this->getObjectManager()->find('Admin\Model\Status',$dados['status']));
        $post->setDataCadastro(new \DateTime($dados['data_publicacao']));
        $post->setUsuario($this->getObjectManager()->find('Admin\Model\Usuario',1));
        $this->getObjectManager()->persist($post);
        try {
            $this->getObjectManager()->flush();
        } catch (Exception $ex) {
            throw new \Exception('Erro ao Salvar, tente novamente mais tarde.');
        }
    }
    
    public function populate($id,$form){
        $post = $this->getObjectManager()->find('Admin\Model\Post',$id);
        $form->get('id')->setValue($post->getId());
        $form->get('titulo')->setValue($post->getTitulo());
        $form->get('postagem')->setValue($post->getPostCompleto());
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
