<?php

namespace Admin\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */

class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * 
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     */
    protected $titulo;
    
    /**
     * @ORM\Column(type="string", length=200)
     * 
     */
    protected $mini_text;
    
    /**
     * @ORM\Column(type="text", length=20000)
     * 
     */
    protected $post_completo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     *
     */
    protected $usuario;

    /**
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status", referencedColumnName="id")
     *
     */
    protected $status;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    protected $data_cadastro;
    
    function getId() {
        return $this->id;
    }

    function getTitulo() {
        return $this->titulo;
    }

    function getMiniText() {
        return $this->mini_text;
    }

    function getPostCompleto() {
        return $this->post_completo;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function getStatus() {
        return $this->status;
    }

    function getDataCadastro() {
        return $this->data_cadastro;
    }

    function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    function setMiniText($mini_text) {
        $this->mini_text = $mini_text;
    }

    function setPostCompleto($post_completo) {
        $this->post_completo = $post_completo;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setDataCadastro($data_cadastro) {
        $this->data_cadastro = $data_cadastro;
    }

}