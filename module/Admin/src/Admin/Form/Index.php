<?php

namespace Admin\Form;

use Zend\Form\Form as Form;

class Index extends Form
{
    public function __construct() {
        parent::__construct('index');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');    
        
        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden'
        ));
        
        $this->add(array(
            'name' => 'usuario',
            'type' => 'text',
            'options' => array(
                'label' => 'E-mail '
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'usuario',
                'placeholder' => 'seunome@dominio.com.br',
            ),
        ));
        
        $this->add(array(
            'name' => 'senha',
            'type' => 'password',
            'options' => array(
                'label' => 'Senha '
            ),
            'attributes' => array(
                'class' => 'form-control',
                'id' => 'senha',
                'placeholder' => '**********'
            ),
        ));
        
        $this->add(array(
            'name' => 'entrar',
            'type' => 'Submit',
            'attributes' => array(
                'class' => 'btn btn-lg btn-success btn-block',
                'value' => 'Login >>',
            ),
        ));
    }
    
}
