<?php

namespace Admin\Service;

use Core\Service\Service;

class Comentario extends Service
{
    public function fetchAll($search = null)
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Post.titulo, Comentario.id,Comentario.nome,Comentario.email,Comentario.comentario,Comentario.data_comentario')
                ->from('Admin\Model\Comentario','Comentario')
                ->join('Comentario.post','Post')
                ->where('Comentario.nome LIKE ?1 OR Comentario.email LIKE ?1 OR Post.titulo LIKE ?1')
                ->setParameter(1,"%".$search['search']."%");
        return $query->getQuery()->getResult();
    }
    
    public function deleteComentario($id)
    {
        $comentario = $this->getObjectManager()->find('Admin\Model\Comentario', $id);
        $this->getObjectManager()->remove($comentario);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            throw new \Exception('O registro não pode ser excluido, por favor tente mais tarde.');
        }
    }
}