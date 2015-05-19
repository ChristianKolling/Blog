<?php

namespace Admin\Service;

use Core\Service\Service;
use Admin\Model\Post as Model;

class Post extends Service
{
    public function fetchAll()
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Post.id, Post.titulo, Post.mini_text, Post.post_completo, Post.data_cadastro')
                ->from('Admin\Model\Post','Post');
        return $query->getQuery()->getResult();
    }

    public function savePost($dados)
    {
        $post = new Model();
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
}