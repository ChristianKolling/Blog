<?php

namespace Admin\Service;

use Core\Service\Service;
use Admin\Model\Usuario as Model;

class Usuario extends Service
{
    public function fetchAll()
    {
        $query = $this->getObjectManager()->createQueryBuilder()
                ->select('Usuario.id, Usuario.nome, Usuario.email, Usuario.data_nascimento as nascimento, Usuario.perfil')
                ->from('Admin\Model\Usuario','Usuario');
        return $query->getQuery()->getResult();
    }
    
    public function saveUsuario($dados)
    {
        if($dados['id'] > 0){
            $usuario = $this->getObjectManager()->find('Admin\Model\Usuario',$dados['id']);
        } else {
            $usuario = new Model();
        }
        
        $usuario->setNome($dados['nome']);
        $usuario->setEmail($dados['email']);
        $usuario->setPerfil($dados['perfil']);
        $usuario->setSenha(md5($dados['senha']));
        $usuario->setDataNascimento(new \DateTime($dados['nascimento']));
        $this->getObjectManager()->persist($usuario);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            throw new \Exception('Erro ao salvar, tente novamente mais tarde.');
        }
    }
    
    public function populate($id, $form)
    {
        $usuario = $this->getObjectManager()->find('Admin\Model\Usuario',$id);
        $form->get('id')->setValue($usuario->getId());
        $form->get('nome')->setValue($usuario->getNome());
        $form->get('email')->setValue($usuario->getEmail());
        $form->get('perfil')->setValue($usuario->getPerfil());
        $form->get('nascimento')->setValue($usuario->getDataNascimento()->format('d-m-Y'));
        return $form;
    }
    
    public function deleteUsuario($id)
    {
        $usuario = $this->getObjectManager()->find('Admin\Model\Usuario',$id);
        $this->getObjectManager()->remove($usuario);
        try {
            $this->getObjectManager()->flush();
        } catch (\Exception $ex) {
            throw new \Exception('Este registro não pode ser excluido, por favor tente mais tarde.');
        }
    }
}