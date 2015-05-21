<?php

namespace Admin\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="usuario")
 */

class Usuario
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * 
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50)
     * 
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * 
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", length=100)
     * 
     */
    protected $senha;
    
    /**
     * @ORM\Column(type="datetime")
     * 
     */
    protected $data_nascimento;
    
    /**
     * @ORM\Column(type="string", length=50)
     * 
     */
    protected $perfil;
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getEmail() {
        return $this->email;
    }

    function getDataNascimento() {
        return $this->data_nascimento;
    }

    function getPerfil() {
        return $this->perfil;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setDataNascimento($data_nascimento) {
        $this->data_nascimento = $data_nascimento;
    }

    function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    function getSenha() {
        return $this->senha;
    }

    function setSenha($senha) {
        $this->senha = $senha;
    }

}
