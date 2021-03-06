<?php

namespace Mant\AlmacenBundle\Entity\gestion;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoUnidad
 *
 * @ORM\Table(name="tipounidad")
 * @ORM\Entity
 */
class TipoUnidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Estructura")
     * @ORM\Id 
     * @ORM\JoinColumns({
     *      @ORM\JoinColumn(name="id_estructura", referencedColumnName="id")
     * })
     */    
    private $estructura;    
    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=45)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden_capacidad", type="integer", nullable=true)
     */
    private $ordenCapacidad;
    



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
     * Set tipo
     *
     * @param string $tipo
     * @return TipoUnidad
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set ordenCapacidad
     *
     * @param integer $ordenCapacidad
     * @return TipoUnidad
     */
    public function setOrdenCapacidad($ordenCapacidad)
    {
        $this->ordenCapacidad = $ordenCapacidad;

        return $this;
    }

    /**
     * Get ordenCapacidad
     *
     * @return integer 
     */
    public function getOrdenCapacidad()
    {
        return $this->ordenCapacidad;
    }

    /**
     * Set id
     *
     * @param integer $id
     * @return TipoUnidad
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function __toString()
    {
        return $this->tipo;
    }

    /**
     * Set estructura
     *
     * @param \Mant\AlmacenBundle\Entity\gestion\Estructura $estructura
     * @return TipoUnidad
     */
    public function setEstructura(\Mant\AlmacenBundle\Entity\gestion\Estructura $estructura)
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
}
