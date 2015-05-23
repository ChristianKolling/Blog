<?php

namespace Main\Service;

use Core\Service\Service;
use Admin\Model\Comentario as Model;

class Comentario extends Service
{
    public function saveComentario($dados,$idPost)
    {
        $comentario = new Model();
        $comentario->setNome($dados['nome']);
        $comentario->setEmail($dados['email']);
        $comentario->setPost($this->getObjectManager()->find('Admin\Model\Post',$idPost));
        $comentario->setComentario($dados['comentario']);
        $comentario->setDataComentario(new \DateTime('now'));
        $this->getObjectManager()->persist($comentario);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $exc) {
            throw new \Exception('Erro ao salvar comentário');
        }
    }
    
    public function getComentarios($id)
    {
        $select = $this->getObjectManager()->createQueryBuilder()
                ->select('Comentario.id,Comentario.nome,Comentario.email,Comentario.comentario, Comentario.data_comentario as data')
                ->from('Admin\Model\Comentario','Comentario')
                ->join('Comentario.post','Post')
                ->orderBy('Comentario.data_comentario','ASC')
                ->where('Post.id = '.$id.'');
        return $select->getQuery()->getResult();
    }
}