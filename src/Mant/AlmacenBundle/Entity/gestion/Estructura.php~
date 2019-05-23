<?php

namespace Mant\AlmacenBundle\Entity\gestion;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estructura
 *
 * @ORM\Table(name="estructuras")
 * @ORM\Entity(repositoryClass="Mant\AlmacenBundle\Entity\gestion\EstructuraRepository")
 */
class Estructura
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_cond", type="integer")
     */
    private $cantidadConductores;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Estructura
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Estructura
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
     * Set cantidadConductores
     *
     * @param integer $cantidadConductores
     * @return Estructura
     */
    public function setCantidadConductores($cantidadConductores)
    {
        $this->cantidadConductores = $cantidadConductores;

        return $this;
    }

    /**
     * Get cantidadConductores
     *
     * @return integer 
     */
    public function getCantidadConductores()
    {
        return $this->cantidadConductores;
    }
}
