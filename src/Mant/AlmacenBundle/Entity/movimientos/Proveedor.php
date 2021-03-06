<?php

namespace Mant\AlmacenBundle\Entity\movimientos;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Proveedor
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\movimientos\ProveedorRepository")
 */
class Proveedor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="razonSocial", type="string", length=255)
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")  
     */
    private $razonSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="cuit", type="string", length=255)
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")  
     */
    private $cuit;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;
    
    /**
    * @ORM\ManyToOne(targetEntity="Mant\AlmacenBundle\Entity\Almacen") 
    * @ORM\JoinColumn(name="id_almacen", referencedColumnName="id")
    * @Assert\NotBlank(message="El campo no puede permanecer en blanco!")     
    */   
    private $deposito;        


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
     * @return Proveedor
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
     * Set cuit
     *
     * @param string $cuit
     * @return Proveedor
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
     * Set direccion
     *
     * @param string $direccion
     * @return Proveedor
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
    
    public function __toString(){
        return $this->razonSocial;
    }

    /**
     * Set deposito
     *
     * @param \Mant\AlmacenBundle\Entity\Almacen $deposito
     * @return Proveedor
     */
    public function setDeposito(\Mant\AlmacenBundle\Entity\Almacen $deposito = null)
    {
        $this->deposito = $deposito;

        return $this;
    }

    /**
     * Get deposito
     *
     * @return \Mant\AlmacenBundle\Entity\Almacen 
     */
    public function getDeposito()
    {
        return $this->deposito;
    }
}
