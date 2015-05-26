<?php

namespace Admin\Form;

use Zend\Form\Form as Form;

class Post extends Form 
{

    public function __construct($objectManager) 
    {
        parent::__construct('novo');
        $this->setAttribute('method', 'post');
        $this->setAttribute('action', '');

        $this->add(array(
            'name' => 'id',
            'type' => 'Hidden',
        ));

        $this->add(array(
            'name' => 'titulo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Título',
            ),
            'attributes' => array(
                'id' => 'titulo',
                'class' => 'form-control input-lg',
                'placeholder' => 'Título da Publicação',
            ),
        ));
        
        $this->add(array(
            'name' => 'resumo',
            'type' => 'Text',
            'options' => array(
                'label' => 'Resumo da Publicação',
            ),
            'attributes' => array(
                'id' => 'resumo',
                'class' => 'form-control input-lg',
                'placeholder' => 'Um pequeno resumo sobre a publicação',
            ),
        ));

        $this->add(array(
            'name' => 'postagem',
            'type' => 'textarea',
            'options' => array( 
                'label' => 'Descrição da Postagem',
            ),
            'attributes' => array(
                'id' => 'postagem',
                'class' => 'form-control input-lg',
                'placeholder' => 'Descreva aqui o conteúdo do post',
                'rows' => '10',
            ),
        ));
        
        $this->add(
                array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'status',
                    'options' => array(
                        'disable_inarray_validator' => true,
                        'empty_opttion' => 'Selecione um Status',
                        'label' => 'Status',
                        'object_manager' => $objectManager,
                        'target_class' => 'Admin\Model\Status',
                        'property' => 'descricao',
                        'is_method' => true,
                        'find_method' => array(
                            'name' => 'findBy',
                            'params' => array(
                                'criteria' => array(),
                                'orderBy' => array('descricao' => 'ASC'),
                            ),
                        ),
                    ),
                    'attributes' => array(
                        'id' => 'status',
                        'class' => 'form-control input-lg',
                    ),
                )
        );

        $this->add(array(
            'name' => 'data_publicacao',
            'type' => 'Text',
            'options' => array(
                'label' => 'Data de Publicação',
            ),
            'attributes' => array(
                'id' => 'data_publicacao',
                'class' => 'form-control input-lg',
                'readonly' => true,
                'value' => date('d-m-Y')
            ),
        ));
        
        $this->add(array(
            'name' => 'publicar',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Publicar',
                'class' => 'btn btn-success',
            ),
        ));
    }

}
