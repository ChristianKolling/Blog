<?php

namespace Main\Service;

use Core\Service\Service;

class Index extends Service
{
    public function getPosts($search = null)
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Post.id, Post.titulo, Post.mini_text as mini, Post.post_completo as completo, Post.data_cadastro as data')
                ->from('\Admin\Model\Post','Post')
                ->orderBy('data','ASC')
                ->where('Post.status = 1 AND (Post.titulo LIKE ?1 OR Post.mini_text LIKE ?1 OR Post.post_completo LIKE ?1)')
                ->setParameters(array(1 => "%" . $search['search'] . "%"));
        return $query->getQuery()->getArrayResult();
    }
}