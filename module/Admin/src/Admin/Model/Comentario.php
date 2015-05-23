<?php

namespace Admin\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="comentario")
 */

class Comentario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * 
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Post")
     * @ORM\JoinColumn(name="post", referencedColumnName="id")
     *
     */
    protected $post;

    /**
     * @ORM\Column(type="string", length=100)
     * 
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="string", length=100)
     * 
     */
    protected $email;
    
    /**
     * @ORM\Column(type="text", length=3000)
     * 
     */
    protected $comentario;
    
    /**
     * @ORM\Column(type="datetime")
     * 
     */
    protected $data_comentario;
    
    function getId() {
        return $this->id;
    }

    function getPost() {
        return $this->post;
    }

    function getEmail() {
        return $this->email;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPost($post) {
        $this->post = $post;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getComentario() {
        return $this->comentario;
    }

    function setComentario($comentario) {
        $this->comentario = $comentario;
    }

    function getNome() {
        return $this->nome;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function getDataComentario() {
        return $this->data_comentario;
    }

    function setDataComentario($data_comentario) {
        $this->data_comentario = $data_comentario;
    }


}