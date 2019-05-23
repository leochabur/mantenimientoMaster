<?php

namespace Mant\AlmacenBundle\Entity\gestion;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empleador
 *
 * @ORM\Table(name="empleadores")
 * @ORM\Entity
 */
class Empleador
{
    /**
     * @var bigint
     *
     * @ORM\Column(name="id", type="bigint", options={"unsigned":true})
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Estructura")
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_estructura", referencedColumnName="id")
     * })
     */    
    private $estructura;    
    
    /**
     * @var string
     *
     * @ORM\Column(name="razon_social", type="string", length=100)
     */
    private $razonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=100)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit_cuil", type="string", length=20)
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=45)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="www", type="string", length=45)
     */
    private $www;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    private $activo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=45)
     */
    private $color;
    
    /**
     * @var string
     *
     * @ORM\Column(name="usr", type="string", length=45)
     */
    private $usr;
    
    /**
     * @var string
     *
     * @ORM\Column(name="pwd", type="string", length=45)
     */
    private $pwd;    
    
  


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set razonSocial
     *
     * @param string $razonSocial
     * @return Empleador
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razonSocial = $razonSocial;

        return $this;
    }

    /**
     * Get razonSocial
     *
     * @return string 
     */
    public function getRazonSocial()
    {
        return $this->razonSocial;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Empleador
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set cuit
     *
     * @param string $cuit
     * @return Empleador
     */
    public function setCuit($cuit)
    {
        $this->cuit = $cuit;

        return $this;
    }

    /**
     * Get cuit
     *
     * @return string 
     */
    public function getCuit()
    {
        return $this->cuit;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Empleador
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return Empleador
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set www
     *
     * @param string $www
     * @return Empleador
     */
    public function setWww($www)
    {
        $this->www = $www;

        return $this;
    }

    /**
     * Get www
     *
     * @return string 
     */
    public function getWww()
    {
        return $this->www;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     * @return Empleador
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return Empleador
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set usr
     *
     * @param string $usr
     * @return Empleador
     */
    public function setUsr($usr)
    {
        $this->usr = $usr;

        return $this;
    }

    /**
     * Get usr
     *
     * @return string 
     */
    public function getUsr()
    {
        return $this->usr;
    }

    /**
     * Set pwd
     *
     * @param string $pwd
     * @return Empleador
     */
    public function setPwd($pwd)
    {
        $this->pwd = $pwd;

        return $this;
    }

    /**
     * Get pwd
     *
     * @return string 
     */
    public function getPwd()
    {
        return $this->pwd;
    }

    /**
     * Set estructura
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Estructura $estructura
     * @return Empleador
     */
    public function setEstructura(\Mant\AlmacenBundle\Entity\gestion\Estructura $estructura = null)
    {
        $this->estructura = $estructura;

        return $this;
    }

    /**
     * Get estructura
     *
     * @return \Mant\AlmacenBundle\Entity\gestion\Estructura 
     */
    public function getEstructura()
    {
        return $this->estructura;
    }
    
    public function __toString()
    {
        return (string)$this->razonSocial;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return Empleador
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
