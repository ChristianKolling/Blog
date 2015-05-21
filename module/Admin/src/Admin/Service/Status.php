<?php

namespace Admin\Service;

use Core\Service\Service;
use Admin\Model\Status as Model;

class Status extends Service
{
    public function fetchAll($search = null)
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Status.id,Status.descricao')
                ->from('Admin\Model\Status','Status')
                ->orderBy('Status.descricao','ASC')
                ->where('Status.descricao LIKE ?1')
                ->setParameters(array(1 => "%" . $search['search'] . "%"));
        return $query->getQuery()->getResult();
    }
    
    public function saveStatus($dados)
    {
        if ($dados['id'] > 0){
            $status = $this->getObjectManager()->find('Admin\Model\Status',$dados['id']);
        }  else {
            $status = new Model();
        }
        $status->setDescricao($dados['descricao']);
        $this->getObjectManager()->persist($status);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            throw new \Exception('Erro ao salvar, tente novamente mais tarde.'); 
        }
    }
    
    public function populate($id,$form)
    {
        $status = $this->getObjectManager()->find('Admin\Model\Status',$id);
        $form->get('id')->setValue($status->getId());
        $form->get('descricao')->setValue($status->getDescricao());
        return $form;
    }
    
    public function deleteStatus($id)
    {
        $status = $this->getObjectManager()->find('Admin\Model\Status', $id);
        $this->getObjectManager()->remove($status);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            throw new \Exception('O registro não pode ser excluido, por favor tente mais tarde.');
        }
    }
}