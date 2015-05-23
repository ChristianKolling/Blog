<?php

namespace Main\Form;

use Zend\Form\Form as Form;

class Comentario extends Form 
{

    public function __construct() 
    {
        parent::__construct('comentario');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'comentario');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'nome',
            'type' => 'Text',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'id' => 'nome',
                'class' => 'form-control',
                'placeholder' => 'Seu nome',
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'type' => 'Text',
            'options' => array(
                'label' => '',
            ),
            'attributes' => array(
                'id' => 'email',
                'class' => 'form-control',
                'placeholder' => 'Seu E-mail',
            ),
        ));
        
        $this->add(array(
            'name' => 'comentario',
            'type' => 'Textarea',
            'options' => array(
                'label' => ' ',
            ),
            'attributes' => array(
                'id' => 'comentario',
                'class' => 'form-control',
                'placeholder' => 'Deixe seu comentário',
            ),
        ));
        
        $this->add(array(
            'name' => 'publicar',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Publicar',
                'class' => 'btn btn-primary btn-sm',
            ),
        ));
    }

}
