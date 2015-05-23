<?php

namespace Main\Service;

use Core\Service\Service;

class Index extends Service
{
    public function getPosts()
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Post.id,Post.titulo,Post.mini_text as mini, Post.post_completo as completo, Post.data_cadastro as data')
                ->from('\Admin\Model\Post','Post');
        return $query->getQuery()->getArrayResult();
    }
}