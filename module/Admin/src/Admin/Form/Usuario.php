<?php

namespace Admin\Form;

use Zend\Form\Form as Form;

class Usuario extends Form 
{

    public function __construct() 
    {
        parent::__construct('usuario');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array(
                'label' => 'Nome ',
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control input-lg',
                'placeholder' => 'Informe seu nome',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'text',
            'options' => array( 
                'label' => 'E-mail',
            ),
            'attributes' => array(
                'id' => 'email',
                'class' => 'form-control input-lg',
                'placeholder' => 'nome@dominio.com.br',
            ),
        ));
        
        $this->add(array(
            'name' => 'senha',
            'type' => 'password',
            'options' => array(
                'label' => 'Senha ',
            ),
            'attributes' => array(
                'id' => 'senha',
                'class' => 'form-control input-lg',
                'placeholder' => '**********',
            ),
        ));
        
        $this->add(array(
            'name' => 'nascimento',
            'type' => 'Text',
            'options' => array(
                'label' => 'Data de Nascimento',
            ),
            'attributes' => array(
                'id' => 'nascimento',
                'class' => 'form-control input-lg',
                'placeholder' => 'Dia-Mês-Ano',
            ),
        ));
        
        $this->add(array(
            'name' => 'perfil',
            'type' => 'Text',
            'options' => array(
                'label' => 'Perfil',
            ),
            'attributes' => array(
                'id' => 'perfil',
                'class' => 'form-control input-lg',
                'placeholder' => 'Admin',
            ),
        ));
        
        $this->add(array(
            'name' => 'salvar',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-success',
            ),
        ));
    }

}
