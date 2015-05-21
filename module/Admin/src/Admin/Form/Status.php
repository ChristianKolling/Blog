<?php

namespace Admin\Form;

use Zend\Form\Form as Form;

class Status extends Form 
{

    public function __construct() 
    {
        parent::__construct('status');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'descricao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Descrição',
            ),
            'attributes' => array(
                'id' => 'descricao',
                'class' => 'form-control input-lg',
                'placeholder' => 'Descreva o status',
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
