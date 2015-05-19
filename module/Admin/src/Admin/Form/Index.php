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
            'name' => 'nome',
            'type' => 'text',
            'options' => array(
                'label' => 'Nome de Usuário'
            ),
            'attributes' => 0,array(
                'id' => 'nome',
                'class' => 'nome',
            ),
        ));
        
        $this->add(array(
            'name' => 'entrar',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Entrar',
            ),
        ));
    }
    
}
