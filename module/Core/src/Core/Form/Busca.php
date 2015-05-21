<?php

namespace Core\Form;

use Zend\Form\Form as Form;

class Busca extends Form 
{

    public function __construct() 
    {
        parent::__construct('busca');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'search',
            'type' => 'Text',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'id' => 'search',
                'class' => 'form-control input-group-lg',
                'placeholder' => 'Pesquisar',
            ),
        ));
    }

}
