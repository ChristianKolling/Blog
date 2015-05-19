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
    protected $email;
    
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


}